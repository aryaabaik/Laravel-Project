@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📚 Daftar Buku</h4>
            <a href="{{ route('buku.create') }}" class="btn btn-light text-primary fw-semibold">
                + Tambah Buku
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success fw-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pengarang</th>
                            <th>Stok</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bukus as $index => $buku)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $buku->judul }}</td>
                                <td>{{ $buku->kategoriBuku->nama_kategori ?? '-' }}</td>
                                <td>
                                    @if($buku->pengarangs->isNotEmpty())
                                        @foreach ($buku->pengarangs as $pengarang)
                                                {{ $pengarang->nama_pengarang  }}<br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $buku->stok }}</td>
                                <td>{{ $buku->tahun }}</td>
                                <td>
                                    <a href="{{ route('buku.show', $buku->id) }}" 
                                       class="btn btn-sm btn-warning text-white fw-semibold me-1">
                                        🔍 Show
                                    </a>
                                    <a href="{{ route('buku.edit', $buku->id) }}" 
                                       class="btn btn-sm btn-warning text-white fw-semibold me-1">
                                        ✏️ Edit
                                    </a>

                                      <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted text-center py-4">
                                    Tidak ada data buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
