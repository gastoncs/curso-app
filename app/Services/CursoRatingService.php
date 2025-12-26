<?php

namespace App\Services;

use App\Models\Curso;

class CursoRatingService
{
    public function averageForCurso(Curso $curso): ?float
    {
        return $curso->comentarios()
            ->whereNotNull('calificacion')
            ->avg('calificacion');
    }
}

