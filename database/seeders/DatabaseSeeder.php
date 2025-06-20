<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        Pengguna::create([
            'nama' => 'shabir',
            'email' => 'shabir@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
            'verifikasi' => 'disetujui', 
        ]);
    }
}
