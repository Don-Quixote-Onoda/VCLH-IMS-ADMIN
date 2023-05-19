<h1>Invoice</h1>
<p>Manager: {{ $transaction->user->name }}</p>
<p>Customer: {{ $transaction->customer_name }}</p>
<p>Invoice Number: {{ $transaction->id }}</p>
<p>Room Number: {{ $transaction->room->room_number }}</p>
<p>Amenities: {{ $transaction->room->freebies }}</p>
<p>Total Payment: Php {{ $transaction->room_rate->rate }}</p>
