<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarangs = Pengarang::all();
        return view('project.pengarang.index', compact('pengarangs'));
    }

    //create
    public function create()
    {
        return view('project.pengarang.create');
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengarang' => 'required|string|max:255',
        ]);

        $pengarangs = new Pengarang();
        $pengarangs->nama_pengarang = $request->nama_pengarang;
        $pengarangs->save();
        
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan.');
    }

   
    public function show(string $id)
    {
        $pengarangs = Pengarang::findOrFail($id);
        return view('project.pengarang.show', compact('pengarangs'));
    }

    public function edit(string $id)
    {
        $pengarangs = Pengarang::findOrFail($id);
        return view('project.pengarang.edit', compact('pengarangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'nama_pengarang' => 'required|string|max:255',
        ]);

        $pengarangs = new Pengarang();
        $pengarangs->nama_pengarang = $request->nama_pengarang;
        $pengarangs->save();
        
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan.');
    }

    //destroy
    public function destroy(string $id)
    {
        $pengaranngs = Pengarang::findOrFail($id);
        $pengarangs->delete();

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus.');
    }
}
