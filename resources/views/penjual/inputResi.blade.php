@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Input Resi Pengiriman</h1>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($pengiriman))
    <form action="{{ route('penjual.pengiriman.simpan-resi', $pengiriman->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Pembeli</label>
            <input type="text" value="{{ $pengiriman->pesanan->pengguna->nama }}" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Kurir</label>
            <input type="text" name="kurir" value="{{ old('kurir', $pengiriman->kurir) }}" class="form-control @error('kurir') is-invalid @enderror" required>
            @error('kurir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>No Resi</label>
            <input type="text" name="no_resi" value="{{ old('no_resi', $pengiriman->no_resi) }}" class="form-control @error('no_resi') is-invalid @enderror" required>
            @error('no_resi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan Resi</button>
    </form>
    @else
        <div class="alert alert-warning">
            Data pengiriman tidak ditemukan.
        </div>
    @endif
</div>
@endsection
