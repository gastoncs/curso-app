<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones';

    protected $fillable = ['titulo', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function video()
    {
        return $this->hasOne(Video::class);
    }
}
