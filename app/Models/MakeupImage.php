<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MakeupImage extends Model
{
    protected $table = 'makeup_images';

    protected $fillable = [
        'id_makeup',
        'image',
    ];

    public function makeup(): BelongsTo
    {
        return $this->belongsTo(
            Makeup::class,
            'id_makeup',
            'id_makeup'
        );
    }
}