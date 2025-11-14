<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
   //index
    public function index()
    {
        $kategoris = KategoriBuku::all();
        return view('project.kategori.index', compact('kategoris'));
        $this->middleware('auth');
    }

    //create
    public function create()
    {
        return view('project.kategori.create');
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategoris = new KategoriBuku();
        $kategoris->nama_kategori = $request->nama_kategori;
        $kategoris->save();
        
        return redirect()->route('kategori.index')->with('success', 'Kategori Buku berhasil ditambahkan.');
    }

    //show

    public function show(string $id)
    {
        $kategoris = KategoriBuku::findOrFail($id);
        return view('project.kategori.show', compact('kategoris'));
    }

    //edit
    public function edit(string $id)
    {
        $kategoris = KategoriBuku::findOrFail($id);
        return view('project.kategori.edit', compact('kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategoris = KategoriBuku::findOrFail($id);
        $kategoris->nama_kategori = $request->nama_kategori;
        $kategoris->save();
        
        return redirect()->route('kategori.index')->with('success', 'Kategori Buku berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoris = KategoriBuku::findOrFail($id);
        $kategoris->delete();
        
        return redirect()->route('kategori.index')->with('success', 'Kategori Buku berhasil dihapus.');
    }
}