<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('acaras')->latest()->get();
        return view('backend.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('backend.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        Kategori::create($request->only('tipe', 'nama'));

        return redirect()->route('backend.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('backend.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'tipe' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $kategori->update($request->only('tipe', 'nama'));

        return redirect()->route('backend.kategori.index')
            ->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('backend.kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
