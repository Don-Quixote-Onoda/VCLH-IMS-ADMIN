@extends('layout.app')

@section('content')

<div class="col-sm-6 col-xl-6">
    <h1>Point of Sale</h1>
    <p>For Room Number: {{ $transaction->room_rate->room->room_number }}</p>

    <form action="{{ route('transactions.addProduct', $transaction->id) }}" method="POST">
        @csrf

        <label for="product">Product:</label>
        <select name="product" id="product" class="form-control mb-3">
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} - PHP{{ $product->price }}</option>
            @endforeach
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control mb-3" name="quantity" id="quantity" min="1" required>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>

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

    <h3>Total Price: Php <span id="totalPrice">{{ session('totalPrice', $transaction->room_rate->rate) }}</span></h3>

    <form action="{{ url('user/transactions-manager/'.$transaction->id.'/checkout') }}" method="POST" id="checkoutForm">
        @csrf

        <div class="form-group">
            <label for="paymentInput">Payment:</label>
            <input type="number" class="form-control" id="paymentInput" name="paymentInput" min="0" step="0.01" required>
        </div>

        <p>Change: Php <span id="change">0</span></p>

        <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
    </form>
</div>

<script>
    // Get the form element
    var form = document.getElementById('checkoutForm');

    // Calculate change on payment input change
    var paymentInput = document.getElementById('paymentInput');
    var changeElement = document.getElementById('change');
    var totalPriceElement = document.getElementById('totalPrice');
    var proceedButton = document.getElementById('proceedButton');

    paymentInput.addEventListener('input', function() {
        var inputValue = parseFloat(this.value);
        var totalPrice = parseFloat(totalPriceElement.innerText);

        if (!isNaN(inputValue)) {
            var change = inputValue - totalPrice;
            changeElement.innerText = change.toFixed(2);

            // Enable or disable the "Proceed to Checkout" button based on the payment input
            if (inputValue >= totalPrice) {
                proceedButton.disabled = false;
            } else {
                proceedButton.disabled = true;
            }
        } else {
            // If the payment input is empty or not a valid number, disable the button
            proceedButton.disabled = true;
        }
    });
</script>



@endsection
