@extends('layoutsPembeli.masterPembeli')

@section('title', 'Form Daftar Penjual')

@section('content')
<div class="container mt-4">
    <h3>Form Pendaftaran Penjual</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pembeli.ajukanPenjual') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_toko" class="form-label">Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="no_wa" class="form-label">Nomor WhatsApp</label>
            <input type="text" name="no_wa" class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="setuju" id="setuju" required>
            <label class="form-check-label" for="setuju">
                Saya menyetujui syarat & ketentuan menjadi penjual
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Sebagai Penjual</button>
    </form>
</div>
@endsection
