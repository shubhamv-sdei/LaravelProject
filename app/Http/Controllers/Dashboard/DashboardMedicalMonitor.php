<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Session;
use Helper;
use Auth;
use App\Model\StaffRequest;
use App\Mail\SendStaffInvite;
use Mail;

class DashboardMedicalMonitor extends Controller
{
    public function addMMUser(Request $request){
    	return view('dashboardPages.medicalMonitor.addMM');
    }

    public function getMMList(Request $request){
    	$data['all'] = User::where('associated_with',Helper::getParentId())->where('id','!=',Auth::id())->where('role','4')->get();
    	return view('dashboardPages.medicalMonitor.MMList',$data);
    }

    public function deleteMM($id){
    	StaffRequest::where('staff_id',$id)->delete();
    	User::find($id)->delete();
    	return response('Medical Monitor Deleted successfully', 200)
                   ->header('Content-Type', 'text/plain');
    }

    public function inviteMM(Request $request){
    	$validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $userObj['firstname'] = $request->firstname;
        $userObj['lastname'] = $request->lastname;
        $userObj['email'] = $request->email;
        $userObj['password'] = Hash::make('TEST12345');
        $userObj['role'] = '4';
        $userObj['associated_with'] = Helper::getParentId();
        $userId = User::insertGetId($userObj);

        $token = time().rand();
        $staffRequest = ['created_by'=>Helper::getParentId(),'staff_id'=>$userId,'token'=>$token];
        StaffRequest::insert($staffRequest);

        /*******Send Mail Code*******/
        $mailData = ['name'=> $request->fname.' '.$request->lname,'url'=>url('signupStaff').'/'.$token, 'invite_user'=> User::where('id',Helper::getParentId())->first()->getFullNameAttribute()];
        Mail::to($request->email)->send(new SendStaffInvite($mailData));
        /*******Send Mail Code End******/

    	$msg = "You have successfully sent an account access invitation to this Medical Monitor.";
        Session::flash('msg', $msg); 
        return redirect()->back();
    }
}
