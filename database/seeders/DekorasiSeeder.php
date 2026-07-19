<?php

namespace Database\Seeders;

use App\Models\Dekorasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DekorasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_dekorasi' => 'DKR001',
                'nama_dekorasi' => 'Dekorasi Rustic',
                'harga' => 8500000,
                'deskripsi' => 'Dekorasi bertema rustic dengan dominasi elemen kayu dan bunga bernuansa alami.',
            ],
            [
                'kode_dekorasi' => 'DKR002',
                'nama_dekorasi' => 'Dekorasi Modern Elegan',
                'harga' => 10000000,
                'deskripsi' => 'Dekorasi modern dengan sentuhan warna elegan yang cocok untuk resepsi indoor.',
            ],
            [
                'kode_dekorasi' => 'DKR003',
                'nama_dekorasi' => 'Dekorasi Garden Party',
                'harga' => 12000000,
                'deskripsi' => 'Dekorasi konsep taman dengan bunga segar untuk acara outdoor.',
            ],
            [
                'kode_dekorasi' => 'DKR004',
                'nama_dekorasi' => 'Dekorasi Minimalis',
                'harga' => 7500000,
                'deskripsi' => 'Dekorasi sederhana namun tetap elegan dengan konsep minimalis.',
            ],
            [
                'kode_dekorasi' => 'DKR005',
                'nama_dekorasi' => 'Dekorasi Glamour',
                'harga' => 15000000,
                'deskripsi' => 'Dekorasi mewah dengan dominasi warna emas dan kristal.',
            ],
            [
                'kode_dekorasi' => 'DKR006',
                'nama_dekorasi' => 'Dekorasi Adat Sunda',
                'harga' => 13000000,
                'deskripsi' => 'Dekorasi khas Sunda dengan sentuhan budaya tradisional.',
            ],
            [
                'kode_dekorasi' => 'DKR007',
                'nama_dekorasi' => 'Dekorasi Indoor',
                'harga' => 9000000,
                'deskripsi' => 'Dekorasi khusus gedung indoor dengan tata cahaya yang elegan.',
            ],
            [
                'kode_dekorasi' => 'DKR008',
                'nama_dekorasi' => 'Dekorasi Outdoor',
                'harga' => 11000000,
                'deskripsi' => 'Dekorasi untuk pesta kebun dan area terbuka dengan konsep alami.',
            ],
            [
                'kode_dekorasi' => 'DKR009',
                'nama_dekorasi' => 'Dekorasi Vintage',
                'harga' => 9500000,
                'deskripsi' => 'Dekorasi bertema vintage dengan nuansa klasik yang hangat.',
            ],
            [
                'kode_dekorasi' => 'DKR010',
                'nama_dekorasi' => 'Dekorasi Luxury',
                'harga' => 18000000,
                'deskripsi' => 'Dekorasi premium dengan desain eksklusif untuk acara pernikahan mewah.',
            ],
        ];

        foreach ($data as $item) {
            Dekorasi::create([
                'kode_dekorasi' => $item['kode_dekorasi'],
                'id_kategori' => 1,
                'nama_dekorasi' => $item['nama_dekorasi'],
                'slug' => Str::slug($item['nama_dekorasi']),
                'harga' => $item['harga'],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}