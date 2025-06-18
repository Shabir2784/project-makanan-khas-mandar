<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penggunas';

    protected $fillable = [
        'nama', 'email', 'password', 'role', 'verifikasi','nama_toko','alamat','no_wa',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }

}
