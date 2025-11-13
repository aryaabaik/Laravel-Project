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
            'judul'            => 'required|string|max:255',
            'stok'             => 'required|integer|min:0',
            'tahun'            => 'required|integer|min:1900|max:' . date('Y'),
            'id_kategori_buku' => 'required|exists:kategori_bukus,id',
            'id_pengarang'     => 'required|array',
            'id_pengarang.*'   => 'exists:pengarangs,id',
        ]);

        // Buat buku utama dulu
        $buku                   = new Buku();
        $buku->judul            = $request->judul;
        $buku->stok             = $request->stok;
        $buku->tahun            = now()->year;
        $buku->kategori_buku_id = $request->id_kategori_buku;
        $buku->save();

        $buku = Buku::create([
    'judul' => $request->judul,
    'stok'  => $request->stok,
    'tahun' => $request->tahun,
]);

$buku->kategori()->attach($request->kategori_buku_id);


        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');

    }

    public function show($id)
    {
        $buku = Buku::with(['kategoriBuku', 'pengarangs'])->findOrFail($id);
        return view('project.buku.show', compact('buku'));
    }

    public function edit($id)
    {
        $buku       = Buku::with(['kategoriBuku', 'pengarangs'])->findOrFail($id);
        $kategoris  = KategoriBuku::all();
        $pengarangs = Pengarang::all();

        return view('project.buku.edit', compact('buku', 'kategoris', 'pengarangs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'stok'             => 'required|integer|min:0',
            'tahun'            => 'required|integer|min:1900|max:' . date('Y'),
            'id_kategori_buku' => 'required|exists:kategori_bukus,id',
            'id_pengarang'     => 'required|array',
            'id_pengarang.*'   => 'exists:pengarangs,id',
        ]);

        // Buat buku utama dulu
        $buku                   = new Buku();
        $buku->judul            = $request->judul;
        $buku->stok             = $request->stok;
        $buku->tahun            = now()->year;
        $buku->kategori_buku_id = $request->id_kategori_buku;
        $buku->save();

        $buku->pengarangs()->sync($request->id_pengarang);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diubah!');
    }

    public function destroy($id)
    {
        $kategoris = KategoriBuku::findOrFail($id);
        $kategoris->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori Buku berhasil dihapus.');
    }
}
