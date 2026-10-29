<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        // Inicia a consulta dos produtos
        $consulta = Produto::query();

        // Filtro pelo nome
        if ($request->filled('nome')) {
            $consulta->where(
                'nome',
                'ilike',
                '%' . $request->input('nome') . '%'
            );
        }

        // Filtro pelo preço mínimo
        if ($request->filled('preco_minimo')) {
            $consulta->where(
                'preco',
                '>=',
                $request->input('preco_minimo')
            );
        }

        // Filtro pelo preço máximo
        if ($request->filled('preco_maximo')) {
            $consulta->where(
                'preco',
                '<=',
                $request->input('preco_maximo')
            );
        }

        // Filtro pelo status
        if ($request->input('ativo') === '1') {
            $consulta->where('ativo', true);
        } elseif ($request->input('ativo') === '0') {
            $consulta->where('ativo', false);
        }

        // Define os campos permitidos para ordenação
        $ordenacoesPermitidas = ['nome', 'preco'];

        // Recebe a opção escolhida pelo usuário
        $ordenarPor = $request->input('ordenar', 'nome');

        // Verifica se a opção é permitida
        if (!in_array($ordenarPor, $ordenacoesPermitidas)) {
            $ordenarPor = 'nome';
        }

        // Ordena os produtos
        $produtos = $consulta
            ->orderBy($ordenarPor, 'asc')
            ->get();

        // Retorna a página com os produtos
        return view('produtos.index', [
            'produtos' => $produtos,
        ]);
    }
}