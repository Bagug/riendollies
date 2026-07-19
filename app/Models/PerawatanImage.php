<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerawatanImage extends Model
{
    protected $table = 'perawatan_images';

    protected $fillable = [
        'id_perawatan',
        'image',
    ];

    public function perawatan(): BelongsTo
    {
        return $this->belongsTo(
            Perawatan::class,
            'id_perawatan',
            'id_perawatan'
        );
    }
}