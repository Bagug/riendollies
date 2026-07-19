<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PakaianImage extends Model
{
    protected $table = 'pakaian_images';

    protected $fillable = [
        'id_pakaian',
        'image',
    ];

    public function pakaian(): BelongsTo
    {
        return $this->belongsTo(
            Pakaian::class,
            'id_pakaian',
            'id_pakaian'
        );
    }
}