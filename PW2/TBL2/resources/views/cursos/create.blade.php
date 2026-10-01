<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Curso</title>
</head>

<body>

    <h1>Cadastrar Curso</h1>

    @if($errors->any())

        <h3>Corrija os erros abaixo:</h3>

        <ul>

            @foreach($errors->all() as $erro)

                <li>
                    {{ $erro }}
                </li>

            @endforeach

        </ul>

    @endif

    <form
        action="{{ route('cursos.store') }}"
        method="POST"
    >

        @csrf

        <label for="nome">
            Nome:
        </label>

        <br>

        <input
            type="text"
            id="nome"
            name="nome"
            value="{{ old('nome') }}"
        >

        <br><br>

        <label for="descricao">
            Descrição:
        </label>

        <br>

        <textarea
            id="descricao"
            name="descricao"
            rows="5"
            cols="40"
        >{{ old('descricao') }}</textarea>

        <br><br>

        <label for="carga_horaria">
            Carga horária:
        </label>

        <br>

        <input
            type="number"
            id="carga_horaria"
            name="carga_horaria"
            value="{{ old('carga_horaria') }}"
            min="1"
        >

        <br><br>

        <label for="ativo">
            Ativo:
        </label>

        <br>

        <select
            id="ativo"
            name="ativo"
        >

            <option value="1">
                Sim
            </option>

            <option value="0">
                Não
            </option>

        </select>

        <br><br>

        <button type="submit">
            Cadastrar
        </button>

    </form>

    <br>

    <a href="{{ route('cursos.index') }}">
        Voltar
    </a>

</body>

</html>