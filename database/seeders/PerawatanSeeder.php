<?php

namespace Database\Seeders;

use App\Models\Perawatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PerawatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_perawatan' => 'PRW001',
                'nama_perawatan' => 'Facial Brightening',
                'harga' => 500000,
                'deskripsi' => 'Perawatan wajah untuk membantu mencerahkan kulit sebelum hari pernikahan.',
            ],
            [
                'kode_perawatan' => 'PRW002',
                'nama_perawatan' => 'Spa Relaxation',
                'harga' => 750000,
                'deskripsi' => 'Perawatan spa untuk memberikan relaksasi dan menyegarkan tubuh.',
            ],
            [
                'kode_perawatan' => 'PRW003',
                'nama_perawatan' => 'Body Treatment',
                'harga' => 850000,
                'deskripsi' => 'Perawatan tubuh lengkap untuk menjaga kesehatan dan kecantikan kulit.',
            ],
            [
                'kode_perawatan' => 'PRW004',
                'nama_perawatan' => 'Hair Spa',
                'harga' => 450000,
                'deskripsi' => 'Perawatan rambut agar tetap sehat, lembut, dan berkilau.',
            ],
            [
                'kode_perawatan' => 'PRW005',
                'nama_perawatan' => 'Creambath Premium',
                'harga' => 400000,
                'deskripsi' => 'Creambath dengan produk premium untuk menutrisi rambut.',
            ],
            [
                'kode_perawatan' => 'PRW006',
                'nama_perawatan' => 'Totok Wajah',
                'harga' => 350000,
                'deskripsi' => 'Perawatan totok wajah untuk membantu melancarkan sirkulasi darah.',
            ],
            [
                'kode_perawatan' => 'PRW007',
                'nama_perawatan' => 'Manicure & Pedicure',
                'harga' => 600000,
                'deskripsi' => 'Perawatan kuku tangan dan kaki agar tampil bersih dan rapi.',
            ],
            [
                'kode_perawatan' => 'PRW008',
                'nama_perawatan' => 'Nail Art Wedding',
                'harga' => 550000,
                'deskripsi' => 'Layanan nail art dengan desain elegan untuk calon pengantin.',
            ],
            [
                'kode_perawatan' => 'PRW009',
                'nama_perawatan' => 'Bridal Treatment',
                'harga' => 1500000,
                'deskripsi' => 'Paket perawatan lengkap khusus calon pengantin sebelum hari H.',
            ],
            [
                'kode_perawatan' => 'PRW010',
                'nama_perawatan' => 'Premium Bridal Package',
                'harga' => 2500000,
                'deskripsi' => 'Paket perawatan premium mulai dari wajah, tubuh, rambut, hingga kuku.',
            ],
        ];

        foreach ($data as $item) {
            Perawatan::create([
                'kode_perawatan' => $item['kode_perawatan'],
                'id_kategori' => 2,
                'nama_perawatan' => $item['nama_perawatan'],
                'slug' => Str::slug($item['nama_perawatan']),
                'harga' => $item['harga'],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}