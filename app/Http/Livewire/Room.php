<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Room as RoomModel;
use App\Models\RoomRate as RoomRate;
use Illuminate\Support\Facades\Auth;
use App\Models\Inn;

class Room extends Component
{
    public $selectedRoom = null;
    public $selectedRate = null;
    public $rates = null;

    public function render()
    {
        $id = Auth::user()->id;
        $inns = Inn::select('*')->where('user_id', $id)->get();
        $rooms = RoomModel::select('*')->where('inn_id', $inns[0]->id)->where('status', 0)->get();
        return view('livewire.room', [
            'rooms' => $rooms,
        ]);
    }

    public function updatedSelectedRoom($room_id) {
        $this->rates = RoomRate::where('room_id', $room_id)->get();
        $this->emit('roomRateSelected', $this->selectedRate);
    }
    public function updatedSelectedRate($rateId)
{
    $this->emit('roomRateSelected', $rateId);
}
}


