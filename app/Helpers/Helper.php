<?php

namespace App\Helpers;
use App\User;
use App\Model\UserMeta;
use App\Model\ContentMeta;
use App\Model\Notification;
use App\Model\SavedTrials;
use App\Model\Appointment;
use Illuminate\Support\Facades\Route;
use Auth;
use App\Model\SocialLinks;
use App\Model\PatientRequest;
use App\Model\Assignment;
use App\Model\Assignment_log;
use App\Mail\chatMessageReceive;
use App\Mail\patientApplyToTrialEmail;
use App\Mail\PhysicianReferralPatient;
use App\Mail\patientRecordUpdate;
use Mail;
use App\CCDA\ImportCCDA;
use App\Model\PatientMeta;
use App\Model\Allergies;
use App\Model\Labs;
use App\Model\Medications;
use App\Model\Notes;
use App\Model\Problems;
use App\Model\Vitals;
use App\Model\PatientFileUpload;
use App\Model\CCDAImport;
use App\Traits\Encryptable;
use App\Model\CcpaDoNotSell;
use App\Model\PatientReimburs;
use Stripe;

class Helper
{
    use Encryptable;

    public static function getUserMeta($user_id){
    	$result = UserMeta::where('user_id',$user_id)->get();
    	if($result->count() != 0){
    		foreach($result->toArray() as $key=>$value){
    			$data[$value['meta_name']] = $value['meta_value'];
    		}
    	}else{
    		$data = [];
    	}
    	return $data;
    }

    public static function insertUpdateUserMeta($user_id,$data){
    	foreach($data as $key=>$value){
    		$checkIfAlreadyExist = UserMeta::where('user_id',$user_id)->where('meta_name',$key)->first();
            if($key == "specialty"){
                $value = implode(",",$value);
            }else if($key == "sub_specialty"){
                $value = implode(",",$value);
            }else if($key == "medicalLicense"){
                $value = implode(",",$value);
            }else if($key == "medicalLicenseState"){
                $value = implode(",",$value);
            }
    		if($checkIfAlreadyExist){
    			UserMeta::where('id',$checkIfAlreadyExist->id)->update(['meta_value'=>$value]);
    		}else{
    			UserMeta::insert(['user_id'=>$user_id,'meta_name'=>$key,'meta_value'=>$value]);
    		}
    	}
    	return ['msg'=>'Record Updated Successfully'];
    }

    public static function insertUserMeta($data){
    	UserMeta::insert($data);
    	return ['msg'=>'Record Inserted Successfully'];
    }

    public static function ActiveParent($data){
    	$current_route = Route::currentRouteName();
    	return (in_array($current_route, $data) ? 'open' : '');
    }

    public static function ActiveLink($route){
    	$current_route = Route::currentRouteName();
    	return ($current_route == $route ? 'active' : '');
    }

    public static function placeValueFromArray($data,$key){
    	if(isset($data[$key]) && $data[$key]){
    		return $data[$key];
    	}else{
    		return '';
    	}
    }

    public static function reCaptcha($recaptcha){
      $secret = "6LcYZtUZAAAAAFll5VyUT9c8sct7n-UoLDsAmrJl";
      $ip = $_SERVER['REMOTE_ADDR'];

      $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
      $url = "https://www.google.com/recaptcha/api/siteverify";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
      $data = curl_exec($ch);
      curl_close($ch);

      return json_decode($data, true);
    }

