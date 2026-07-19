<?php

namespace Database\Seeders;

use App\Models\Makeup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MakeupSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Makeup Natural', 800000],
            ['Makeup Glamour', 1200000],
            ['Makeup Premium', 1800000],
            ['Makeup Bridal', 2000000],
            ['Makeup Traditional', 1500000],
            ['Makeup Engagement', 1000000],
            ['Makeup VIP', 2500000],
            ['Makeup Bridesmaid', 700000],
            ['Makeup Family', 900000],
            ['Makeup Exclusive', 3000000],
        ];

        foreach ($data as $i => $item) {
            Makeup::create([
                'kode_makeup' => 'MKP'.str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'id_kategori' => 2,
                'nama_makeup' => $item[0],
                'slug' => Str::slug($item[0]),
                'harga' => $item[1],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => 'Jasa '.$item[0].' untuk menunjang penampilan di hari spesial.',
            ]);
        }
    }
}