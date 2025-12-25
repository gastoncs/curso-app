<h1>Crear Curso</h1>

<form method="POST" action="{{ route('cursos.store') }}">
    @csrf

    <input name="titulo" placeholder="Título">

    <select name="instructor_id">
        @foreach($instructors as $instructor)
            <option value="{{ $instructor->id }}">
                {{ $instructor->nombre }}
            </option>
        @endforeach
    </select>

    <button>Guardar</button>
</form>

