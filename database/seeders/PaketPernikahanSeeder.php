<?php

namespace Database\Seeders;

use App\Models\PaketPernikahan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaketPernikahanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_paket' => 'PKT001',
                'nama_paket' => 'Paket Silver',
                'harga' => 15000000,
                'deskripsi' => 'Paket Silver meliputi dekorasi pelaminan sederhana, rias pengantin, dan dokumentasi acara.',
            ],
            [
                'kode_paket' => 'PKT002',
                'nama_paket' => 'Paket Gold',
                'harga' => 25000000,
                'deskripsi' => 'Paket Gold meliputi dekorasi premium, rias pengantin, wedding organizer, dan dokumentasi lengkap.',
            ],
            [
                'kode_paket' => 'PKT003',
                'nama_paket' => 'Paket Platinum',
                'harga' => 40000000,
                'deskripsi' => 'Paket Platinum mencakup seluruh layanan premium Riendollies dengan fasilitas lengkap.',
            ],
            [
                'kode_paket' => 'PKT004',
                'nama_paket' => 'Paket Rustic',
                'harga' => 22000000,
                'deskripsi' => 'Paket dengan konsep rustic yang cocok untuk acara indoor maupun outdoor.',
            ],
            [
                'kode_paket' => 'PKT005',
                'nama_paket' => 'Paket Garden Party',
                'harga' => 27000000,
                'deskripsi' => 'Paket bertema taman dengan dekorasi bunga segar dan suasana alami.',
            ],
            [
                'kode_paket' => 'PKT006',
                'nama_paket' => 'Paket Adat Sunda',
                'harga' => 30000000,
                'deskripsi' => 'Paket pernikahan dengan konsep adat Sunda lengkap beserta dekorasi tradisional.',
            ],
            [
                'kode_paket' => 'PKT007',
                'nama_paket' => 'Paket Modern Elegan',
                'harga' => 32000000,
                'deskripsi' => 'Paket modern dengan dekorasi elegan dan dokumentasi profesional.',
            ],
            [
                'kode_paket' => 'PKT008',
                'nama_paket' => 'Paket Minimalis',
                'harga' => 18000000,
                'deskripsi' => 'Paket sederhana namun tetap elegan untuk acara pernikahan yang intim.',
            ],
            [
                'kode_paket' => 'PKT009',
                'nama_paket' => 'Paket Luxury',
                'harga' => 50000000,
                'deskripsi' => 'Paket eksklusif dengan layanan premium, dekorasi mewah, dan dokumentasi terbaik.',
            ],
            [
                'kode_paket' => 'PKT010',
                'nama_paket' => 'Paket Exclusive',
                'harga' => 60000000,
                'deskripsi' => 'Paket paling lengkap dengan seluruh fasilitas dan layanan terbaik Riendollies.',
            ],
        ];

        foreach ($data as $item) {
            PaketPernikahan::create([
                'kode_paket' => $item['kode_paket'],
                'id_kategori' => 1, 
                'nama_paket' => $item['nama_paket'],
                'slug' => Str::slug($item['nama_paket']),
                'harga' => $item['harga'],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}