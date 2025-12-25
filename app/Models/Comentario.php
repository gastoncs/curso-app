<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comentable()
    {
        return $this->morphTo();
    }
}

