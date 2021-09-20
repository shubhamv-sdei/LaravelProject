<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    protected $table = "chat_history";

    function getUsers(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
