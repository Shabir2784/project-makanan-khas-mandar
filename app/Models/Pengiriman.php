<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengiriman extends Model
{
    protected $table = 'pengirimans';

    protected $fillable = [
        'pesanan_id', 'nama_penerima', 'alamat', 'kota', 'kode_pos', 'kurir', 'no_resi', 'status'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    
    
}
