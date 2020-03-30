<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
	//Subscriber Table Fillables
    public $fillable = [
    	'sender', 'receiver'
    ];
}
