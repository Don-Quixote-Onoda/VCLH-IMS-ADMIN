@extends('layout.app')
@section('content')

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <h1>{{ $inns[0]->inn_name }}</h1>
                <h2>Number of Rooms: {{ $inns[0]->number_of_rooms }}</h2>
                <hr class="my-3">

                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add Reservation</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Reservations Table</h6>
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
                                                    <a href="/user/reservations-manager/{{ $reservation->id }}/edit"
                                                        class="btn btn-success">Edit</a>

                                                </td>
                                                <td>
                                                    <form action="/user/reservations-manager/{{ $reservation->id }}"
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
                                        <form action="{{ route('reservations-manager.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $inns[0]->id }}">
                                            <div>
                                               <div class="mb-3">
                                                   <label for="" class="mb-2">Enter reservation date: </label>
                                                   <input type="date" name="reservationDate" class="form-control mb-3"/>
                                               </div>
                                               <div class="mb-3">
                                                   <label for="" class="mb-2">Enter reservee name: </label>
                                                   <input type="text" name="name" class="form-control mb-3"/>
                                               </div>
                                               <div class="mb-3">
                                                   <label for="" class="mb-2">Enter contact number: </label>
                                                   <input type="number" name="contactNumber" class="form-control mb-3"/>
                                               </div>
                                                   <div class="mb-3">
                                                       <select name="room_id" class="form-select mb-3" aria-label="Default select example">
                                                           <option value="">Select Room Number</option>
                                                           @if (!is_null($rooms))
                                                               @foreach ($rooms as $room)
                                                                   <option value="{{$room->id}}">Room No. {{$room->room_number}} - with {{$room->freebies}}</option>
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
            @endsection
