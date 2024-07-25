<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle_detail extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function userInfo()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }

    public function RandStringInfo()
    {
        return $this->belongsTo(random_string::class,  'rand_word_id', 'id');
    }
}
