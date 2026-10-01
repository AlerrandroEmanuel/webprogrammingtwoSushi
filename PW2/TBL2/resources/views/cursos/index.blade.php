<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cursos</title>
</head>

<body>

    <h1>Lista de Cursos</h1>

    @if(session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('cursos.create') }}">
        Cadastrar novo curso
    </a>

    <hr>

    @forelse($cursos as $curso)

        <h2>
            {{ $curso->nome }}
        </h2>

        <p>
            {{ $curso->descricao }}
        </p>

        <p>
            <strong>Carga horária:</strong>
            {{ $curso->carga_horaria }} horas
        </p>

        <p>
            <strong>Status:</strong>
            {{ $curso->ativo ? 'Ativo' : 'Inativo' }}
        </p>

        <a href="{{ route('cursos.show', $curso) }}">
            Ver detalhes
        </a>

        <form
            action="{{ route('cursos.destroy', $curso) }}"
            method="POST"
        >

            @csrf

            @method('DELETE')

            <button type="submit">
                Excluir
            </button>

        </form>

        <hr>

    @empty

        <p>
            Nenhum curso cadastrado.
        </p>

    @endforelse

</body>

</html>