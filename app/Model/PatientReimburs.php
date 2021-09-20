<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PatientReimburs extends Model{

    public function getPatientDetails(){
        return $this->hasOne('\App\User','id','patient_id');
    }

    public function getTrialDetails(){
        return $this->hasOne('\App\Model\SavedTrials','id','trial_id');
    }

    public function getCreatedBy(){
        return $this->hasOne('\App\User','id','created_by');
    }

    public function getStatusFromScreenVisit()
    {
        return $this->hasMany('\App\Model\ScreenVisit','patient_id','patient_id')->where('screen_visit_complete','1');
    }

}
