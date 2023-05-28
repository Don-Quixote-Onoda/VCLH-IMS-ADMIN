@extends('layout.app')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>

    {{-- Transaction History --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Transaction History Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"> #</th>
                                            <th scope="col">Transaction Date</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($transaction_histories) > 0)
                                            @foreach ($transaction_histories as $transaction_history)
                                                <tr>
                                                    <td>{{ $transaction_history->id }}</td>
                                                    <td>{{ date("F j, Y", strtotime($transaction_history->created_at))  }}</td>
                                                    <td>{{ $transaction_history->customer_name }}</td>
                                                    <td>{{ $transaction_history->payment_amount }}</td>
                                                    

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>


@endsection

{{-- <td>
                                                        <a href="/admin/reservations-admin/{{ $reservation->id }}/edit"
                                                            class="btn btn-success">Edit</a>

                                                    </td>
                                                    <td>
                                                        <form action="/admin/reservations-admin/{{ $reservation->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger d-inline">Delete</button>
                                                        </form>
                                                    </td>
                                                    <td> --}}