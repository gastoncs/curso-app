<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comentario;

class ComentarioFactory extends Factory
{
    protected $model = Comentario::class;

    public function definition()
    {
        return [
            'comentario'   => $this->faker->paragraph(),
            'calificacion' => $this->faker->numberBetween(1, 5)
        ];
    }
}

