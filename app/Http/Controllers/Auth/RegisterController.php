<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        //validate the data
        return Validator::make($data, [
            'firstname' => ['required', 'max:20', 'string', 'regex:/^[a-zA-Z]+$/u'],
            'surname' => ['required', 'max:25', 'string', 'regex:/^[a-zA-Z]+$/u'],
            'username' => ['required', 'max:15', 'string', 'regex:/^[a-zA-Z]+$/u', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'string', 'unique:users'],
            'gender' => ['required'],
            'year' => ['required', 'digits:4', 'between:1900,2005' ,'numeric'],
            'month' => ['required', 'digits:2', 'between:01, 12' ,'numeric'],
            'day' => ['required', 'digits:2' , 'between:01, 31' ,'numeric'],
            'password' => ['required', 'min:8', 'max:255', 'string', 'regex:/^[a-zA-Z0-9]+$/i' ,'confirmed'],
        ]);
    }

    protected function create(array $data)
    {

        //creating an account for the user
        return User::create([
            'firstname' => $data['firstname'],
            'surname' => $data['surname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'dob' => $data['year'].'-'.$data['month'].'-'.$data['day'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
