<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Pengiriman;
use App\Models\DetailPesanan;
use App\Models\Ulasan;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class PembeliController extends Controller
{
     public function dashboard()
    {
        $produks = Produk::all();
        return view('pembeli.dashboardPembeli', compact('produks'));
    }
    public function cari(Request $request)
    {
        $keyword = $request->input('q');

        $produks = Produk::where('nama', 'like', '%' . $keyword . '%')->get();

        return view('pembeli.dashboard', compact('produks'));
    }
    public function keranjang()
    {
        $userId = Auth::id();
        $items = Keranjang::with('produk')
            ->where('user_id', $userId)
            ->get();

        return view('pembeli.keranjang', compact('items'));
    }
    public function detailProduk($id)
    {
        $produk = Produk::with([
            'pengguna',
            'ulasans' => function ($query) {
                $query->where('status', 'disetujui')->latest();
            },
            'ulasans.pengguna' // agar bisa menampilkan nama pembeli di view
        ])->findOrFail($id);

        return view('pembeli.detailProduk', compact('produk'));
    }

    
    public function pesananSaya()
    {
        $pesanans = Pesanan::with(['produk', 'pengiriman'])
            ->where('pengguna_id', Auth::id())
            ->latest()
            ->get();
            // dd($pesanans); 

        return view('pembeli.pesananSaya', compact('pesanans'));
    }

    public function konfirmasiDiterima($id)
    {
        $pengiriman = Pengiriman::where('pesanan_id', $id)->firstOrFail();
        $pengiriman->status = 'diterima';
        $pengiriman->save();

        return back()->with('success', 'Pesanan telah dikonfirmasi diterima.');
    }
    public function pesananSelesai($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->pengguna_id !== Auth::id()) {
            abort(403);
        }

        $pesanan->update(['status' => 'selesai']);

        return redirect()->route('pembeli.pesanan')->with('success', 'Pesanan telah dikonfirmasi selesai.');
    }

    public function riwayatPesananSaya()
{
    $pesanans = Pesanan::with([
        'detailPesanans.produk', 
        'pengiriman', 
        'produks' // relasi many-to-many dari pivot pesanan_produk
    ])
    ->where('pengguna_id', Auth::id())
    ->orderByDesc('created_at')
    ->get();

    return view('pembeli.riwayatPesanan', compact('pesanans'));
}


    public function tambahKeKeranjang(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $produkId = $request->input('produk_id');
        $jumlah = $request->input('jumlah', 1);

        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $produkId)
            ->first();

        if ($keranjang) {
            $keranjang->jumlah += $jumlah;
            $keranjang->save();
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $produkId,
                'jumlah' => $jumlah,
            ]);
        }

        return redirect()->route('pembeli.keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
    public function updateJumlahKeranjang(Request $request)
{
    $request->validate([
        'keranjang_id' => 'required|exists:keranjangs,id',
        'aksi' => 'required|in:tambah,kurang',
    ]);

    $keranjang = Keranjang::where('id', $request->keranjang_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $aksi = $request->aksi;

    if ($aksi == 'tambah') {
        // opsional: cek stok produk
        $keranjang->jumlah += 1;
    } elseif ($aksi == 'kurang') {
        $keranjang->jumlah -= 1;
    }

    if ($keranjang->jumlah <= 0) {
        $keranjang->delete();
    } else {
        $keranjang->save();
    }

    return redirect()->route('pembeli.keranjang')->with('success', 'Jumlah diperbarui.');
}

public function checkoutLangsung(Request $request)
{
    $pengguna = Auth::user();

    $produkIds = $request->input('produk_id');
    $jumlahs = $request->input('jumlah');

    // Validasi minimal 1 produk dipilih
    if (empty($produkIds)) {
        return redirect()->route('pembeli.keranjang')->with('error', 'Pilih minimal satu produk untuk checkout.');
    }

    // Normalisasi jika beli langsung (satu produk saja)
    if (!is_array($produkIds)) {
        $produkIds = [$produkIds];

        // Jika jumlah bukan array (dikirim sebagai angka), ubah ke bentuk array asosiatif
        $jumlahs = [$produkIds[0] => is_numeric($jumlahs) ? (int)$jumlahs : 1];
    }

    // Ambil produk dari database
    $produks = Produk::whereIn('id', $produkIds)->get();

    $dataCheckout = [];
    $grandTotal = 0;

    foreach ($produks as $produk) {
        $id = $produk->id;
        $jumlah = isset($jumlahs[$id]) ? (int)$jumlahs[$id] : 1;

        $subtotal = $produk->harga * $jumlah;
        $grandTotal += $subtotal;

        $dataCheckout[] = [
            'produk' => $produk,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal,
        ];
    }
    return view('pembeli.checkoutLangsung', compact('dataCheckout', 'grandTotal', 'pengguna'));
}

public function checkoutStore(Request $request) 
{
    $request->validate([
        'produk_id' => 'required|array',
        'jumlah' => 'required|array',
        'alamat' => 'required|string',
        'metode_pembayaran' => 'required|string',
    ]);

    $userId = Auth::id();
    $produkIds = $request->input('produk_id');
    $jumlahs = $request->input('jumlah');
    $alamat = $request->input('alamat');
    $metode = $request->input('metode_pembayaran');

    DB::beginTransaction();

    try {
        $grandTotal = 0;
        $detailData = [];
        $produkPivotData = [];

        foreach ($produkIds as $index => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlah = isset($jumlahs[$index]) ? (int)$jumlahs[$index] : 1;

            // ✅ Cek stok cukup
            if ($produk->stok < $jumlah) {
                throw new \Exception("Stok produk '{$produk->nama}' tidak mencukupi.");
            }

            $subtotal = $produk->harga * $jumlah;
            $grandTotal += $subtotal;

            // ✅ Kurangi stok
            $produk->decrement('stok', $jumlah);
            $produk->increment('terjual', $jumlah);

            // ✅ Simpan untuk detail_pesanans
            $detailData[] = [
                'produk_id' => $produkId,
                'jumlah' => $jumlah,
                'harga_satuan' => $produk->harga,
                'subtotal' => $subtotal,
            ];

            // ✅ Simpan untuk pivot pesanan_produk
            $produkPivotData[$produkId] = [
                'jumlah' => $jumlah,
                'harga_satuan' => $produk->harga,
                'subtotal' => $subtotal,
            ];
        }

        $pesanan = Pesanan::create([
            'produk_id' => null, // karena multi-produk
            'pengguna_id' => $userId,
            'total_harga' => $grandTotal,
            'status' => 'menunggu',
            'alamat' => $alamat,
            'metode_pembayaran' => $metode,
        ]);

        // ✅ Simpan ke tabel detail_pesanans
        foreach ($detailData as $detail) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $detail['produk_id'],
                'jumlah' => $detail['jumlah'],
                'harga_satuan' => $detail['harga_satuan'],
                'subtotal' => $detail['subtotal'],
            ]);
        }

        // ✅ Simpan ke pivot pesanan_produk
        $pesanan->produks()->attach($produkPivotData);

        // ✅ Hapus dari keranjang
        Keranjang::where('user_id', $userId)->whereIn('produk_id', $produkIds)->delete();

        DB::commit();

        return redirect()->back()->with('success', 'Checkout berhasil!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Checkout gagal. ' . $e->getMessage());
    }
}

   public function hapusKeranjang($id)
    {
        $item = Keranjang::findOrFail($id);

        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();

        return redirect()->route('pembeli.keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
    public function tampilFormPenjual()
    {
        return view('pembeli.formDaftarPenjual');
    }
    public function ajukanPenjual(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_wa' => 'required|string',
            'setuju' => 'accepted'
        ]);
/** @var \App\Models\Pengguna $user */
        $user = Auth::user(); // ambil user yang sedang login

        $user->nama_toko = $request->nama_toko;
        $user->alamat = $request->alamat;
        $user->no_wa = $request->no_wa;
        $user->verifikasi = 'menunggu'; // penting!
        $user->save();

        return redirect()->route('pembeli.dashboard')->with('success', 'Pengajuan berhasil dikirim!');
    }


    public function submitPenjual(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'setuju' => 'accepted',
        ]);

        $user = \App\Models\Pengguna::find(Auth::id());
        $user->nama_toko = $request->nama_toko;
        $user->alamat = $request->alamat;
        $user->no_wa = $request->no_wa;
        $user->verifikasi = 'menunggu';
        $user->save();

        return redirect()->route('pembeli.dashboard')->with('success', 'Pengajuan penjual telah dikirim.');
    }
    public function editProfil()
    {
        $pengguna = Auth::user();
        return view('pembeli.editProfil', compact('pengguna'));
    }
    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);
        /** @var \App\Models\Pengguna $pengguna */
        $pengguna = Auth::user();
        $pengguna->nama = $request->nama;      
        $pengguna->no_wa = $request->no_wa;      
        $pengguna->alamat = $request->alamat;
        $pengguna->save();

        return redirect()->route('pembeli.profil')->with('success', 'Profil berhasil diperbarui.');
    }
    public function formUlasan($produk_id, $pesanan_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $pesanan = Pesanan::findOrFail($pesanan_id);

        return view('pembeli.beriUlasan', compact('produk', 'pesanan'));
    }

    public function storeUlasan(Request $request)
    {
        $request->validate([
            'produk_id'   => 'required|exists:produks,id',
            'pesanan_id'  => 'required|exists:pesanans,id',
            'rating'      => 'required|integer|min:1|max:5',
            'komentar'    => 'required|string|max:1000',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('ulasan', 'public');
        }

        Ulasan::create([
            'pengguna_id' => Auth::id(),
            'produk_id'   => $request->produk_id,
            'pesanan_id'  => $request->pesanan_id,
            'rating'      => $request->rating,
            'komentar'    => $request->komentar,
            'gambar'      => $path,
            'status'      => 'menunggu',
        ]);

        return redirect()->route('pembeli.pesanan')->with('success', 'Ulasan berhasil dikirim dan menunggu persetujuan admin.');
    }

}
