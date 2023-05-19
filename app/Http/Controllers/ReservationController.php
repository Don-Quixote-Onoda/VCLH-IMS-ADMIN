<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Inn;
use App\Models\Transaction;
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
        $inns = Inn::all();
    
        // Retrieve the list of reservations with room and room rate relationships
        $reservations = Reservation::with('room', 'roomRate')->get();
    
        // Pass the data to the view
        return view('reservations.index', compact('inns', 'reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$rooms = Room::all();
        $roomRates = RoomRate::all();
        return view('reservations.index', compact('roomRates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        $reservation = new Reservation();
        $reservation->day_of_reservation = $request->input('reservationDate');
        $reservation->name = $request->input('name');
        $reservation->contact_number = $request->input('contactNumber');
        $reservation->room_id = $request->input('room_id');
        $reservation->room_rate_id = $request->input('room_rate_id');
        $reservation->save();
    
        // Retrieve the room rates associated with the selected room
        $roomRates = Room::findOrFail($request->room_id)->roomRate;
    
        return redirect()->back()->with(['success' => 'Added Successfully!', 'roomRates' => $roomRates]);

        

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the reservation details
    $reservation = Reservation::findOrFail($id);
    
    // Retrieve the status options
    $statusOptions = $reservation->getStatusOptions();

    return view('your-view', compact('reservation', 'statusOptions'));
}

public function updateStatus(Request $request, Reservation $reservation)
{
    $reservationId = $request->input('reservation_id');
    $reservation = Reservation::findOrFail($reservationId);
    $newStatus = $request->input('status');

    $statusOptions = Reservation::getStatusOptions();

    if (array_key_exists($newStatus, $statusOptions)) {
        $reservation->status = $newStatus;
        $reservation->save();

        if ($reservation->status === 'confirmed') {
            // Create a new transaction record and associate it with the reservation
            $transaction = new Transaction();
            $transaction->inn_id = $reservation->inn_id;
            $transaction->room_id = $reservation->room_id;
            $transaction->room_rate_id = $reservation->room_rate_id;
            $transaction->user_id = $reservation->user_id;

            // Associate the transaction with the reservation
            $reservation->transaction()->save($transaction);
        }

        return redirect()->back()->with('success', 'Status updated successfully!');
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
            'room_rate_id' => $request->roomRateId,
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
