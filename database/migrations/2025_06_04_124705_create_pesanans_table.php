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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengguna_id')->constrained('penggunas')->onDelete('cascade'); 

            // ✅ Dibuat nullable agar bisa digunakan saat banyak produk
            $table->foreignId('produk_id')
                  ->nullable()
                  ->constrained('produks')
                  ->onDelete('cascade');   

            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');

            $table->text('alamat')->nullable();
            $table->string('metode_pembayaran')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
