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
    Schema::create('detail_penyewaans', function (Blueprint $table) {

        $table->id('id_detail');

        $table->foreignId('id_penyewaan')
            ->constrained('penyewaans', 'id_penyewaan')
            ->cascadeOnDelete();

        $table->unsignedBigInteger('id_layanan');

        $table->string('jenis_layanan');

        $table->string('nama_layanan');

        $table->decimal('harga', 15, 2);

        $table->integer('qty')->default(1);

        $table->decimal('subtotal', 15, 2);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penyewaans');
    }
};
