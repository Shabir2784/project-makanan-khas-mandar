<?php
namespace App\Models;
use App\Models\Pengguna;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;
use App\Models\Pengiriman;
use App\Models\Produk;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'produk_id', 'pengguna_id', 'total_harga', 'status' , 'alamat','metode_pembayaran'
    ];


    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class)->with('produk');
    }

    public function pembeli()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id'); 
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class);
    }
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'pesanan_produk')
                    ->withPivot('jumlah', 'harga_satuan', 'subtotal')
                    ->withTimestamps();
    }
}