    public static function addNotification($to="",$message="",$redirect="",$type="1",$Mdata=[]){
        // Notification type 
        // 1 = default
        // 2 = trial_assignment
        // 3 = patientapplytrial
        // 4 = physicanrefferal
        // 5 = chat
        $data = ['to'=>$to,'from'=>Auth::id(),'message'=>$message,'created_at'=>date("Y-m-d"),'updated_at'=>date("Y-m-d"),'redirect'=>$redirect,'type'=>$type];
        Notification::insert($data);

        $Mdata['type'] = $type;
        // dd($Mdata);
        //Send Notification Mail
        $mailData = [];
        if($type == '2'){
            // trial_assignment
            $to = User::where('id',$Mdata['to'])->first();
            $from = User::where('id',$Mdata['from'])->first();
            if($to && $from){
                $mailData['to_name'] = $to->getFullNameAttribute();
                $mailData['to_email'] = $to->email;
                $mailData['to_profile'] = (!$to->image ? url('assets/avatar.jpg') : url($to->image));
                $mailData['from_name'] = $from->getFullNameAttribute();
                $mailData['from_email'] = $from->email;
                $mailData['from_profile'] = (!$from->image ? url('assets/avatar.jpg') : url($from->image));
                $mailData['trial_name'] = $Mdata['trial_name'];
                $mailData['trial_url'] = $Mdata['url'];
                $mailData['logo'] = url('assets/images/logo.png');
                if($from->role == '2'){
                    $mailData['profile_url'] = url('/dashboard/patient/view/').'/'.$Mdata['from'];
                }else{
                    $mailData['profile_url'] = $Mdata['url'];
                }
                if($from->role == '1'){
                    Mail::to($to->email)->send(new PhysicianReferralPatient($mailData));
                }else{
                    Mail::to($to->email)->send(new patientApplyToTrialEmail($mailData));
                }
                // Add Assignment Log
                Assignment_log::insert(['trial_id'=>$Mdata['trial_id'],'user_id'=>$Mdata['from'],'assigned_from'=>$Mdata['from'],'assigned_to'=>$Mdata['to'],'remark'=>'','type'=>'1','created_at'=>date("Y-m-d"),'updated_at'=>date("Y-m-d")]);
            }
        }elseif($type == '3'){
            //patientapplytrial
            // trial_assignment
            $to = User::where('id',$Mdata['to'])->first();
            $from = User::where('id',$Mdata['from'])->first();
            if($to && $from){
                $mailData['to_name'] = $to->getFullNameAttribute();
                $mailData['to_email'] = $to->email;
                $mailData['to_profile'] = (!$to->image ? url('assets/avatar.jpg') : url($to->image));
                $mailData['from_name'] = $from->getFullNameAttribute();
                $mailData['from_email'] = $from->email;
                $mailData['from_profile'] = (!$from->image ? url('assets/avatar.jpg') : url($from->image));
                $mailData['trial_name'] = $Mdata['trial_name'];
                $mailData['trial_url'] = $Mdata['url'];
                $mailData['logo'] = url('assets/images/logo.png');
                if($from->role == '2'){
                    $mailData['profile_url'] = url('/dashboard/patient/view/').'/'.$Mdata['from'];
                }else{
                    $mailData['profile_url'] = $Mdata['url'];
                }
                if($from->role == '1'){
                    Mail::to($to->email)->send(new PhysicianReferralPatient($mailData));
                }else{
                    Mail::to($to->email)->send(new patientApplyToTrialEmail($mailData));
                }
                // Add Assignment Log
                Assignment_log::insert(['trial_id'=>$Mdata['trial_id'],'user_id'=>$Mdata['from'],'assigned_from'=>$Mdata['from'],'assigned_to'=>$Mdata['to'],'remark'=>'','type'=>'1','created_at'=>date("Y-m-d"),'updated_at'=>date("Y-m-d")]);
            }
        }elseif($type == '4'){
            //physicanrefferal
            // trial_assignment
            $to = User::where('id',$Mdata['to'])->first();
            $from = User::where('id',$Mdata['from'])->first();
            if($to && $from){
                $mailData['to_name'] = $to->getFullNameAttribute();
                $mailData['to_email'] = $to->email;
                $mailData['to_profile'] = (!$to->image ? url('assets/avatar.jpg') : url($to->image));
                $mailData['from_name'] = $from->getFullNameAttribute();
                $mailData['from_email'] = (!$from->image ? url('assets/avatar.jpg') : url($from->image));
                $mailData['from_profile'] = $from->image;
                $mailData['trial_name'] = $Mdata['trial_name'];
                $mailData['trial_url'] = $Mdata['url'];
                $mailData['logo'] = url('assets/images/logo.png');
                if($from->role == '2'){
                    $mailData['profile_url'] = url('/dashboard/patient/view/').'/'.$Mdata['from'];
                }else{
                    $mailData['profile_url'] = $Mdata['url'];
                }
                Mail::to($to->email)->send(new PhysicianReferralPatient($mailData));

                // Add Assignment Log
                Assignment_log::insert(['trial_id'=>$Mdata['trial_id'],'user_id'=>$Mdata['from'],'assigned_from'=>$Mdata['from'],'assigned_to'=>$Mdata['to'],'remark'=>'','type'=>'1','created_at'=>date("Y-m-d"),'updated_at'=>date("Y-m-d")]);
            }
        }elseif($type == '5'){
            //chat
            $to = User::where('id',$Mdata['to'])->first();
            $from = User::where('id',$Mdata['from'])->first();
            if($to && $from){
                $mailData['to_name'] = $to->getFullNameAttribute();
                $mailData['to_email'] = $to->email;
                $mailData['to_profile'] = (!$to->image ? url('assets/avatar.jpg') : url($to->image));
                $mailData['from_name'] = $from->getFullNameAttribute();
                $mailData['from_email'] = (!$from->image ? url('assets/avatar.jpg') : url($from->image));
                $mailData['from_profile'] = $from->image;
                $mailData['chat_msg'] = $Mdata['chat_msg'];
                $mailData['url'] = $Mdata['url'];
                $mailData['logo'] = url('assets/images/logo.png');
                Mail::to($to->email)->send(new chatMessageReceive($mailData));
            }
        }elseif($type == '6'){
            // Add Assignment Log
            Assignment_log::insert(['trial_id'=>$Mdata['trial_id'],'user_id'=>$Mdata['to'],'assigned_from'=>$Mdata['from'],'assigned_to'=>$Mdata['to'],'remark'=>'','type'=>'1','created_at'=>date("Y-m-d"),'updated_at'=>date("Y-m-d")]);
        }elseif($type == '7'){
            // This is for when any file or document has been updated into patient
            $to = User::where('id',$Mdata['to'])->first();
            $from = User::where('id',$Mdata['from'])->first();
            if($to && $from){
                $mailData['to_name'] = $to->getFullNameAttribute();
                $mailData['to_email'] = $to->email;
                $mailData['to_profile'] = (!$to->image ? url('assets/avatar.jpg') : url($to->image));
                $mailData['from_name'] = $from->getFullNameAttribute();
                $mailData['from_email'] = (!$from->image ? url('assets/avatar.jpg') : url($from->image));
                $mailData['from_profile'] = $from->image;
                $mailData['chat_msg'] = $Mdata['chat_msg'];
                $mailData['url'] = $Mdata['url'];
                $mailData['logo'] = url('assets/images/logo.png');
                Mail::to($to->email)->send(new patientRecordUpdate($mailData));
            }
        }

        //End Notification Mail
        return true;
    }

