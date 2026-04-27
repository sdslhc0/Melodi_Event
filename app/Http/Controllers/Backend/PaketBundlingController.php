<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\PaketBundling;
use Illuminate\Http\Request;

class PaketBundlingController extends Controller
{
    public function index()
    {
        $paketBundlings = PaketBundling::with('acaras.kategori')->latest()->get();
        return view('backend.bundling.index', compact('paketBundlings'));
    }

    public function create()
    {
        $acarasByTipe = Acara::with('kategori')->get()->groupBy(function ($acara) {
            return $acara->kategori->tipe ?? 'Lainnya';
        });
        return view('backend.bundling.create', compact('acarasByTipe'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'layanan' => 'required|array|min:1',
            'layanan.*' => 'exists:acaras,id',
        ], [
            'layanan.required' => 'Pilih minimal 1 layanan untuk paket bundling.',
            'layanan.min' => 'Pilih minimal 1 layanan untuk paket bundling.',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $uploaded = cloudinary()->upload($request->file('gambar')->getRealPath(), [
                'folder' => 'paket-bundling'
            ]);
            $data['gambar'] = $uploaded->getSecurePath();
        }

        $paket = PaketBundling::create($data);
        $paket->acaras()->sync($request->layanan);

        return redirect()->route('backend.bundling.index')
            ->with('success', 'Paket Bundling berhasil ditambahkan.');
    }

    public function edit(PaketBundling $bundling)
    {
        $bundling->load('acaras');
        $acarasByTipe = Acara::with('kategori')->get()->groupBy(function ($acara) {
            return $acara->kategori->tipe ?? 'Lainnya';
        });
        $selectedAcaraIds = $bundling->acaras->pluck('id')->toArray();
        return view('backend.bundling.edit', compact('bundling', 'acarasByTipe', 'selectedAcaraIds'));
    }

    public function update(Request $request, PaketBundling $bundling)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'layanan' => 'required|array|min:1',
            'layanan.*' => 'exists:acaras,id',
        ], [
            'layanan.required' => 'Pilih minimal 1 layanan untuk paket bundling.',
            'layanan.min' => 'Pilih minimal 1 layanan untuk paket bundling.',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $uploaded = cloudinary()->upload($request->file('gambar')->getRealPath(), [
                'folder' => 'paket-bundling'
            ]);
            $data['gambar'] = $uploaded->getSecurePath();
        }

        $bundling->update($data);
        $bundling->acaras()->sync($request->layanan);

        return redirect()->route('backend.bundling.index')
            ->with('success', 'Paket Bundling berhasil diupdate.');
    }

    public function destroy(PaketBundling $bundling)
    {
        $bundling->delete();

        return redirect()->route('backend.bundling.index')
            ->with('success', 'Paket Bundling berhasil dihapus.');
    }
}