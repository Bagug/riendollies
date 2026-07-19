<?php

namespace App\Models;

use App\Models\Dekorasi;
use App\Models\WeddingOrganizer;
use App\Models\Makeup;
use App\Models\Pakaian;
use App\Models\Perawatan;
use App\Models\Hiburan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['kode_kategori', 'nama_kategori', 'slug', 'color'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function dekorasi(): HasMany
    {
        return $this->hasMany(Dekorasi::class, 'id_kategori', 'id_kategori');
    }

    public function weddingOrganizers(): HasMany
    {
        return $this->hasMany(WeddingOrganizer::class, 'id_kategori', 'id_kategori');
    }

    public function makeups(): HasMany
    {
        return $this->hasMany(Makeup::class, 'id_kategori', 'id_kategori');
    }

    public function pakaians(): HasMany
    {
        return $this->hasMany(Pakaian::class, 'id_kategori', 'id_kategori');
    }

    public function perawatans(): HasMany
    {
        return $this->hasMany(Perawatan::class, 'id_kategori', 'id_kategori');
    }

    public function hiburans(): HasMany
    {
        return $this->hasMany(Hiburan::class, 'id_kategori', 'id_kategori');
    }

    // public function photographers(): HasMany
    // {
    //     return $this->hasMany(Photographer::class, 'id_kategori', 'id_kategori');
    // }

    // public function paketPernikahans(): HasMany
    // {
    //     return $this->hasMany(PaketPernikahan::class, 'id_kategori', 'id_kategori');
    // }
}
