<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inn;
use App\Models\Room;
use App\Models\Freebie;
use App\Models\InventoryManagement;
use App\Models\OrderDetail;
use App\Models\OrderSummary;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Reservation;
use App\Models\Category;
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
        $order_summary = OrderSummary::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $order_details = OrderDetail::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $total = 0;
        foreach($order_details as $order_detail)
            $total = $total + $order_detail->subtotal;
        $rooms = Room::where('inn_id', $request->inn_id)->get();
        return redirect('/user/dashboard/')
        ->with('products', $products)
        ->with('rooms', $rooms)
        ->with('total', $total)
        ->with('order_details', $order_details)
        ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id+1 : 1)
        ->with('id', $request->inn_id);
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
        $order_summary = OrderSummary::where('inn_id', $id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $id)->where('is_deleted', 0)->get();
        $order_number = count($order_summary) > 0 ? 'vcw-'.$id.'-ams-'.$order_summary->last()->id+1 : 'vcw-'.$id.'-ams-1';
        $order_details = OrderDetail::where('inn_id', $id)->where('order_number', $order_number)->where('is_deleted', 0)->get();
        $total = 0;
        foreach($order_details as $order_detail)
            $total = $total + $order_detail->subtotal;
        $rooms = Room::where('inn_id', $id)->get();
        return view('user.order_summary.pay')
        ->with('products', $products)
        ->with('rooms', $rooms)
        ->with('total', $total)
        ->with('order_details', $order_details)
        ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id : 1)
        ->with('id', $id);
    }
}