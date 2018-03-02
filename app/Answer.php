<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table='question_answers';

    protected $guarded = ['id'];

    public function question(){
        return $this->belongsTo('App\Question', 'question_id');
    }
}
