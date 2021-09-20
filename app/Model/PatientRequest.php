<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PatientRequest extends Model
{
    function getUsers(){
    	return $this->hasOne('\App\User', 'id', 'patient_id');
    }

    function getStatusFromScreenVisit()
    {
        return $this->hasMany('\App\Model\ScreenVisit','patient_id','patient_id')->where('screen_visit_complete','1');
    }
}
