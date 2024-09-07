<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->order_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td, .invoice-box table th {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .invoice-box table th {
            background: #f4f4f4;
            font-weight: bold;
        }
        .invoice-box table td {
            vertical-align: top;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 25px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .order-items th, .order-items td {
            text-align: left;
        }
        .order-items{
            border
        }
        .order-items td,  .order-items table th {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Fruitables India Pvt Ltd</h2>
                            </td>
                            <td>
                                Invoice #: {{ $order->order_id }}<br>
                                Created: {{ $order->created_at->format('d/m/Y') }}<br>
                                Due: {{ \Carbon\Carbon::parse($order->created_at)->addDays(30)->format('d/m/Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                               <p>Address: 198 Near MP Nagar Bhopal, India</p>
                               <p>Email: info@fruitables.com</p>
                            </td>
                            <td>
                                {{ $order->customer_name }}<br>
                                {{ $order->customer_address }}<br>
                                {{ $order->customer_email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="order-items">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>INR {{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>INR {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="3" style="text-align: right;">
                    Total:
                </td>
                <td>
                   INR {{ number_format($order->total, 2) }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
