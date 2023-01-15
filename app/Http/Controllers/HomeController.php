<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freebie;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $freebies = Freebie::all();
        return view('home')
        ->with('freebies', $freebies);
    }
}
