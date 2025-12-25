<h1>Cursos</h1>

<a href="{{ route('cursos.create') }}">Nuevo Curso</a>

<ul>
@foreach($cursos as $curso)
    <li>
        {{ $curso->titulo }} — {{ $curso->instructor->nombre }}
        <a href="{{ route('cursos.show', $curso) }}">Ver</a>
        <a href="{{ route('cursos.edit', $curso) }}">Editar</a>

        <form method="POST" action="{{ route('cursos.destroy', $curso) }}">
            @csrf
            @method('DELETE')
            <button>Eliminar</button>
        </form>
    </li>
@endforeach
</ul>

{{ $cursos->links() }}

