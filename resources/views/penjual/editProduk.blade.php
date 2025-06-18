@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Edit Produk</h1>

    <form action="{{ route('penjual.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nama">Nama Produk</label>
            <input type="text" name="nama" class="form-control" required value="{{ old('nama', $produk->nama) }}">
        </div>

        <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="harga">Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" required value="{{ old('harga', $produk->harga) }}">
        </div>

        <div class="form-group mb-3">
            <label for="stok">Stok</label>
            <input type="number" name="stok" class="form-control" required value="{{ old('stok', $produk->stok) }}">
        </div>

        <div class="form-group mb-3">
            <label for="gambar">Gambar Produk</label>
            @if ($produk->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/images/' . $produk->gambar) }}" alt="{{ $produk->nama }}" width="120"> 
                                      
                </div>
            @endif
            <input type="file" name="gambar" class="form-control-file">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
        <a href="{{ route('penjual.produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
