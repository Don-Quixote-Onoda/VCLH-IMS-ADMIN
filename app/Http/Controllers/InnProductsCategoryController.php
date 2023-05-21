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

class InnProductsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $categories = Category::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        return view('user.category.index')
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $inn[0]->id);
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
            'name' => 'required',
            'description' => 'required',
        ]);
        $category = Category::create([
            "name" => $request->name,
            "description" => $request->description,
            'inn_id' => $inn[0]->id,
            "is_deleted" => 0
        ]);
        $categories = Category::where('inn_id', $inn[0]->id)->get();

        return redirect()->back()
        ->with('inn', $inn)
        ->with('categories', $categories)
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
        $inn =  $inn = Inn::where('user_id', Auth::user()->id)->get();
        $category = Category::find($id);

        return view('user.category.edit')
        ->with('inn', $inn)
        ->with('category', $category)
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
        ]);
        $category = Category::find($request->id);
        $category->update([
            'name' => $request->name,
            "description" => $request->description,
        ]);
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $categories = Category::where('inn_id', $inn[0]->id)->get();

        return redirect('/user/products-category/')
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
        $category = Category::find($id);
        $category->update([
            "is_deleted" => 1
        ]);
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $categories = Category::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();

        return redirect()->back()
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $inn[0]->id);
    }
}
