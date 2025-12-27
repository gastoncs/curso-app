<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'instructor_id'];

    /**
     * Instructor del curso.
     *
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Lecciones del curso.
     *
     * @return HasMany
     */
    public function lecciones(): HasMany
    {
        return $this->hasMany(Leccion::class);
    }

    /**
     * Relación con los favoritos.
     *
     * @return HasMany
     */
    public function favoritos(): HasMany
    {
        return $this->hasMany(Favorito::class);
    }

    /**
     * Usuarios que seleccionaron como favorito.
     *
     * @return BelongsToMany
     */
    public function usuariosQueSeleccionaronFavorito(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'favoritos'
        )->withTimestamps();
    }

    /**
     * Relación polimórfica con los comentarios.
     *
     * @return MorphMany
     */
    public function comentarios(): MorphMany
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    /**
     * Elimina el curso de forma segura.
     *
     * @return void
     * @throws \Exception
     */
    public function safeDelete(): void
    {
        if ($this->instructor->cursos()->count() <= 1) {
            throw new \Exception('El instructor debe de tener al menos un curso registrado');
        }

        $this->delete();
    }
}
