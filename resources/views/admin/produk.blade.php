@extends('layouts.master') {{-- Ini penting agar tampilan tetap dalam dashboard --}}

@section('content')




    <h1 class="h3 mb-4 text-gray-800">Manajemen Produk</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <a  class="btn btn-primary mb-3">Lihat Produk</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Penjual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produks as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>{{ $item->pengguna->nama ?? '-' }}</td>
                                <td>
                                    {{-- <a href="#" class="btn btn-sm btn-warning">Edit</a> --}}
                                    <form action="{{ route('admin.produk.hapusProduk', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada produk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