    public static function getNotification(){
        return Notification::where('to',Auth::id())->where('status','1')->get();
    }

    public static function getFooterLink(){
        $checkIf = SocialLinks::where('id','1')->count();
        if($checkIf){
            $data = SocialLinks::where('id','1')->first();
        }else{
            $data['linkdIn'] = '';
            $data['instagram'] = '';
            $data['facebook'] = '';
            $data['twitter'] = '';
        }
        return $data;
    }

    public static function getAboutUs(){
        $flag1 = ContentMeta::where('meta_name','our_story')->count();
        $flag2 = ContentMeta::where('meta_name','our_team')->count();
        $data = [];
        if($flag1){
            $data['our_story'] = ContentMeta::where('meta_name','our_story')->first()->meta_value;
        }else{
            $data['our_story'] = '';
        }
        if($flag2){
            $data['our_team'] = ContentMeta::where('meta_name','our_team')->first()->meta_value;
        }else{
            $data['our_team'] = '';
        }
        return $data;
    }

    public static function getProviderNetwork(){
        $flag1 = ContentMeta::where('meta_name','provider_network_title_block_1')->count();
        $flag2 = ContentMeta::where('meta_name','provider_network_content_block_1')->count();
        $flag3 = ContentMeta::where('meta_name','provider_network_title_block_2')->count();
        $flag4 = ContentMeta::where('meta_name','provider_network_content_block_2')->count();
        $flag5 = ContentMeta::where('meta_name','provider_network_title_block_3')->count();
        $flag6 = ContentMeta::where('meta_name','provider_network_content_block_3')->count();
        $data = [];
        if($flag1){
            $data['provider_network_title_block_1'] = ContentMeta::where('meta_name','provider_network_title_block_1')->first()->meta_value;
        }else{
            $data['provider_network_title_block_1'] = '';
        }
        if($flag2){
            $data['provider_network_content_block_1'] = ContentMeta::where('meta_name','provider_network_content_block_1')->first()->meta_value;
        }else{
            $data['provider_network_content_block_1'] = '';
        }

        if($flag3){
            $data['provider_network_title_block_2'] = ContentMeta::where('meta_name','provider_network_title_block_2')->first()->meta_value;
        }else{
            $data['provider_network_title_block_2'] = '';
        }
        if($flag4){
            $data['provider_network_content_block_2'] = ContentMeta::where('meta_name','provider_network_content_block_2')->first()->meta_value;
        }else{
            $data['provider_network_content_block_2'] = '';
        }

        if($flag5){
            $data['provider_network_title_block_3'] = ContentMeta::where('meta_name','provider_network_title_block_3')->first()->meta_value;
        }else{
            $data['provider_network_title_block_3'] = '';
        }
        if($flag6){
            $data['provider_network_content_block_3'] = ContentMeta::where('meta_name','provider_network_content_block_3')->first()->meta_value;
        }else{
            $data['provider_network_content_block_3'] = '';
        }
        return $data;
    }

