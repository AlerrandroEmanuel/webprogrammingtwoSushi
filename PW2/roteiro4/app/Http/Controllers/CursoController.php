
<?php

use Illuminate\Http\Request;

require_once app_path('Models/Curso.php');

class CursoController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $cursos = Curso::all();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'carga_horaria' => 'required|integer|min:1',
            'ativo' => 'required|boolean',
        ]);

        Curso::create($dados);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso cadastrado com sucesso!');
    }

    public function show($id)
    {
        $curso = Curso::findOrFail($id);

        return view('cursos.show', compact('curso'));
    }

    public function edit($id)
    {
        $curso = Curso::findOrFail($id);

        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, $id)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'carga_horaria' => 'required|integer|min:1',
            'ativo' => 'required|boolean',
        ]);

        $curso = Curso::findOrFail($id);
        $curso->update($dados);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso excluído com sucesso!');
    }
}
