<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inn;
use App\Models\Room;
use App\Models\Freebie;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;


class InnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $inns = Inn::latest()->get();
    $freebies = Freebie::all();
    return view('admin.inns.index')
    ->with('inns', $inns)
    ->with('freebies', $freebies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $freebies = Freebie::all();
        return view('admin.inns.create')->with('freebies', $freebies);
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
            'inn_name' => 'required',
            'number_of_rooms' => 'required',
            "lat" => 'required',
            "long" => 'required',
            "freebies" => 'required',
            'inn_image' => 'image|nullable|max:1999'
        ]);
 
        
        if($request->hasFile('inn_image')) {
            $filenameWithExt = $request->file('inn_image');
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('inn_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('inn_image')->storeAs('public/inns/inns_images', $filenameToStore);
        }
        else {
            $filenameToStore = 'noimage.jpg';
        }

        $inn = new Inn;
        $inn->inn_name = $request->inn_name;
        $inn->number_of_rooms = $request->number_of_rooms;
        $inn->lat = $request->lat;
        $inn->long = $request->long;

        $input = $request->all();
        $freebies = $input['freebies'];
        $input['freebies'] = implode(',', $freebies);

        $inn->freebies = $input['freebies'];
        $inn->user_id = Auth::user()->id;
        $inn->inn_image =  $filenameToStore;
        $inn->save();

        return redirect('/admin/inns-admin')->with('success', 'Inn Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inn = Inn::find($id);
        $rooms = Room::select('*')->where('inn_id', $id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();

        return view('admin.inns.show')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('rooms', $rooms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inn = Inn::find($id);
        $freebies = Freebie::all();
        $inn_freebies = explode(",",$inn->freebies);

        return view('admin.inns.edit')
        ->with('freebies', $freebies)
        ->with('inn_freebies', $inn_freebies)
        ->with('inn', $inn);
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
            'inn_name' => 'required',
            'number_of_rooms' => 'required',
            "lat" => 'required',
            "long" => 'required',
            "freebies" => 'required',
            'inn_image' => 'image|nullable|max:1999'
        ]);
 
        
        if($request->hasFile('inn_image')) {
            $filenameWithExt = $request->file('inn_image');
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('inn_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('inn_image')->storeAs('public/inns/inns_images', $filenameToStore);
        }
        else {
            $filenameToStore = 'noimage.jpg';
        }

        $inn = Inn::find($id);
        $inn->inn_name = $request->inn_name;
        $inn->number_of_rooms = $request->number_of_rooms;
        $inn->lat = $request->lat;
        $inn->long = $request->long;

        $input = $request->all();
        $freebies = $input['freebies'];
        $input['freebies'] = implode(',', $freebies);

        $inn->freebies = $input['freebies'];
        $inn->user_id = Auth::user()->id;
        $inn->inn_image =  $filenameToStore;
        $inn->save();

        return redirect('/admin/inns-admin')->with('success', 'Inn Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inn = Inn::find($id);
        $inn->delete();

        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
