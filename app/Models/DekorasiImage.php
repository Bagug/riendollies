<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DekorasiImage extends Model
{
    protected $table = 'dekorasi_images';

    protected $fillable = [
        'id_dekorasi',
        'image',
    ];

    public function dekorasi(): BelongsTo
    {
        return $this->belongsTo(
            Dekorasi::class,
            'id_dekorasi',
            'id_dekorasi'
        );
    }
}