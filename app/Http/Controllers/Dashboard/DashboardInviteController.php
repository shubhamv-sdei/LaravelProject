<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\UserRequest;
use Illuminate\Support\Facades\Validator;
use Session;
use Mail;
use App\Mail\InviteUsers as Invite;
use Helper;

class DashboardInviteController extends Controller
{
    function index(Request $request){
    	$data['all'] = UserRequest::with('getUser')->where('created_by',Helper::getParentId())->get();
    	//dd($data['all']);
    	return view('dashboardPages.inviteList.inviteList',$data);
    }

    function inviteUser(Request $request){
    	$validator = Validator::make($request->all(), [
            'role' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $userData = ['firstname'=>$request->fname,'lastname'=>$request->lname,'email'=>$request->email,'password'=>rand(),'role'=>$request->role];
        $userId = User::insertGetId($userData);

        $token = time().rand();
        $userRequest = ['created_by'=>Helper::getParentId(),'user_id'=>$userId,'token'=>$token,'nct_id'=>$request->nct_id,'trial_url'=>$request->share_link,'created_at'=>date("Y-m-d h:m:s"),'updated_at'=>date("Y-m-d h:m:s")];
        UserRequest::insert($userRequest);

        /*******Send Mail Code*******/
        $mailData = ['name'=> $request->fname.' '.$request->lname,'url'=>url('signupInviteUsers').'/'.$token,'role'=>$request->role,'nct_id'=>$request->nct_id,'trial_url'=>$request->share_link,'share'=>'','type'=>'MMInvite'];
        Mail::to($request->email)->send(new Invite($mailData));
        /*******Send Mail Code End******/

        $msg = "You have successfully sent invitation to User.";
        Session::flash('msg', $msg); 
        return redirect(route('Dashboard.InviteList'));
    }
}
