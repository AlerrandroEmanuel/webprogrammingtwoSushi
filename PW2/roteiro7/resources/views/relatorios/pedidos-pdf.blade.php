
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Pedidos</title>

    <style>
        @page {
            margin: 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
        }

        .cabecalho {
            border-bottom: 2px solid #004b93;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        h1 {
            color: #004b93;
            font-size: 21px;
            margin: 0 0 6px;
        }

        .subtitulo {
            color: #666;
            font-size: 10px;
        }

        .informacoes {
            margin-bottom: 18px;
            line-height: 1.8;
        }

        .indicadores {
            width: 100%;
            margin-bottom: 20px;
        }

        .indicadores td {
            width: 50%;
            padding: 12px;
            background-color: #f1f5f9;
            border: 1px solid #dce3eb;
        }

        .indicador-titulo {
            color: #555;
            font-size: 9px;
        }

        .indicador-valor {
            color: #004b93;
            font-size: 17px;
            font-weight: bold;
            margin-top: 5px;
        }

        h2 {
            font-size: 13px;
            color: #004b93;
            margin-bottom: 8px;
        }

        table.pedidos {
            width: 100%;
            border-collapse: collapse;
        }

        table.pedidos th {
            background-color: #004b93;
            color: white;
            padding: 9px 6px;
            text-align: left;
            font-size: 9px;
        }

        table.pedidos td {
            border-bottom: 1px solid #ddd;
            padding: 8px 6px;
            font-size: 9px;
        }

        table.pedidos tr:nth-child(even) {
            background-color: #f5f7fa;
        }

        .vazio {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .rodape {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
            color: #777;
            font-size: 8px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="cabecalho">
        <h1>Relatório de Pedidos</h1>

        <div class="subtitulo">
            Relatório gerado em
            {{ $dataGeracao->format('d/m/Y H:i:s') }}
        </div>
    </div>

    <div class="informacoes">
        <strong>Período consultado:</strong>

        {{ $dataInicio
            ? \Carbon\Carbon::parse($dataInicio)->format('d/m/Y')
            : 'Não informado' }}

        até

        {{ $dataFim
            ? \Carbon\Carbon::parse($dataFim)->format('d/m/Y')
            : 'Não informado' }}

        <br>

        <strong>Status selecionado:</strong>

        @if ($statusSelecionado)
            {{ ucfirst($statusSelecionado) }}
        @else
            Todos os status
        @endif
    </div>

    <table class="indicadores">
        <tr>
            <td>
                <div class="indicador-titulo">
                    QUANTIDADE DE PEDIDOS
                </div>

                <div class="indicador-valor">
                    {{ $totalPedidos }}
                </div>
            </td>

            <td>
                <div class="indicador-titulo">
                    VALOR TOTAL
                </div>

                <div class="indicador-valor">
                    R$ {{ number_format((float) $valorTotal, 2, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>

    <h2>Detalhamento dos pedidos</h2>

    <table class="pedidos">
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
                    <td colspan="5" class="vazio">
                        Nenhum pedido encontrado para os filtros selecionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="rodape">
        Sistema de Relatórios — Relatório de Pedidos
    </div>

</body>
</html>
