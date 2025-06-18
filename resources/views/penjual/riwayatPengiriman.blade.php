@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Riwayat Pengiriman</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Kurir</th>
                <th>No Resi</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Waktu Kirim</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengirimans as $pengiriman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengiriman->pesanan->pengguna->nama }}</td>
                    <td>{{ $pengiriman->kurir }}</td>
                    <td>{{ $pengiriman->no_resi }}</td>
                   <td>{{ $pengiriman->alamat }}, {{ $pengiriman ->kota }}, {{ $pengiriman->kode_pos }}</td>
                    <td>{{ ucfirst($pengiriman->status) }}</td>
                    <td>{{ $pengiriman->updated_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada riwayat pengiriman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
