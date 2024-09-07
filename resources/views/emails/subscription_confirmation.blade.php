<!DOCTYPE html>
<html>
<head>
    <title>Subscription Confirmation</title>
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
        .content {
            margin-top: 20px;
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
            <h1>Thank You for Subscribing!</h1>
        </div>

        <div class="content">
            <p>Hello,User</p>
            <p>Thank you for subscribing to our newsletter. We're excited to have you on board!</p>
            <p>You will now receive regular updates and exclusive offers directly in your inbox.</p>
        </div>

        <div class="footer">
            <p>If you have any questions, feel free to <a href="{{ url('/contact') }}">contact us</a>.</p>
            <p>&copy; {{ date('Y') }} Fruitables. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
