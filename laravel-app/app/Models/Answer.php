<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['list_id', 'question_id', 'answer'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function list()
    {
        return $this->belongsTo(Lists::class);
    }

}
