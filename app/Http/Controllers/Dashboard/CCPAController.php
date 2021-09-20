<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CcpaDoNotSell;
use Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Helper;

class CCPAController extends Controller
{
    public function SubmitCCPA(Request $request){

    	$recaptcha = $_POST['g-recaptcha-response'];
        $res = Helper::reCaptcha($recaptcha);
        if(!$res['success']){
          return redirect()->back();
        }

    	$validator = Validator::make($request->all(), [
            'role' => 'required',
            'req_type' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:ccpa_do_not_sells',
            'telephone' => 'required',
            //'companyname' => 'required',
            'address1' => 'required',
           // 'address2' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zip' => 'required',
            'california' => 'required',
            'reqDetails' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = [
        			// 'user_id'=>Auth::id(),
        			'user_role'=>$request->role,
        			'req_type'=>$request->req_type,
        			'first_name'=>$request->fname,
        			'last_name'=>$request->lname,
        			'email'=>$request->email,
        			'phone_no'=>$request->telephone,
        			'company_name'=>$request->companyname,
        			'address_1'=>$request->address1,
        			'address_2'=>$request->address2,
        			'city'=>$request->city,
        			'country'=>$request->country,
        			'state'=>'',
        			'zip'=>$request->zip,
        			'i_am_cz_cali'=>$request->california,
        			'request_details'=>$request->reqDetails,
        			'created_at'=>date("Y-m-d h:m:s"),
        			'updated_at'=>date("Y-m-d h:m:s")
        		];
        $res = CcpaDoNotSell::insert($data);
        $msg = "CCPA Do Not Sell Policy has been updated successfully.";
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function SubmitCCPAList(Request $request){
    	$data['data']=CcpaDoNotSell::with(['getUsers'])->get();
    	return view('dashboardPages.CCPA.index',$data);
    }
}
