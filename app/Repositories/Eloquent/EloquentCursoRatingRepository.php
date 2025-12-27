<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CursoRatingRepository;
use Illuminate\Support\Collection;
use App\Models\Curso;

class EloquentCursoRatingRepository implements CursoRatingRepository
{
    /**
     * Obtener cursos con su calificación promedio
     *
     * @return Collection
     */
    public function getCursosWithAverageRating(): Collection
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

