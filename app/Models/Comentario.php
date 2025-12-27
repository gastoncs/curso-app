<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'comentario',
        'calificacion',
        'user_id',
        'comentable_id',
        'comentable_type'
    ];

    /**
     * Obtiene el usuario que ha comentado.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el modelo que puede ser comentado.
     *
     * @return MorphTo
     */
    public function comentable(): MorphTo
    {
        return $this->morphTo();
    }
}

