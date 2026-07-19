<?php

namespace Database\Seeders;

use App\Models\Pakaian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PakaianSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_pakaian' => 'PKN001',
                'nama_pakaian' => 'Gaun Pengantin A-Line',
                'ukuran' => 'M',
                'jumlah_item' => 1,
                'harga' => 3500000,
                'deskripsi' => 'Gaun pengantin model A-Line dengan desain elegan dan modern.',
            ],
            [
                'kode_pakaian' => 'PKN002',
                'nama_pakaian' => 'Gaun Mermaid',
                'ukuran' => 'S',
                'jumlah_item' => 1,
                'harga' => 4000000,
                'deskripsi' => 'Gaun pengantin model Mermaid yang anggun dan mewah.',
            ],
            [
                'kode_pakaian' => 'PKN003',
                'nama_pakaian' => 'Ball Gown Premium',
                'ukuran' => 'L',
                'jumlah_item' => 1,
                'harga' => 5000000,
                'deskripsi' => 'Gaun Ball Gown premium dengan detail bordir eksklusif.',
            ],
            [
                'kode_pakaian' => 'PKN004',
                'nama_pakaian' => 'Kebaya Modern',
                'ukuran' => 'M',
                'jumlah_item' => 2,
                'harga' => 2000000,
                'deskripsi' => 'Kebaya modern cocok untuk akad maupun resepsi.',
            ],
            [
                'kode_pakaian' => 'PKN005',
                'nama_pakaian' => 'Kebaya Sunda',
                'ukuran' => 'L',
                'jumlah_item' => 2,
                'harga' => 2500000,
                'deskripsi' => 'Kebaya adat Sunda dengan sentuhan tradisional.',
            ],
            [
                'kode_pakaian' => 'PKN006',
                'nama_pakaian' => 'Beskap Sunda',
                'ukuran' => 'XL',
                'jumlah_item' => 2,
                'harga' => 1800000,
                'deskripsi' => 'Beskap pria adat Sunda lengkap dengan aksesoris.',
            ],
            [
                'kode_pakaian' => 'PKN007',
                'nama_pakaian' => 'Jas Pengantin Premium',
                'ukuran' => 'L',
                'jumlah_item' => 1,
                'harga' => 2500000,
                'deskripsi' => 'Jas pengantin premium dengan bahan berkualitas.',
            ],
            [
                'kode_pakaian' => 'PKN008',
                'nama_pakaian' => 'Dress Bridesmaid',
                'ukuran' => 'M',
                'jumlah_item' => 6,
                'harga' => 3000000,
                'deskripsi' => 'Paket dress bridesmaid dengan warna senada.',
            ],
            [
                'kode_pakaian' => 'PKN009',
                'nama_pakaian' => 'Kebaya Orang Tua',
                'ukuran' => 'XL',
                'jumlah_item' => 2,
                'harga' => 2200000,
                'deskripsi' => 'Kebaya elegan untuk orang tua pengantin.',
            ],
            [
                'kode_pakaian' => 'PKN010',
                'nama_pakaian' => 'Jas Pendamping',
                'ukuran' => 'L',
                'jumlah_item' => 4,
                'harga' => 2800000,
                'deskripsi' => 'Jas pendamping pria dengan desain formal.',
            ],
        ];

        foreach ($data as $item) {
            Pakaian::create([
                'kode_pakaian' => $item['kode_pakaian'],
                'id_kategori' => 1,
                'nama_pakaian' => $item['nama_pakaian'],
                'ukuran' => $item['ukuran'],
                'jumlah_item' => $item['jumlah_item'],
                'slug' => Str::slug($item['nama_pakaian']),
                'harga' => $item['harga'],
                'status_ketersediaan' => 'Tersedia',
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}