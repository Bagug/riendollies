<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotographerImage extends Model
{
    protected $table = 'photographer_images';

    protected $fillable = [
        'id_photographer',
        'image',
    ];

    public function photographer(): BelongsTo
    {
        return $this->belongsTo(
            Photographer::class,
            'id_photographer',
            'id_photographer'
        );
    }
}