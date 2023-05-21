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

class InnProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $inn =  $inn = Inn::where('user_id', Auth::user()->id)->get();
        $categories = Category::where('inn_id',$inn[0]->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id',$inn[0]->id)->where('is_deleted', 0)->get();
        return view('user.products.index')
        ->with('inn', $inn)
        ->with('products', $products)
        ->with('categories', $categories)
        ->with('id',$inn[0]->id);

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
        $inn =  $inn = Inn::where('user_id', Auth::user()->id)->get();
        $this->validate($request, [
            'product_name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'inn_id' => 'required',
        ]);

        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image');
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/inns/products', $filenameToStore);
        }
        else {
            $filenameToStore = 'noimage.jpg';
        }

        Product::create([
            'name' => $request->product_name,
            'image' => $filenameToStore,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'inn_id' => $inn[0]->id,
            'is_deleted' => 0,
        ]);

        $categories = Category::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        return redirect('/user/products/')
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
        $inn = Inn::where('user_id', Auth::user()->id)->get();

        $categories = Category::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
       
        $product = Product::find($id);
        return view('user.products.edit')
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('product', $product)
        ->with('id', $inn[0]->id);
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'inn_id' => 'required',
        ]);

        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $categories = Category::where('inn_id', $inn[0]->id)->get();

        return redirect('/user/products/')
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $inn[0]->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->is_deleted = 1;
        $product->save();
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $products = Product::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();

        return redirect()->back()
        ->with('inn', $inn)
        ->with('products', $products)
        ->with('id', $inn[0]->id);
    }
}
