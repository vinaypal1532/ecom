<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Subscribing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333333;
            margin-top: 0;
        }
        p {
            color: #666666;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            border-top: 1px solid #e0e0e0;
            padding-top: 10px;
            text-align: center;
            font-size: 12px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Thank You for Subscribing!</h2>

        <p>Dear Subscriber,</p>

        <p>We appreciate you subscribing to our newsletter. Get ready to stay updated on the latest news, offers, and exciting updates from fruitables.</p>

        <p>If you have any questions or if there's anything specific you'd like to know, feel free to reach out to us at <a href="mailto:info@fruitables.in">info@fruitables.in</a>.</p>

        <p>Thank you again for choosing fruitables. We're thrilled to have you as part of our community!</p>

        <p>Best Regards,<br>fruitables Team</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} fruitables. All rights reserved.</p>
            <p>Follow us on <a href="#">Facebook</a>, <a href="#">Twitter</a>, and <a href="#">Instagram</a>.</p>
        </div>

    </div>

</body>

</html>
