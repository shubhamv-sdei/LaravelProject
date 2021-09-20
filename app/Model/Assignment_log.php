<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment_log extends Model
{
    function getUser(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    function getTrial(){
    	return $this->hasOne('App\Model\SavedTrials', 'id', 'trial_id');
    }

    function getTo(){
    	return $this->hasOne('App\User', 'id', 'assigned_to');
    }

    function getFrom(){
    	return $this->hasOne('App\User', 'id', 'assigned_from');
    }
}
