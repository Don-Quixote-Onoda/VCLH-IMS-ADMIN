@extends('layout.app')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>


    {{-- Order Details --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
              
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Order Details Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order #</th>
                                            <th scope="col">Product </th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($order_details) > 0)
                                            @foreach ($order_details as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->order_number }}</td>
                                                    <td>{{ $reservation->product_id }}</td>
                                                    <td>{{ $reservation->quantity }}</td>
                                                    <td>{{ $reservation->price }}</td>
                                                    <td>{{ $reservation->subtotal }}</td>
                                                    
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
                                                    </td> --}}