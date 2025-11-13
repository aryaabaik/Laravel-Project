<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['kode_peminjaman', 'nama_peminjam', 'tanggal_peminjaman', 'tanggal_kembali'] ;

    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
    }
}
