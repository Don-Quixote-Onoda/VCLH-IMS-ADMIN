<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, sans-serif;">

    <h1 style="text-align: center;">Checkout Summary</h1>

    <p style="text-align: center;">Room Number: {{ $transaction->room_rate->room->room_number }}</p>

    <h2>Selected Products:</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5px;">Product</th>
                <th style="border: 1px solid black; padding: 5px;">Quantity</th>
                <th style="border: 1px solid black; padding: 5px;">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('selectedProducts', []) as $product)
                <tr>
                    <td style="border: 1px solid black; padding: 5px;">{{ $product['name'] }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $product['quantity'] }}</td>
                    <td style="border: 1px solid black; padding: 5px;">Php {{ $product['price'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Price: Php {{ $totalAmount }}</h3>

    <p>Room Rate: Php {{ $transaction->room_rate->rate }}</p>

    <p>Payment: Php {{ $paymentInput }}</p>

    <p>Change: Php {{ $change }}</p>

</body>
</html>
