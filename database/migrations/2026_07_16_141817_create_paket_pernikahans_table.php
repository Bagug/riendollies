<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paket_pernikahans', function (Blueprint $table) {
            $table->id('id_paket');

            $table->string('kode_paket', 25)->unique();

            $table->foreignId('id_kategori')
                ->constrained('categories', 'id_kategori')
                ->cascadeOnDelete();

            $table->string('nama_paket')
                ->collation('nocase')
                ->unique();

            $table->string('slug')->unique();

            $table->decimal('harga', 12, 2);

            $table->enum('status_ketersediaan', [
                'Tersedia',
                'Tidak Tersedia'
            ])->default('Tersedia');

            $table->text('deskripsi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_pernikahans');
    }
};
