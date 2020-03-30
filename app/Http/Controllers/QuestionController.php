<?php

namespace App\Http\Controllers;

use App\Question;
use App\Answer;
use App\Favourite;
use App\Subscribers;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	return view('loggedin.QuestionView.createadebate');
    }

    public function getQuestions(){
        //get the logged in user
        $loggedinUser = auth()->user()->username;

        //get the users the loggedin user is subscribed to
        $subscriptions = Subscribers::where('sender', '=', $loggedinUser)->get()->pluck('receiver');

        //get the loggedin users questions and the users the loggedin user is subscribed to
        $questions = Question::where('username', '=', $loggedinUser)
        ->orderBy('id', 'DESC')
        ->OrwhereIn('username', $subscriptions)
        ->orderBy('id', 'DESC')
        ->with('favourite')
        ->orderBy('id', 'DESC')
        ->with('answer')
        ->orderBy('id', 'DESC')
        ->get();

    	return response()->json($questions, 200);
    }

    protected function store(Request $data){
    	//validation
    	$data = request()->validate([
            'username' => ['required'],
    		'question' => ['required', 'max:200']
    	]);

    	//store the question in the database
    	Question::create([
            'username' => $data['username'],
    		'question' => $data['question']
    	]);

    	return response()->json($data, 200);
    }

    protected function destroy($id){
        //delete the question based on the id
        Question::find($id)->delete();

        //delete the answer based on the id
        Answer::where('question_id', '=', $id)->delete();

        //delete the favourite based on the id
        Favourite::where('question_id', '=', $id)->delete();
    }
}
