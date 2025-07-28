<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #888;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
    <base href="/public">
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="assets/image/logo.png" alt="Company Logo">
        </div>
        <div class="content">
            <h1>Hello, {{ $mailData['name'] }}!</h1>
            <p>Please reset your password by clicking the button below:</p>
            <a href="{{ $mailData['activation_link'] }}" class="button">Reset Password</a>
            <p>If you did not authorize this password reset request, kindly ignore this email.</p>
            <p><strong>Note:</strong> This email address is not monitored. Please do not reply to this email.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
