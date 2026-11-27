
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
</head>
<body>

    <h1>Lista de clientes</h1>

    @forelse ($clientes as $cliente)

        <article>
            <h2>{{ $cliente->nome }}</h2>

            <p>Email: {{ $cliente->email }}</p>

            <p>
                Quantidade de pedidos:
                {{ $cliente->pedidos_count }}
            </p>

            <a href="{{ route('clientes.pedidos', $cliente->id) }}">
                Ver pedidos
            </a>
        </article>

        <hr>

    @empty

        <p>Nenhum cliente cadastrado.</p>

    @endforelse

    <a href="{{ route('pedidos.index') }}">Voltar aos pedidos</a>

</body>
</html>
