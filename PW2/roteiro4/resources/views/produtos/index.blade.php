
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cursos</title>
</head>
<body>

    <h1>Lista de Cursos</h1>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('cursos.create') }}">Cadastrar Curso</a>

    <br><br>

    @if($cursos->count() > 0)

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Carga Horária</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cursos as $curso)
                    <tr>
                        <td>{{ $curso->id }}</td>
                        <td>{{ $curso->nome }}</td>
                        <td>{{ $curso->carga_horaria }} horas</td>
                        <td>{{ $curso->ativo ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            <a href="{{ route('cursos.show', $curso->id) }}">Visualizar</a>

                            <a href="{{ route('cursos.edit', $curso->id) }}">Editar</a>

                            <form action="{{ route('cursos.destroy', $curso->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Deseja excluir este curso?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p>Nenhum curso cadastrado.</p>
    @endif

    <br>

    <a href="{{ route('produtos.index') }}">Ir para Produtos</a>

</body>
</html>
