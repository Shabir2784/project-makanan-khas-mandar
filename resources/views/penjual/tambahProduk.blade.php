@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Tambah Produk Baru</h1>

    <form action="{{ route('penjual.produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nama">Nama Produk</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="harga">Harga</label>
        <input type="number" name="harga" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="stok">Stok</label>
        <input type="number" name="stok" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="gambar">Gambar Produk</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

</div>
@endsection
