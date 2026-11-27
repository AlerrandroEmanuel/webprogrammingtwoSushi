
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo pedido</title>
</head>
<body>

    <h1>Novo pedido</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pedidos.store') }}" method="POST">

        @csrf

        <label for="cliente_id">Cliente</label>

        <select name="cliente_id" id="cliente_id" required>
            <option value="">Selecione</option>

            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                    @selected(old('cliente_id') == $cliente->id)>
                    {{ $cliente->nome }}
                </option>
            @endforeach

        </select>

        <br><br>

        <label for="data">Data</label>

        <input
            type="date"
            name="data"
            id="data"
            value="{{ old('data') }}"
            required
        >

        <br><br>

        <label for="valor">Valor</label>

        <input
            type="number"
            name="valor"
            id="valor"
            step="0.01"
            min="0"
            value="{{ old('valor') }}"
            required
        >

        <br><br>

        <button type="submit">Salvar pedido</button>

    </form>

    <p>
        <a href="{{ route('pedidos.index') }}">Ver pedidos</a>
    </p>

</body>
</html>
