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

class InnInventoryManagementController extends Controller
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
        $inventories = InventoryManagement::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();

         return view('user.inventory_management.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('inventories', $inventories)
        ->with('products', $products)
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
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
            'inn_id' => 'required',
        ]);

        $product = Product::find($request->product_id);

        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image');
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/inns/products', $filenameToStore);
            $product->image = $filenameToStore;
        }
        else {
            $filenameToStore = 'noimage.jpg';
        }
        $product->quantity = $request->quantity + $product->quantity;
        $product->save();
        InventoryManagement::create([
            'name' => $product->name,
            'image' => $filenameToStore,
            'quantity' => $request->quantity,
            'inn_id' => $inn[0]->id,
            'is_deleted' => 0,
        ]);
        $categories = Category::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        return redirect()->back()
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('products', $products)
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
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $inventory = InventoryManagement::find($id);
        $inventory->is_deleted = 1;
        $inventory->save();
        $rooms = Room::select('*')->where('inn_id', $inn[0]->id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();
        $inventories = InventoryManagement::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        return redirect()->back()
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('inventories', $inventories)
        ->with('products', $products)
        ->with('id', $inn[0]->id)
        ->with('rooms', $rooms);
    }
}
