<?php
namespace App\Models;
use App\Models\Pengguna;
use App\Models\Koleksi;
use App\Models\DetailPesanan;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama', 'deskripsi', 'harga', 'stok', 'gambar', 'pengguna_id'
    ];
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
    public function penjual()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
        
    }
     public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }
    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_produk')
                    ->withPivot('jumlah', 'harga_satuan', 'subtotal')
                    ->withTimestamps();
    }

}
