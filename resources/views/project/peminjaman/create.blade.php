@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Transaksi Baru</h3>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                {{-- Pilih Pelanggan --}}
                <div class="mb-3">
                    <label for="" class="form-label">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" class="form-control @error('nama_peminjam') is-invalid @enderror" value="{{ old('nama_peminjam') }}" required>
                </div>

                <hr>
                <h5>Daftar Buku</h5>

                {{-- Wrapper Produk --}}
               <div id="buku-wrapper">

    <div class="row buku-item mb-3">
        <div class="col-md-5">
            <label class="form-label">Buku</label>
            <select name="buku_id[]" class="form-select buku-select" required>
                <option value="">-- Pilih Buku --</option>
                @foreach ($buku as $book)
                <option value="{{ $book->id }}" data-stok="{{ $book->stok }}">
                    {{ $book->kategoriBuku->nama_kategori }} -
                    {{ $book->pengarangs->first()->nama_pengarang }} -
                    {{ $book->judul }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah[]" class="form-control jumlah-input" min="1" value="1">
        </div>

        <div class="col-md-3">
            <label class="form-label">Total Pinjam</label>
            <input type="text" class="form-control subtotal" readonly value="1">
        </div>

        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-remove w-100">×</button>
        </div>
        </div>
        </div>

        <div class="text-end mb-3">
            <button type="button" class="btn btn-sm btn-secondary" id="btn-add">+ Tambah Buku</button>
        </div>
                    
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_peminjaman" class="form-control" required>
                        </div>

                         <div class="mb-23">
                             <label class="form-label">Tanggal Kembali</label>
                             <input type="date" name="tanggal_kembali" class="form-control" required>
                         </div>

                     

                <div class="text-end mb-4">
                    <h5>Total Buku: <span id="total">0</span></h5>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Transaksi</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

{{-- Script JS --}}
<script>
    function hitungSubtotal() {
        let total = 0;

        document.querySelectorAll('.buku-item').forEach(item => {
            let jumlah = parseInt(item.querySelector('.jumlah-input').value || 0);
            let subtotalInput = item.querySelector('.subtotal');

            // subtotal = jumlah saja
            subtotalInput.value = jumlah;

            total += jumlah;
        });

        document.getElementById('total').innerText = total;
    }

    document.addEventListener('input', hitungSubtotal);
    document.addEventListener('change', hitungSubtotal);

    // Tambah buku
    document.getElementById('btn-add').addEventListener('click', function () {
        let wrapper = document.getElementById('buku-wrapper');
        let first = wrapper.querySelector('.buku-item');

        let newRow = first.cloneNode(true);
        
        newRow.querySelector('.buku-select').value = '';
        newRow.querySelector('.jumlah-input').value = 1;
        newRow.querySelector('.subtotal').value = 1;

        wrapper.appendChild(newRow);

        hitungSubtotal();
    });

    // Hapus buku
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove')) {

            let items = document.querySelectorAll('.buku-item');
            if (items.length > 1) {
                e.target.closest('.buku-item').remove();
                hitungSubtotal();
            }
        }
    });
</script>


@endsection