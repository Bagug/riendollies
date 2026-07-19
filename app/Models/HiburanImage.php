<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HiburanImage extends Model
{
    protected $table = 'hiburan_images';

    protected $fillable = [
        'id_hiburan',
        'image',
    ];

    public function hiburan(): BelongsTo
    {
        return $this->belongsTo(
            Hiburan::class,
            'id_hiburan',
            'id_hiburan'
        );
    }
}