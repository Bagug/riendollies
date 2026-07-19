<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perawatan_images', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('id_perawatan');

            $table->foreign('id_perawatan')
                ->references('id_perawatan')
                ->on('perawatans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('image',150);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perawatan_images');
    }
};