<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->integer('stok');
            $table->year('tahun');
            $table->foreignId('kategori_buku_id')->constrained('kategori_bukus')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('buku_pengarang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
            $table->foreignId('pengarang_id')->constrained('pengarangs')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('bukus');
        Schema::dropIfExists('buku_pengarang');
    }
};
