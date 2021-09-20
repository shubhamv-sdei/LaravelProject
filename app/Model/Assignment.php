<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    function getTrial(){
    	return $this->hasOne('App\Model\SavedTrials', 'id', 'trial_id');
    }

    function getInv(){
    	return $this->hasOne('App\User', 'id', 'investigator_id');
    }
}
