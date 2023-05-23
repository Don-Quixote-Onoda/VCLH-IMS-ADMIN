@extends('layout.inn-layout')
@section('content')

    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-6">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Order Number: vcw-{{ $id }}-ams-{{ $last_id }}</h6>
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

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <form action="{{ route('order-summary.store') }}" id="form" class="w-100" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="order_number" value="vcw-{{ $id }}-ams-{{ $last_id }}">

                        <div>
                            <div class="mb-3">
                                <select  name="room_id" class="form-select mb-3" aria-label="Default select example"
                                    required>
                                    <option value="" >Select Room #</option>
                                    @if (!is_null($rooms))
                                        
                                        @if (count($transactions) > 0)
                                        @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}" {{$room->id == $transactions[0]->room_id ? 'selected' : ''}}>Room #{{ $room->room_number }}
                                        </option>
                                    @endforeach
                                        @else
                                        @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}" >Room #{{ $room->room_number }}
                                        </option>
                                    @endforeach
                                        @endif
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Total: </label>
                                <input type="number" id="total" disabled value="{{$total }}" required
                                    name="total" class="form-control mb-3" />
                                    <input type="hidden" name="total" value="{{$total }}">
                            </div>
                            <input type="hidden" name="inn_id" value="{{ $id }}">
                            @if(count($transactions) > 0)
                            <input type="hidden" name="transaction_id" value="{{ $transactions[0]->id }}">
                            @endif
                            <div class="mb-3">
                                <label for="" class="mb-2">Payment: </label>
                                <input type="number" id="payment" required name="payment" class="form-control mb-3" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2" >Change: </label>
                                <input type="number" id="change" disabled required name="change" class="form-control mb-3" />
                            </div>
                            
                                    <input type="hidden" name="change" id="total-change" value="{{$total }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Sale & Revenue End -->

    <script>
        var total = document.getElementById('total');
        var numberInput = document.getElementById('payment');
        var changeInput = document.getElementById('change');
        var totalChange = document.getElementById('total-change');

    numberInput.addEventListener('input', function() {
        var inputValue = this.value;
        changeInput.value = inputValue - total.value;
        totalChange.value = inputValue - total.value;
    });
    
    </script>


@endsection
