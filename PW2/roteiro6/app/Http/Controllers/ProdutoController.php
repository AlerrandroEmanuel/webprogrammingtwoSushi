
<?php

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        // Receber os filtros enviados pelo formulário
        $termo = $request->input('busca');
        $situacao = $request->input('ativo', 'todos');

        // Iniciar consulta dos produtos
        $consulta = Produto::query();

        // Aplicar pesquisa pelo nome
        $consulta->when(!empty($termo), function ($query) use ($termo) {
            $query->where('nome', 'ilike', '%' . $termo . '%');
        });

        // Aplicar filtro por situação
        $consulta->when($situacao === '1', function ($query) {
            $query->where('ativo', true);
        });

        $consulta->when($situacao === '0', function ($query) {
            $query->where('ativo', false);
        });

        // Ordenar e paginar os resultados
        $produtos = $consulta
            ->orderBy('nome')
            ->paginate(5)
            ->withQueryString();

        // Retornar os dados para a tela
        return view('produtos.index', [
            'produtos' => $produtos,
            'termo' => $termo,
            'situacao' => $situacao
        ]);
    }
}
