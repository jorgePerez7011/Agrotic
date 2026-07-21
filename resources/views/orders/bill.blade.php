<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
            color: #4CAF50;
        }
        .invoice-header p {
            margin: 5px 0;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
        }
        .total strong {
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Factura</h1>
            <p>Fecha: {{ $order->date_order }}</p>
            <p>Total: ${{ $order->total }}</p>
            <p>Cliente: {{ $client->name }}</p>
            <p>Documento: {{ $client->document }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>${{ $detail->product->price }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ $detail->product->price * $detail->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p><strong>Total: ${{ $order->total }}</strong></p>
        </div>
    </div>
</body>

</html>
