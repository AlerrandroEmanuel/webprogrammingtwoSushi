<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $curso->nome }}</title>
</head>

<body>

    <h1>
        {{ $curso->nome }}
    </h1>

    <h3>
        Descrição
    </h3>

    <p>
        {{ $curso->descricao }}
    </p>

    <h3>
        Carga horária
    </h3>

    <p>
        {{ $curso->carga_horaria }} horas
    </p>

    <h3>
        Status
    </h3>

    <p>

        @if($curso->ativo)
            Ativo
        @else
            Inativo
        @endif

    </p>

    <br>

    <a href="{{ route('cursos.index') }}">
        Voltar para cursos
    </a>

</body>

</html>