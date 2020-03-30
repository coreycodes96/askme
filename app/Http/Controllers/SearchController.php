<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        //return the search view
    	return view('loggedin.SearchView.search');
    }

    protected function getSearch(Request $data){
        //check if a user exists with the username the user has entered
    	$search = User::where('username', 'LIKE',  '%'.$data['username'].'%')->get();

    	return response()->json($search, 200);
    }
}
