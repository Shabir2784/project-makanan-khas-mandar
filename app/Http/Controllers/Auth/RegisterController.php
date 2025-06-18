<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // ✅ Validasi form pendaftaran
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:penggunas,email',
            'password' => 'required|string|min:5|confirmed',
        ]);

        // ✅ Simpan pengguna baru
        $user = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembeli',
            'verifikasi' => 'disetujui',
        ]);

        // 🔐 Auto login
        Auth::login($user);

        // 🔁 Redirect ke dashboard pembeli
        return redirect()->route('pembeli.dashboard');
    }
}
