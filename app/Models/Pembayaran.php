<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_penyewaan',
        'tanggal_pembayaran',
        'bukti_pembayaran',
        'status_verifikasi',
        'catatan_admin'
    ];

    public function penyewaan()
    {
        return $this->belongsTo(
            Penyewaan::class,
            'id_penyewaan',
            'id_penyewaan'
        );
    }
}