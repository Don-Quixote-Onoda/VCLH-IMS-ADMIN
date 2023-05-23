@extends('layout.app')
@section('content')
    
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary mb- 4 rounded d-flex align-items-center justify-content-between p-4">
                            <form action="{{ route('order-details.store') }}" class="w-100" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="order_number" value="vcw-{{$id}}-ams-{{$last_id}}">

                                <div>
                                    <div class="mb-3">
                                        <h3>Point of Sale</h3>
                                        <select name="product_id" class="form-select mb-3"
                                            aria-label="Default select example" required>
                                            <option value="">Select Room</option>
                                            @if (!is_null($products))
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }} - {{$product->category_id}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <select name="room_id" class="form-select mb-3"
                                            aria-label="Default select example" required>
                                            <option value="">Select Room #</option>
                                            @if (!is_null($rooms))
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">Room #{{ $room->room_number }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div> --}}
                                    <input type="hidden" name="inn_id" value="{{ $id }}">
                                    <div class="mb-3">
                                        <label for="" class="mb-2">Quantity: </label>
                                        <input type="number" required name="quantity"
                                            class="form-control mb-3" />
                                    </div>
                                   
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        @if (count($transactions))
                        <div class="bg-secondary mt-4 rounded d-flex align-items-center justify-content-between p-4">
                            <form action="{{ route('transactions-manager.store') }}" class="w-100" method="post">
                                @csrf
                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                <input type="hidden" name="pos_transaction_number" value="vcw-{{$id}}-ams-{{$last_id}}">

                                <div>
                                    <div class="mb-3">
                                        <h3>Transaction</h3>
                                        <select name="room_id" class="form-select mb-3" disabled
                                            aria-label="Default select example" required>
                                            <option value="">Select Room</option>
                                            @if (!is_null($rooms))
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}" {{$transactions[0]->room_id == $room->id ? 'selected': ''}}>Room Number #{{ $room->room_number }}
                                                @endforeach
                                            @endif
                                        </select>
                                        <select name="room_rate_id" class="form-select mb-3" disabled
                                            aria-label="Default select example" required>
                                            <option value="">Select Room Rates</option>
                                            @if (!is_null($room_rates))
                                                @foreach ($room_rates as $room_rate)
                                                    <option value="{{ $room_rate->id }}"  {{$transactions[0]->room_rate_id == $room_rate->id ? 'selected': ''}}>{{ $room_rate->number_of_hours }}hrs - {{$room_rate->rate}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                   
                                   
                                </div>
                            </form>
                        </div>
                        @endif
                        
                    </div>
                    <div class="col-sm-6 col-xl-6" >
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4">POS/Transaction Number: vcw-{{$id}}-ams-{{$last_id}}</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <p>POS</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($order_details) > 0)
                                                @foreach ($order_details as $order_detail)
                                                    <tr>
                                                        <td>{{ $order_detail->product_id }}</td>
                                                        <td>{{ $order_detail->quantity }}</td>
                                                        <td>₱{{ number_format($order_detail->price, 2, '.', ',') }}</td>
                                                        <td>{{ $order_detail->subtotal }}</td>
                                                        <td>
    
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <table class="table table-hover">
                                        <p>Transactions</p>
                                        <thead>
                                            <tr>
                                                <th scope="col">Room Number</th>
                                                <th scope="col">Number of hours</th>
                                                <th scope="col">Room Rate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($transactions) > 0)
                                                @foreach ($transactions as $transaction)
                                                    <tr>
                                                        <td>#{{ $transaction->room->room_number }}</td>
                                                        <td>{{ $transaction->room_rate->number_of_hours }}</td>
                                                        <td>₱{{ number_format($transaction->room_rate->rate, 2, '.', ',') }}</td>
                                                        <td>
    
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <a type="submit" href="/user/pay_order_summary/{{$id}}" class="btn btn-primary">Pay</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->



@endsection