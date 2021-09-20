<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CcpaDoNotSell extends Model
{
    function getUsers(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
