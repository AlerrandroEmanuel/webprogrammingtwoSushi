
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Consulta de Produtos</title>

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

        input, select, button {
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

        a {
            color: #004b93;
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
            color: #444;
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

        .mensagem {
            margin-top: 25px;
            padding: 15px;
            background: #f1f4f7;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <h1>Consulta de Produtos</h1>

    <!-- Formulário de pesquisa e filtros -->

    <form action="{{ route('produtos.index') }}" method="GET">

        <div class="filtros">

            <div class="campo">

                <label for="busca">Nome do produto:</label>

                <input
                    type="text"
                    id="busca"
                    name="busca"
                    value="{{ $termo ?? '' }}"
                    placeholder="Digite o nome do produto"
                >

            </div>

            <div class="campo">

                <label for="ativo">Situação:</label>

                <select id="ativo" name="ativo">

                    <option value="todos"
                        {{ $situacao === 'todos' ? 'selected' : '' }}>
                        Todos
                    </option>

                    <option value="1"
                        {{ $situacao === '1' ? 'selected' : '' }}>
                        Ativos
                    </option>

                    <option value="0"
                        {{ $situacao === '0' ? 'selected' : '' }}>
                        Inativos
                    </option>

                </select>

            </div>

            <button type="submit">Pesquisar</button>

            <a href="{{ route('produtos.index') }}">
                Limpar filtros
            </a>

        </div>

    </form>

    <!-- Quantidade de registros encontrados -->

    <p class="resultado">

        Exibindo {{ $produtos->count() }} registro(s) nesta página,
        de um total de {{ $produtos->total() }} encontrado(s).

    </p>

    <!-- Listagem dos produtos -->

    @if ($produtos->count() > 0)

        <table>

            <thead>

                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Situação</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($produtos as $produto)

                    <tr>

                        <td>{{ $produto->nome }}</td>

                        <td>{{ $produto->descricao }}</td>

                        <td>
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </td>

                        <td>{{ $produto->quantidade }}</td>

                        <td>
                            {{ $produto->ativo ? 'Ativo' : 'Inativo' }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="mensagem">

            <p>Nenhum produto corresponde aos filtros informados.</p>

        </div>

    @endif

    <!-- Navegação entre páginas -->

    <div class="paginacao">

        {{ $produtos->links() }}

    </div>

</body>

</html>
