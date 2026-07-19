<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photographer;
use Illuminate\Support\Str;

class PhotographerSeeder extends Seeder
{
    public function run(): void
    {
        
        $data = [
            [
                'kode_photographer' => 'FG001',
                'nama_photographer' => 'Silver Photography',
                'harga' => 2500000,
                'deskripsi' => 'Paket dokumentasi pernikahan dengan 1 fotografer profesional.',
            ],
            [
                'kode_photographer' => 'FG002',
                'nama_photographer' => 'Golden Photography',
                'harga' => 4000000,
                'deskripsi' => 'Paket dokumentasi dengan 2 fotografer dan album eksklusif.',
            ],
            [
                'kode_photographer' => 'FG003',
                'nama_photographer' => 'Premium Photography',
                'harga' => 6000000,
                'deskripsi' => 'Paket dokumentasi premium lengkap dengan drone dan video teaser.',
            ],
        ];

        foreach ($data as $item) {
            Photographer::create([
                'kode_photographer' => $item['kode_photographer'],
                'id_kategori' => 2,
                'nama_photographer' => $item['nama_photographer'],
                'slug' => Str::slug($item['nama_photographer']),
                'harga' => $item['harga'],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}