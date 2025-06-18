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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->decimal('jumlah', 10, 2);
            $table->string('metode');
            $table->enum('status', ['belum dibayar', 'sudah dibayar'])->default('belum dibayar');

            // Tambahan untuk sistem escrow
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('verifikasi_admin', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->timestamp('verifikasi_at')->nullable();
            $table->boolean('diteruskan_ke_penjual')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
