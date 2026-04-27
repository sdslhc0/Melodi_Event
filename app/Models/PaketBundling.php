<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBundling extends Model
{
    use HasFactory;

    protected $table = 'paket_bundlings';

    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'gambar',
    ];

    /**
     * Layanan (acara) included in this bundling package
     */
    public function acaras()
    {
        return $this->belongsToMany(Acara::class, 'paket_bundling_acara', 'paket_bundling_id', 'acara_id')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_paket_bundling');
    }

    public function getFormattedHargaAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
