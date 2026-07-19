<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama',
        'username',
        'email',
        'no_hp',
        'alamat',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function penyewaans()
{
    return $this->hasMany(Penyewaan::class, 'id_pelanggan', 'id_pelanggan');
}

}

