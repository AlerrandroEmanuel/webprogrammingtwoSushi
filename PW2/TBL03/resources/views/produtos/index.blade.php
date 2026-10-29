<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Consulta de Produtos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            align-items: end;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #004b93;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #003366;
        }

        .limpar {
            padding: 10px 15px;
            color: #004b93;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #004b93;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .mensagem {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Consulta de Produtos</h1>

        <!-- Formulário de filtros -->
        <form method="GET" action="{{ route('produtos.index') }}">

            <!-- Filtro por nome -->
            <div class="campo">
                <label for="nome">Nome do produto</label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Digite o nome"
                    value="{{ request('nome') }}"
                >
            </div>

            <!-- Filtro por preço mínimo -->
            <div class="campo">
                <label for="preco_minimo">Preço mínimo</label>

                <input
                    type="number"
                    id="preco_minimo"
                    name="preco_minimo"
                    step="0.01"
                    placeholder="Preço mínimo"
                    value="{{ request('preco_minimo') }}"
                >
            </div>

            <!-- Filtro por preço máximo -->
            <div class="campo">
                <label for="preco_maximo">Preço máximo</label>

                <input
                    type="number"
                    id="preco_maximo"
                    name="preco_maximo"
                    step="0.01"
                    placeholder="Preço máximo"
                    value="{{ request('preco_maximo') }}"
                >
            </div>

            <!-- Filtro por status -->
            <div class="campo">
                <label for="ativo">Status</label>

                <select id="ativo" name="ativo">

                    <option value="">Todos</option>

                    <option value="1"
                        {{ request('ativo') === '1' ? 'selected' : '' }}>
                        Ativos
                    </option>

                    <option value="0"
                        {{ request('ativo') === '0' ? 'selected' : '' }}>
                        Inativos
                    </option>

                </select>
            </div>

            <!-- Ordenação dos produtos -->
            <div class="campo">
                <label for="ordenar">Ordenar por</label>

                <select id="ordenar" name="ordenar">

                    <option value="nome"
                        {{ request('ordenar', 'nome') === 'nome' ? 'selected' : '' }}>
                        Nome
                    </option>

                    <option value="preco"
                        {{ request('ordenar') === 'preco' ? 'selected' : '' }}>
                        Preço
                    </option>

                </select>
            </div>

            <!-- Botões -->
            <button type="submit">Filtrar</button>

            <a href="{{ route('produtos.index') }}" class="limpar">
                Limpar filtros
            </a>

        </form>

        <!-- Quantidade de produtos encontrados -->
        <p>
            Produtos encontrados: {{ $produtos->count() }}
        </p>

        <!-- Tabela de produtos -->
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($produtos as $produto)

                    <tr>
                        <td>{{ $produto->id }}</td>

                        <td>{{ $produto->nome }}</td>

                        <td>
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </td>

                        <td>
                            {{ $produto->ativo ? 'Ativo' : 'Inativo' }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="mensagem">
                            Nenhum produto encontrado.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</body>
</html>