@extends('layoutsPembeli.masterPembeli')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Riwayat Pesanan Saya</h2>

    @if ($pesanans->isEmpty())
        <div class="alert alert-info">
            Belum ada pesanan yang tercatat.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Produk</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $pesanan)
                        @php
                            $totalHarga = $pesanan->produks->sum(function($p) {
                                return $p->pivot->subtotal;
                            });
                        @endphp
                        <tr>
                            <td>#{{ $pesanan->id }}</td>

                            {{-- PRODUK --}}
                            <td>
                                <table class="table table-sm table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Ulasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan->produks as $produk)
                                            <tr>
                                                <td>{{ $produk->nama }}</td>
                                                <td>{{ $produk->pivot->jumlah }}</td>
                                                <td>Rp{{ number_format($produk->pivot->harga_satuan, 0, ',', '.') }}</td>
                                                <td>Rp{{ number_format($produk->pivot->subtotal, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($pesanan->status === 'selesai')
                                                        @php
                                                            $sudahDiulas = \App\Models\Ulasan::where('pengguna_id', Auth::id())
                                                                ->where('produk_id', $produk->id)
                                                                ->where('pesanan_id', $pesanan->id)
                                                                ->exists();
                                                        @endphp
                                                        @if (!$sudahDiulas)
                                                            <a href="{{ route('pembeli.ulasan.form', [$produk->id, $pesanan->id]) }}" class="btn btn-sm btn-outline-primary">Beri Ulasan</a>
                                                        @else
                                                            <span class="text-success">✅ Sudah Diulas</span>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>

                            {{-- TOTAL HARGA --}}
                            <td>Rp{{ number_format($totalHarga, 0, ',', '.') }}</td>

                            {{-- STATUS --}}
                            <td>
                                @php
                                    $badge = [
                                        'menunggu' => 'secondary',
                                        'diproses' => 'warning',
                                        'selesai' => 'success',
                                    ][$pesanan->status] ?? 'dark';
                                @endphp
                                <span class="badge bg-{{ $badge }}">
                                    {{ ucfirst($pesanan->status) }}
                                </span>
                            </td>

                            {{-- PENGIRIMAN --}}
                            <td>
                                @if ($pesanan->pengiriman)
                                    @if ($pesanan->pengiriman->no_resi)
                                        <div>
                                            <strong>Kurir:</strong> {{ $pesanan->pengiriman->kurir }} <br>
                                            <strong>No. Resi:</strong> {{ $pesanan->pengiriman->no_resi }} <br>
                                            <span class="badge bg-success">Sudah Dikirim</span>

                                            @if ($pesanan->status === 'diproses')
                                                <form action="{{ route('pembeli.pesanan.selesai', $pesanan->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin pesanan ini sudah diterima?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-success mt-2">Pesanan Diterima</button>
                                                </form>
                                            @endif
                                        </div>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Diinput</span>
                                    @endif
                                @else
                                    <span class="text-muted">Belum tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('pembeli.dashboard') }}" class="btn btn-outline-secondary mt-4">
            ← Kembali ke Beranda
        </a>
    @endif
</div>
@endsection
