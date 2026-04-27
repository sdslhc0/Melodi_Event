<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

use App\Models\Kategori;

class FrontendLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $kategori_tipes = Kategori::select('tipe')->distinct()->pluck('tipe');
        return view('layouts.frontend', compact('kategori_tipes'));
    }
}
