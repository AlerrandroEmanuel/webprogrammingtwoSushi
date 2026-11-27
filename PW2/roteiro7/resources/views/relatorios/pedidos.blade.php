
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Relatório de Pedidos</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            color: #004b93;
        }

        .botoes {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .botao {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .csv {
            background: #198754;
        }

        .pdf {
            background: #dc3545;
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

        input,
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            min-width: 170px;
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
            min-width: 600px;
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

        .sem-registros {
            text-align: center;
            padding: 25px;
            color: #777;
        }

        .paginacao {
            margin-top: 20px;
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

    <div class="topo">
        <h1>Relatório de Pedidos</h1>

        <div class="botoes">
            <a
                href="{{ route('relatorios.pedidos.csv', request()->query()) }}"
                class="botao csv"
            >
                ↓ Exportar CSV
            </a>

            <a
                href="{{ route('relatorios.pedidos.pdf', request()->query()) }}"
                class="botao pdf"
            >
                ↓ Exportar PDF
            </a>
        </div>
    </div>

    <div class="filtros">
        <h2>Filtros de pesquisa</h2>

        <form method="GET" action="{{ route('relatorios.pedidos') }}">

            <div class="campo">
                <label for="data_inicio">Data inicial</label>

                <input
                    type="date"
                    name="data_inicio"
                    id="data_inicio"
                    value="{{ request('data_inicio') }}"
                >
            </div>

            <div class="campo">
                <label for="data_fim">Data final</label>

                <input
                    type="date"
                    name="data_fim"
                    id="data_fim"
                    value="{{ request('data_fim') }}"
                >
            </div>

            <div class="campo">
                <label for="status">Status</label>

                <select name="status" id="status">
                    <option value="">Todos</option>

                    <option value="aberto" @selected(request('status') === 'aberto')>
                        Aberto
                    </option>

                    <option value="pago" @selected(request('status') === 'pago')>
                        Pago
                    </option>

                    <option value="cancelado" @selected(request('status') === 'cancelado')>
                        Cancelado
                    </option>
                </select>
            </div>

            <button type="submit" class="filtrar">
                Filtrar
            </button>

            <a
                href="{{ route('relatorios.pedidos') }}"
                class="limpar"
            >
                Limpar filtros
            </a>

        </form>
    </div>

    <div class="indicadores">

        <div class="indicador">
            <h3>Total de pedidos</h3>

            <p>{{ $totalPedidos }}</p>
        </div>

        <div class="indicador">
            <h3>Valor total</h3>

            <p>
                R$ {{ number_format((float) $valorTotal, 2, ',', '.') }}
            </p>
        </div>

        <div class="indicador">
            <h3>Valor médio</h3>

            <p>
                R$ {{ number_format((float) $valorMedio, 2, ',', '.') }}
            </p>
        </div>

    </div>

    <div class="tabela-container">

        <h2>Pedidos encontrados</h2>

        <table>
            <thead>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Valor</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>

                        <td>
                            {{ $pedido->cliente->nome ?? 'Não informado' }}
                        </td>

                        <td>
                            {{ $pedido->data_pedido->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ ucfirst($pedido->status) }}
                        </td>

                        <td>
                            R$ {{ number_format((float) $pedido->valor_total, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="sem-registros">
                            Nenhum pedido encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="paginacao">
            {{ $pedidos->links() }}
        </div>

    </div>

</div>

</body>
</html>
