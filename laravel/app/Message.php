<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function board(){
        return $this->belongsTo('App\Board');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
