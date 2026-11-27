
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Consulta de Cursos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #243447;
        }

        h1 {
            color: #004b93;
        }

        .filtros {
            display: flex;
            align-items: end;
            flex-wrap: wrap;
            gap: 15px;
            margin: 25px 0;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        input, button {
            padding: 10px;
            font-size: 14px;
        }

        button {
            background: #004b93;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccd5df;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #eaf2f7;
        }

        .resultado {
            margin-top: 20px;
        }

        .mensagem {
            margin-top: 25px;
            padding: 15px;
            background: #f1f4f7;
            border-radius: 5px;
        }

        .paginacao {
            margin-top: 25px;
        }

        .paginacao nav {
            display: flex;
            justify-content: center;
        }

        .paginacao a,
        .paginacao span {
            padding: 8px 12px;
            border: 1px solid #ccd5df;
            text-decoration: none;
            color: #243447;
        }

        a {
            color: #004b93;
        }
    </style>
</head>

<body>

    <h1>Consulta de Cursos</h1>

    <!-- Formulário de pesquisa -->

    <form action="{{ route('cursos.index') }}" method="GET">

        <div class="filtros">

            <div class="campo">

                <label for="busca">Nome do curso:</label>

                <input
                    type="text"
                    id="busca"
                    name="busca"
                    value="{{ $termo ?? '' }}"
                    placeholder="Digite o nome do curso"
                >

            </div>

            <div class="campo">

                <label for="carga_horaria_minima">
                    Carga horária mínima:
                </label>

                <input
                    type="number"
                    id="carga_horaria_minima"
                    name="carga_horaria_minima"
                    min="0"
                    value="{{ $cargaHoraria ?? '' }}"
                    placeholder="Ex: 40"
                >

            </div>

            <button type="submit">Pesquisar</button>

            <a href="{{ route('cursos.index') }}">
                Limpar filtros
            </a>

        </div>

    </form>

    <!-- Quantidade de resultados -->

    <p class="resultado">

        Exibindo {{ $cursos->count() }} registro(s) nesta página,
        de um total de {{ $cursos->total() }} encontrado(s).

    </p>

    <!-- Tabela de cursos -->

    @if ($cursos->count() > 0)

        <table>

            <thead>

                <tr>
                    <th>Nome do curso</th>
                    <th>Carga horária</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($cursos as $curso)

                    <tr>

                        <td>{{ $curso->nome }}</td>

                        <td>
                            {{ $curso->carga_horaria }} horas
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="mensagem">

            <p>
                Nenhum curso corresponde aos filtros informados.
            </p>

        </div>

    @endif

    <!-- Paginação -->

    <div class="paginacao">

        {{ $cursos->links() }}

    </div>

</body>

</html>
