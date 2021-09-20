<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TrialVisit extends Model
{
    function getPatient(){
    	return $this->hasOne('App\User', 'id', 'patient_id');
    }

    function getTrial(){
    	return $this->hasOne('App\Model\SavedTrials', 'id', 'clinical_id');
    }
}
