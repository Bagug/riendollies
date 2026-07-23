<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dekorasi_images', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('id_dekorasi');

            $table->foreign('id_dekorasi')
                ->references('id_dekorasi')
                ->on('dekorasis')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('image');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dekorasi_images');
    }
};