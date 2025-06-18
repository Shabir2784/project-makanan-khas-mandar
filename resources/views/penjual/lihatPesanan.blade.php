@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container py-4">
    <h3 class="mb-4">Daftar Pesanan Masuk</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($pesanans->isEmpty())
        <p class="text-muted">Belum ada pesanan.</p>
    @else
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $pesanan)
                    @php
                        // Ambil hanya produk milik penjual ini
                        $detailPenjual = $pesanan->detailPesanans->filter(function ($d) {
                            return $d->produk->pengguna_id == Auth::id();
                        });

                        $totalJumlah = $detailPenjual->sum('jumlah');
                        $totalHarga = $detailPenjual->sum(function ($d) {
                            return $d->jumlah * $d->harga_satuan;
                        });
                    @endphp
                    <tr>
                        <td>#{{ $pesanan->id }}</td>
                        <td>{{ $pesanan->pembeli->nama ?? '-' }}</td>
                        <td>
                            <ul class="mb-0 ps-3">
                                @foreach ($detailPenjual as $detail)
                                    <li>{{ $detail->produk->nama }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $totalJumlah }}</td>
                        <td>Rp{{ number_format($totalHarga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $pesanan->status === 'menunggu' ? 'info' : ($pesanan->status === 'diproses' ? 'warning' : 'success') }}">
                                {{ ucfirst($pesanan->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($pesanan->status === 'menunggu')
                                <form action="{{ route('penjual.pesanan.konfirmasi', $pesanan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-success">Konfirmasi</button>
                                </form>
                            @elseif ($pesanan->status === 'diproses')
                                @if ($pesanan->pengiriman && empty($pesanan->pengiriman->no_resi))
                                    <a href="{{ route('penjual.pengiriman.inputResi', $pesanan->pengiriman->id) }}" class="btn btn-sm btn-primary">Input Resi</a>
                                @elseif ($pesanan->pengiriman && $pesanan->pengiriman->no_resi)
                                    <span class="badge bg-success">Sudah Dikirim</span>
                                @else
                                    <span class="text-muted">Pengiriman tidak ditemukan</span>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
