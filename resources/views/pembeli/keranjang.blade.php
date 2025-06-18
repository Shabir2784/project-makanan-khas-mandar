<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h3 class="mb-4">Keranjang Saya</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($items->isEmpty())
        <p class="text-muted">Keranjang kamu kosong.</p>
    @else
        <div class="mb-2">
            <input type="checkbox" id="pilih-semua"> <label for="pilih-semua">Pilih Semua</label>
        </div>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th></th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <input type="checkbox" class="checkbox-item" value="{{ $item->produk_id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/images/' . $item->produk->gambar) }}" width="80" class="me-3 rounded">
                                <div>
                                    <strong>{{ $item->produk->nama }}</strong><br>
                                    <small class="text-muted">{{ $item->produk->ukuran ?? '-' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('pembeli.keranjang.updateJumlah') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="keranjang_id" value="{{ $item->id }}">
                                <input type="hidden" name="aksi" value="kurang">
                                <button type="submit" class="btn btn-sm btn-outline-secondary">−</button>
                            </form>

                            <span class="mx-2">{{ $item->jumlah }}</span>

                            <form action="{{ route('pembeli.keranjang.updateJumlah') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="keranjang_id" value="{{ $item->id }}">
                                <input type="hidden" name="aksi" value="tambah">
                                <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                            </form>
                        </td>
                        <td>Rp{{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('pembeli.keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('pembeli.checkout.langsung') }}" method="GET" id="form-checkout">
            @foreach ($items as $item)
                <input type="hidden" name="jumlah[{{ $item->produk_id }}]" value="{{ $item->jumlah }}">
            @endforeach
            <div id="produk-dipilih"></div>
            <button type="submit" class="btn btn-success mt-3">Checkout</button>
        </form>
    @endif

    <a href="{{ route('pembeli.dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
</div>

<script>
    document.getElementById('pilih-semua').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.checkbox-item');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    document.getElementById('form-checkout').addEventListener('submit', function (e) {
        const checkboxes = document.querySelectorAll('.checkbox-item');
        const container = document.getElementById('produk-dipilih');
        container.innerHTML = '';

        let adaYangDipilih = false;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                adaYangDipilih = true;
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'produk_id[]';
                hiddenInput.value = cb.value;
                container.appendChild(hiddenInput);
            }
        });

        if (!adaYangDipilih) {
            e.preventDefault();
            alert('Pilih minimal satu produk untuk checkout.');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
