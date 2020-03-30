<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('username');
            $table->text('question');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
