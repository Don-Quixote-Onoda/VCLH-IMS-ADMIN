<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
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

        Reservation::create([
            'day_of_reservation' => $request->reservationDate,
            'name' => $request->name,
            'contact_number' => $request->contactNumber,
            'inn_id' => $request->inn_id,
            'room_id' => $request->room_id,
        ]);
        return redirect()->back()->with('success', 'Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $newStatus = $request->input('status'); // Retrieve the new status from the request
        
        $statusOptions = Reservation::getStatusOptions();
        
        if (array_key_exists($newStatus, $statusOptions)) {
            $reservation->status = $newStatus;
            $reservation->save();
            
            return redirect('user/reservations-manager/')->with('success', 'Added Successfully!');
        } else {
            return response()->json(['error' => 'Invalid status provided.'], 400);
        }
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms = Room::all();
        $reservation = Reservation::find($id);
        return view('admin.reservations.edit', [
            'reservation' => $reservation,
            'rooms' => $rooms
        ]);
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
        $reservation = Reservation::find($id);
        $reservation->update([
            'day_of_reservation' => $request->reservationDate,
            'name' => $request->name,
            'contact_number' => $request->contactNumber,
            'inn_id' => $request->inn_id,
            'room_id' => $request->room_id,
        ]);
        return redirect('admin/inns-admin/'.$request->inn_id)->with('success', 'Added Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return redirect()->back()->with('success', 'Added Successfully!');
    }
}
