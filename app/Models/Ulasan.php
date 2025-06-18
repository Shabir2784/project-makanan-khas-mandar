<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ulasan extends Model
{
    protected $table = 'ulasans'; // pastikan nama tabelnya sesuai
    protected $guarded = [];
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    
    public function pesanan() {
        return $this->belongsTo(Pesanan::class);
    }

}
