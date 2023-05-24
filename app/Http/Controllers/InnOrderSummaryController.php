<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inn;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Freebie;
use App\Models\InventoryManagement;
use App\Models\OrderDetail;
use App\Models\OrderSummary;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Reservation;
use App\Models\Category;
use App\Models\POS_Transaction;
use Illuminate\Support\Facades\Auth;

class InnOrderSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $rooms = Room::select('*')->where('inn_id', $inn[0]->id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();
        $order_summaries = OrderSummary::where('inn_id', $inn[0]->id)->get();

        return view('user.order_summary.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('reservations', $reservations)
        ->with('order_summaries', $order_summaries)
        ->with('id', $inn[0]->id)
        ->with('rooms', $rooms);
        
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

        OrderSummary::create([
            'total_amount' => $request->total,
            'payment' => $request->payment, 
            'change' => $request->change,
            'order_number' => $request->order_number,
            'room_id' => $request->room_id,
            'inn_id' => $request->inn_id,
            'is_deleted' => 0,
        ]);
        
        $selectedTransactionId = $request->selected_transaction_id;
        
        $selectedTransaction = Transaction::find($selectedTransactionId);
        
        if ($selectedTransaction) {
            $selectedRoomId = $selectedTransaction->room_id;
            $selectedRoomFee = $selectedTransaction->room->fee; // Assuming you have a relationship set up between Transaction and Room models
        
            // Now you can update the OrderSummary's total_amount with the selected room fee
            $orderSummary->total_amount += $selectedRoomFee;
            $orderSummary->room_id = $selectedRoomId;
            $orderSummary->save();
        }
        $order_summary = OrderSummary::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $order_number = count($order_summary) > 0 ? 'vcw-' . $request->inn_id . '-ams-' . $order_summary->last()->id + 1 : 'vcw-'.$request->inn_id.'-ams-1';
        
        $products = Product::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $order_details = OrderDetail::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $total = 0;
        foreach($order_details as $order_detail) {
            $total += $order_detail->subtotal;
        }
        $rooms = Room::where('inn_id', $request->inn_id)->get();
        $transactions = Transaction::where('inn_id', $request->inn_id)->where('pos_transaction_number', $order_number)->get();
        POS_Transaction::create([
            'order_number' => $request->order_number,
            'transaction_id'=>$request->transaction_id, 
            'total_amount'=>$request->total,
            'inn_id' => $request->inn_id,
        ]);
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $order_summary = OrderSummary::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();

        $order_number = count($order_summary) > 0 ? 'vcw-' . $inn[0]->id . '-ams-' . $order_summary->last()->id + 1 : 'vcw-'.$inn[0]->id.'-ams-1';

        $order_details = OrderDetail::where('inn_id', $inn[0]->id)->where('order_number', $order_number)->where('is_deleted', 0)->get();
        $rooms = Room::where('inn_id', $inn[0]->id)->get();
        $room_rates = RoomRate::all();
        $transactions = Transaction::where('inn_id', $inn[0]->id)->where('pos_transaction_number', $order_number)->get();
        return view('user.dashboard')
            ->with('products', $products)
            ->with('rooms', $rooms)
            ->with('room_rates', $room_rates)
            ->with('transactions', $transactions)
            ->with('order_details', $order_details)
            ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id + 1 : 1)
            ->with('id', $inn[0]->id);
    
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

    public function pay_order_summary(string $id) {
        // $order_summary = OrderSummary::where('inn_id', $id)->where('is_deleted', 0)->get();
        // $products = Product::where('inn_id', $id)->where('is_deleted', 0)->get();
        // $order_number = count($order_summary) > 0 ? 'vcw-'.$id.'-ams-'.$order_summary->last()->id+1 : 'vcw-'.$id.'-ams-1';
        // $order_details = OrderDetail::where('inn_id', $id)->where('order_number', $order_number)->where('is_deleted', 0)->get();
        // $total = 0;
        // foreach($order_details as $order_detail)
        //     $total = $total + $order_detail->subtotal;
        // $rooms = Room::where('inn_id', $id)->get();
        // return view('user.order_summary.pay')
        // ->with('products', $products)
        // ->with('rooms', $rooms)
        // ->with('total', $total)
        // ->with('order_details', $order_details)
        // ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id : 1)
        // ->with('id', $id);

        if (Auth::user()->status == 0) {
            return view('user.preventEnter');
        } elseif (Auth::user()->status == 1) {
            $inn = Inn::where('user_id', Auth::user()->id)->get();
            $order_summary = OrderSummary::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
            $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();

            $order_number = count($order_summary) > 0 ? 'vcw-' . $inn[0]->id . '-ams-' . $order_summary->last()->id + 1 : 'vcw-'.$inn[0]->id.'-ams-1';
            $transactions = Transaction::where('inn_id', $inn[0]->id)->where('pos_transaction_number', $order_number)->get();

            $order_details = OrderDetail::where('inn_id', $inn[0]->id)->where('order_number', $order_number)->where('is_deleted', 0)->get();
             
            $total = 0;
            if(count($transactions) > 0)
             $total += $transactions[0]->room_rate->rate;
            
        foreach($order_details as $order_detail)
            $total = $total + $order_detail->subtotal;
            $rooms = Room::where('inn_id', $inn[0]->id)->get();
            $room_rates = RoomRate::all();
            return view('user.order_summary.pay')
                ->with('products', $products)
                ->with('rooms', $rooms)
                ->with('total', $total)
                ->with('room_rates', $room_rates)
                ->with('transactions', $transactions)
                ->with('order_details', $order_details)
                ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id + 1 : 1)
                ->with('id', $inn[0]->id);
        }
    }
}


