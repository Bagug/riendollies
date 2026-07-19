<?php

namespace App\Models;


use App\Models\PhotographerImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Photographer extends Model
{
    use HasFactory;

    protected $table = 'photographers';

    protected $primaryKey = 'id_photographer';

    protected $fillable = [
        'kode_photographer',
        'id_kategori',
        'nama_photographer',
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
        return $this->hasMany(PhotographerImage::class, 'id_photographer', 'id_photographer');
    }
}
