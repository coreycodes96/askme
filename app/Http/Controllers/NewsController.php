<?php

namespace App\Http\Controllers;

class NewsController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){
    	//return news View
    	return view('loggedin.news');
    }
}