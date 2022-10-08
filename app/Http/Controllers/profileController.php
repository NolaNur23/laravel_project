<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
// use Auth;

class profileController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function getProfile()
    {
        $auth = Auth::User();
        return response()->json($auth);
    }
    //
}
