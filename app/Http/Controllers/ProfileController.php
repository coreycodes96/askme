<?php

namespace App\Http\Controllers;

use App\User;
use App\Question;
use App\Answer;
use App\Favourite;
use App\Subscribers;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function index($username){
    	$user = User::where('username', '=', $username)->first();

    	if($user){
            //get questions
    		$questions = Question::where('username', '=', $username)->orderBy('id', 'DESC')->with('favourite')->with('answer')->orderBy('id', 'DESC')->get();

            //get subscribers
            $subscribers = Subscribers::where('receiver', '=', $username)->get();

            //get subscriptions
            $subscriptions = Subscribers::where('sender', '=', $username)->get();

            //return a view with the variables
    		return view('loggedin.ProfileView.profile', compact('user', 'questions', 'subscribers', 'subscriptions'));
    	}else{
    		//redirect user if the username doesn't exist
    		return redirect('profile/'.auth()->user()->username);
    	}
    }
}
