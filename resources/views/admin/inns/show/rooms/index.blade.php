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

@endsection
