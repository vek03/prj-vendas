<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Vendas</title>
</head>

<body style="font-size: 12px;">
    <h2 style="text-align: center">Vendas</h2>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd;">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Cliente</th>
                <th style="border: 1px solid #ccc;">Valor</th>
                <th style="border: 1px solid #ccc;">Data</th>
                <th style="border: 1px solid #ccc;">N° Items</th>
                <th style="border: 1px solid #ccc;">N° Parcelas</th>
                <th style="border: 1px solid #ccc;">Forma de Pagamento</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($sales as $sale)
                <tr style="text-align: center">
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $sale->id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $sale->client()->first()->name }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{  'R$ '.number_format(DB::table('item__vendas')->select(DB::raw('sum(quantity * price_uni) AS total'))->where('id_sale', $sale->id)->first()->total, 2, ',', '.')    }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ \Carbon\Carbon::parse($sale->created_at)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $sale->items()->sum('quantity') }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $sale->payments()->count('*') }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $sale->method }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma venda encontrada!</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</body>

</html>