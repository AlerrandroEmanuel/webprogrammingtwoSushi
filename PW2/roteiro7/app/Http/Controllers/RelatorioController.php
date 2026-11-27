
<?php

class RelatorioController extends \Illuminate\Routing\Controller
{
    public function pedidos(\Illuminate\Http\Request $request)
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
}
