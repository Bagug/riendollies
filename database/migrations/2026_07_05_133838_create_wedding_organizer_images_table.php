<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wedding_organizer_images', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('id_wo');

            $table->foreign('id_wo')
                ->references('id_wo')
                ->on('wedding_organizers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('image');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_organizer_images');
    }
};