    public static function getLandingPage(){
        for($i=1;$i<=9;$i++){
             $flag[$i] = ContentMeta::where('meta_name','landing_block_'.$i)->count();
             if($flag[$i]){
                $data['landing_block_'.$i] = ContentMeta::where('meta_name','landing_block_'.$i)->first()->meta_value;
            }else{
                 $data['landing_block_'.$i] = '';
            }
        }
        return $data;
    }

    public static function getContactUsPage(){
        for($i=1;$i<=2;$i++){
            $flag[$i] = ContentMeta::where('meta_name','contactus_block_'.$i)->count();
            if($flag[$i]){
                $data['contactus_block_'.$i] = ContentMeta::where('meta_name','contactus_block_'.$i)->first()->meta_value;
            }else{
                 $data['contactus_block_'.$i] = '';
            }
        }
        return $data;
    }

    public static function getParentId(){
        $parent_id = Auth::user()->parent_id;
        if(!$parent_id){
           $parent_id = Auth::id(); 
        }
        return $parent_id;
    }

    public static function getDashboardCount(){
        $Self_Id = Helper::getParentId();

        $role = User::where('id',$Self_Id)->first()->role;
        $data=[];
        if($role == '1'){
            // Physician
            $data['patient'] = User::where('role','2')->where('is_deleted','1')->count();
            $data['principal_inv'] = User::where('role','5')->where('is_deleted','1')->count();
            $data['save_trial'] = SavedTrials::where('user_id',$Self_Id)->count();

            $data['appointment'] = Appointment::where('date', '>=', date('Y-m-d'))->where(function($query) use($Self_Id) {
                    return $query->Where('to', $Self_Id)
                        ->orWhere('from', $Self_Id);
                })->count();
            $data['invite_patient'] = PatientRequest::where('created_by',$Self_Id)->count();

        }else if($role == '2'){
            // Patient
            $data['save_trial'] = Assignment::where('patient_ids','like', "%{$Self_Id}%")->count();

            $data['appointment'] = Appointment::where('date', '>=', date('Y-m-d'))->where(function($query) use($Self_Id) {
                    return $query->Where('to', $Self_Id)
                        ->orWhere('from', $Self_Id);
                })->count();

        }else if($role == '3'){
            // Family & Friend
            $data['save_trial'] = Assignment::where('patient_ids','like', "%{$Self_Id}%")->count();

            $data['appointment'] = Appointment::where('date', '>=', date('Y-m-d'))->where(function($query) use($Self_Id) {
                    return $query->Where('to', $Self_Id)
                        ->orWhere('from', $Self_Id);
                })->count();
            
        }else if($role == '4'){
            // Sponsors
            $data['save_trial'] = Assignment::where('patient_ids','like', "%{$Self_Id}%")->count();

            $data['appointment'] = Appointment::where('date', '>=', date('Y-m-d'))->where(function($query) use($Self_Id) {
                    return $query->Where('to', $Self_Id)
                        ->orWhere('from', $Self_Id);
                })->count();
            
        }else if($role == '5'){
            // Principal Inv.
            $data['patient'] = User::where('role','2')->where('is_deleted','1')->count();
            $data['Physician'] = User::where('role','1')->where('is_deleted','1')->count();
            $data['save_trial'] = SavedTrials::where('user_id',$Self_Id)->count();

            $data['appointment'] = Appointment::where('date', '>=', date('Y-m-d'))->where(function($query) use($Self_Id) {
                    return $query->Where('to', $Self_Id)
                        ->orWhere('from', $Self_Id);
                })->count();
            $data['invite_patient'] = PatientRequest::where('created_by',$Self_Id)->count();
            
        }else if($role == '6'){
            // Super Admin
            $data['Physician'] = User::where('role','1')->where('is_deleted','1')->count();
            $data['patient'] = User::where('role','2')->where('is_deleted','1')->count();
            $data['principal_inv'] = User::where('role','5')->where('is_deleted','1')->count(); 
        }
        return $data;
    }

