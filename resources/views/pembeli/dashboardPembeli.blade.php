@extends('layoutsPembeli.masterPembeli')

@section('title', 'Dashboard Pembeli')

@section('content')
<div class="container mt-4">
    
    
    <h2 class="mb-4">Toko Makanan Khas Mandar</h2>

    <div class="row">
        @foreach ($produks as $produk)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="overflow-hidden" style="height: 200px;">
                        <img src="{{ asset('storage/images/' . $produk->gambar) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $produk->nama }}">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produk->nama }}</h5>
                        <p class="card-text mb-1">Ukuran: {{ $produk->ukuran }}</p>
                        <p class="card-text text-warning fw-bold mb-1">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <p class="card-text text-muted mb-3"><small>{{ $produk->lokasi }}</small></p>
                        <a href="{{ route('pembeli.produk.detail', $produk->id) }}" class="btn btn-sm btn-success mt-auto w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
