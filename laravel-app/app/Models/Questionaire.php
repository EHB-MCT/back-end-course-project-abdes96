<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'scoring_mechanism',
        'layout',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
