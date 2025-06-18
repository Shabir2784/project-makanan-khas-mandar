<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use App\Models\Pesanan; 
use App\Models\Pengiriman;
use App\Models\Ulasan;

use App\Models\User;


class PenjualController extends Controller
{

    public function index()
    {
        return view('penjual.dashboardPenjual');
    }

     // 1. Menampilkan daftar produk milik penjual
    public function produkIndex(){
    $produks = Produk::where('pengguna_id', Auth::id())->get(); 
    return view('penjual.lihatProduk', compact('produks'));
    }

    // 2. Menampilkan form tambah produk
    public function produkCreate(){
        return view('penjual.tambahProduk'); 
    }

    public function produkStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = new Produk();
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->pengguna_id = Auth::id(); 
        
        if ($request->hasFile('gambar')) {
            $originalName = $request->file('gambar')->getClientOriginalName();
            $safeName = time() . '_' . str_replace(' ', '_', $originalName);
            Storage::disk('public')->putFileAs('images', $request->file('gambar'), $safeName);
            $produk->gambar = $safeName;
        }

        $produk->save();

        return redirect()->route('penjual.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function produkEdit($id){
        $produk = Produk::where('id', $id)->where('pengguna_id', Auth::id())->firstOrFail();
        
        return view('penjual.editProduk', compact('produk')); 
    }
     public function hapusProduk($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
    public function produkUpdate(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $produk->nama = $request->input('nama');
        $produk->harga = $request->input('harga');
        $produk->stok = $request->input('stok');
        $produk->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            if ($produk->gambar && Storage::disk('public')->exists('images/' . $produk->gambar)) {
                Storage::disk('public')->delete('images/' . $produk->gambar);
            }
            Storage::disk('public')->putFileAs('images', $file, $filename);
            $produk->gambar = $filename;
        }

        $produk->save();

        return redirect()->route('penjual.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }
    
    public function lihatPesanan()
    {
        $pesanans = Pesanan::with(['pengguna', 'detailPesanans.produk'])
            ->whereHas('detailPesanans.produk', function ($query) {
                $query->where('pengguna_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penjual.lihatPesanan', compact('pesanans'));
    }

    public function pesananProses()
    {
        $pesanans = Pesanan::with(['pengguna', 'detailPesanans.produk'])
            ->where('status', 'diproses')
            // ->whereHas('detailPesanans.produk', function ($query) {
            //     $query->where('pengguna_id', Auth::id());
            // })
            ->latest()
            ->get();

            // dd($pesanans);

        return view('penjual.pesananDiproses', compact('pesanans'));
    }
    public function konfirmasiPesanan($id)
    {
        $pesanan = Pesanan::with('pengguna')->findOrFail($id);

        // Ubah status pesanan
        $pesanan->status = 'diproses';
        $pesanan->save();

        //  dd($pesanan->alamat);

        // Buat pengiriman jika belum ada
        if (!$pesanan->pengiriman) {
            Pengiriman::create([
                'pesanan_id' => $pesanan->id,
                'nama_penerima' => $pesanan->pengguna->nama ?? 'Tanpa Nama',
                'alamat' => $pesanan->alamat ?? 'Alamat belum diisi', // ✅ Fix di sini
                'kota' => '-', // atau bisa tambahkan field kota jika ada
                'kurir' => '-',
                'kode_pos' => '-', // atau tambahkan jika ada input
                'status' => 'belum dikirim',
            ]);
        }

        return back()->with('success', 'Pesanan dikonfirmasi dan pengiriman dibuat.');
    }

    public function pesananRiwayat()
    {
        $pesanans = Pesanan::with(['pengguna', 'detailPesanans.produk'])
            ->where('status', 'selesai')
            ->whereHas('detailPesanans.produk', function ($query) {
                $query->where('pengguna_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('penjual.riwayatPesanan', compact('pesanans'));
    }
    public function formInputResi($id)
    {
        $pengiriman = Pengiriman::with('pesanan.pengguna')->findOrFail($id);
        return view('penjual.inputResi', compact('pengiriman'));
    }

    public function simpanResi(Request $request, $id)
    {
        $request->validate([
            'kurir' => 'required',
            'no_resi' => 'required',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update([
            'kurir' => $request->kurir,
            'no_resi' => $request->no_resi,
            'status' => 'dikirim',
        ]);

        return redirect()->route('penjual.pesanan.lihat')->with('success', 'Resi berhasil disimpan.');
    }

    public function pengirimanInputResi()
    {
        $pengirimans = Pengiriman::with('pesanan.pengguna')
            ->whereHas('pesanan.detailPesanans.produk', function ($q) {
                $q->where('pengguna_id', Auth::id());
            })
            ->get();

        return view('penjual.inputResi', compact('pengirimans'));
    }
    public function riwayatPengiriman()
    {
        $pengirimans = Pengiriman::with('pesanan.pengguna')
            ->whereNotNull('no_resi') // pastikan sudah diisi
            ->whereHas('pesanan', function ($q) {
                $q->where('status', 'Selesai'); // pastikan status pesanan = 'Selesai'
            })
            ->get();

        return view('penjual.riwayatPengiriman', compact('pengirimans'));
    }

    public function ulasanIndex()
    {
        $ulasans = Ulasan::with(['produk', 'pengguna'])
            ->whereHas('produk', function ($query) {
                $query->where('pengguna_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('penjual.lihatUlasan', compact('ulasans'));
    }

    public function ulasanTerbaru()
    {
        $ulasans = Ulasan::with(['produk', 'pengguna'])
            ->whereHas('produk', function ($query) {
                $query->where('pengguna_id', Auth::id());
            })
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->get();

        return view('penjual.ulasanTerbaru', compact('ulasans'));
    }
    public function pengirimanAktif()
    {
        $pengirimans = Pengiriman::with('pesanan.pengguna', 'pesanan.detailPesanans.produk')
            ->whereNotNull('no_resi') // sudah input resi
            ->whereHas('pesanan', function ($q) {
                $q->whereNotIn('status', ['Selesai']); // belum selesai
            })
            ->get();

        return view('penjual.lihatPengiriman', compact('pengirimans'));
    }
    public function profilGabung()
    {
        $pengguna = Auth::user();
        return view('penjual.profil', compact('pengguna')); // 🔁 gunakan view penjual/profil.blade.php
    }

    public function profilGabungUpdate(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_wa' => 'nullable|string|max:20',
            'password_lama' => 'nullable|string',
            'password_baru' => 'nullable|string|min:6|confirmed',
        ]);

        /** @var \App\Models\Pengguna $user */
        $user = Auth::user();

        // ✅ Update nama, alamat, no_wa
        $user->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
        ]);

        // 🔐 Jika user isi password baru
        if ($request->filled('password_lama') && $request->filled('password_baru')) {
            if (!Hash::check($request->password_lama, $user->password)) {
                return back()->withErrors(['password_lama' => 'Password lama salah'])->withInput();
            }

            $user->update([
                'password' => Hash::make($request->password_baru),
            ]);
        }

        return redirect()->route('penjual.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

}
