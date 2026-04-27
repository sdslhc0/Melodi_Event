<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'id_users',
        'id_acara',
        'nama_lengkap',
        'no_whatsapp',
        'jenis_acara',
        'biaya_venue',
        'jumlah_tamu',
        'acara_mulai',
        'acara_selesai',
        'id_paket_bundling',
        'jumlah_porsi',
        'tanggal',
        'waktu',
        'subtotal',
        'catatan',
        'metode_pembayaran',
        'bank',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'subtotal' => 'integer',
            'biaya_venue' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_acara');
    }

    public function detailBooking()
    {
        return $this->hasOne(DetailBooking::class, 'id_booking');
    }

    public function layanans()
    {
        return $this->hasMany(BookingLayanan::class, 'id_booking');
    }


    public function paketBundling()
    {
        return $this->belongsTo(PaketBundling::class, 'id_paket_bundling');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
