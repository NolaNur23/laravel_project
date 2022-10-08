<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller

{
    public function login(Request $request)
    {
        $user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($user) {
            return redirect()->to('/dashboard');
        } else {
            session()->flash('message', 'user not found');
            return Redirect::back();
        }
    }


    public function index(){
        if( Auth::user()){
            return redirect('/dashboard');
        }
        return view('login');
    }
}
