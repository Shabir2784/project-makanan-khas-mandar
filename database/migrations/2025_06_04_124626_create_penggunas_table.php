<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'penjual', 'pembeli'])->default('pembeli');
            $table->enum('verifikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->string('nama_toko')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_wa')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};
