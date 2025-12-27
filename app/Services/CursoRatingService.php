<?php

namespace App\Services;

use App\Repositories\CursoRatingRepository;
use Illuminate\Support\Collection;

class CursoRatingService
{
    public function __construct(
        private CursoRatingRepository $repository
    ) {}

    /**
     * Obtener cursos con su calificación promedio
     *
     * @return Collection
     */
    public function getCursosWithRating(): Collection
    {
        return $this->repository->getCursosWithAverageRating();
    }
}
