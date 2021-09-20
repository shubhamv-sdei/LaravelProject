<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ScreenVisit extends Model
{
    function getPatient(){
    	return $this->hasOne('App\User', 'id', 'patient_id');
    }

    function getTrial(){
    	return $this->hasOne('App\Model\SavedTrials', 'id', 'trial_id');
    }

    function getInvistigator(){
    	return $this->hasOne('App\User', 'id', 'invistigator_id');
    }
}
