
<?php

class ClienteController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $clientes = \Cliente::withCount('pedidos')
            ->orderBy('nome')
            ->get();

        return view('clientes.index', compact('clientes'));
    }
}
