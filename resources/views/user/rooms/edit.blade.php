@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center my-5">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <form action="/user/rooms-manager/{{ $room->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Room Number</label>
                        <input type="number" name="room_number" value="{{ $room->room_number }}" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Number of Beds</label>
                        <input type="number" name="number_of_beds" value="{{ $room->number_of_beds }}"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <input type="hidden" name="inn_id" value="{{ $room->inn_id }}">
                    <div class="mb-3">
                        <select name="status" class="form-select mb-3" aria-label="Default select example">
                            <option value="">Select Status</option>
                            <option value="0" selected>Un-Occcupied</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-control tags-select w-75 d-inline" name="freebies[]" multiple="multiple">
                            @if (count($freebies) > 0)
                                @foreach ($freebies as $freebie)
                                    @if (count($room_freebies) > 0)
                                        @foreach ($room_freebies as $room_freebie)
                                            @if ($room_freebie == $freebie->name)
                                                <option value="{{ $freebie->name }}" selected>{{ $freebie->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                        <option value="{{ $freebie->name }}">{{ $freebie->name }}
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <button type="button" class="btn btn-primary fw-bold float-end" data-bs-toggle="modal"
                            data-bs-target="#addFreebies">
                            +
                        </button>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
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
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
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
