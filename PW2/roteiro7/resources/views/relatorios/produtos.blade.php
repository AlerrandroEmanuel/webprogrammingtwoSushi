
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Relatório de Produtos</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .topo {
            margin-bottom: 25px;
        }

        h1 {
            color: #004b93;
            margin: 0 0 8px;
        }

        .descricao {
            color: #666;
            margin: 0;
        }

        .filtros,
        .indicador,
        .tabela-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .filtros form {
            display: flex;
            align-items: end;
            gap: 15px;
            flex-wrap: wrap;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        label {
            font-weight: bold;
            font-size: 13px;
        }

        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            min-width: 190px;
            background: white;
        }

        button,
        .limpar {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .filtrar {
            background: #004b93;
            color: white;
        }

        .limpar {
            background: #6c757d;
            color: white;
        }

        .indicadores {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .indicador {
            margin: 0;
        }

        .indicador h3 {
            margin: 0 0 10px;
            color: #666;
            font-size: 14px;
        }

        .indicador p {
            margin: 0;
            color: #004b93;
            font-size: 25px;
            font-weight: bold;
        }

        .tabela-container {
            overflow-x: auto;
        }

        h2 {
            margin-top: 0;
            color: #004b93;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #004b93;
            color: white;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        .situacao {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 12px;
            background: #e8f0fe;
            color: #004b93;
            font-size: 12px;
            font-weight: bold;
        }

        .sem-registros {
            text-align: center;
            padding: 25px;
            color: #777;
        }

        .paginacao {
            margin-top: 20px;
        }

        .voltar {
            display: inline-block;
            margin-bottom: 20px;
            color: #004b93;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 700px) {
            body {
                padding: 15px;
            }

            .indicadores {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('relatorios.pedidos') }}" class="voltar">
        ← Ir para relatório de pedidos
    </a>

    <div class="topo">
        <h1>Relatório de Produtos</h1>

        <p class="descricao">
            Consulte os produtos cadastrados, suas categorias,
            preços e situações.
        </p>
    </div>

    <div class="filtros">

        <h2>Filtros de pesquisa</h2>

        <form method="GET" action="{{ route('relatorios.produtos') }}">

            <div class="campo">
                <label for="categoria">Categoria</label>

                <select name="categoria" id="categoria">
                    <option value="">Todas as categorias</option>

                    @foreach ($categorias as $categoria)
                        <option
                            value="{{ $categoria }}"
                            @selected(request('categoria') === $categoria)
                        >
                            {{ $categoria }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="campo">
                <label for="situacao">Situação</label>

                <select name="situacao" id="situacao">
                    <option value="">Todas as situações</option>

                    @foreach ($situacoes as $situacao)
                        <option
                            value="{{ $situacao }}"
                            @selected(request('situacao') === $situacao)
                        >
                            {{ ucfirst($situacao) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="filtrar">
                Filtrar
            </button>

            <a
                href="{{ route('relatorios.produtos') }}"
                class="limpar"
            >
                Limpar filtros
            </a>

        </form>

    </div>

    <div class="indicadores">

        <div class="indicador">
            <h3>Total de produtos encontrados</h3>

            <p>{{ $totalProdutos }}</p>
        </div>

        <div class="indicador">
            <h3>Produtos ativos encontrados</h3>

            <p>{{ $produtosAtivos }}</p>
        </div>

        <div class="indicador">
            <h3>Preço médio dos produtos</h3>

            <p>
                R$ {{ number_format((float) $precoMedio, 2, ',', '.') }}
            </p>
        </div>

    </div>

    <div class="tabela-container">

        <h2>Produtos cadastrados</h2>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Situação</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>

                        <td>{{ $produto->nome }}</td>

                        <td>{{ $produto->categoria }}</td>

                        <td>
                            R$ {{ number_format((float) $produto->preco, 2, ',', '.') }}
                        </td>

                        <td>
                            <span class="situacao">
                                {{ ucfirst($produto->situacao) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="sem-registros">
                            Nenhum produto encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="paginacao">
            {{ $produtos->links() }}
        </div>

    </div>

</div>

</body>
</html>
