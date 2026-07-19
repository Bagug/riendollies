<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pakaian extends Model
{
    protected $table = 'pakaians';

    protected $primaryKey = 'id_pakaian';

    protected $fillable = [
        'kode_pakaian',
        'id_kategori',
        'nama_pakaian',
        'ukuran',
        'jumlah_item',
        'slug',
        'harga',
        'status_ketersediaan',
        'deskripsi',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'id_kategori',
            'id_kategori'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(
            PakaianImage::class,
            'id_pakaian',
            'id_pakaian'
        );
    }
}
