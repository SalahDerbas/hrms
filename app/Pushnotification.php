<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pushnotification extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
