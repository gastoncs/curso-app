<h1>Editar Curso</h1>

<form method="POST" action="{{ route('cursos.update', $curso) }}">
    @csrf
    @method('PUT')

    <input name="titulo" value="{{ $curso->titulo }}">

    <select name="instructor_id">
        @foreach($instructors as $instructor)
            <option value="{{ $instructor->id }}"
                @selected($curso->instructor_id == $instructor->id)>
                {{ $instructor->nombre }}
            </option>
        @endforeach
    </select>

    <button>Actualizar</button>
</form>

