@extends('layouts.master')

@section('content')
<h4>Edit Pengguna</h4>
<form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" value="{{ $pengguna->nama }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $pengguna->email }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="admin" {{ $pengguna->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="penjual" {{ $pengguna->role == 'penjual' ? 'selected' : '' }}>Penjual</option>
            <option value="pembeli" {{ $pengguna->role == 'pembeli' ? 'selected' : '' }}>Pembeli</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
@endsection
