<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Akun - Toko Ikan Hias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-sm w-100" style="max-width: 400px;">
    <div class="card-body">
      <h4 class="card-title text-center mb-4">Daftar Akun Baru</h4>

      {{-- ✅ Tampilkan error validasi --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required autofocus>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Alamat Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="form-label">Ulangi Kata Sandi</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Daftar</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
