@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <strong>Detail Peminjaman</strong>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-secondary float-end">Kembali</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Kode Peminjaman</th>
                            <td>{{ $peminjaman->kode_peminjaman }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal peminjaman</th>
                            <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                           
                        </tr>
                        <tr>
                        <th>Tanggal Kembali</th>
                            <td>{{ $peminjaman->tanggal_kembali }}</td>
                           
                        <tr>
                            <th>Jumlah Buku Dipinjam</th>
                            <td>{{ $peminjaman->bukus->sum('pivot.jumlah') }}</td>
                        </tr>
                        
                        <tr>
                            <th>Nama Peminjam</th>
                            <td>{{ $peminjaman->nama_peminjam }}</td>
                        </tr>
                    </table>

                    <h5 class="mt-4">Daftar Buku</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Jumlah</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjaman->bukus as $buku)
                                <tr>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->pivot->jumlah }}</td>
                                    <td>{{ $buku->kategoriBuku->nama_kategori }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
