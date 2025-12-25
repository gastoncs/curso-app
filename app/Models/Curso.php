<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'instructor_id'];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    public function usersQueFavoritaron()
    {
        return $this->belongsToMany(
            User::class,
            'favoritos'
        )->withTimestamps();
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }
}
