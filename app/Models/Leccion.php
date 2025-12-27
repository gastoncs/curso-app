<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones';

    protected $fillable = ['titulo', 'curso_id'];

    /**
     * Obtiene el curso al que pertenece la lección.
     *
     * @return BelongsTo
     */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    /**
     * Obtiene el video de la lección.
     *
     * @return HasOne
     */
    public function video(): HasOne
    {
        return $this->hasOne(Video::class);
    }
}
