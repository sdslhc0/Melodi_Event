<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class AcaraController extends Controller
{
    public function index()
    {
        $acaras = Acara::with('kategori')->latest()->get();
        return view('backend.acara.index', compact('acaras'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('backend.acara.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['id_kategori', 'nama', 'harga', 'deskripsi']);

        if ($request->hasFile('foto')) {

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploaded = $cloudinary->uploadApi()->upload(
                $request->file('foto')->getRealPath(),
                ['folder' => 'acara']
            );

            $data['foto'] = $uploaded['secure_url'];
        }

        Acara::create($data);

        return redirect()->route('backend.acara.index')
            ->with('success', 'Acara berhasil ditambahkan!');
    }

    public function edit(Acara $acara)
    {
        $kategoris = Kategori::all();
        return view('backend.acara.edit', compact('acara', 'kategoris'));
    }

    public function update(Request $request, Acara $acara)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['id_kategori', 'nama', 'harga', 'deskripsi']);

        if ($request->hasFile('foto')) {

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploaded = $cloudinary->uploadApi()->upload(
                $request->file('foto')->getRealPath(),
                ['folder' => 'acara']
            );

            $data['foto'] = $uploaded['secure_url'];
        }

        $acara->update($data);

        return redirect()->route('backend.acara.index')
            ->with('success', 'Acara berhasil diupdate!');
    }

    public function destroy(Acara $acara)
    {
        $acara->delete();

        return redirect()->route('backend.acara.index')
            ->with('success', 'Acara berhasil dihapus!');
    }
}