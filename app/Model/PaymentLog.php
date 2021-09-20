<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    function getUser(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
