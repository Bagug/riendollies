<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perawatan extends Model
{
    use HasFactory;

    protected $table = 'perawatans';

    protected $primaryKey = 'id_perawatan';

    protected $fillable = [
        'kode_perawatan',
        'id_kategori',
        'nama_perawatan',
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
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PerawatanImage::class, 'id_perawatan', 'id_perawatan');
    }
}
