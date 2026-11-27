
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
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            color: #174a7e;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .filtros {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: end;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button, .limpar {
            padding: 11px 18px;
            border: none;
            border-radius: 5px;
            background: #174a7e;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .limpar {
            background: #666;
        }

        .indicadores {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .indicador h3 {
            color: #666;
            font-size: 14px;
        }

        .indicador p {
            font-size: 24px;
            font-weight: bold;
            color: #174a7e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #174a7e;
            color: white;
        }

        .vazio {
            text-align: center;
            padding: 25px;
        }

        .paginacao {
            margin-top: 20px;
        }

        @media (max-width: 700px) {
            .indicadores {
                grid-template-columns: 1fr;
            }

            body {
                padding: 12px;
            }

            .tabela {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Relatório de Pedidos</h1>

    <div class="card">

        <h2>Filtros de pesquisa</h2>

        <form method="GET" action="{{ route('relatorios.pedidos') }}">

            <div class="filtros">

                <div class="campo">
                    <label>Data inicial</label>

                    <input
                        type="date"
                        name="data_inicio"
                        value="{{ request('data_inicio') }}"
                    >
                </div>

                <div class="campo">
                    <label>Data final</label>

                    <input
                        type="date"
                        name="data_fim"
                        value="{{ request('data_fim') }}"
                    >
                </div>

                <div class="campo">
                    <label>Situação</label>

                    <select name="status">
                        <option value="">Todas</option>

                        <option value="aberto"
                            @selected(request('status') == 'aberto')>
                            Aberto
                        </option>

                        <option value="pago"
                            @selected(request('status') == 'pago')>
                            Pago
                        </option>

                        <option value="cancelado"
                            @selected(request('status') == 'cancelado')>
                            Cancelado
                        </option>
                    </select>
                </div>

                <button type="submit">
                    Filtrar
                </button>

                <a
                    href="{{ route('relatorios.pedidos') }}"
                    class="limpar"
                >
                    Limpar
                </a>

            </div>

        </form>

        @if ($errors->any())
            <div style="color: red; margin-top: 15px;">
                @foreach ($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach
            </div>
        @endif

    </div>

    <div class="indicadores">

        <div class="card indicador">
            <h3>Quantidade de pedidos</h3>
            <p>{{ $totalPedidos }}</p>
        </div>

        <div class="card indicador">
            <h3>Valor total</h3>
            <p>R$ {{ number_format($valorTotal, 2, ',', '.') }}</p>
        </div>

        <div class="card indicador">
            <h3>Valor médio</h3>
            <p>R$ {{ number_format($valorMedio, 2, ',', '.') }}</p>
        </div>

    </div>

    <div class="card">

        <h2>Pedidos encontrados</h2>

        <div class="tabela">

            <table>

                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Situação</th>
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
                                R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="vazio">
                                Nenhum pedido encontrado.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="paginacao">
            {{ $pedidos->links() }}
        </div>

    </div>

</div>

</body>
</html>
