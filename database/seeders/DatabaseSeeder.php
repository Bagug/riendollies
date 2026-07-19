<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            DekorasiSeeder::class,
            WeddingOrganizerSeeder::class,
            MakeupSeeder::class,
            PakaianSeeder::class,
            HiburanSeeder::class,
            PerawatanSeeder::class,
            PhotographerSeeder::class,
            PaketPernikahanSeeder::class,
        ]);
    }
}