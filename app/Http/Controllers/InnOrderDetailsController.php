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

class InnOrderDetailsController extends Controller
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
        $reservations = Reservation::all();
        $order_details = OrderDetail::where('inn_id', $inn[0]->id)->get();
        $transactions = Transaction::where('inn_id', $inn[0]->id)->get();
    
        return view('admin.inns.show.order_details.index')
            ->with('inn', $inn)
            ->with('freebies', $freebies)
            ->with('transactions', $transactions)
            ->with('reservations', $reservations)
            ->with('order_details', $order_details)
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
        $product = Product::find($request->product_id);
        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

OrderDetail::create([
    'order_number' => $request->order_number,
    'quantity' => $request->quantity,
    'price' => $product->price,
    'subtotal' => $request->quantity * $product->price,
    'product_id' => $request->product_id, 
    'inn_id' => $request->id,
    'is_deleted' => 0
]);

    $order_summary = OrderSummary::where('inn_id', $request->id)->where('is_deleted', 0)->get();
    $products = Product::where('inn_id', $request->id)->where('is_deleted', 0)->get();
    $order_details = OrderDetail::where('inn_id', $request->id)->where('is_deleted', 0)->get();
    $rooms = Room::where('inn_id', $request->id)->get();
    $transactions = Transaction::where('inn_id', $request->inn_id)->get();

    return redirect()->back()
        ->with('products', $products)
        ->with('rooms', $rooms)
        ->with('order_details', $order_details)
        ->with('transactions', $transactions) // Pass the $transactions variable to the view
        ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id : 1)
        ->with('id', $request->id);

        
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
}
