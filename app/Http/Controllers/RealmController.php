<?php

namespace App\Http\Controllers;

use App\Realm;

class RealmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id) {
        $realm = Realm::find($id);
        return view('realm', ['realm' => $realm]);
    }
}
