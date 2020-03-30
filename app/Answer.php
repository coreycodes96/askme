<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	//Answer Table Fillables
    public $fillable = [
    	'username', 'answer', 'question_id'
    ];

  	//Question Relationship
    public function question(){
    	return $this->belongsTo(Question::class)->latest();
    }
}
