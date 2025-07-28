<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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

        .product-image {
            max-width: 80px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src= "assets/image/logo.png" alt="Company Logo">
        </div>
        <div class="content">
            <h1>Hello, {{ $mailData['name'] }}!</h1>
            <p>Thank you for your order. Here are the details of your purchase:</p>

            <h3>Shipping Address:</h3>
            <p>{{ $mailData['address'] }}</p>

            <table>
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mailData['orders'] as $order)
                        <tr>
                              <td><img src="{{ asset('assets/image/' . $order['product_image']) }}" alt="Product Image" class="product-image"></td>

                            <td>{{ $order['product_names'] }}</td>
                            <td>{{ $order['quantity'] }}</td>
                            <td>${{ number_format($order['total_price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p><strong>Total Amount Paid:</strong> ${{ number_format($mailData['total_price'], 2) }}</p>

            <p>If you have any questions or concerns about your order, feel free to contact us.</p>

            <p><strong>Note:</strong> This email address is not monitored. Please do not reply to this email.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} DesignAura. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
