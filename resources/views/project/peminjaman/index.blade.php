@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start ">
                        Data Transaksi
                    </div>
                    <div class="float-end">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
                    </div>
                </div>

                <div class="card-body">
            {{-- Search --}}
            <form action="{{ route('peminjaman.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari kode transaksi..." value="{{ $search }}">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                    @if($search)
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Alert sukses --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

                    @if($peminjaman->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Peminjaman</th>
                                    <th>Nama Peminjam</th>
                                    <th>Kategori Buku</th>
                                    <th>Daftar Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                                @foreach ($peminjaman as $no => $pj)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $pj->kode_peminjaman }}</td>
                                    <td>{{ $pj->nama_peminjam }}</td>
                                    <td>
                                        @foreach($pj->bukus as $buku)
                                            {{ $buku->kategoriBuku->nama_kategori ?? '-' }} <br>
                                        @endforeach
                                    </td>

                                    <td>
                                            @foreach($pj->bukus as $buku)
                                                {{ $buku->judul }} :
                                                {{ $buku->pengarangs->pluck('nama_pengarang')->join(', ') ?: '-' }}
                                                <br>
                                            @endforeach
                                        </td>
                                    <td>{{ \Carbon\Carbon::parse($pj->tanggal_peminjaman)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pj->tanggal_kembali)->format('d/m/Y') }}</td>
                                    <td>{{ $pj->bukus->sum('pivot.jumlah') }}</td>
                                    <td>
                                        <a href="{{ route('peminjaman.show', $pj->id) }}" class="btn btn-info btn-sm">
                                            Show
                                        </a>

                                        <a href="{{ route('peminjaman.edit', $pj->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('peminjaman.destroy', $pj->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        Data Transaksi belum Tersedia.
                    </div>
                @endif
                </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
            <span class="text-muted">Arya Adhitya XI RPL 3 </span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#twitter"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#instagram"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#facebook"></use>
                    </svg></a></li>
        </ul>
    </footer>
</div>

@endsection

    