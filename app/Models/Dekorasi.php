<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dekorasi extends Model
{
    use HasFactory;

    protected $table = 'dekorasis';

    protected $primaryKey = 'id_dekorasi';

    protected $fillable = [
        'kode_dekorasi',
        'id_kategori',
        'nama_dekorasi',
        'slug',
        'harga',
        'status_ketersediaan',
        'deskripsi',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }

    public function images(): HasMany
    {
        return $this->hasMany(DekorasiImage::class, 'id_dekorasi', 'id_dekorasi');
    }

    
}
