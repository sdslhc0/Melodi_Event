<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = ['tipe', 'nama'];

    public function acaras()
    {
        return $this->hasMany(Acara::class, 'id_kategori');
    }
}
