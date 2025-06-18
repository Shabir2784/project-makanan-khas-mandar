@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Pembayaran</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $pay)
            <tr>
                <td>{{ $pay->pesanan_id }}</td>
                <td>Rp{{ number_format($pay->jumlah, 0, ',', '.') }}</td>
                <td>{{ $pay->metode }}</td>
                <td>{{ $pay->status }}</td>
                <td>{{ ucfirst($pay->verifikasi_admin) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
