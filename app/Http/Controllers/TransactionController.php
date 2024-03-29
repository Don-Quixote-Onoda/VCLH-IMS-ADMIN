<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
            'inn_id' => 'required',
            'room_id' => 'required',
            'room_rate_id' => 'required',
        ]);

        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->inn_id = $request->inn_id;
        $transaction->room_id = $request->room_id;
        $transaction->status = 1;
        $transaction->room_rate_id = $request->room_rate_id;
        $transaction->save();

        $room = Room::find($request->room_id);
        $room->status = 1;
        $room->save();

        return redirect()->back()->with('success', 'Added Successfully!');

    }

    public function printInvoice($id)
        {
            $transaction = Transaction::findOrFail($id);
            // Fetch other necessary data for the invoice

            return view('transactions.print', compact('transaction'));
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $transaction = Transaction::find($id);

         return view('user.dashboard', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
