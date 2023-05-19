<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inn;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Freebie; 
use App\Models\Transaction; 
use App\Models\Reservation; 

class ReservationManagerController extends Controller
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
        $transactions = Transaction::latest()->get();
        $reservations = Reservation::where('inn_id', $inns[0]->id)->get();
        $inn = Inn::where('user_id', Auth::user()->id)->get();

        return view('user.reservations.index')
        ->with('inns', $inns)
        ->with('rooms', $rooms)
        ->with('inn', $inn)
        ->with('transactions', $transactions)
        ->with('freebies', $freebies)
        ->with('user_id', $id)
        ->with('reservations', $reservations);
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
    public function updateStatus(Request $request, $id)
        {
            $reservation = Reservation::findOrFail($id);
            $reservation->status = $request->status;
            $reservation->save();
            if ($reservation->status === 'confirmed') {
                // Create a new transaction record and associate it with the reservation
                $transaction = new Transaction();
                $transaction->inn_id = $reservation->inn_id;
                $transaction->room_id = $reservation->room_id;
                $transaction->room_rate_id = $reservation->room_rate_id;
                $transaction->user_id = Auth::user()->id;
                $transaction->customer_name = $reservation->name; 
    
                // Associate the transaction with the reservation
                $reservation->transaction()->save($transaction);
            }

            return redirect()->back()->with('status', 'Reservation status updated successfully.');
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
            'room_rate_id' => $request->room_rate_id,
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
        $user_id = Auth::user()->id;
        $inns = Inn::select('*')->where('user_id', $user_id)->get();
        $rooms = Room::select('*')->where('inn_id', $inns[0]->id)->get();
        $reservation = Reservation::find($id);
        return view('user.reservations.edit', [
            'reservation' => $reservation,
            'rooms' => $rooms,
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
            'room_rate_id' => $request->room_rate_id,
        ]);
        return redirect('/user/reservations-manager')->with('success', 'Added Successfully!');
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
