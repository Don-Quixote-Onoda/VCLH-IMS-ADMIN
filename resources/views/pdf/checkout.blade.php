<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        
        h2 {
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        
        thead th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .total-price {
            margin-top: 30px;
            text-align: right;
        }
        
        .total-price h3 {
            font-size: 18px;
        }
        
        .payment-details {
            margin-top: 30px;
        }
        
        .payment-details p {
            margin-bottom: 5px;
        }
        
        .invoice-note {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Checkout Summary</h1>
        <h3>Accomodation: {{$inn->inn_name}}</h3>
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

        <div class="total-price">
            <h3>Total Price: Php {{ $totalAmount }}</h3>
        </div>

        <div class="payment-details">
            <p>Room Rate: Php {{ $transaction->room_rate->rate }}</p>
            <p>Payment: Php {{ $paymentInput }}</p>
            <p>Change: Php {{ $change }}</p>
        </div>

        <div class="invoice-note">
            <p>Please make the payment at the reception.</p>
        </div>
    </div>

</body>
</html>
