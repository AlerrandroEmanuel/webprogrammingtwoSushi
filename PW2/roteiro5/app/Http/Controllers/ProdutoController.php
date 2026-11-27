
<?php

class ProdutoController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $produtos = \Produto::with('categoria')
            ->orderBy('nome')
            ->get();

        return view('produtos.index', compact('produtos'));
    }
}
