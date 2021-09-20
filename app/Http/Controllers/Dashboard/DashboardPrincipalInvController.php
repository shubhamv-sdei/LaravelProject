<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Assignment_log;
use Auth;

class DashboardPrincipalInvController extends Controller
{
    public function index(){
    	$principalInv = User::where('role','5')->get();
    	return view('dashboardPages.principalInv.index',['principalInv'=>$principalInv]);
    }

    public function trialAssignmentLog(Request $request){
    	$log = Assignment_log::with('getUser','getTrial','getTo','getFrom')->where('trial_id',$request->trial_id)->get();
    	$data = [];
    	$html = '';
    	foreach($log as $key=>$value){
    		$data[$key]['trial_id'] = $value->id;
    		$data[$key]['trial_name'] = $value['getTrial']['BriefTitle'];
    		$data[$key]['user_name'] = $value['getUser']->getFullNameAttribute();
    		$data[$key]['to'] = $value['getTo']->getFullNameAttribute();
    		$data[$key]['from'] = $value['getFrom']->getFullNameAttribute();
    		$data[$key]['type'] = $value->type;
    		$data[$key]['remark'] = $value->remark;
    		$data[$key]['created_at'] = $value->created_at;
    		

            if(Auth::user()->role == '6'){
                $html = $html . '<tr>';
                $html = $html . '<td>'.$value['getTrial']['BriefTitle'].'</td>';

                $url = url('/superadmin/professionalInfo').'/'.$value['getUser']->id;
                $html = $html . '<td><a href="'.$url.'" target="__blank">'.$value['getUser']->getFullNameAttribute().'</a></td>';

                $url = url('/superadmin/professionalInfo').'/'.$value['getTo']->id;
                $html = $html . '<td><a href="'.$url.'" target="__blank">'.$value['getTo']->getFullNameAttribute().'</a></td>';

                $url = url('/superadmin/professionalInfo').'/'.$value['getFrom']->id;
                $html = $html . '<td><a href="'.$url.'" target="__blank">'.$value['getFrom']->getFullNameAttribute().'</a></td>';
                $html = $html . '<td>'.$value->remark.'</td>';
                $html = $html . '<td>'.($value->type == 1 ? 'Assigned' : 'UnAssigned').'</td>';
                $html = $html . '<td>'.date_format(date_create($value->created_at),"d M, Y").'</td>';
                $html = $html . '</tr>';
            }else{
                $html = $html . '<tr>';
                $html = $html . '<td>'.$value['getTrial']['BriefTitle'].'</td>';
                $html = $html . '<td>'.$value['getUser']->getFullNameAttribute().'</td>';
                $html = $html . '<td>'.$value['getTo']->getFullNameAttribute().'</td>';
                $html = $html . '<td>'.$value['getFrom']->getFullNameAttribute().'</td>';
                $html = $html . '<td>'.$value->remark.'</td>';
                $html = $html . '<td>'.($value->type == 1 ? 'Assigned' : 'UnAssigned').'</td>';
                $html = $html . '<td>'.date_format(date_create($value->created_at),"d M, Y").'</td>';
                $html = $html . '</tr>';
            }
    	}
    	return response()->json(['data'=>$data, 'html'=>$html]);
    }
}
