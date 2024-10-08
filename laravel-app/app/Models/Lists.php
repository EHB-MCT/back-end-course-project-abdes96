<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'client',
        'list_type',
        'completed',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }


}
