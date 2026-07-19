<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'kode_kategori' => 'KTG001',
                'nama_kategori' => 'Barang',
                'color' => '#8B5CF6',
            ],
            [
                'kode_kategori' => 'KTG002',
                'nama_kategori' => 'Jasa',
                'color' => '#3B82F6',
            ],
        ];

        foreach ($categories as $index => $category) {
            Category::create([
                'kode_kategori' => $category['kode_kategori'],
                'nama_kategori' => $category['nama_kategori'],
                'slug' => Str::slug($category['nama_kategori']),
                'color' => $category['color'],
            ]);
        }
    }
}
