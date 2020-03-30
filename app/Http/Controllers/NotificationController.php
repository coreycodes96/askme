<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	return view('loggedin.NotificationView.notification');
    }

    public function markAsRead(){
        //mark the loggedin users notifications as read
    	auth()->user()->unreadNotifications->markAsRead();

    	return response()->json('Done', 200);
    }

    protected function deleteNotification($id){
        //delete a users notification
    	DB::table('notifications')->delete($id);
    	return response()->json('Notification deleted', 200);
    }
}
