<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pengguna;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\DetailPesanan;
use App\Models\Pengiriman;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function produkIndex() {
        $produks = Produk::with('pengguna')->get(); // tambahkan relasi
        return view('admin.produk', compact('produks'));
    }

    public function hapusProduk($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
    
    public function penggunaIndex(){
        $penggunas = Pengguna::all();
        return view('admin.pengguna', compact('penggunas'));
    }
    public function editPengguna($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('admin.edit', compact('pengguna'));
    }

    // Simpan perubahan pengguna
    public function updatePengguna(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|in:admin,penjual,pembeli',
        ]);

        $pengguna = Pengguna::findOrFail($id);
        $pengguna->update($request->only('nama', 'email', 'role'));

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function hapusPengguna($id)
    {
        $pengguna = Pengguna::findOrFail($id);

       if (Auth::id() === $pengguna->id) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }
        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
    public function verifikasiPenjual()
    {
        $penggunas = Pengguna::where('verifikasi', 'menunggu')->where('role', 'pembeli')->get();
        return view('admin.verifikasi', compact('penggunas'));
    }

    public function pembayaranIndex(){
        $pembayarans = Pembayaran::with('pesanan.pengguna')->get();
        return view('admin.pembayaran', compact('pembayarans'));
    }
    public function transaksiIndex(){
        $transaksi = Pesanan::with('pengguna')->get();
        return view('admin.transaksi', compact('transaksi'));
    }

    public function laporanIndex(){
        $laporan = Pesanan::with('pengguna')->where('status', 'selesai')->get();
        return view('admin.laporan', compact('laporan'));
    }

    // ulasan
    public function ulasanIndex(){
        $ulasan = Ulasan::with(['pengguna', 'produk'])->where('status', 'menunggu')->get();
        return view('admin.ulasan', compact('ulasan'));
    }

    public function ulasanTerima($id){
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->status = 'disetujui';
        $ulasan->save();

        return redirect()->back()->with('success', 'Ulasan disetujui.');
    }

    public function ulasanTolak($id){
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->status = 'ditolak';
        $ulasan->save();

        return redirect()->back()->with('success', 'Ulasan ditolak.');
    }
    public function setujuiPenjual($id)
    {
        $user = Pengguna::findOrFail($id);
        $user->verifikasi = 'disetujui';
        $user->role = 'penjual';
        $user->save();

        return back()->with('success', 'Pengguna telah disetujui sebagai penjual.');
    }
    public function terimaVerifikasi($id)
    {
        $user = Pengguna::findOrFail($id);
        $user->verifikasi = 'disetujui';
        $user->role = 'penjual';
        $user->save();

        return back()->with('success', 'Penjual berhasil diverifikasi.');
    }

    public function tolakVerifikasi($id)
    {
        $user = \App\Models\Pengguna::findOrFail($id);
        $user->verifikasi = 'ditolak';
        $user->save();

        return back()->with('success', 'Pengajuan penjual ditolak.');
    }

    

}
