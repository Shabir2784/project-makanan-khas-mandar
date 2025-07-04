<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id', 'produk_id', 'jumlah', 'harga_satuan', 'subtotal'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
 
}
