<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class QuestionsAnswers extends Model
{
    protected $table = "questions_answers";
    public function  question()
    {
      return $this->belongsTo("App\Questions", 'question_id');
    }
}
