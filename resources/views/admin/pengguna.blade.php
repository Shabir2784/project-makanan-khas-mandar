@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengguna</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penggunas as $pengguna)
                            <tr>
                                <td>{{ $pengguna->nama }}</td>
                                <td>{{ $pengguna->email }}</td>
                                <td>
                                    <span class="badge 
                                        @if($pengguna->role == 'admin') badge-primary
                                        @elseif($pengguna->role == 'penjual') badge-success
                                        @else badge-secondary
                                        @endif">
                                        {{ ucfirst($pengguna->role) }}
                                    </span>
                                </td>
                    
                                <td>
                                    <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.pengguna.hapusPengguna', $pengguna->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</button>
                                    </form>
                                </td>                               
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada pengguna terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