    public static function getTotalTrial($trial_id){
        return SavedTrials::where('remark',$trial_id)->count();
    }

    public static function getTrialInv($trial_id){
        $assign_dtl = Assignment::where('trial_id',$trial_id)->first();
        $inv_id = '';
        if($assign_dtl){
            $inv_id = $assign_dtl->investigator_id;
        }
        return $inv_id;
    }

    public static function getUserNameWithRole($id){
        $user = User::where('id',$id)->first();
        if($user->role == '1'){
            return $user->getFullNameAttribute().'-'.'(Physician)';
        }else if($user->role == '2'){
            return $user->getFullNameAttribute().'-'.'(Patient)';
        }else if($user->role == '3'){
            return $user->getFullNameAttribute().'-'.'(Family & Friends)';
        }else if($user->role == '4'){
            return $user->getFullNameAttribute().'-'.'(Principal Inv.)';
        }else if($user->role == '5'){
            return $user->getFullNameAttribute().'-'.'(Super Admin)';
        }else{
            return $user->getFullNameAttribute().'-'.'(UnAssigned)';
        }
    }

    public static function getRole($id){
        if($id == '1'){
            return '(Physician)';
        }else if($id == '2'){
            return '(Patient)';
        }else if($id == '3'){
            return '(Family & Friends)';
        }else if($id == '4'){
            return '(Principal Inv.)';
        }else if($id == '5'){
            return '(Super Admin)';
        }else{
            return '(UnAssigned)';
        }
    }

    public static function get_InfoRole($role){
        if($role == '1'){
            return 'Info Request';
        }
        if($role == '2'){
            return 'Data Deletion';
        }
        if($role == '3'){
            return 'Do Not Sell My Information';  
        }
        return '';
    }

