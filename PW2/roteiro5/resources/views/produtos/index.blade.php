
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
</head>
<body>

    <h1>Lista de produtos</h1>

    @forelse ($produtos as $produto)

        <article>
            <h2>{{ $produto->nome }}</h2>

            <p>
                Categoria: {{ $produto->categoria->nome }}
            </p>

            <p>
                Preço: R$ {{ number_format((float) $produto->preco, 2, ',', '.') }}
            </p>
        </article>

        <hr>

    @empty

        <p>Nenhum produto cadastrado.</p>

    @endforelse

    <a href="{{ route('clientes.index') }}">Ver clientes</a>

</body>
</html>
