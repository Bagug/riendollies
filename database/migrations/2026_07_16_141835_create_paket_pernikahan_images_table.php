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
        Schema::create('paket_pernikahan_images', function (Blueprint $table) {

            $table->id();

            $table->foreignId('id_paket')
                ->constrained('paket_pernikahans', 'id_paket')
                ->cascadeOnDelete();

            $table->string('image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_pernikahan_images');
    }
};
