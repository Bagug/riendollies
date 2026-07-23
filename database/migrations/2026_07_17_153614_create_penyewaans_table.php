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
    Schema::create('penyewaans', function (Blueprint $table) {

    $table->id('id_penyewaan');

    $table->foreignId('id_pelanggan')
        ->constrained('pelanggans', 'id_pelanggan')
        ->cascadeOnDelete();

    $table->string('kode_penyewaan', 25)->unique();

    $table->date('tanggal_penyewaan');

    $table->date('tanggal_acara');

    $table->date('tanggal_selesai');

    $table->text('alamat_acara');

    $table->decimal('total_harga', 15, 2)->default(0);

    $table->enum('status', [
        'Menunggu Pembayaran',
        'Menunggu Verifikasi',
        'Disetujui',
        'Ditolak',
        'Selesai'
    ])->default('Menunggu Pembayaran');

    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
