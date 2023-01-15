<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inn;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Freebie;

class RoomManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $inns = Inn::select('*')->where('user_id', $id)->get();
        $rooms = Room::select('*')->where('inn_id', $inns[0]->id)->get();
        $freebies = Freebie::all();
        return view('user.rooms.index')
        ->with('inns', $inns)
        ->with('rooms', $rooms)
        ->with('freebies', $freebies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $freebies = Freebie::all();
        return view('user.rooms.create')
        ->with('inn', $inn)
        ->with('freebies', $freebies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'room_number' => 'required',
            "number_of_beds" => 'required',
            "status" => "required",
            "freebies" => "required"
        ]);
        

        $room = new Room;
        $room->room_number = $request->room_number;
        $room->number_of_beds = $request->number_of_beds;
        $room->status = $request->status;
        $room->inn_id = $request->inn_id;

        $input = $request->all();
        $freebies = $input['freebies'];
        $input['freebies'] = implode(',', $freebies);

        $room->freebies = $input['freebies'];

        $room->save();

        return redirect('/user/rooms-manager')->with('success', 'Room Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        $room_rates = RoomRate::latest()->where('room_id', $id)->get();
        return view('user.rooms.show')
        ->with('room', $room)
        ->with('room_rates', $room_rates);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $freebies = Freebie::all();
        $room = Room::find($id);
        $room_freebies = explode(",",$room->freebies);
        $room_rates = RoomRate::latest()->where('room_id', $id)->get();
        $inn = Inn::where('user_id', Auth::user()->id)->get();


        return view('user.rooms.edit')
        ->with('freebies', $freebies)
        ->with('room', $room)
        ->with('inn', $inn)
        ->with('room_freebies', $room_freebies)
        ->with('room_rates', $room_rates); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'room_number' => 'required',
            "number_of_beds" => 'required',
            "status" => "required",
            "freebies" => "required"
        ]);

        $room = Room::find($id);
        $room->room_number = $request->room_number;
        $room->number_of_beds = $request->number_of_beds;
        $room->status = $request->status;
        $room->inn_id = $request->inn_id;

        $input = $request->all();
        $freebies = $input['freebies'];
        $input['freebies'] = implode(',', $freebies);

        $room->freebies = $input['freebies'];

        $room->save();

        return redirect('/user/rooms-manager')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $room = Room::find($id);
        $room->delete();

        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
