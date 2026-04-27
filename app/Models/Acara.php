<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $table = 'acaras';

    protected $fillable = [
        'id_kategori',
        'nama',
        'harga',
        'foto',
        'deskripsi',
    ];

    protected $casts = [
        'harga' => 'integer',
        'id_kategori' => 'integer'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_acara');
    }

    public function paketBundlings()
    {
        return $this->belongsToMany(PaketBundling::class, 'paket_bundling_acara', 'acara_id', 'paket_bundling_id');
    }

    public function getFormattedHargaAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
