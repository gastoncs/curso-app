<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructores';

    /**
     * Obtiene los cursos que tiene el instructor.
     *
     * @return HasMany
     */
    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class);
    }

    /**
     * Obtiene los comentarios de los cursos.
     *
     * @return MorphMany
     */
    public function comentarios(): MorphMany
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }
}

