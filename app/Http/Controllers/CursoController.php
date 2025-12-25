<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('instructor')->paginate(10);
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        $instructors = Instructor::all();
        return view('cursos.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructores,id',
        ]);

        Curso::create($validated);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado correctamente');
    }

    public function show(Curso $curso)
    {
        $curso->load('instructor', 'comentarios.user');
        return view('cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        $instructors = Instructor::all();
        return view('cursos.edit', compact('curso', 'instructors'));
    }

    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructores,id',
        ]);

        $curso->update($validated);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado correctamente');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado');
    }
}

