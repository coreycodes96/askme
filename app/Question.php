<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	//Question Table Fillables
    public $fillable = [
    	'question', 'username'
    ];

    //Answer Relationship
    public function answer(){
    	return $this->hasMany(Answer::class)->latest();
    }

    //Favourite Relationship
    public function favourite(){
    	return $this->hasMany(Favourite::class);
    }
}