<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #f9f9f9;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

        .info div {
            width: 45%;
        }

        .info div p {
            margin: 0;
            line-height: 1.5;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <h1>Invoice <br /> {{ $order->merchant->company_name }}</h1>
            <p>{{ $order->merchant->address }}</p>
        </div>
        <hr />
        <div class="info">
            <div>
                <p><strong>Kepada:</strong></p>
                <p>{{ $order->customer->company_name }}</p>
                <p>{{ $order->customer->address }}</p>
                <p>{{ $order->customer->contact }}</p>
            </div>
            <div>
                <p><strong>Delivery Date:</strong></p>
                <p>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $order->menu->name }}</td>
                    <td>Rp. {{ number_format($order->menu->price, 0, ',', '.') }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>Rp. {{ number_format($order->quantity * $order->menu->price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: right;">Total</th>
                    <th>RP. {{ number_format($order->quantity * $order->menu->price, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Terima kasih telah memesan dari kami!</p>
        </div>
    </div>
</body>

</html>
