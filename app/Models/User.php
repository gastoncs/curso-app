<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtiene los atributos que deben ser convertidos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define una relación de uno a muchos con el modelo Favorito.
     *
     * @return HasMany
     */
    public function favoritos(): HasMany
    {
        return $this->hasMany(Favorito::class);
    }

    /**
     * Define una relación de muchos a muchos con el modelo Curso a través del modelo Favorito.
     *
     * @return BelongsToMany
     */
    public function cursosFavoritos(): BelongsToMany
    {
        return $this->belongsToMany(
            Curso::class,
            'favoritos'
        )->withTimestamps();
    }

    /**
     * Define una relación de uno a muchos con el modelo Comentario.
     *
     * @return HasMany
     */
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }
}
