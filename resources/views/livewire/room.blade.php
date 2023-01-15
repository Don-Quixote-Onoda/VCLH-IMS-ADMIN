<div>
    <div class="mb-3">
        <select name="room_id" class="form-select mb-3" wire:model="selectedRoom" aria-label="Default select example">
            <option value="">Select Room Number</option>
            @foreach ($rooms as $room)
                <option value="{{$room->id}}">Room No. {{$room->room_number}} - with {{$room->freebies}}</option>
            @endforeach
        </select>
    </div>
        <div class="mb-3">
            <select name="room_rate_id" class="form-select mb-3" wire:model="selectedRate" aria-label="Default select example">
                <option value="">Select Room Rate</option>
                @if (!is_null($rates))
                    @foreach ($rates as $rate)
                        <option value="{{$rate->id}}">{{$rate->number_of_hours}} {{($rate->number_of_hours > 2) ? 'hours' : 'hour'}} - PHP {{$rate->rate}}</option>
                    @endforeach
                @endif
            </select>
        </div>
</div>


