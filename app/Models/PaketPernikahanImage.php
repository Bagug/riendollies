<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketPernikahanImage extends Model
{
    protected $table = 'paket_pernikahan_images';

    protected $fillable = [
        'id_paket',
        'image',
    ];

    public function paket(): BelongsTo
    {
        return $this->belongsTo(
            PaketPernikahan::class,
            'id_paket',
            'id_paket'
        );
    }
}