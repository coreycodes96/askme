<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
	//Favourite Table Fillables
    public $fillable = [
    	'sender', 'receiver', 'question_id'
    ];

    //Question Relationship
    public function question(){
    	return $this->hasMany(Question::class);
    }
}
