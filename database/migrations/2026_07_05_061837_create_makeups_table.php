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
        Schema::create('makeups', function (Blueprint $table) {

    $table->id('id_makeup');

    $table->unsignedBigInteger('id_kategori');

    $table->foreign('id_kategori')
        ->references('id_kategori')
        ->on('categories')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

    $table->string('kode_makeup',10)->unique();

    $table->string('nama_makeup')
      ->collation('nocase')
      ->unique();

    $table->string('slug',100)->unique();

    $table->decimal('harga',12,2);

     $table->enum('status_ketersediaan',[
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
        Schema::dropIfExists('makeups');
    }
};
