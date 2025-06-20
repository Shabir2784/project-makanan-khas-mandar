<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Ikan Hias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-success" href="#">TokoIkan</a>
    <form class="d-flex ms-auto me-3 w-50">
      <input class="form-control me-2" type="search" placeholder="Cari ikan hias..." aria-label="Search">
      <button class="btn btn-success" type="submit">Cari</button>
    </form>
    <a href="{{ route('login') }}" class="btn btn-outline-success me-2">login</a>
    <a href="{{ route('register') }}" class="btn btn-success">register</a>
  </div>
</nav>

<!-- ✅ Flash Message -->
@if(session('success'))
  <div class="alert alert-success text-center mb-0">{{ session('success') }}</div>
@endif

<!-- Hero -->
<section class="py-5 bg-white text-center">
  <div class="container">
    <h1 class="display-5 fw-bold">Selamat Datang di Toko Ikan Hias</h1>
    <p class="lead text-muted">Temukan ikan hias asli Indonesia untuk mempercantik akuarium Anda.</p>
  </div>
</section>

<!-- Produk -->
<section class="container py-5">
  <h3 class="mb-4">Katalog Ikan Hias Lokal</h3>
  <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
    @php
    $produkList = [
      [
        'nama' => 'Cupang Serit',
        'harga' => 35000,
        'stok' => 15,
        'gambar' => 'IkanCupang.jpg',
        'deskripsi' => 'Jenis cupang lokal dengan sirip berjumbai dan warna atraktif.'
      ],
      [
        'nama' => 'Pelangi Boesemani',
        'harga' => 85000,
        'stok' => 10,
        'gambar' => 'boesemanirainbow.jpg',
        'deskripsi' => 'Ikan endemik Papua yang berwarna biru-oranye seperti pelangi.'
      ],
      [
        'nama' => 'Arwana Super Red',
        'harga' => 2500000,
        'stok' => 3,
        'gambar' => 'IkanArwanaSuperRed.jpg',
        'deskripsi' => 'Arwana eksklusif asal Kalimantan dengan sisik merah menyala.'
      ],
      [
        'nama' => 'Botia',
        'harga' => 55000,
        'stok' => 8,
        'gambar' => 'IkanBotia.jpg',
        'deskripsi' => 'Ikan corak belang hitam kuning, aktif dan cocok untuk akuarium besar.'
      ],
      [
        'nama' => 'Zebra Danio Sumatera',
        'harga' => 15000,
        'stok' => 20,
        'gambar' => 'IkanZebra.jpg',
        'deskripsi' => 'Ikan kecil cepat dengan pola garis-garis hitam putih khas.'
      ],
      [
        'nama' => 'Ikan Belida',
        'harga' => 120000,
        'stok' => 5,
        'gambar' => 'IkanBelida.jpg',
        'deskripsi' => 'Bentuk tubuh pipih seperti pisau, gerakan lembut dan anggun.'
      ],
    ];
    @endphp

    @foreach ($produkList as $item)
    <div class="col">
      <div class="card h-100 shadow-sm">
        <img src="{{ asset('imgg/' . urlencode($item['gambar'])) }}" class="card-img-top" alt="{{ $item['nama'] }}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ $item['nama'] }}</h5>
          <p class="text-success fw-bold">Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
          <p><strong>Stok:</strong> {{ $item['stok'] }}</p>
          <p class="text-muted small">{{ $item['deskripsi'] }}</p>
          <div class="mt-auto">
            <a href="#" class="btn btn-success w-100">Lihat Detail</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>


<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-5">
  <div class="container">
    <small>&copy; {{ date('Y') }} Toko Online Ikan Hias</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
