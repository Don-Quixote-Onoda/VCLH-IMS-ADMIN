<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomRate;

class RoomRatesManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'number_of_hours' => 'required',
            'rate' => 'required',
        ]);

        $room_rate = new RoomRate;
        $room_rate->number_of_hours = $request->number_of_hours;
        $room_rate->rate = $request->rate;
        $room_rate->room_id = $request->room_id;
        $room_rate->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room_rate = RoomRate::find($id);
        return view('user.room_rates.edit')
        ->with('room_rate', $room_rate);
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
            'number_of_hours' => 'required',
            'rate' => 'required',
        ]);

        $room_rate = RoomRate::find($id);
        $room_rate->number_of_hours = $request->number_of_hours;
        $room_rate->rate = $request->rate;
        $room_rate->room_id = $request->room_id;
        $room_rate->save();

        return redirect('/user/rooms-manager'.'/'.$room_rate->room_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room_rate = RoomRate::find($id);
        $room_rate->delete();

        return redirect()->back();
    }
}
