@extends('layout.inn-layout')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>

{{-- rooms --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewRoom">Add New Room</button> --}}
                <a href="/admin/add-room-admin/{{ $id }}" class="btn btn-outline-primary">+ Room</a>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Rooms Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">room number</th>
                                            <th scope="col">number of beds</th>
                                            <th scope="col">freebie</th>
                                            <th scope="col">status</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($rooms) > 0)
                                            @foreach ($rooms as $room)
                                                <tr>
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->number_of_beds }}
                                                        {{ $room->number_of_beds > 1 ? 'beds' : 'bed' }} </td>
                                                    <td>{{ $room->freebies }}</td>
                                                    <td>{{ $room->status == 1 ? 'occupied' : 'un-occupied' }}</td>
                                                    <td>
                                                        <a href="/admin/rooms-admin/{{ $room->id }}"
                                                            class="btn btn-success">Add Rate</a>

                                                    </td>
                                                    <td>
                                                        <a href="/admin/rooms-admin/{{ $room->id }}/edit"
                                                            class="btn btn-success">Edit</a>

                                                    </td>
                                                    <td>
                                                        <form action="/admin/rooms-admin/{{ $room->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger d-inline">Delete</button>
                                                        </form>
                                                    </td>
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

    {{-- transaction --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewTransaction">Add New Transaction</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Transactions Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">username</th>
                                            <th scope="col">lodging house / inn name</th>
                                            <th scope="col">room number</th>
                                            <th scope="col">freebie</th>
                                            <th scope="col">hours</th>
                                            <th scope="col">rate</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($transactions) > 0)
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->user->name }}</td>
                                                    <td>{{ $transaction->inn_name }}</td>
                                                    <td>{{ $transaction->room->room_number }}</td>
                                                    <td>{{ $transaction->room->freebies }}</td>
                                                    <td>{{ $transaction->room_rate->number_of_hours }} hours</td>
                                                    <td>PHP{{ $transaction->room_rate->rate }}</td>
                                                    <td>
                                                        <a href="/admin/transactions-admin/{{ $transaction->id }}"
                                                            class="btn btn-success">Print</a>

                                                    </td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewTransaction" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Transaction</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('transactions-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <livewire:room></livewire:room>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Reservation --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Reservation</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Reservations Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">day of reservation</th>
                                            <th scope="col">reservee name</th>
                                            <th scope="col">contact number</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reservations) > 0)
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->day_of_reservation }}</td>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->contact_number }}</td>
                                                    <td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('reservations-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservation date: </label>
                                                    <input type="date" name="reservationDate"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservee name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter contact number: </label>
                                                    <input type="number" name="contactNumber"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="room_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">Select Room Number</option>
                                                        @if (!is_null($rooms))
                                                            @foreach ($rooms as $room)
                                                                <option value="{{ $room->id }}">Room No.
                                                                    {{ $room->room_number }} - with {{ $room->freebies }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>



                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Products --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Products</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Products Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">day of reservation</th>
                                            <th scope="col">reservee name</th>
                                            <th scope="col">contact number</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reservations) > 0)
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->day_of_reservation }}</td>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->contact_number }}</td>
                                                    <td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('reservations-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservation date: </label>
                                                    <input type="date" name="reservationDate"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservee name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter contact number: </label>
                                                    <input type="number" name="contactNumber"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="room_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">Select Room Number</option>
                                                        @if (!is_null($rooms))
                                                            @foreach ($rooms as $room)
                                                                <option value="{{ $room->id }}">Room No.
                                                                    {{ $room->room_number }} - with {{ $room->freebies }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Orders --}}

    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Products</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Products Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">day of reservation</th>
                                            <th scope="col">reservee name</th>
                                            <th scope="col">contact number</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reservations) > 0)
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->day_of_reservation }}</td>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->contact_number }}</td>
                                                    <td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('reservations-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservation date: </label>
                                                    <input type="date" name="reservationDate"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservee name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter contact number: </label>
                                                    <input type="number" name="contactNumber"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="room_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">Select Room Number</option>
                                                        @if (!is_null($rooms))
                                                            @foreach ($rooms as $room)
                                                                <option value="{{ $room->id }}">Room No.
                                                                    {{ $room->room_number }} - with {{ $room->freebies }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Category --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Product Categories</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Product Categories Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">day of reservation</th>
                                            <th scope="col">reservee name</th>
                                            <th scope="col">contact number</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reservations) > 0)
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->day_of_reservation }}</td>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->contact_number }}</td>
                                                    <td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('reservations-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservation date: </label>
                                                    <input type="date" name="reservationDate"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservee name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter contact number: </label>
                                                    <input type="number" name="contactNumber"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="room_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">Select Room Number</option>
                                                        @if (!is_null($rooms))
                                                            @foreach ($rooms as $room)
                                                                <option value="{{ $room->id }}">Room No.
                                                                    {{ $room->room_number }} - with {{ $room->freebies }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Details --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Order Details</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Order Details Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">day of reservation</th>
                                            <th scope="col">reservee name</th>
                                            <th scope="col">contact number</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reservations) > 0)
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->day_of_reservation }}</td>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->contact_number }}</td>
                                                    <td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('reservations-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservation date: </label>
                                                    <input type="date" name="reservationDate"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservee name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter contact number: </label>
                                                    <input type="number" name="contactNumber"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="room_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">Select Room Number</option>
                                                        @if (!is_null($rooms))
                                                            @foreach ($rooms as $room)
                                                                <option value="{{ $room->id }}">Room No.
                                                                    {{ $room->room_number }} - with {{ $room->freebies }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Summary --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Order Summary</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Order Summary Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">day of reservation</th>
                                            <th scope="col">reservee name</th>
                                            <th scope="col">contact number</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reservations) > 0)
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->day_of_reservation }}</td>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->contact_number }}</td>
                                                    <td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('reservations-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservation date: </label>
                                                    <input type="date" name="reservationDate"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservee name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter contact number: </label>
                                                    <input type="number" name="contactNumber"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="room_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">Select Room Number</option>
                                                        @if (!is_null($rooms))
                                                            @foreach ($rooms as $room)
                                                                <option value="{{ $room->id }}">Room No.
                                                                    {{ $room->room_number }} - with {{ $room->freebies }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Inventory Management --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Inventory</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Inventory Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">day of reservation</th>
                                            <th scope="col">reservee name</th>
                                            <th scope="col">contact number</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reservations) > 0)
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->day_of_reservation }}</td>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->contact_number }}</td>
                                                    <td>
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
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('reservations-admin.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservation date: </label>
                                                    <input type="date" name="reservationDate"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter reservee name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Enter contact number: </label>
                                                    <input type="number" name="contactNumber"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="room_id" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option value="">Select Room Number</option>
                                                        @if (!is_null($rooms))
                                                            @foreach ($rooms as $room)
                                                                <option value="{{ $room->id }}">Room No.
                                                                    {{ $room->room_number }} - with {{ $room->freebies }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addFreebies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Freebie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{ route('freebies-admin.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="freebie" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
