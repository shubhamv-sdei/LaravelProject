<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DashboardPhysicanController extends Controller
{
    public function index(){
    	$physican = User::where('role','1')->get();
    	return view('dashboardPages.physican.index',['physican'=>$physican]);
    }
}
