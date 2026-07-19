<?php

namespace App\Models;


use App\Models\HiburanImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hiburan extends Model
{
    use HasFactory;

    protected $table = 'hiburans';

    protected $primaryKey = 'id_hiburan';

    protected $fillable = [
        'kode_hiburan',
        'id_kategori',
        'nama_hiburan',
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
        return $this->hasMany(HiburanImage::class, 'id_hiburan', 'id_hiburan');
    }
}
