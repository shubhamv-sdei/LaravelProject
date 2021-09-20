<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\UserMeta;
use App\Model\PatientRequest;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
use App\Model\Allergies;
use App\Model\Labs;
use App\Model\Medications;
use App\Model\Notes;
use App\Model\Problems;
use App\Model\Vitals;
use App\Model\PatientFileUpload;
use App\Mail\SendPatientInvite;
use App\Mail\SendStaffInvite;
use App\Model\CCDAImport;
use Mail;
use Helper;

class DashboardPatientController extends Controller
{
    public function savedPatient(Request $request){

    	$validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
         // 'patient_id' => 'required',
            'email' => 'required|email|unique:users',
         // 'phone' => 'required',
         // 'sex' => 'required',
         // 'dob' => 'required',
         // 'address' => 'required'
         // 'message' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Save under User Table
        // $userData = ['firstname'=>$request->fname,'lastname'=>$request->lname,'email'=>$request->email,'contact'=>$request->phone,'address'=>$request->address,'password'=>rand(),'dob'=>$request->dob,'sex'=>'1'];
        $userData = ['firstname'=>$request->fname,'lastname'=>$request->lname,'email'=>$request->email,'password'=>rand()];
        $userId = User::insertGetId($userData);

        if($request->patient_id){
            $userMeta = ['user_id'=>$userId,'meta_name'=>'patient_id','meta_value'=>$request->patient_id];
            UserMeta::insert($userMeta);
        }
        $token = time().rand();
        $patientRequest = ['created_by'=>Helper::getParentId(),'patient_id'=>$userId,'token'=>$token];
        PatientRequest::insert($patientRequest);

        /*******Send Mail Code*******/
        $mailData = ['name'=> $request->fname.' '.$request->lname,'url'=>url('signupPatient').'/'.$token];
        Mail::to($request->email)->send(new SendPatientInvite($mailData));
        /*******Send Mail Code End******/

    	$msg = "You have successfully sent invitation to patient.";
        Session::flash('msg', $msg); 
        if($request->redirect){
            return redirect(route($request->redirect));
        }else{
            return redirect(route('Dashboard.getSavedTrial'));
        }
    }

    public function patientList(Request $request){
    	$data = PatientRequest::with(['getStatusFromScreenVisit','getUsers'])->where('created_by', Helper::getParentId())->get();
        $data2 = User::with(['getStatusFromScreenVisit'])->where('role','2')->get();
    	return view('dashboardPages.patient.index',['data'=>$data,'data2'=>$data2]);
    }

    public function patientAdd(Request $request){
        return view('dashboardPages.patient.addPatient');
    }

    public function patientView(Request $request,$id){
        $data['patient'] = User::where('id',$id)->first();
        $patient_id = $data['patient']->id;
        $data['allergies'] = Allergies::where('user_id',$patient_id)->get();
        $data['labs'] = Labs::where('user_id',$patient_id)->get();
        $data['medications'] = Medications::where('user_id',$patient_id)->get();
        $data['notes'] = Notes::where('user_id',$patient_id)->get();
        $data['problems'] = Problems::where('user_id',$patient_id)->get();
        $data['vitals'] = Vitals::where('user_id',$patient_id)->get();
        $data['patientfileupload'] = PatientFileUpload::where('user_id',$patient_id)->get();
        $data['ccdafileimport'] = CCDAImport::where('patient_id',$patient_id)->get();
        $data['is_add'] = true;
        return view('dashboardPages.patient.viewPatient',$data);
    }

    public function savedNewPatient(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'dob'   => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'sex' => 'required',
            'dob' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Save under User Table
        $userData = ['firstname'=>$request->fname,'lastname'=>$request->lname,'email'=>$request->email,'contact'=>$request->phone,'address'=>$request->address1.' '.$request->address2.' '.$request->city.' '.$request->zip,'password'=>rand(),'dob'=>$request->dob,'sex'=>$request->sex];
        $userId = User::insertGetId($userData);
        /*******Send Mail Code**********/
-

        /*******Send Mail Code End******/
        $msg = "You have successfully created a patient.";
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function patientDashboard(){
        $id = Auth::id();
        $data['patient'] = User::where('id',$id)->first();
        $patient_id = $data['patient']->id;
        $data['allergies'] = Allergies::where('user_id',$patient_id)->get();
        $data['labs'] = Labs::where('user_id',$patient_id)->get();
        $data['medications'] = Medications::where('user_id',$patient_id)->get();
        $data['notes'] = Notes::where('user_id',$patient_id)->get();
        $data['problems'] = Problems::where('user_id',$patient_id)->get();
        $data['vitals'] = Vitals::where('user_id',$patient_id)->get();
        $data['patientfileupload'] = PatientFileUpload::where('user_id',$patient_id)->get();
        $data['ccdafileimport'] = CCDAImport::where('patient_id',$patient_id)->get();
        $data['is_add'] = false;
        return view('dashboardPages.patient.viewPatient',$data);
    }
}
