@extends('layout.app')
@section('content')

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <h1>{{ $inns[0]->inn_name }}</h1>
                <h2>Number of Rooms: {{ $inns[0]->number_of_rooms }}</h2>
                <hr class="my-3">

                {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewRoom">Add New Room</button> --}}
                <a href="/user/rooms-manager/create" class="btn btn-outline-primary">Add New Room</a>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Rooms Table</h6>
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
                                                <td>{{ $room->status == 1 ? 'active' : 'inactive' }}</td>
                                                <td>
                                                    <a href="/user/rooms-manager/{{ $room->id }}"
                                                        class="btn btn-success">Room
                                                        Rate</a>

                                                </td>
                                                <td>
                                                    <a href="/user/rooms-manager/{{ $room->id }}/edit"
                                                        class="btn btn-success">Edit</a>

                                                </td>
                                                <td>
                                                    <form action="/user/rooms-manager/{{ $room->id }}" method="post">
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

                <!-- Modal -->
                <div class="modal fade" id="addNewRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Room</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('rooms-manager.store') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Room Number</label>
                                                <input type="number" name="room_number" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Number of Beds</label>
                                                <input type="number" name="number_of_beds" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <input type="hidden" name="inn_id" value="{{ $inns[0]->id }}">
                                            <div class="mb-3">
                                                <select name="status" class="form-select mb-3"
                                                    aria-label="Default select example">
                                                    <option value="">Select Status</option>
                                                    <option value="1" selected>Active</option>
                                                    <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select name="freebie_id" class="form-select mb-3 w-75 d-inline"
                                                    aria-label="Default select example">
                                                    <option value="">Select Freebies</option>
                                                    @if (count($freebies) > 0)
                                                        @foreach ($freebies as $freebie)
                                                            <option value="{{ $freebie->id }}">with
                                                                {{ $freebie->freebie }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <button type="button" class="btn btn-primary fw-bold float-end"
                                                    data-bs-toggle="modal" data-bs-target="#addFreebies">
                                                    +
                                                </button>
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
                            <form action="{{ route('freebies-manager.store') }}" method="post">
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