    public static function processCCDA($data = ""){
        try{
            // $data = ['insert_id'=>'1','patient_id'=>34,'user_id'=>32,'description'=>'description','file_path'=>'/storage/1614772826.xml','status'=>'1'];
            $patient_id = $data['patient_id'];
            $ccda_id = $data['insert_id'];
            if($data){
                $path = \Storage::disk('local')->path(str_replace("storage","public",$data['file_path']));
                $xml = file_get_contents($path);
                $patient = new ImportCCDA($xml);
                $patient_json = $patient->construct_json();
                $patient_arr = json_decode($patient_json,true);
                // dd($patient_arr);
                // PatientMeta
                if(isset($patient_arr['rx']) && $patient_arr['rx']){
                    // Medications
                    foreach($patient_arr['rx'] as $key=>$value){
                        $data = [
                                    'medicine' => Self::c_encode($value['product_name']),
                                    'pt_instructions' => Self::c_encode($value['dose_quantity']['value'].' '.$value['dose_quantity']['unit']),
                                    'added_by' => Auth::id(),
                                    'user_id' => $patient_id,
                                    'created_at' => date('Y-m-d h:m:s', strtotime($value['date_range']['start'])),
                                    'status' => '1'
                                ];
                        $insertId = Medications::insertGetId($data);

                        // Add Meta Value
                        $data = [];
                        $data[] = [
                                    'type' => 'Medications',
                                    'row_id' => $insertId,
                                    'meta_key' => 'XML_Process_Id',
                                    'meta_value' => $ccda_id,
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        $data[] = [
                                    'type' => 'Medications',
                                    'row_id' => $insertId,
                                    'meta_key' => 'product_code',
                                    'meta_value' => $value['product_code'],
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        $data[] = [
                                    'type' => 'Medications',
                                    'row_id' => $insertId,
                                    'meta_key' => 'product_code_system',
                                    'meta_value' => $value['product_code_system'],
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        PatientMeta::insert($data);
                    }
                }

                if(isset($patient_arr['dx']) && $patient_arr['dx']){
                    // Problems
                    foreach($patient_arr['dx'] as $key=>$value){
                        $data = [
                                    'problem' => Self::c_encode($value['name']),
                                    'type' => $value['code'],
                                    'added_by' => Auth::id(),
                                    'user_id' => $patient_id,
                                    'created_at' => date('Y-m-d h:m:s', strtotime($value['date_range']['start'])),
                                    'status' => '1'
                                ];
                        $insertId = Problems::insertGetId($data);

                        // Add Meta Value
                        $data = [];
                        $data[] = [
                                    'type' => 'Problems',
                                    'row_id' => $insertId,
                                    'meta_key' => 'XML_Process_Id',
                                    'meta_value' => $ccda_id,
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        PatientMeta::insert($data);
                    }
                }

                if(isset($patient_arr['lab']) && $patient_arr['lab']){
                    // Labs
                    foreach($patient_arr['lab'] as $key=>$value){
                        $data = [
                                    'title' => Self::c_encode($value['panel_name']),
                                    'notes' => Self::c_encode(json_encode($value['results'])),
                                    'added_by' => Auth::id(),
                                    'user_id' => $patient_id,
                                    'created_at' => date('Y-m-d h:m:s', strtotime($value['results']['date'])),
                                    'status' => '1'
                                ];
                        $insertId = Labs::insertGetId($data);

                        // Add Meta Value
                        $data = [];
                        $data[] = [
                                    'type' => 'Labs',
                                    'row_id' => $insertId,
                                    'meta_key' => 'XML_Process_Id',
                                    'meta_value' => $ccda_id,
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        PatientMeta::insert($data);
                    }
                }

                if(isset($patient_arr['immunizaiton']) && $patient_arr['immunizaiton']){
                    
                }

                if(isset($patient_arr['proc']) && $patient_arr['proc']){
                    
                }

                if(isset($patient_arr['vital']) && $patient_arr['vital']){
                    // Vitals
                    foreach($patient_arr['vital'] as $key=>$value){
                        $data = [
                                    'user_id' => $patient_id,
                                    'BP' => '',
                                    'HR' => '',
                                    'RR' => '',
                                    'temp' => '',
                                    'pain' => '',
                                    'height' => '',
                                    'weight' => '',
                                    'BMI' => '',
                                    'SPO2' => '',
                                    'added_by' => Auth::id(),
                                    'created_at' => date('Y-m-d h:m:s', strtotime($value['date'])),
                                    'status' => '1'
                                ];
                        foreach ($value['results'] as $res_key => $res_value) {
                            if($res_value['name'] == 'Height'){
                                $data['height'] = Self::c_encode(json_encode(['name'=>'Height','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }else if($res_value['name'] == 'weight'){
                                $data['weight'] = Self::c_encode(json_encode(['name'=>'weight','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }else if($res_value['name'] == 'Intravascular Systolic'){
                                $data['BMI'] = Self::c_encode(json_encode(['name'=>'Intravascular Systolic','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }else if($res_value['name'] == 'BP Diastolic'){
                                $data['BP'] = Self::c_encode(json_encode(['name'=>'BP Diastolic','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }else if($res_value['name'] == 'Heart Rate'){
                                $data['HR'] = Self::c_encode(json_encode(['name'=>'Heart Rate','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }else if($res_value['name'] == 'Inhaled Oxygen'){
                                $data['SPO2'] = Self::c_encode(json_encode(['name'=>'Inhaled Oxygen','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }else if($res_value['name'] == 'Body Temperature'){
                                $data['temp'] = Self::c_encode(json_encode(['name'=>'Body Temperature','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }else if($res_value['name'] == 'RespiratoryRate'){
                                $data['RR'] = Self::c_encode(json_encode(['name'=>'RespiratoryRate','value'=>$res_value['value'],'unit'=>$res_value['unit']])); 
                            }
                        }
                        $insertId = Vitals::insertGetId($data);

                        // Add Meta Value
                        $data = [];
                        $data[] = [
                                    'type' => 'vital',
                                    'row_id' => $insertId,
                                    'meta_key' => 'XML_Process_Id',
                                    'meta_value' => $ccda_id,
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        PatientMeta::insert($data);
                    }
                }

                if(isset($patient_arr['allergy']) && $patient_arr['allergy']){
                    // Allergies
                    foreach($patient_arr['allergy'] as $key=>$value){
                        $data = [
                                    'allergent' => Self::c_encode($value['allergen']['name']),
                                    'severity' => Self::c_encode($value['name']),
                                    'Reaction' => Self::c_encode($value['reaction']['name']),
                                    'added_by' => Auth::id(),
                                    'user_id' => $patient_id,
                                    'created_at' => date('Y-m-d h:m:s', strtotime($value['results']['date'])),
                                    'status' => '1'
                                ];
                        $insertId = Allergies::insertGetId($data);

                        // Add Meta Value
                        $data = [];
                        $data[] = [
                                    'type' => 'Allergies',
                                    'row_id' => $insertId,
                                    'meta_key' => 'XML_Process_Id',
                                    'meta_value' => $ccda_id,
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        PatientMeta::insert($data);
                    }
                }

                if(isset($patient_arr['enc']) && $patient_arr['enc']){
                    // Notes
                    foreach($patient_arr['enc'] as $key=>$value){
                        $data = [
                                    'title' => Self::c_encode($value['name']),
                                    'notes' => Self::c_encode(json_encode($value)),
                                    'added_by' => Auth::id(),
                                    'user_id' => $patient_id,
                                    'created_at' => date('Y-m-d h:m:s', strtotime($value['date'])),
                                    'status' => '1'
                                ];
                        $insertId = Notes::insertGetId($data);

                        // Add Meta Value
                        $data = [];
                        $data[] = [
                                    'type' => 'Notes',
                                    'row_id' => $insertId,
                                    'meta_key' => 'XML_Process_Id',
                                    'meta_value' => $ccda_id,
                                    'created_at' => date("Y-m-d h:m:s")
                                ];
                        PatientMeta::insert($data);
                    }
                }
            }
            // Here we update the status complete
            CCDAImport::where('id',$ccda_id)->update(['status'=>'2']);
        }catch(Exception $ex){
            // Here we update the status failed
            CCDAImport::where('id',$ccda_id)->update(['status'=>'3']);
        }

    }

    public static function CheckVital($obj){
        $obj = Self::c_decode($obj);
        if(self::is_json($obj)){
            $arr = json_decode($obj,true);
            return $arr['value'].' '.$arr['unit'];
        }else{
            return $obj;
        }
    }

    public static function CheckLab($obj){
        $obj = Self::c_decode($obj);
        if(self::is_json($obj)){
            $arr = json_decode($obj,true);
            return $arr['name'].' '.$arr['value'].' '.$arr['unit'];
        }else{
            return $obj;
        }
    }

    public static function CheckNotes($obj){
        $obj = Self::c_decode($obj);
        if(self::is_json($obj)){
            $arr = json_decode($obj,true);
            $msg = '';
            if($arr['finding']['name']){
                $msg .= '<br/><b>Finding: </b>' . $arr['finding']['name'];
            }
            if($arr['performer']['name']){
                $msg .= '<br/><b>Performer: </b>' . $arr['performer']['name'];
            }
            if($arr['location']['organization']){
                $msg .= '<br/><b>Location: </b>'.$arr['location']['organization'].' '.json_encode($arr['location']['street']).' '.$arr['location']['state'].' '.$arr['location']['zip'].' '.$arr['location']['country'];
            }
            return $msg;
        }else{
            return $obj;
        }
    }

    public static function is_json($string,$return_data = false) {
        $string = Self::c_decode($string);
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
    }

    public static function CcpaCount(){
        return CcpaDoNotSell::where('user_id',Self::getParentId())->get()->count();
    }

    public static function getTrial_Inv_Name($trial_id=""){
        $obj = Assignment::with(['getTrial'])->where('trial_id',$trial_id)->first();
        $data = ['trial_name'=>'','trial_id'=>'','inv_name'=>'','inv_id'=>''];
        if($obj){
            $data['trial_name'] = $obj['getTrial']->BriefTitle;
            $data['trial_id'] = $trial_id;
            $inv = User::where('id',$obj->investigator_id)->first();
            if($inv){
                $data['inv_name'] = $inv->getFullNameAttribute();
                $data['inv_id'] = $obj->investigator_id;
            }
        }
        return $data;
    }

    public static function IsReimbursPatient($trial_id,$patient_id){
        return (PatientReimburs::where('patient_id',$patient_id)->where('trial_id',$trial_id)->count() ? 'Yes' : 'No');
    }

    public static function createStripeCustomer($user_id){
        $user = User::where('id',$user_id)->first();
        $return = [];
        if(!$user->stripe_customer_id){
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $response = $stripe->customers->create([
                          'email' => $user->email,
                          'name'  => $user->firstname.' '.$user->lastname,
                          'description' => $user->id,
                        ]);
            if($response){
                User::where('id',$user->id)->update(['stripe_customer_id'=>$response->id,'stripe_customer_json'=>json_encode($response)]);
                $return['customer_id'] = $response->id;
            }else{
                $return['customer_id'] = '';
            }
        }else{
            $return['customer_id'] = $user->stripe_customer_id;
        }
        return json_encode($return);
    }

    public static function getInvNameByTrialId($trial_id){
        $response = Assignment::with(['getInv'])->where('trial_id',$trial_id)->first();
        if($response){
            return $response['getInv']->getFullNameAttribute();
        }
        return '';
    }

}

?>