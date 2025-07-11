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
    <a class="navbar-brand fw-bold text-success" href="#">Toko Makanan Khas Mandar</a>
    <form class="d-flex ms-auto me-3 w-50">
      <input class="form-control me-2" type="search" placeholder="Cari makanan..." aria-label="Search">
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
    <h1 class="display-5 fw-bold">Selamat Datang di Toko Makanan Khas Mandar</h1>
    <p class="lead text-muted">Temukan makanan khas mandar asli disini.</p>
  </div>
</section>

<section class="container py-5">
  <h3 class="mb-4">Katalog Makanan Khas Mandar</h3>
  <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-4">
    @php
    $produkList = [
      [
        'nama' => 'Jepa dan Bau Peapi',
        'harga' => 10000,
        'stok' => 12,
        'gambar' => 'jepa.jpg',
        'deskripsi' => 'Jepa adalah roti sagu khas Mandar yang biasanya disantap dengan kuah ikan bau peapi.'
      ],
      [
        'nama' => 'Golla Kambu',
        'harga' => 5000,
        'stok' => 20,
        'gambar' => 'golla.jpeg',
        'deskripsi' => 'Kue tradisional dari kelapa parut, gula merah, dan beras ketan yang manis dan legit.'
      ],
      [
        'nama' => 'Sambusa',
        'harga' => 2000,
        'stok' => 25,
        'gambar' => 'sambusa.jpeg',
        'deskripsi' => 'Makanan ringan berbentuk segitiga berisi daging cincang dan rempah, mirip pastel goreng.'
      ],
      [
        'nama' => 'Bikang',
        'harga' => 3000,
        'stok' => 18,
        'gambar' => 'bikang.jpeg',
        'deskripsi' => 'Kue tradisional lembut dan manis, berbentuk bulat pipih dan berpori seperti sarang lebah.'
      ],
      [
        'nama' => 'Loka Sattai',
        'harga' => 5000,
        'stok' => 10,
        'gambar' => 'loka.png',
        'deskripsi' => 'Loka sattai adalah adonan ketan yang dipipihkan dan dimasak dalam air mendidih.'
      ],
      [
        'nama' => 'Cucur',
        'harga' => 7000,
        'stok' => 15,
        'gambar' => 'cucur.jpeg',
        'deskripsi' => 'Kue cucur memiliki rasa manis dengan tekstur garing di tepi dan lembut di tengah.'
      ],
      [
        'nama' => 'Kue Paso',
        'harga' => 2000,
        'stok' => 20,
        'gambar' => 'paso.jpeg',
        'deskripsi' => 'Kue tradisional dari tepung ketan berisi gula merah dan dibungkus daun pisang.'
      ],
      [
        'nama' => 'Lokasari',
        'harga' => 9000,
        'stok' => 10,
        'gambar' => 'lokasari.jpeg',
        'deskripsi' => 'Pisang muda rebus disajikan dengan kuah santan manis, disukai sebagai hidangan penutup.'
      ]
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
    <small>&copy; {{ date('Y') }} Toko Online Makanan Khas Mandar</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
