<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;
    protected $table = 'lists';
    protected $fillable = [
        'title', 'description', 'scoring', 'layout', 'questions'
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

}
