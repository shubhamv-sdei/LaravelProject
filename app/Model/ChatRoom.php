<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ChatRoom extends Model
{
    protected $table = "chat_rooms";

    function getChatCount(){
    	return $this->hasMany('App\Model\ChatHistory','room_id')->where('user_id','!=', Auth::id())->where('status','1')->count();
    }

}
