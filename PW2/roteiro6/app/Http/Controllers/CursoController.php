
<?php

require_once app_path('Models/Curso.php');

use Illuminate\Http\Request;

class CursoController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        // Receber os parâmetros da pesquisa
        $termo = $request->input('busca');

        $cargaHoraria = $request->input('carga_horaria_minima');

        // Iniciar a consulta
        $consulta = Curso::query();

        // Pesquisar pelo nome do curso
        $consulta->when(!empty($termo), function ($query) use ($termo) {
            $query->where('nome', 'ilike', '%' . $termo . '%');
        });

        // Filtrar pela carga horária mínima
        $consulta->when(
            $cargaHoraria !== null && $cargaHoraria !== '',
            function ($query) use ($cargaHoraria) {
                $query->where('carga_horaria', '>=', $cargaHoraria);
            }
        );

        // Ordenar e paginar
        $cursos = $consulta
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        // Enviar os resultados para a tela
        return view('cursos.index', [
            'cursos' => $cursos,
            'termo' => $termo,
            'cargaHoraria' => $cargaHoraria
        ]);
    }
}
