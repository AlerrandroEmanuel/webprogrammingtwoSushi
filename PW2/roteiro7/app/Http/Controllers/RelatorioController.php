
<?php

class RelatorioController extends \Illuminate\Routing\Controller
{
    private function consultaPedidos($request)
    {
        $request->validate([
            'data_inicio' => ['nullable', 'date'],
            'data_fim' => [
                'nullable',
                'date',
                'after_or_equal:data_inicio'
            ],
            'status' => [
                'nullable',
                'in:aberto,pago,cancelado'
            ],
        ]);

        $consulta = Pedido::with('cliente');

        if ($request->filled('data_inicio')) {
            $consulta->whereDate(
                'data_pedido',
                '>=',
                $request->data_inicio
            );
        }

        if ($request->filled('data_fim')) {
            $consulta->whereDate(
                'data_pedido',
                '<=',
                $request->data_fim
            );
        }

        if ($request->filled('status')) {
            $consulta->where('status', $request->status);
        }

        return $consulta;
    }

    private function consultaProdutos($request)
    {
        $request->validate([
            'categoria' => ['nullable', 'string', 'max:100'],
            'situacao' => ['nullable', 'string', 'max:30'],
        ]);

        $consulta = Produto::query();

        if ($request->filled('categoria')) {
            $consulta->where('categoria', $request->categoria);
        }

        if ($request->filled('situacao')) {
            $consulta->where('situacao', $request->situacao);
        }

        return $consulta;
    }

    public function painelGerencial(\Illuminate\Http\Request $request)
    {
        $consulta = $this->consultaPedidos($request);

        // Indicadores de pedidos
        $totalPedidos = (clone $consulta)->count();

        $valorTotalVendas = (clone $consulta)->sum('valor_total');

        $valorMedioPedido = (clone $consulta)->avg('valor_total') ?? 0;

        // Indicadores de produtos
        $totalProdutos = Produto::count();

        $produtosAtivos = Produto::where(
            'situacao',
            'ativo'
        )->count();

        // Quantidade e valor dos pedidos por situação
        $pedidosPorStatus = (clone $consulta)
            ->select('status')
            ->selectRaw('COUNT(*) as quantidade')
            ->selectRaw('SUM(valor_total) as valor_total')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        // Listagem paginada dos pedidos
        $pedidos = (clone $consulta)
            ->orderBy('data_pedido', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('relatorios.painel-gerencial', compact(
            'totalPedidos',
            'valorTotalVendas',
            'valorMedioPedido',
            'totalProdutos',
            'produtosAtivos',
            'pedidosPorStatus',
            'pedidos'
        ));
    }

    public function produtos(\Illuminate\Http\Request $request)
    {
        $consulta = $this->consultaProdutos($request);

        $totalProdutos = (clone $consulta)->count();

        $precoMedio = (clone $consulta)->avg('preco') ?? 0;

        $produtosAtivos = (clone $consulta)
            ->where('situacao', 'ativo')
            ->count();

        $produtos = (clone $consulta)
            ->orderBy('nome')
            ->paginate(15)
            ->withQueryString();

        $categorias = Produto::query()
            ->select('categoria')
            ->whereNotNull('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $situacoes = Produto::query()
            ->select('situacao')
            ->whereNotNull('situacao')
            ->distinct()
            ->orderBy('situacao')
            ->pluck('situacao');

        return view('relatorios.produtos', compact(
            'produtos',
            'totalProdutos',
            'precoMedio',
            'produtosAtivos',
            'categorias',
            'situacoes'
        ));
    }

    public function pedidos(\Illuminate\Http\Request $request)
    {
        $consulta = $this->consultaPedidos($request);

        $totalPedidos = (clone $consulta)->count();

        $valorTotal = (clone $consulta)->sum('valor_total');

        $valorMedio = (clone $consulta)->avg('valor_total') ?? 0;

        $pedidos = (clone $consulta)
            ->orderBy('data_pedido', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('relatorios.pedidos', compact(
            'pedidos',
            'totalPedidos',
            'valorTotal',
            'valorMedio'
        ));
    }

    public function resumoStatus()
    {
        $resumoStatus = Pedido::query()
            ->select('status')
            ->selectRaw('COUNT(*) as quantidade')
            ->selectRaw('SUM(valor_total) as valor_total')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        return view('relatorios.resumo-status', compact(
            'resumoStatus'
        ));
    }

    public function exportarCsv(\Illuminate\Http\Request $request)
    {
        $consulta = $this->consultaPedidos($request);

        $pedidos = $consulta
            ->orderBy('data_pedido', 'desc')
            ->get();

        $nomeArquivo = 'relatorio-pedidos.csv';

        return response()->streamDownload(function () use ($pedidos) {
            $arquivo = fopen('php://output', 'w');

            fwrite($arquivo, "\xEF\xBB\xBF");

            fputcsv($arquivo, [
                'Pedido',
                'Cliente',
                'Data',
                'Situacao',
                'Valor'
            ], ';');

            foreach ($pedidos as $pedido) {
                fputcsv($arquivo, [
                    $pedido->id,
                    $pedido->cliente->nome ?? 'Não informado',
                    $pedido->data_pedido->format('d/m/Y'),
                    ucfirst($pedido->status),
                    number_format(
                        (float) $pedido->valor_total,
                        2,
                        ',',
                        '.'
                    )
                ], ';');
            }

            fclose($arquivo);
        }, $nomeArquivo, [
            'Content-Type' => 'text/csv; charset=UTF-8'
        ]);
    }

    public function exportarPdf(\Illuminate\Http\Request $request)
    {
        $consulta = $this->consultaPedidos($request);

        $pedidos = $consulta
            ->orderBy('data_pedido', 'desc')
            ->get();

        $totalPedidos = $pedidos->count();

        $valorTotal = $pedidos->sum('valor_total');

        $dados = [
            'pedidos' => $pedidos,
            'totalPedidos' => $totalPedidos,
            'valorTotal' => $valorTotal,
            'dataInicio' => $request->data_inicio,
            'dataFim' => $request->data_fim,
            'statusSelecionado' => $request->status,
            'dataGeracao' => now()
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'relatorios.pedidos-pdf',
            $dados
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('relatorio-pedidos.pdf');
    }
}
