<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add any custom styles for the PDF */
    </style>
</head>
<body>
    <h1>Checkout Summary</h1>

    <p>Room Number: {{ $transaction->room_rate->room->room_number }}</p>

    <h2>Selected Products:</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('selectedProducts', []) as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>Php {{ $product['price'] }}</td>
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