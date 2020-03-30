<?php

namespace App\Http\Controllers;

use App\Notifications\SubscribersNotification;
use App\User;
use App\Subscribers;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    protected function subscribeToUser(Request $data){
        //check if user has already subscribed to another user
        $checkSubscribe = Subscribers::where([
            ['sender', '=', $data['sender']],
            ['receiver', '=', $data['receiver']]
        ])->first();

        if($checkSubscribe){
            //delete the subscription
            Subscribers::where([
                ['sender', '=', $data['sender']],
                ['receiver', '=', $data['receiver']]
            ])->delete();
            $res = ['message' => 'Unsubscribed', 'data' => $data];
            return response()->json($res, 200);
        }else{
            //validation
            $data = request()->validate([
             'sender' => ['required'],
             'receiver' => ['required']
            ]);

            //subscribe to the user
            Subscribers::create($data, [
             'sender' => $data["sender"],
             'receiver' => $data["receiver"]
            ]);

            //get the username of the user the logged in user is subscribing to
            $get_user = User::where('username', '=', $data['receiver'])->get();

            //notify that user
            $get_user[0]->notify(new SubscribersNotification($data['sender']));

            $res = ['message' => 'Subscribed', 'data' => $data];
            return response()->json($res, 200);

        }
    }
}
