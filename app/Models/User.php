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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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
     * Define a one-to-many relationship with the Favorito model.
     *
     * @return HasMany
     */
    public function favoritos(): HasMany
    {
        return $this->hasMany(Favorito::class);
    }

    /**
     * Define a many-to-many relationship with the Curso model through the Favorito model.
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
     * Define a one-to-many relationship with the Comentario model.
     *
     * @return HasMany
     */
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }
}
