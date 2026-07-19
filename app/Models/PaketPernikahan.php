<?php

namespace App\Models;


use App\Models\PaketPernikahanImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketPernikahan extends Model
{
    use HasFactory;

    protected $table = 'paket_pernikahans';

    protected $primaryKey = 'id_paket';

    protected $fillable = [
        'kode_paket',
        'id_kategori',
        'nama_paket',
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
        return $this->hasMany(PaketPernikahanImage::class, 'id_paket', 'id_paket');
    }
}
