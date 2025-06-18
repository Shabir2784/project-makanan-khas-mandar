@extends('layoutsPenjual.masterPenjual')

@section('contentPenjual')
<div class="container">
    <h1 class="mb-4">Daftar Pengiriman Aktif</h1>

    <table class="table table-bordered align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Alamat</th>
                <th>Produk</th>
                <th>Jumlah</th> 
                <th>Kurir</th>
                <th>Resi</th>
                <th>Status</th>
                <th>Waktu Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengirimans as $pengiriman)
                @php
                    $detailSaya = $pengiriman->pesanan->detailPesanans->filter(fn($d) => $d->produk->pengguna_id === Auth::id());
                    $totalJumlah = $detailSaya->sum('jumlah');
                    $alamatPengiriman = $pengiriman->alamat ?? '-'; // ✅ UBAH DI SINI
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $pengiriman->pesanan->pengguna->nama }}</td>
                    <td>{{ $alamatPengiriman }}</td> {{-- ✅ menampilkan alamat dari tabel pengiriman --}}
                    <td>
                        <ul class="mb-0 ps-3">
                            @foreach ($detailSaya as $detail)
                                <li>{{ $detail->produk->nama }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">{{ $totalJumlah }}</td>
                    <td>{{ $pengiriman->kurir ?? '-' }}</td>
                    <td>{{ $pengiriman->no_resi ?? '-' }}</td>
                    <td class="text-capitalize">{{ $pengiriman->status }}</td>
                    <td>{{ $pengiriman->updated_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Tidak ada pengiriman aktif</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
