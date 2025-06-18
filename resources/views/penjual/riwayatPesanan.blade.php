@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Riwayat Pesanan</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Waktu Selesai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanans as $pesanan)
                @php
                    $detailPenjual = $pesanan->detailPesanans->filter(fn($d) => $d->produk->pengguna_id === Auth::id());
                    $totalJumlah = $detailPenjual->sum('jumlah');
                    $totalHarga = $detailPenjual->sum('subtotal');
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->pengguna->nama }}</td>
                    <td>
                        <ul class="mb-0 ps-3">
                            @foreach ($detailPenjual as $detail)
                                <li>{{ $detail->produk->nama }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $totalJumlah }}</td>
                    <td>Rp{{ number_format($totalHarga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($pesanan->status) }}</td>
                    <td>{{ $pesanan->updated_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada riwayat</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection


{{-- @extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Riwayat Pesanan</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th>Waktu Selesai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanans as $pesanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->pengguna->nama }}</td>
                    <td>
                        <ul>
                            @foreach ($pesanan->detailPesanans as $detail)
                                @if ($detail->produk->pengguna_id === Auth::id())
                                    <li>{{ $detail->produk->nama }} ({{ $detail->jumlah }})</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $pesanan->detailPesanans->where('produk.pengguna_id', Auth::id())->sum('jumlah') }}</td>
                    <td>
                        Rp{{ number_format(
                            $pesanan->detailPesanans->filter(fn($d) => $d->produk->pengguna_id === Auth::id())->sum('subtotal'),
                            0, ',', '.'
                        ) }}
                    </td>
                    <td>{{ ucfirst($pesanan->status) }}</td>
                    <td>{{ $pesanan->updated_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada riwayat</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection --}}
