<?php

namespace App\Models;

use App\Models\MakeupImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Makeup extends Model
{
    use HasFactory;

    protected $table = 'makeups';

    protected $primaryKey = 'id_makeup';

    protected $fillable = [
        'kode_makeup',
        'id_kategori',
        'nama_makeup',
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
        return $this->hasMany(MakeupImage::class, 'id_makeup', 'id_makeup');
    }
}
