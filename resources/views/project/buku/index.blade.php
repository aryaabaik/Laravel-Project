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
                        <a href="{{ route('buku.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
                    </div>
                </div>
                @if($bukus->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Pelanggan</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($bukus as $no => $data)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $data->kategori->nama_kategori }}</td>
                                    <td>{{ $data->judul}}</td>
                                    <td> {{ $data->pengarang->nama_pengarang }} </td>
                                    <td> {{ $data->stok }} </td>
                                    <td> {{ $data->tahun }} </td>
                                    <td>

                                        <a href="{{ route('buku.show', $data->id) }}" class="btn btn-sm btn-outline-dark">Show</a> |
                                        <a href="{{ route('buku.edit', $data->id) }}" class="btn btn-sm btn-outline-success">Edit</a> |
                                        <form action="{{ route('buku.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda Yakin Ingin Menghapus Data Ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return" class="btn btn-sm btn-outline-danger">Delete</button>
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
