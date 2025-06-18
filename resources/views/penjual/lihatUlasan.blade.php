@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Ulasan Produk Saya</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Nama Pembeli</th>
                <th>Komentar</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ulasans as $ulasan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ulasan->produk->nama }}</td>
                    <td>{{ $ulasan->pengguna->nama }}</td>
                    <td>{{ $ulasan->komentar }}</td>
                    <td>{{ ucfirst($ulasan->status) }}</td>
                    <td>{{ $ulasan->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada ulasan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
