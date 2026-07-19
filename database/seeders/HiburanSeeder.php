<?php

namespace Database\Seeders;

use App\Models\Hiburan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HiburanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_hiburan' => 'HIB001',
                'nama_hiburan' => 'Organ Tunggal',
                'harga' => 2500000,
                'deskripsi' => 'Layanan organ tunggal untuk memeriahkan acara pernikahan.',
            ],
            [
                'kode_hiburan' => 'HIB002',
                'nama_hiburan' => 'Band Akustik',
                'harga' => 3500000,
                'deskripsi' => 'Penampilan band akustik dengan lagu-lagu romantis.',
            ],
            [
                'kode_hiburan' => 'HIB003',
                'nama_hiburan' => 'Live Music',
                'harga' => 4500000,
                'deskripsi' => 'Layanan live music untuk menciptakan suasana yang berkesan.',
            ],
            [
                'kode_hiburan' => 'HIB004',
                'nama_hiburan' => 'Electone',
                'harga' => 3000000,
                'deskripsi' => 'Layanan electone dengan berbagai pilihan lagu.',
            ],
            [
                'kode_hiburan' => 'HIB005',
                'nama_hiburan' => 'String Quartet',
                'harga' => 5500000,
                'deskripsi' => 'Penampilan string quartet yang elegan untuk acara pernikahan.',
            ],
            [
                'kode_hiburan' => 'HIB006',
                'nama_hiburan' => 'Angklung',
                'harga' => 2800000,
                'deskripsi' => 'Pertunjukan angklung khas Indonesia untuk memeriahkan acara.',
            ],
            [
                'kode_hiburan' => 'HIB007',
                'nama_hiburan' => 'Degung Sunda',
                'harga' => 4000000,
                'deskripsi' => 'Pertunjukan musik tradisional Sunda yang khas.',
            ],
            [
                'kode_hiburan' => 'HIB008',
                'nama_hiburan' => 'Wedding Band',
                'harga' => 6000000,
                'deskripsi' => 'Band profesional khusus acara resepsi pernikahan.',
            ],
            [
                'kode_hiburan' => 'HIB009',
                'nama_hiburan' => 'DJ Performance',
                'harga' => 5000000,
                'deskripsi' => 'Penampilan DJ dengan musik modern untuk resepsi.',
            ],
            [
                'kode_hiburan' => 'HIB010',
                'nama_hiburan' => 'MC Professional',
                'harga' => 3500000,
                'deskripsi' => 'Master of Ceremony profesional untuk memandu jalannya acara.',
            ],
        ];

        foreach ($data as $item) {
            Hiburan::create([
                'kode_hiburan' => $item['kode_hiburan'],
                'id_kategori' => 2,
                'nama_hiburan' => $item['nama_hiburan'],
                'slug' => Str::slug($item['nama_hiburan']),
                'harga' => $item['harga'],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}