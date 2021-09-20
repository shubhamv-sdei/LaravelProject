<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'faqs';

    function getCreatedBy(){
    	return $this->hasOne('App\User', 'id', 'created_by');
    }

    function getInv(){
    	return $this->hasOne('App\User', 'id', 'inv_id');
    }

    function getTrial(){
        return $this->hasOne('App\Model\SavedTrials', 'id', 'trial_id');
    }

    function getAnswerBy(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
