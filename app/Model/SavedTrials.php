<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SavedTrials extends Model
{
    protected $table = "saved_trials";

    function getAssignment(){
    	return $this->hasOne('App\Model\Assignment', 'trial_id', 'id');
    }
}
