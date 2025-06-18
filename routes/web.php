<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Penjual\PenjualController;
use App\Http\Controllers\Pembeli\PembeliController;
use App\Http\Controllers\Auth\LoginController;
use Inertia\Inertia;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::middleware(['auth'])->get('/pembeli', function () {
    $produks = \App\Models\Produk::all();
    return view('pembeli.dashboardPembeli', compact('produks'));
})->name('pembeli.dashboard');


Route::prefix('admin')->name('admin.')->middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/produk', [AdminController::class, 'produkIndex'])->name('produk.index');
    Route::delete('produk/{id}', [AdminController::class, 'hapusProduk'])->name('produk.hapusProduk');
    Route::get('/pengguna', [AdminController::class, 'penggunaIndex'])->name('pengguna.index');
    Route::get('pengguna/{id}/edit', [AdminController::class, 'editPengguna'])->name('pengguna.edit');
    Route::put('pengguna/{id}', [AdminController::class, 'updatePengguna'])->name('pengguna.update');
    Route::delete('pengguna/{id}', [AdminController::class, 'hapusPengguna'])->name('pengguna.hapusPengguna');
    Route::get('/verifikasi-penjual', [AdminController::class, 'verifikasiPenjual'])->name('verifikasi.penjual');
    Route::get('/pembayaran', [AdminController::class, 'pembayaranIndex'])->name('pembayaran.index');
    Route::get('/transaksi', [AdminController::class, 'transaksiIndex'])->name('transaksi.index');
    Route::get('/laporan', [AdminController::class, 'laporanIndex'])->name('laporan');
    Route::get('/ulasan', [AdminController::class, 'ulasanIndex'])->name('ulasan');
    Route::post('/ulasan/terima/{id}', [AdminController::class, 'ulasanTerima'])->name('ulasan.terima');
    Route::post('/ulasan/tolak/{id}', [AdminController::class, 'ulasanTolak'])->name('ulasan.tolak');
    Route::post('/verifikasi/penjual/{id}/setujui', [AdminController::class, 'setujuiPenjual'])->name('setujuiPenjual');
    Route::post('/verifikasi/terima/{id}', [AdminController::class, 'terimaVerifikasi'])->name('verifikasi.terima');
    Route::post('/verifikasi/tolak/{id}', [AdminController::class, 'tolakVerifikasi'])->name('verifikasi.tolak');
});

Route::prefix('penjual')->name('penjual.')->middleware(['auth', 'penjualMiddleware'])->group(function () {
    Route::get('/dashboard', [PenjualController::class, 'index'])->name('dashboard');
    Route::get('/produk', [PenjualController::class, 'produkIndex'])->name('produk.index');
    Route::get('/produk/create', [PenjualController::class, 'produkCreate'])->name('produk.create');
    Route::post('/produk', [PenjualController::class, 'produkStore'])->name('produk.store');
    Route::get('/produk/{id}/edit', [PenjualController::class, 'produkEdit'])->name('produk.edit');
    Route::put('/produk/{id}', [PenjualController::class, 'produkUpdate'])->name('produk.update');
    Route::delete('/produk/{id}', [PenjualController::class, 'hapusProduk'])->name('produk.hapusProduk');
    Route::get('/pesanan', [PenjualController::class, 'lihatPesanan'])->name('pesanan.lihat');
    Route::put('/pesanan/{id}/konfirmasi', [PenjualController::class, 'konfirmasiPesanan'])->name('pesanan.konfirmasi');
    Route::get('/pesanan/proses', [PenjualController::class, 'pesananProses'])->name('pesanan.proses');
    Route::get('/pesanan/riwayat', [PenjualController::class, 'pesananRiwayat'])->name('pesanan.riwayat');
    Route::get('/pengiriman', [PenjualController::class, 'pengirimanAktif'])->name('pengiriman.index');
    Route::get('/pengiriman/input-resi', [PenjualController::class, 'pengirimanInputResi'])->name('pengiriman.input-resi');
    Route::get('/pengiriman/riwayat', [PenjualController::class, 'riwayatPengiriman'])->name('pengiriman.riwayat');
    Route::get('/ulasan', [PenjualController::class, 'ulasanIndex'])->name('ulasan.index');
    Route::get('/ulasan/terbaru', [PenjualController::class, 'ulasanTerbaru'])->name('ulasan.terbaru');
    Route::get('/profil', [PenjualController::class, 'profilGabung'])->name('profil.index');
    Route::put('/profil', [PenjualController::class, 'profilGabungUpdate'])->name('profil.updateGabung');
    Route::get('/pengiriman/{id}/input-resi', [PenjualController::class, 'formInputResi'])->name('pengiriman.inputResi');
    Route::post('/pengiriman/{id}/simpan-resi', [PenjualController::class, 'simpanResi'])->name('pengiriman.simpan-resi');
    
});

Route::prefix('pembeli')->name('pembeli.')->middleware(['auth', 'pembeliMiddleware'])->group(function () {
    Route::get('/dashboard', [PembeliController::class, 'dashboard'])->name('dashboard');
    Route::get('/produk/cari', [PembeliController::class, 'cari'])->name('produk.cari');
    Route::get('/keranjang', [PembeliController::class, 'keranjang'])->name('keranjang');
    Route::get('/produk/{id}', [PembeliController::class, 'detailProduk'])->name('produk.detail');
    Route::post('/keranjang/tambah', [PembeliController::class, 'tambahKeKeranjang'])->name('keranjang.tambah');
    Route::post('/keranjang/checkout', [PembeliController::class, 'checkoutKeranjang'])->name('keranjang.checkout');
    Route::get('/checkout/langsung', [PembeliController::class, 'checkoutLangsung'])->name('checkout.langsung');
    Route::post('/checkout/store', [PembeliController::class, 'checkoutStore'])->name('checkout.store');
    Route::post('/checkout', [PembeliController::class, 'checkoutStore'])->name('checkout.store');
    Route::delete('/keranjang/hapus/{id}', [PembeliController::class, 'hapusKeranjang'])->name('keranjang.hapus');
    Route::post('/keranjang/update-jumlah', [PembeliController::class, 'updateJumlahKeranjang'])->name('keranjang.updateJumlah');
    Route::get('/form-daftar-penjual', [PembeliController::class, 'tampilFormPenjual'])->name('formPenjual');
    Route::post('/ajukan-penjual', [PembeliController::class, 'ajukanPenjual'])->name('ajukanPenjual');
    Route::get('/pesanan', [PembeliController::class, 'pesananSaya'])->name('pesanan');
    Route::put('/pesanan/{id}/konfirmasi-diter ima', [PembeliController::class, 'konfirmasiDiterima'])->name('pesanan.konfirmasiDiterima');
    Route::put('/pesanan/{id}/selesai', [PembeliController::class, 'pesananSelesai'])->name('pesanan.selesai');
    Route::get('/profil', [PembeliController::class, 'editProfil'])->name('profil');
    Route::post('/profil/update', [PembeliController::class, 'updateProfil'])->name('profil.update');
    Route::get('/pembeli/beranda', [PembeliController::class, 'dashboard'])->name('pembeli.dashboard');
    Route::get('/ulasan/form/{produk_id}/{pesanan_id}', [PembeliController::class, 'formUlasan'])->name('ulasan.form');
    Route::post('/ulasan/kirim', [PembeliController::class, 'storeUlasan'])->name('ulasan.store');

    
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda telah berhasil logout.');
        // return redirect('/')->with('success', 'Anda telah berhasil logout.');
    })->name('logout');
});






