<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Pengarang;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with(['kategoriBuku', 'pengarangs'])->latest()->get();
        return view('project.buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris  = KategoriBuku::all();
        $pengarangs = Pengarang::all();
        return view('project.buku.create', compact('kategoris', 'pengarangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'            => 'required',
            'kategori_buku_id' => 'required',
            'pengarang_id'     => 'required|array',
            'stok'             => 'required|integer',
            'tahun'            => 'required|integer',
        ]);

        // 1. Simpan data buku
        $buku = Buku::create([
            'judul'            => $request->judul,
            'kategori_buku_id' => $request->kategori_buku_id,
            'stok'             => $request->stok,
            'tahun'            => $request->tahun,
        ]);

        // 2. Attach pengarang ke pivot buku_pengarang
        $buku->pengarangs()->attach($request->pengarang_id);

        return redirect()->route('buku.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }


    public function show($id)
    {
        $buku = Buku::with(['kategoriBuku', 'pengarangs'])->findOrFail($id);
        return view('project.buku.show', compact('buku'));
    }

    public function edit($id)
    {
        $buku = Buku::with(['pengarangs'])->findOrFail($id);
        $kategoris = KategoriBuku::all();
        $pengarangs = Pengarang::all();
        return view('project.buku.edit', compact('buku','kategoris','pengarangs'));

    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required|exists:kategori_bukus,id',
            'stok' => 'required|integer',
            'tahun' => 'required|integer',
            'pengarang_id' => 'required|array',
        ]);

        // Update data buku
        $buku->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'tahun' => $request->tahun,
        ]);

        // Sinkron pengarang many-to-many
        $buku->pengarangs()->sync($request->pengarang_id);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui');
    }


    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}