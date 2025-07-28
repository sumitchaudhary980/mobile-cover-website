<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Notification</title>
    <base href="/public">
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

        .link {
            color: #007bff;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="assets/image/logo.png" alt="Company Logo">
        </div>
        <div class="content">
            <h1>Hello, {{ $mailData['name'] }}!</h1>
            <p>Your password has been changed. If this was not you, please contact support immediately.</p>

            <p><span class="bold">For further assistance:</span> You can reach out to our support team at <a href="mailto:jaiswalsumit1010@gmail.com" class="link">jaiswalsumit1010@gmail.com</a>.</p>
            <p><strong>Note:</strong> This email address is not monitored. Please do not reply to this email.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} DesignAura. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
