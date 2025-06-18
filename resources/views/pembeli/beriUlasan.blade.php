@extends('layoutsPembeli.masterPembeli')

@section('content')
<div class="container py-4">
    <h4>Beri Ulasan untuk {{ $produk->nama }}</h4>

    <form action="{{ route('pembeli.ulasan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <input type="hidden" name="pesanan_id" value="{{ $pesanan->id }}">

        <div class="mb-2">
            <label>Rating:</label>
            <select name="rating" class="form-select" required>
                <option value="">Pilih rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} bintang</option>
                @endfor
            </select>
        </div>

        <div class="mb-2">
            <label>Komentar:</label>
            <textarea name="komentar" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-2">
            <label>Upload Gambar (opsional):</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button class="btn btn-success">Kirim Ulasan</button>
    </form>
</div>
@endsection
