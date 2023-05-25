@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center mt-5">
    <div class="col-11">
        <div class="bg-secondary rounded h-100 p-4">
            <h1>{{ $inns[0]->inn_name }}</h1>
            <h2>Number of Rooms: {{ $inns[0]->number_of_rooms }}</h2>
            <hr class="my-3">

            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#addNewReservation">Add Reservation</button>
            <div class="row mt-3 overflow-scroll ">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Reservations Table</h6>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Day of Reservation</th>
                                    <th scope="col">Reservee Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Room Number</th>
                                    <th scope="col">Room Rate</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($reservations) > 0)
                                @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->day_of_reservation }}</td>
                                    <td>{{ $reservation->name }}</td>
                                    <td>{{ $reservation->contact_number }}</td>
                                    <td>{{ $reservation->room->room_number }}</td>
                                    <td>{{ $reservation->roomRate ? $reservation->roomRate->rate : 'N/A' }}</td>
                                    <td>{{ $reservation->status }}</td>
                                    <td>
                                        <a href="/user/reservations-manager/{{ $reservation->id }}/edit"
                                            class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStatusModal{{ $reservation->id }}">Status</button>
                                    </td>
                                    <!-- <td>
                                        <form action="/user/reservations-manager/{{ $reservation->id }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger d-inline">Delete</button>
                                        </form>
                                    </td> -->
                                </tr>
                                <div class="modal fade" id="editStatusModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="editStatusModalLabel{{ $reservation->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusModalLabel{{ $reservation->id }}">Edit Reservation Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reservations-manager.updateStatus', $reservation->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="status{{ $reservation->id }}">Status</label>
                            <select class="form-control" id="status{{ $reservation->id }}" name="status">
                                <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                                    <form action="{{ route('reservations-manager.store') }}" method="post"
                                        id="addReservationForm">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="reservationDate" class="col-sm-3 col-form-label">Day of
                                                Reservation</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="reservationDate"
                                                    name="reservationDate" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-3 col-form-label">Reservee Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="contactNumber" class="col-sm-3 col-form-label">Contact
                                                Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="contactNumber"
                                                    name="contactNumber" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        <livewire:room ></livewire:room>
                                        </div>
                                        <input type="hidden" name="inn_id" value="{{ $inns[0]->id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" form="addReservationForm">Add
                                Reservation</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
    <script>
          // Get the room and room rate select elements
          const roomSelect = document.getElementById('roomSelect');
        const roomRateSelect = document.getElementById('roomRateSelect');

        // Update room rate options when room selection changes
        roomSelect.addEventListener('change', function() {
            const selectedRoom = this.options[this.selectedIndex];
            const roomRates = JSON.parse(selectedRoom.getAttribute('data-room-rates'));

            // Clear previous options
            roomRateSelect.innerHTML = '<option value="">Select Room Rate</option>';

            // Add new options
            roomRates.forEach(function(roomRate) {
                const option = document.createElement('option');
                option.value = roomRate.id;
                option.textContent = roomRate.rate;
                roomRateSelect.appendChild(option);
            });
        });

        document.addEventListener("livewire:load", function () {
            // Get the room and room rate select elements
            const roomSelect = document.getElementById('roomSelect');
            const roomRateSelect = document.getElementById('roomRateSelect');

            // Update room rate options when room selection changes
            roomSelect.addEventListener('change', function () {
                const selectedRoom = this.options[this.selectedIndex];
                const roomRates = JSON.parse(selectedRoom.getAttribute('data-room-rates'));

                // Clear previous options
                roomRateSelect.innerHTML = '<option value="">Select Room Rate</option>';

                // Add new options
                roomRates.forEach(function (roomRate) {
                    const option = document.createElement('option');
                    option.value = roomRate.id;
                    option.textContent = roomRate.rate;
                    roomRateSelect.appendChild(option);
                });

                // Emit event to update selected room rate
                Livewire.emit('roomRateSelected', roomRateSelect.value);
            });

            // Listen to the emitted event from Livewire component and set the selected room rate
            Livewire.on('roomRateSelected', function (selectedRate) {
                roomRateSelect.value = selectedRate;
            });
        });
    </script>
@endpush
