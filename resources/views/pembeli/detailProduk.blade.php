@extends('layoutsPembeli.masterPembeli')

@section('content')
<div class="container py-5">

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <!-- Gambar Produk -->
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 h-100 d-flex align-items-center justify-content-center">
                <img src="{{ asset('storage/images/' . $produk->gambar) }}" class="produk-image" alt="{{ $produk->nama }}">
            </div>
        </div>

        <!-- Informasi Produk -->
        <div class="col-md-6">
            <h3 class="mb-2">{{ $produk->nama }}</h3>
            <p class="text-muted mb-1">
                Terjual: {{ ($produk->terjual ?? 0) > 0 ? $produk->terjual . '+' : '0' }}
            </p>
            <h4 class="text-success fw-bold mb-3">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h4>

            <p><strong>Stok:</strong> {{ $produk->stok }}</p>
            <p><strong>Penjual:</strong> {{ $produk->pengguna->nama ?? 'Tidak diketahui' }}</p>
            <p><strong>Deskripsi:</strong><br>{{ $produk->deskripsi }}</p>

            @if ($produk->stok > 0)
                <div class="d-grid gap-2 mt-4">
                    <form action="{{ route('pembeli.keranjang.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <input type="hidden" name="jumlah" value="1">
                        <button type="submit" class="btn btn-success btn-lg w-100">+ Keranjang</button>
                    </form>

                    <form action="{{ route('pembeli.checkout.langsung') }}" method="GET">
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <input type="hidden" name="jumlah" value="1">
                        <button type="submit" class="btn btn-outline-success btn-lg w-100">Beli Langsung</button>
                    </form>
                </div>
            @else
                <div class="alert alert-warning mt-4">Stok produk ini habis.</div>
            @endif

            <a href="{{ route('pembeli.dashboard') }}" class="btn btn-secondary mt-4">Kembali</a>
        </div>
    </div>

    <!-- ULASAN PEMBELI -->
    <div class="mt-5">
        <h4>Ulasan Pembeli</h4>
        @if ($produk->ulasans->isEmpty())
            <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
        @else
            @foreach ($produk->ulasans as $ulasan)
                <div class="border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $ulasan->pengguna->nama ?? 'Pembeli' }}</strong>
                        <small class="text-muted">{{ $ulasan->created_at->format('d M Y') }}</small>
                    </div>
                    <div class="text-warning mb-1">
                        {{ str_repeat('★', $ulasan->rating) }}{{ str_repeat('☆', 5 - $ulasan->rating) }}
                    </div>
                    <p class="mb-1">{{ $ulasan->komentar }}</p>
                    @if ($ulasan->gambar)
                        <img src="{{ asset('storage/' . $ulasan->gambar) }}" alt="Foto Ulasan" width="120" class="rounded border">
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .produk-image {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 0.5rem;
    }
</style>
@endpush
