<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Lista todos os cursos.
     */
    public function index()
    {
        $cursos = Curso::all();

        return view('cursos.index', compact('cursos'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Salva um novo curso.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                'unique:cursos,nome',
            ],

            'descricao' => [
                'required',
                'string',
            ],

            'carga_horaria' => [
                'required',
                'integer',
                'min:1',
            ],

            'ativo' => [
                'required',
                'boolean',
            ],
        ]);

        Curso::create($dados);

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um curso.
     */
    public function show(Curso $curso)
    {
        return view('cursos.show', compact('curso'));
    }

    /**
     * Exclui um curso.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso excluído com sucesso!');
    }
}