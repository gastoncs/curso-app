<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'leccion_id'];

    /**
     * Obtiene la lección a la que pertenece el video.
     *
     * @return BelongsTo
     */
    public function leccion(): BelongsTo
    {
        return $this->belongsTo(Leccion::class);
    }
}
