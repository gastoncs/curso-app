<?php

namespace App\DTOs;

class CursoRatingDto
{
    public function __construct(
        public int $id,
        public string $titulo,
        public ?float $rating
    ) {}
}
