
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos do cliente</title>
</head>
<body>

    <h1>Pedidos de {{ $cliente->nome }}</h1>

    <p>Email: {{ $cliente->email }}</p>

    @forelse ($pedidos as $pedido)

        <article>
            <p>Pedido: #{{ $pedido->id }}</p>

            <p>
                Data: {{ $pedido->data->format('d/m/Y') }}
            </p>

            <p>
                Valor: R$ {{ $pedido->valor }}
            </p>
        </article>

        <hr>

    @empty

        <p>Este cliente ainda não possui pedidos.</p>

    @endforelse

    <a href="{{ route('pedidos.index') }}">Voltar aos pedidos</a>

</body>
</html>
