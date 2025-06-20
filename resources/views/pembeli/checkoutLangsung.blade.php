<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout Langsung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h3 class="mb-4">Checkout</h3>

    <!-- ✅ Flash message -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pembeli.checkout.store') }}" method="POST">
        @csrf

        @php $totalKeseluruhan = 0; @endphp

        @foreach ($dataCheckout as $index => $checkout)
            @php
                $produk = $checkout['produk'];
                $jumlah = max(1, (int) $checkout['jumlah']);
                $subtotal = $produk->harga * $jumlah;
                $totalKeseluruhan += $subtotal;
            @endphp

            <input type="hidden" name="produk_id[]" value="{{ $produk->id }}">

            <div class="mb-3">
                <label>Produk</label>
                <input type="text" class="form-control" value="{{ $produk->nama }}" readonly>
            </div>

            <div class="mb-3">
                <label>Harga Satuan</label>
                <input type="text" class="form-control" value="Rp{{ number_format($produk->harga, 0, ',', '.') }}" readonly>
            </div>

            <div class="mb-3">
                <label>Jumlah (Stok tersedia: {{ $produk->stok }})</label>
                <input type="number" name="jumlah[]" class="form-control jumlah-input"
                       value="{{ $jumlah }}" min="1" max="{{ $produk->stok }}" required>
            </div>

            <hr>
        @endforeach

        <div class="mb-3">
            <label>Total Harga</label>
            <input type="text" class="form-control" id="total-keseluruhan" value="Rp{{ number_format($totalKeseluruhan, 0, ',', '.') }}" readonly>
        </div>

        <div class="mb-3">
            <label>Alamat Pengiriman</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat', $pengguna->alamat ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-select" required>
                <option value="">-- Pilih Metode --</option>
                <option value="transfer">Transfer Bank</option>
                <option value="cod">COD (Bayar di Tempat)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Konfirmasi Checkout</button>
    </form>
</div>

<!-- ✅ Tambahan JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahInputs = document.querySelectorAll('.jumlah-input');
        const totalInput = document.getElementById('total-keseluruhan');
        const hargaSatuans = @json(collect($dataCheckout)->pluck('produk.harga'));
        const stokMax = @json(collect($dataCheckout)->pluck('produk.stok'));

        function updateTotal() {
            let total = 0;

            jumlahInputs.forEach((input, i) => {
                let jumlah = parseInt(input.value) || 1;
                const max = stokMax[i];

                if (jumlah < 1) jumlah = 1;
                if (jumlah > max) jumlah = max;

                total += hargaSatuans[i] * jumlah;
            });

            totalInput.value = 'Rp' + total.toLocaleString('id-ID');
        }

        jumlahInputs.forEach((input, i) => {
            const max = stokMax[i];

            input.addEventListener('input', function () {
                const val = parseInt(this.value);
                if (val > max) {
                    this.setCustomValidity(`Maksimal pembelian adalah ${max} item`);
                } else if (val < 1) { 
                    this.setCustomValidity("Minimal pembelian adalah 1 item");
                } else {
                    this.setCustomValidity('');
                }
                updateTotal();
            });

            input.addEventListener('invalid', function () {
                const val = parseInt(this.value);
                if (val > max) {
                    this.setCustomValidity(`Maksimal pembelian adalah ${max} item`);
                } else if (val < 1) {
                    this.setCustomValidity("Minimal pembelian adalah 1 item");
                }
            });
        });

        updateTotal();
    });
</script>
</body>
</html>
