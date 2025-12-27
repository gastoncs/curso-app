<?php

namespace App\Services;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;

class CursoRatingService
{
    /**
     * Obtiene todos los cursos con su calificación promedio.
     *
     * @return Collection
     */
    public function allWithAverage(): Collection
    {
        return Curso::select('cursos.id', 'cursos.titulo')
            ->selectSub(function ($query) {
                $query->from('comentarios')
                    ->whereColumn('comentarios.comentable_id', 'cursos.id')
                    ->where('comentarios.comentable_type', Curso::class)
                    ->whereNotNull('calificacion')
                    ->selectRaw('ROUND(AVG(calificacion), 2)');
            }, 'rating_promedio')
            ->get();
    }
}


