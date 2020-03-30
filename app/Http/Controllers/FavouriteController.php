<?php

namespace App\Http\Controllers;

use App\Notifications\FavouriteNotification;
use App\User;
use App\Question;
use App\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    protected function store(Request $data){
    	//check if the user has already liked the post
    	$likeCheck = Favourite::where([
    		['sender', '=', $data['sender']],
    		['question_id', '=', $data['question_id']]
    	])->first();

    	if($likeCheck){
            //delete the favourite
    		Favourite::where([
    			['sender', '=', $data['sender']],
    			['question_id', '=', $data['question_id']]
    		])->delete();
    		return response()->json('unfavourite', 200);
    	}else{
            //validation
	    	$data = request()->validate([
	    		'sender' => ['required'],
	    		'receiver' => ['required'],
	    		'question_id' => ['required']
	    	]);
	    	
            //favourite the question
    		Favourite::create($data, [
    			'sender' => $data['sender'],
    			'receiver' => $data['receiver'],
    			'question_id' => $data['question_id']
    		]);

            //get the username of the user the loggedin user is favouriting
            $get_user = User::where('username', '=', $data['receiver'])->get();

            //get the question of the user the loggedin user is favouriting
            $get_question = Question::where('id', '=', $data['question_id'])->get('question');

            //store the results in an array
            $info = [
                'question' => $get_question[0],
                'username' => $data['sender']
            ];

            //notify that user
            $get_user[0]->notify(new FavouriteNotification($info));

    		return response()->json('favourite', 200);
    	}
    }
}
