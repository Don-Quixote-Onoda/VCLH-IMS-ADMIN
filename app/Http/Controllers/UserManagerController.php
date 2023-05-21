<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status == 0) {
            return view('user.preventEnter');
        } elseif (Auth::user()->status == 1) {
            $inn = Inn::where('user_id', Auth::user()->id)->get();
            $order_summary = OrderSummary::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
            $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();

            $order_number = count($order_summary) > 0 ? 'vcw-' . $inn[0]->id . '-ams-' . $order_summary->last()->id + 1 : 'vcw-'.$inn[0]->id.'-ams-1';

            $order_details = OrderDetail::where('inn_id', $inn[0]->id)->where('order_number', $order_number)->where('is_deleted', 0)->get();
            $rooms = Room::where('inn_id', $inn[0]->id)->get();
            return view('user.dashboard')
                ->with('products', $products)
                ->with('rooms', $rooms)
                ->with('order_details', $order_details)
                ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id + 1 : 1)
                ->with('id', $inn[0]->id);
        }
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
        //
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
