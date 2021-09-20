<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubmitClinicalTrials extends Model
{
    function getTrial(){
    	return $this->hasOne('App\Model\SavedTrials', 'id', 'trial');
    }

    function getUser(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
