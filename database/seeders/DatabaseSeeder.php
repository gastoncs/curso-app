<?php

namespace Database\Seeders;

use App\Models\Leccion;
use App\Models\Video;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Curso;
use App\Models\Comentario;
use App\Models\Favorito;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Users
        $users = User::factory()->count(10)->create();

        // Create Instructores con Comentarios
        $instructors = Instructor::factory()
            ->count(5)
            ->create()
            ->each(function ($instructor) use ($users) {
                // Cada Instructor tine 1–3 comentarios de usuarios
                Comentario::factory()
                    ->count(rand(1,3))
                    ->for($instructor, 'comentable')
                    ->create([
                        'user_id' => $users->random()->id
                    ]);
            });

        // Create Cursos con Comentarios
        $cursos = Curso::factory()
            ->count(10)
            ->create()
            ->each(function ($curso) use ($users) {
                // Cada Curso tine 1–3 comentarios de usuarios
                Comentario::factory()
                    ->count(rand(1,3))
                    ->for($curso, 'comentable')
                    ->create([
                        'user_id' => $users->random()->id
                    ]);
            });

        // Create Favoritos
        foreach ($users as $user) {
            // Agregar favorito a cursos
            $favoritosCursos = $cursos->random(rand(1,5));
            foreach ($favoritosCursos as $curso) {
                Favorito::factory()->create([
                    'user_id' => $user->id,
                    'curso_id' => $curso->id
                ]);
            }
        }

        // Create Cursos con Lecciones y Video
        Curso::all()->each(function ($curso) {

            // Por cada curso hay 3–8 lecciones
            Leccion::factory()
                ->count(rand(3, 8))
                ->create([
                    'curso_id' => $curso->id,
                ])
                ->each(function ($leccion) {

                    // Un video por leccion
                    Video::factory()->create([
                        'leccion_id' => $leccion->id,
                    ]);
                });
        });
    }
}
