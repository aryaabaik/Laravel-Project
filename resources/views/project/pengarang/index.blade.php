@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">PENGARANG</h5>
            <a href="{{ route('pengarang.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
        </div>

        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama pengarang</th>
                        <th class="text-center" style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengarangs as $index => $pengarang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pengarang->nama_pengarang }}</td>
                        <td class="text-center">
                            <a href="{{ route('pengarang.show', $pengarang->id) }}" class="btn btn-outline-dark btn-sm">Show</a>
                            <a href="{{ route('pengarang.edit', $pengarang->id) }}" class="btn btn-outline-success btn-sm">Edit</a>
                            <form action="{{ route('pengarang.destroy', $pengarang->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

