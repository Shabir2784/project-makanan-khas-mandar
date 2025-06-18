@extends('layoutsPembeli.masterPembeli')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Profil</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('pembeli.profil.update') }}">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama"
                   value="{{ old('nama', $pengguna->nama) }}" required>
        </div>
        <div class="mb-3">
            <label for="no_wa" class="form-label">Nomor WhatsApp</label>
            <input type="text" class="form-control" id="no_wa" name="no_wa"
                value="{{ old('no_wa', $pengguna->no_wa) }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pengguna->alamat) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
