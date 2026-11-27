
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Curso</title>
</head>
<body>

    <h1>Detalhes do Curso</h1>

    <p><strong>ID:</strong> {{ $curso->id }}</p>

    <p><strong>Nome:</strong> {{ $curso->nome }}</p>

    <p><strong>Descrição:</strong> {{ $curso->descricao }}</p>

    <p><strong>Carga Horária:</strong> {{ $curso->carga_horaria }} horas</p>

    <p><strong>Status:</strong> {{ $curso->ativo ? 'Ativo' : 'Inativo' }}</p>

    <br>

    <a href="{{ route('cursos.edit', $curso->id) }}">Editar Curso</a>

    <br><br>

    <a href="{{ route('cursos.index') }}">Voltar para a Lista</a>

</body>
</html>
