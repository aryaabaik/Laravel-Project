<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['judul', 'stok', 'tahun', 'kategori_buku_id'] ;

    public function kategoriBuku()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_buku_id');
    }

    public function pengarangs()
    {
        return $this->belongsToMany(Pengarang::class, 'buku_pengarang', 'buku_id', 'pengarang_id');
    }
}
