<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeddingOrganizerImage extends Model
{
    protected $table = 'wedding_organizer_images';

    protected $fillable = [
        'id_wo',
        'image',
    ];

    public function weddingOrganizer(): BelongsTo
    {
        return $this->belongsTo(
            WeddingOrganizer::class,
            'id_wo',
            'id_wo'
        );
    }
}