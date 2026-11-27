
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel Gerencial</title>

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
            max-width: 1250px;
            margin: auto;
        }

        .topo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
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

        .atalhos {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .atalho {
            display: inline-block;
            padding: 11px 15px;
            border-radius: 5px;
            background: #004b93;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .filtros,
        .card,
        .tabela-container,
        .status-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .filtros {
            margin-bottom: 20px;
        }

        .filtros form {
            display: flex;
            align-items: end;
            flex-wrap: wrap;
            gap: 15px;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        label {
            font-size: 13px;
            font-weight: bold;
        }

        input,
        select {
            min-width: 170px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: white;
        }

        button,
        .limpar {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
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

        .card {
            border-top: 4px solid #004b93;
        }

        .card h3 {
            margin: 0 0 12px;
            color: #666;
            font-size: 14px;
            font-weight: normal;
        }

        .valor {
            margin: 0;
            color: #004b93;
            font-size: 27px;
            font-weight: bold;
        }

        .secao {
            margin-bottom: 20px;
        }

        .secao-titulo {
            margin: 0 0 15px;
            color: #004b93;
            font-size: 19px;
        }

        .status-container {
            margin-bottom: 20px;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .status-card {
            padding: 15px;
            border: 1px solid #e1e5eb;
            border-radius: 6px;
        }

        .status-card h3 {
            margin: 0 0 10px;
            font-size: 15px;
        }

        .status-card p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }

        .tabela-container {
            overflow-x: auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
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

        .acoes {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .csv {
            background: #198754;
            color: white;
        }

        .pdf {
            background: #dc3545;
            color: white;
        }

        .paginacao {
            margin-top: 20px;
        }

        .sem-registros {
            text-align: center;
            color: #777;
            padding: 25px;
        }

        @media (max-width: 800px) {
            body {
                padding: 15px;
            }

            .indicadores,
            .status-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="topo">
        <div>
            <h1>Painel Gerencial</h1>

            <p class="descricao">
                Visão geral dos produtos e das vendas do sistema.
            </p>
        </div>

        <div class="atalhos">
            <a
                href="{{ route('relatorios.produtos') }}"
                class="atalho"
            >
                Relatório de Produtos
            </a>

            <a
                href="{{ route('relatorios.resumo-status') }}"
                class="atalho"
            >
                Resumo por Situação
            </a>

            <a
                href="{{ route('relatorios.pedidos') }}"
                class="atalho"
            >
                Relatório de Pedidos
            </a>
        </div>
    </div>

    <div class="filtros">
        <h2 class="secao-titulo">Filtrar informações de vendas</h2>

        <form
            method="GET"
            action="{{ route('relatorios.painel-gerencial') }}"
        >
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
                <label for="status">Situação do pedido</label>

                <select name="status" id="status">
                    <option value="">Todas</option>

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
                Aplicar filtros
            </button>

            <a
                href="{{ route('relatorios.painel-gerencial') }}"
                class="limpar"
            >
                Limpar filtros
            </a>
        </form>
    </div>

    <div class="indicadores">

        <div class="card">
            <h3>Total de produtos cadastrados</h3>

            <p class="valor">
                {{ $totalProdutos }}
            </p>
        </div>

        <div class="card">
            <h3>Produtos ativos</h3>

            <p class="valor">
                {{ $produtosAtivos }}
            </p>
        </div>

        <div class="card">
            <h3>Pedidos encontrados</h3>

            <p class="valor">
                {{ $totalPedidos }}
            </p>
        </div>

        <div class="card">
            <h3>Valor total das vendas</h3>

            <p class="valor">
                R$ {{ number_format((float) $valorTotalVendas, 2, ',', '.') }}
            </p>
        </div>

        <div class="card">
            <h3>Valor médio por pedido</h3>

            <p class="valor">
                R$ {{ number_format((float) $valorMedioPedido, 2, ',', '.') }}
            </p>
        </div>

    </div>

    <div class="status-container secao">

        <h2 class="secao-titulo">
            Pedidos por situação
        </h2>

        <div class="status-grid">

            @forelse ($pedidosPorStatus as $item)
                <div class="status-card">

                    <h3>{{ ucfirst($item->status) }}</h3>

                    <p>
                        Quantidade:
                        <strong>{{ $item->quantidade }}</strong>
                    </p>

                    <p>
                        Valor:
                        <strong>
                            R$ {{ number_format((float) $item->valor_total, 2, ',', '.') }}
                        </strong>
                    </p>

                </div>
            @empty
                <p>Nenhum pedido encontrado para os filtros selecionados.</p>
            @endforelse

        </div>

    </div>

    <div class="tabela-container">

        <h2 class="secao-titulo">
            Pedidos recentes
        </h2>

        <table>
            <thead>
                <tr>
                    <th>Número</th>
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
                            <span class="situacao">
                                {{ ucfirst($pedido->status) }}
                            </span>
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

    <div class="acoes">

        <a
            href="{{ route('relatorios.pedidos.csv', request()->query()) }}"
            class="atalho csv"
        >
            Exportar pedidos em CSV
        </a>

        <a
            href="{{ route('relatorios.pedidos.pdf', request()->query()) }}"
            class="atalho pdf"
        >
            Exportar pedidos em PDF
        </a>

    </div>

</div>

</body>
</html>
