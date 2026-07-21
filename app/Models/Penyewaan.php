<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = 'penyewaans';

    protected $primaryKey = 'id_penyewaan';

    protected $fillable = [
        'id_pelanggan',
        'kode_penyewaan',
        'tanggal_penyewaan',
        'tanggal_acara',
        'tanggal_selesai',
        'alamat_acara',
        'total_harga',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function detailPenyewaans()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_penyewaan', 'id_penyewaan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class,'id_penyewaan','id_penyewaan');
    }
}
