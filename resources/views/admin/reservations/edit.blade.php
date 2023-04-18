@extends('layout.app')
@section('content')
<a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>
    <div class="row d-flex justify-content-center my-5">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary rounded h-100 p-4">
                <form action="{{ route('reservations-admin.update', $reservation->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="inn_id" value="{{ $reservation->inn_id }}">
                         <div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Enter reservation date: </label>
                                <input type="date" name="reservationDate" value="{{$reservation->day_of_reservation}}" class="form-control mb-3"/>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Enter reservee name: </label>
                                <input type="text" name="name" value="{{$reservation->name}}" class="form-control mb-3"/>
                            </div>
                            {{-- <input type="hidden" name="inn_id" value="{{$inn->id}}">  --}}
                            <div class="mb-3">
                                <label for="" class="mb-2">Enter contact number: </label>
                                <input type="number" value="{{$reservation->contact_number}}" name="contactNumber" class="form-control mb-3"/>
                            </div>
                                <div class="mb-3">
                                    <select name="room_id" class="form-select mb-3" aria-label="Default select example">
                                        <option value="">Select Room Number</option>
                                        @if (!is_null($rooms))
                                            @foreach ($rooms as $room)
                                                <option value="{{$room->id}}" {{($reservation->room_id == $room->id) ? 'selected': ''}}>Room No. {{$room->room_number}} - with {{$room->freebies}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                        </div>
                        
                        
                        
                         <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    @endsection
