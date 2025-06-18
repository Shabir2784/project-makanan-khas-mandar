@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Verifikasi Penjual</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penggunas as $pengguna)
                            <tr>
                                <td>{{ $pengguna->nama }}</td>
                                <td>{{ $pengguna->email }}</td>
                                <td><span class="badge badge-warning">Menunggu Verifikasi</span></td>
                                <td>
                                    <form action="{{ route('admin.verifikasi.terima', $pengguna->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                    </form>
                                    <form action="{{ route('admin.verifikasi.tolak', $pengguna->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada penjual yang menunggu verifikasi.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
