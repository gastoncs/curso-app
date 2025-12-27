<?php

namespace App\Http\Controllers;

use App\Services\CursoRatingService;
use App\Models\Curso;
use App\Models\Instructor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CursoController extends Controller
{
    /**
     * Obtiene una lista paginada de cursos, incluyendo los datos del instructor asociado.
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Curso::with('instructor')->paginate(10);
    }

    /**
     * Registra un nuevo curso.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructores,id',
        ]);

        $curso = Curso::create($validated);

        return response()->json($curso, 201);
    }

    /**
     * Muestra los detalles de un curso específico junto con sus relaciones.
     *
     * @param Curso $curso
     *
     * @return Model
     */
    public function show(Curso $curso): Model
    {
        return $curso->load([
            'instructor',
            'lecciones.video',
            'comentarios.user',
            'usuariosQueSeleccionaronFavorito:id,name'
        ]);
    }

    /**
     * Actualiza la información de un curso existente.
     *
     * @param Request $request
     * @param Curso $curso
     *
     * @return JsonResponse
     */
    public function update(Request $request, Curso $curso): JsonResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructores,id',
        ]);

        $curso->update($validated);

        return response()->json($curso);
    }

    /**
     * Elimina un curso de manera segura.
     *
     * @param Curso $curso
     *
     * @return JsonResponse
     */
    public function destroy(Curso $curso): JsonResponse
    {
        try {
            $curso->safeDelete();
            return response()->json(['message' => 'Curso eliminado'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Obtiene una lista paginada de instructores con sus datos básicos.
     *
     * @return JsonResponse
     */
    public function instructores(): JsonResponse
    {
        $instructores = Instructor::select('id', 'nombre')
            ->orderBy('id')
            ->paginate(50);

        return response()->json($instructores);
    }

    /**
     * Obtiene una lista de todos los instructores con sus datos básicos.
     *
     * @return StreamedResponse
     */
    public function instructoresAll(): StreamedResponse
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

    /**
     * Obtiene la calificación promedio de los cursos.
     *
     * @param CursoRatingService $ratingService
     *
     * @return JsonResponse
     */
    public function averageRating(CursoRatingService $ratingService): JsonResponse
    {
        $cursos = $ratingService->allWithAverage();

        return response()->json([
            'cursos' => $cursos
        ]);
    }
}

