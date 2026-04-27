<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingLayanan extends Model
{
    use HasFactory;

    protected $table = 'booking_layanans';

    protected $fillable = [
        'id_booking',
        'id_acara',
        'harga',
        'qty',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_acara');
    }
}
