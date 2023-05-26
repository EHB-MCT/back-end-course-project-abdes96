<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'score',
        'lists_id',
    ];

    public function list()
    {
        return $this->belongsTo(Lists::class, );

    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
