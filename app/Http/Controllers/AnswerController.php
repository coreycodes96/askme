<?php

namespace App\Http\Controllers;

use App\User;
use App\Question;
use App\Answer;
use App\Notifications\AnswerNotification;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    protected function store(Request $data){
    	//validation
    	$data = request()->validate([
    		'username' => ['required'],
    		'answer' => ['required', 'max:600'],
    		'question_id' => ['required']
    	]);

    	//store the question in the database
    	Answer::create([
    		'username' => $data['username'],
    		'answer' => $data['answer'],
    		'question_id' => $data['question_id']
    	]);

        //get the question owners username
        $question_username = Question::where('id', '=', $data['question_id'])->get(['username', 'question']);

        //get the question owners user information
        $get_user = User::where('username', '=', $question_username[0]['username'])->get();

        //putting the data into an array
        $info = [
            'answer' => $data['answer'],
            'username' => $data['username'],
            'question' => $question_username[0]['question']
        ];

        if($question_username[0]['username'] != $data['username']){
            // //notifiying the question owner that they have has a answer
            $get_user[0]->notify(new AnswerNotification($info));
        }

        return response()->json($data, 200);
    }

    protected function destroy($id){
        Answer::find($id)->delete();
    }
}