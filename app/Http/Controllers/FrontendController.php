<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Kategori;
use App\Models\Review;
use App\Models\PaketBundling;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        // 1. Fetch categories with limited fields and their services in one go
        $layananByTipe = Kategori::with(['acaras' => function($q) {
            $q->select('id', 'id_kategori', 'nama', 'harga')->orderBy('harga', 'asc');
        }])
        ->where('tipe', '!=', 'Katering')
        ->get(['id', 'nama', 'tipe'])
        ->groupBy('tipe');

        // 2. Optimized Base Prices Calculation (Single Query Group By)
        $basePrices = Kategori::join('acaras', 'kategoris.id', '=', 'acaras.id_kategori')
            ->selectRaw('tipe, min(harga) as min_harga')
            ->groupBy('tipe')
            ->pluck('min_harga', 'tipe');

        // 3. Fetch latest services for featured display
        $acaras = Acara::with('kategori:id,nama,tipe')->latest()->take(6)->get(['id', 'id_kategori', 'nama', 'harga', 'foto']);

        // 4. Transform categories to a simpler JSON format for Alpine.js
        $layananList = [];
        foreach ($layananByTipe as $tipe => $kategoris) {
            $packages = [];
            foreach ($kategoris as $kat) {
                foreach ($kat->acaras as $a) {
                    $packages[] = [
                        'id' => $a->id,
                        'nama' => $a->nama,
                        'harga' => $a->harga,
                    ];
                }
            }
            if (!empty($packages)) {
                $layananList[] = [
                    'tipe' => $tipe,
                    'packages' => $packages
                ];
            }
        }

        // 5. Fetch reviews, catering, and bundling (with optimized relations)
        $reviews = Review::with('user:id,nama')->latest()->take(10)->get();
        $paketBundlings = PaketBundling::with('acaras:id,nama')->get();

        $tipes = $basePrices->keys();

        return view('frontend.home', compact(
            'tipes', 'acaras', 'layananList', 'basePrices', 'reviews', 'paketBundlings'
        ));
    }

    public function kategori(Request $request)
    {
        $tipe = $request->tipe ?? 'all';
        
        $kategoriQuery = Kategori::query();
        if ($tipe !== 'all') {
            $kategoriQuery->where('tipe', $tipe);
        }
        $kategoris = $kategoriQuery->get();

        $query = Acara::with('kategori');

        if ($tipe !== 'all') {
            $query->whereHas('kategori', function($q) use ($tipe) {
                $q->where('tipe', $tipe);
            });
        } elseif ($request->t) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('tipe', $request->t);
            });
        }

        if ($request->has('kategori') && $request->kategori != 'all') {
            $query->where('id_kategori', $request->kategori);
        }

        $acaras = $query->latest()->get();

        return view('frontend.kategori', compact('kategoris', 'acaras', 'tipe'));
    }

    public function detailAcara(Acara $acara)
    {
        $acara->load('kategori');
        $related = Acara::where('id_kategori', $acara->id_kategori)
            ->where('id', '!=', $acara->id)
            ->take(3)
            ->get();

        return view('frontend.detail-acara', compact('acara', 'related'));
    }
}
