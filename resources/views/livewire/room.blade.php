<div>
    <div class="mb-3 row">
    <label for="room_rate_id" class="col-sm-3 col-form-label">Room Number</label>
        
        <div class="col-sm-9">
        <select name="room_id" class="form-select col-sm-9 mb-3" wire:model="selectedRoom" aria-label="Default select example">
            <option value="">Select Room Number</option>
            {{$rooms}}
            @foreach ($rooms as $room)
                <option value="{{$room->id}}">Room No. {{$room->room_number}} - with {{$room->freebies}}</option>
            @endforeach
        </select>
        </div>
    </div>
        <div class="mb-3 row">
        <label for="room_rate_id" class="col-sm-3 col-form-label">Room Rate</label>
    <div class="col-sm-9">
        <select name="room_rate_id" id="roomRateSelect" class="form-select" wire:model="selectedRate">
            <option value="">Select Room Rate</option>
            @if (!is_null($rates))
                @foreach ($rates as $rate)
                    <option value="{{$rate->id}}">{{$rate->number_of_hours}} {{($rate->number_of_hours > 2) ? 'hours' : 'hour'}} - PHP {{$rate->rate}}</option>
                @endforeach
            @endif
        </select>
    </div>
        </div>
</div>


