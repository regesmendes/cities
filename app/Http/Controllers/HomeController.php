<?php

namespace App\Http\Controllers;

use App\Realm;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $realms = Realm::all();
        return view('home', ['realms' => $realms]);
    }
}
