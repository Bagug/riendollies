<?php

namespace Database\Seeders;

use App\Models\Dekorasi;
use App\Models\DekorasiImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DekorasiImageSeeder extends Seeder
{
    public function run(): void
    {
        $files = collect(
            File::files(storage_path('app/public/dekorasi'))
        );

        foreach (Dekorasi::all() as $dekorasi) {

            $gambar = $files->shuffle()->take(4);

            foreach ($gambar as $file) {

                DekorasiImage::create([
                    'id_dekorasi' => $dekorasi->id_dekorasi,
                    'image' => 'dekorasi/' . $file->getFilename(),
                ]);
            }
        }
    }
}