<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Question;

class Response extends Model
{
    protected $table='user_responses';

    protected $guarded = ['id'];

    public static function boot(){

        parent::boot();

        static::creating(function($model){

            if($model::whereSession(session()->getId())->count() >= Question::count()) session()->regenerate();

            $model->session = session()->getId();
        });
    }

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function answer(){
        return $this->belongsTo('App\Answer', 'answer_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
