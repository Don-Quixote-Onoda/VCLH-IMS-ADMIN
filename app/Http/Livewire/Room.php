<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Room as RoomModel;
use App\Models\RoomRate as RoomRate;

class Room extends Component
{
    public $selectedRoom = null;
    public $selectedRate = null;
    public $rates = null;

    public function render()
    {
        return view('livewire.room', [
            'rooms' => RoomModel::where('status', 0)->get(),
        ]);
    }

    public function updatedSelectedRoom($room_id) {
        $this->rates = RoomRate::where('room_id', $room_id)->get();
    }
}


