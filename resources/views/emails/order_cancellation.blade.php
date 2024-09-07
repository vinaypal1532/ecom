<!DOCTYPE html>
<html>
<head>
    <title>Order Cancellation</title>
</head>
<body>
    <h1>Order Cancellation Confirmation</h1>
    <p>Dear {{ $user->name }},</p>
    <p>We regret to inform you that your order with ID <strong>{{ $order->order_id }}</strong> has been canceled.</p>
    <p>If you have any questions, please feel free to contact our support team.</p>
    <p>Thank you for shopping with us.</p>
    <p>Best regards,</p>
    <div class="footer">
            <p>If you have any questions, feel free to <a href="{{ url('/contact') }}">contact us</a>.</p>
            <p>&copy; {{ date('Y') }} Fruitables. All rights reserved.</p>
        </div>
</body>
</html>
