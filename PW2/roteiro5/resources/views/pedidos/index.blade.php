
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
</head>
<body>

    <h1>Pedidos</h1>

    @if (session('sucesso'))
        <p>{{ session('sucesso') }}</p>
    @endif

    <p>
        <a href="{{ route('pedidos.create') }}">Novo pedido</a>
    </p>

    <h2>Filtrar pedidos por cliente</h2>

    <form action="{{ route('pedidos.index') }}" method="GET">

        <label for="cliente_id">Selecione o cliente:</label>

        <select name="cliente_id" id="cliente_id">

            <option value="">Todos os clientes</option>

            @foreach ($clientes as $cliente)
                <option
                    value="{{ $cliente->id }}"
                    @selected(request('cliente_id') == $cliente->id)
                >
                    {{ $cliente->nome }}
                </option>
            @endforeach

        </select>

        <button type="submit">Filtrar</button>

        <a href="{{ route('pedidos.index') }}">Limpar filtro</a>

    </form>

    <hr>

    <h2>Lista de pedidos</h2>

    @forelse ($pedidos as $pedido)

        <article>

            <p>Pedido #{{ $pedido->id }}</p>

            <p>
                Cliente: {{ $pedido->cliente->nome }}
            </p>

            <p>
                Data: {{ $pedido->data->format('d/m/Y') }}
            </p>

            <p>
                Valor: R$ {{ number_format((float) $pedido->valor, 2, ',', '.') }}
            </p>

        </article>

        <hr>

    @empty

        <p>Nenhum pedido encontrado para esse cliente.</p>

    @endforelse

</body>
</html>