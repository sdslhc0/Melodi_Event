<?php

namespace Database\Seeders;

use App\Models\Acara;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // USER
        // ========================
        User::create([
            'nama' => 'Admin MELODI',
            'email' => 'admin@melodi.com',
            'telepon' => '08123456789',
            'password' => Hash::make('password'),
            'role' => '1',
        ]);

        User::create([
            'nama' => 'User Demo',
            'email' => 'user@melodi.com',
            'telepon' => '08987654321',
            'password' => Hash::make('password'),
            'role' => '0',
        ]);

        // ========================
        // KATEGORI
        // ========================
        $kategoriData = [
            'Dekorasi' => ['Wedding', 'Birthday'],
            'Catering' => ['Reguler', 'Premium', 'VVIP'],
            'Fotografer' => ['Wedding & Pre-wed', 'Event Umum'],
            'Rias dan Busana' => ['Tradisional', 'Modern'],
            'Musik' => ['Band', 'Akustik'],
            'Buku Undangan' => ['Digital', 'Cetak Eksklusif'],
        ];

        $kategoriList = [];

        foreach ($kategoriData as $tipe => $listNama) {
            foreach ($listNama as $nama) {
                $kategori = Kategori::create([
                    'tipe' => $tipe,
                    'nama' => $nama
                ]);

                $kategoriList[$tipe][] = $kategori;
            }
        }

        // ========================
        // ACARA
        // ========================

        // Dekorasi
        Acara::create([
            'id_kategori' => $kategoriList['Dekorasi'][0]->id,
            'nama' => 'Paket Dekorasi Elegant Wedding',
            'harga' => 8000000,
            'deskripsi' => 'Dekorasi pelaminan lengkap tema elegant.',
            'foto' => null,
        ]);

        Acara::create([
            'id_kategori' => $kategoriList['Dekorasi'][1]->id,
            'nama' => 'Dekorasi Birthday Rustic',
            'harga' => 10000000,
            'deskripsi' => 'Dekorasi ulang tahun tema rustic kekinian.',
            'foto' => null,
        ]);

        // ========================
        // Catering
        // ========================

        // Reguler
        Acara::create([
            'id_kategori' => $kategoriList['Catering'][0]->id,
            'nama' => 'Paket Catering Reguler',
            'harga' => 25000,
            'deskripsi' => 'Menu hemat: nasi putih, ayam goreng, sayur tumis, sambal, kerupuk, air mineral.',
            'foto' => null,
        ]);

        // Premium
        Acara::create([
            'id_kategori' => $kategoriList['Catering'][1]->id,
            'nama' => 'Paket Catering Premium',
            'harga' => 50000,
            'deskripsi' => 'Menu variatif: ayam bakar madu, daging semur, capcay, buah, es teh manis.',
            'foto' => null,
        ]);

        // VVIP
        Acara::create([
            'id_kategori' => $kategoriList['Catering'][2]->id, // ✅ FIX INDEX
            'nama' => 'Paket Catering VVIP',
            'harga' => 75000,
            'deskripsi' => 'Menu mewah: nasi briyani, steak/cordon bleu, udang mentega, dessert, minuman spesial.',
            'foto' => null,
        ]);

        // Fotografer
        Acara::create([
            'id_kategori' => $kategoriList['Fotografer'][0]->id,
            'nama' => 'Foto Wedding & Prewedding',
            'harga' => 800000,
            'deskripsi' => 'Dokumentasi lengkap wedding & prewed.',
            'foto' => null,
        ]);

        Acara::create([
            'id_kategori' => $kategoriList['Fotografer'][1]->id,
            'nama' => 'Foto Event Standar',
            'harga' => 500000,
            'deskripsi' => 'Dokumentasi event profesional.',
            'foto' => null,
        ]);

        // Rias dan Busana
        Acara::create([
            'id_kategori' => $kategoriList['Rias dan Busana'][0]->id,
            'nama' => 'Rias Pengantin Tradisional',
            'harga' => 1500000,
            'deskripsi' => 'Make up dan busana adat lengkap.',
            'foto' => null,
        ]);

        Acara::create([
            'id_kategori' => $kategoriList['Rias dan Busana'][1]->id,
            'nama' => 'Rias Modern Exclusive',
            'harga' => 2000000,
            'deskripsi' => 'Make up modern + gaun premium.',
            'foto' => null,
        ]);

        // Musik
        Acara::create([
            'id_kategori' => $kategoriList['Musik'][0]->id,
            'nama' => 'Live Band Wedding',
            'harga' => 2500000,
            'deskripsi' => 'Band lengkap untuk wedding.',
            'foto' => null,
        ]);

        Acara::create([
            'id_kategori' => $kategoriList['Musik'][1]->id,
            'nama' => 'Akustik Santai',
            'harga' => 2000000,
            'deskripsi' => 'Musik akustik santai.',
            'foto' => null,
        ]);

        // Buku Undangan
        Acara::create([
            'id_kategori' => $kategoriList['Buku Undangan'][0]->id,
            'nama' => 'Undangan Digital Interaktif',
            'harga' => 3000,
            'deskripsi' => 'Undangan online modern.',
            'foto' => null,
        ]);

        Acara::create([
            'id_kategori' => $kategoriList['Buku Undangan'][1]->id,
            'nama' => 'Undangan Cetak Eksklusif',
            'harga' => 7000,
            'deskripsi' => 'Undangan cetak premium elegan.',
            'foto' => null,
        ]);

    }
}