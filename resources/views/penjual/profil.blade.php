@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container py-5">
    <h4 class="mb-4">Profil Saya</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('penjual.profil.updateGabung') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $pengguna->nama) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" value="{{ $pengguna->email }}" readonly>
        </div>

        <div class="mb-3">
            <label>No WhatsApp</label>
            <input type="text" name="no_wa" value="{{ old('no_wa', $pengguna->no_wa) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat', $pengguna->alamat) }}</textarea>
        </div>

        <hr>
        <h5 class="mt-4">Ganti Password</h5>

        <div class="mb-3">
            <label>Password Lama</label>
            <input type="password" name="password_lama" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password_baru" class="form-control">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_baru_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
    </form>
</div>
@endsection
