<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('produks', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->text('deskripsi')->nullable();
        $table->decimal('harga', 10, 2);
        $table->integer('stok');
        $table->integer('terjual')->default(0); // ✅ Tambahan: jumlah produk yang sudah terjual
        $table->string('gambar')->nullable();
        $table->foreignId('pengguna_id')->constrained('penggunas')->onDelete('cascade');
        $table->timestamps();
        $table->softDeletes();
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
