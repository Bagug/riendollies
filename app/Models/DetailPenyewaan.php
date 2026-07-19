<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    protected $table = 'detail_penyewaans';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_penyewaan',
        'id_layanan',
        'jenis_layanan',
        'nama_layanan',
        'harga',
        'qty',
        'subtotal'
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan', 'id_penyewaan');
    }
}
