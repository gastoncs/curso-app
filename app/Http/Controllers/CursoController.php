<?php

namespace App\Http\Controllers;

use App\Services\CursoRatingService;
use App\Models\Curso;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        return Curso::with('instructor')->paginate(10);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructores,id',
        ]);

        $curso = Curso::create($validated);

        return response()->json($curso, 201);
    }

    public function show(Curso $curso)
    {
        return $curso->load([
            'instructor',
            'lecciones.video',
            'comentarios.user',
            'usuariosQueSeleccionaronFavorito:id,name'
        ]);
    }

    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructores,id',
        ]);

        $curso->update($validated);

        return response()->json($curso);
    }

    public function destroy(Curso $curso)
    {
        try {
            $curso->safeDelete();
            return response()->json(['message' => 'Curso eliminado'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function instructores()
    {
        $instructores = Instructor::select('id', 'nombre')
            ->orderBy('id')
            ->paginate(50);

        return response()->json($instructores);
    }

    public function instructoresAll()
    {
        return response()->stream(function () {
            echo '[';

            $isFirst = true;
            Instructor::select('id', 'nombre')
                ->orderBy('id')
                ->chunk(1000, function ($chunk) use (&$isFirst) {
                    foreach ($chunk as $instructor) {
                        if (!$isFirst) {
                            echo ',';
                        }
                        $isFirst = false;

                        echo json_encode([
                            'id' => $instructor->id,
                            'nombre' => $instructor->nombre,
                        ]);
                    }
                });

            echo ']';
        }, 200, [
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ]);
    }

    public function averageRating(CursoRatingService $ratingService)
    {
        $cursos = $ratingService->allWithAverage();

        return response()->json([
            'cursos' => $cursos
        ]);
    }
}

