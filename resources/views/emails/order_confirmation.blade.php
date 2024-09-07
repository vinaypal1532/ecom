<!DOCTYPE html>
<html>
<head>
    <title>Address Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #333;
        }
        .order-details {
            margin-top: 20px;
        }
        .order-details h2 {
            color: #555;
        }
        .order-items {
            margin: 20px 0;
        }
        .order-items th, .order-items td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .order-items th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .footer p {
            color: #555;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Address Created</h1>
        </div>
        <p>Hello {{ Auth::user()->name }},</p>
        <p>Your new address has been successfully created:</p>
        <ul>
            <li><strong>Name:</strong> {{ $address->name }}</li>
            <li><strong>Mobile:</strong> {{ $address->mobile }}</li>
            <li><strong>Address:</strong> {{ $address->address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->pincode }}, {{ $address->landmark }}</li>
        </ul>
        <div class="footer">
            <p>If you have any questions, feel free to <a href="{{ url('/contact') }}">contact us</a>.</p>
            <p>&copy; {{ date('Y') }} Fruitables. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
