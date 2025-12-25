<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curso;
use App\Models\Instructor;

class CursoFactory extends Factory
{
    protected $model = Curso::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'instructor_id' => Instructor::factory(),
        ];
    }
}


