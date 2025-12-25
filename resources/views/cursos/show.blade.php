<h1>{{ $curso->titulo }}</h1>

<p>Instructor: {{ $curso->instructor->nombre }}</p>

<h3>Comentarios</h3>

@foreach($curso->comentarios as $comentario)
    <p>
        {{ $comentario->comentario }}
        ({{ $comentario->user->name }})
    </p>
@endforeach

