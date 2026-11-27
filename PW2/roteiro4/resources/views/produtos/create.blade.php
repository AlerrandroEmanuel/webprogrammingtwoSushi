
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Curso</title>
</head>
<body>

    <h1>Cadastrar Curso</h1>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf

        <label>Nome:</label>
        <br>
        <input type="text" name="nome" value="{{ old('nome') }}" required>

        <br><br>

        <label>Descrição:</label>
        <br>
        <textarea name="descricao" required>{{ old('descricao') }}</textarea>

        <br><br>

        <label>Carga Horária:</label>
        <br>
        <input type="number" name="carga_horaria"
               value="{{ old('carga_horaria') }}" min="1" required>

        <br><br>

        <label>Status:</label>
        <br>
        <select name="ativo" required>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>

        <br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>

    <a href="{{ route('cursos.index') }}">Voltar</a>

</body>
</html>
