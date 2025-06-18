@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Pesanan Sedang Diproses</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanans as $pesanan)
              {{-- <pre>
                @foreach ($pesanan->detailPesanans as $d)
                    produk_id: {{ $d->produk_id ?? 'null' }} |
                    produk: {{ $d->produk->nama ?? 'produk null' }} |
                    pengguna_id: {{ $d->produk->pengguna_id ?? 'null' }} |
                    jumlah: {{ $d->jumlah ?? 'null' }} |
                    subtotal: {{ $d->subtotal ?? 'null' }}
                    <br>
                @endforeach
                </pre> --}}
                @php
                $detailSaya = $pesanan->detailPesanans->filter(fn($d) => $d->produk->pengguna_id === Auth::id());
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pesanan->pengguna->nama }}</td>
                <td>
                    <ul class="mb-0 ps-3">
                        @foreach ($detailSaya as $detail)
                            <li>{{ $detail->produk->nama }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $detailSaya->sum('jumlah') }}</td>
                <td>Rp{{ number_format($detailSaya->sum('subtotal'), 0, ',', '.') }}</td>
                <td>{{ ucfirst($pesanan->status) }}</td>
                <td>{{ $pesanan->updated_at->format('d M Y H:i') }}</td>
            </tr>

            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Tidak ada pesanan diproses</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
