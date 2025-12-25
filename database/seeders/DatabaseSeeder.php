<?php

namespace Database\Seeders;

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

        // Create Instructores with Comentarios
        $instructors = Instructor::factory()
            ->count(5)
            ->create()
            ->each(function ($instructor) use ($users) {
                // Each instructores gets 1–3 comments from random users
                Comentario::factory()
                    ->count(rand(1,3))
                    ->for($instructor, 'comentable')
                    ->create([
                        'user_id' => $users->random()->id
                    ]);
            });

        // Create Cursos with Comentarios
        $cursos = Curso::factory()
            ->count(10)
            ->create()
            ->each(function ($curso) use ($users) {
                // Each curso gets 1–3 comments from random users
                Comentario::factory()
                    ->count(rand(1,3))
                    ->for($curso, 'comentable')
                    ->create([
                        'user_id' => $users->random()->id
                    ]);
            });

        // Create Favoritos (users favoritos cursos)
        foreach ($users as $user) {
            // Each user favorites 1–5 random cursos
            $favoritosCursos = $cursos->random(rand(1,5));
            foreach ($favoritosCursos as $curso) {
                Favorito::factory()->create([
                    'user_id' => $user->id,
                    'curso_id' => $curso->id
                ]);
            }
        }
    }
}
