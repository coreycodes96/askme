<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $data){
        //attempting to log the user in
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            return response()->json('Okay', 200); //if the data matches
        }else{
            return response()->json('Not Okay', 200); //if the data does not match
        }
    }
}