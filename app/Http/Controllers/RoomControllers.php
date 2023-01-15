<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Freebie;
use App\Models\Inn;

class RoomControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index')->with('rooms', $rooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    public function addRoom($id) {
        $inn = Inn::find($id);
        $freebies = Freebie::all();
        return view('admin.rooms.create')
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

        return redirect('/admin/inns-admin/'.$request->inn_id)->with('success', 'Room Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $freebies = Freebie::all();
        $room = Room::find($id);
        $room_rates = RoomRate::latest()->where('room_id', $id)->get();

        return view('admin.rooms.show')
        ->with('freebies', $freebies)
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


        return view('admin.rooms.edit')
        ->with('freebies', $freebies)
        ->with('room', $room)
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


        return redirect('/admin/inns-admin'.'/'.$request->inn_id)->with('success', 'Room Updated Successfully!');
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
