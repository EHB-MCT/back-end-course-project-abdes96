<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $fillable = [
        'list_id', 'user_id', 'status', 'completed_at', 'data'
    ];
    public function list()
    {
        return $this->belongsTo(Lists::class);
}

}
