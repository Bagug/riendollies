<?php

namespace Database\Seeders;

use App\Models\WeddingOrganizer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WeddingOrganizerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_wo' => 'WO001',
                'nama_wo' => 'WO Silver',
                'harga' => 5000000,
                'deskripsi' => 'Paket Wedding Organizer Silver untuk acara pernikahan sederhana dengan pelayanan profesional.',
            ],
            [
                'kode_wo' => 'WO002',
                'nama_wo' => 'WO Gold',
                'harga' => 7500000,
                'deskripsi' => 'Paket Wedding Organizer Gold dengan koordinasi acara yang lebih lengkap.',
            ],
            [
                'kode_wo' => 'WO003',
                'nama_wo' => 'WO Platinum',
                'harga' => 10000000,
                'deskripsi' => 'Paket Wedding Organizer Platinum dengan pelayanan premium.',
            ],
            [
                'kode_wo' => 'WO004',
                'nama_wo' => 'WO Premium',
                'harga' => 12500000,
                'deskripsi' => 'Paket Wedding Organizer Premium untuk acara pernikahan eksklusif.',
            ],
            [
                'kode_wo' => 'WO005',
                'nama_wo' => 'WO Exclusive',
                'harga' => 15000000,
                'deskripsi' => 'Paket Wedding Organizer Exclusive dengan pelayanan maksimal.',
            ],
            [
                'kode_wo' => 'WO006',
                'nama_wo' => 'WO Luxury',
                'harga' => 18000000,
                'deskripsi' => 'Paket Wedding Organizer Luxury untuk konsep pernikahan mewah.',
            ],
            [
                'kode_wo' => 'WO007',
                'nama_wo' => 'WO Intimate Wedding',
                'harga' => 7000000,
                'deskripsi' => 'Paket Wedding Organizer khusus acara intimate wedding.',
            ],
            [
                'kode_wo' => 'WO008',
                'nama_wo' => 'WO Outdoor Wedding',
                'harga' => 11000000,
                'deskripsi' => 'Paket Wedding Organizer untuk konsep outdoor wedding.',
            ],
            [
                'kode_wo' => 'WO009',
                'nama_wo' => 'WO Traditional Wedding',
                'harga' => 13000000,
                'deskripsi' => 'Paket Wedding Organizer dengan konsep adat tradisional.',
            ],
            [
                'kode_wo' => 'WO010',
                'nama_wo' => 'WO Signature',
                'harga' => 20000000,
                'deskripsi' => 'Paket Wedding Organizer Signature dengan layanan terbaik.',
            ],
        ];

        foreach ($data as $item) {
            WeddingOrganizer::create([
                'kode_wo' => $item['kode_wo'],
                'id_kategori' => 1,
                'nama_wo' => $item['nama_wo'],
                'slug' => Str::slug($item['nama_wo']),
                'harga' => $item['harga'],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}