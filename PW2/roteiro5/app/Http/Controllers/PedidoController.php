
<?php

class PedidoController extends \App\Http\Controllers\Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $clientes = \Cliente::orderBy('nome')->get();

        $consulta = \Pedido::with('cliente');

        if ($request->filled('cliente_id')) {
            $consulta->where('cliente_id', $request->cliente_id);
        }

        $pedidos = $consulta
            ->orderBy('data', 'desc')
            ->get();

        return view('pedidos.index', compact('pedidos', 'clientes'));
    }

    public function create()
    {
        $clientes = \Cliente::orderBy('nome')->get();

        return view('pedidos.create', compact('clientes'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $dados = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'data' => ['required', 'date'],
            'valor' => ['required', 'numeric', 'min:0'],
        ]);

        \Pedido::create($dados);

        return redirect()
            ->route('pedidos.index')
            ->with('sucesso', 'Pedido cadastrado com sucesso!');
    }

    public function pedidosCliente(\Cliente $cliente)
    {
        $pedidos = $cliente->pedidos()
            ->orderBy('data', 'desc')
            ->get();

        return view('pedidos.cliente', compact('cliente', 'pedidos'));
    }
}
