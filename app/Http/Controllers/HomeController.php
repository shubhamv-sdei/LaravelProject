<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PasswordReset;
use App\Model\ContactUs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Helper;
use Artisan;
use App\Model\SocialLinks;
use App\Model\PatientRequest;
use App\Model\StaffRequest;
use App\Model\UserRequest;
use App\Model\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == '7'){
            return view('home');
        }else{
            return redirect(route('Dashboard'));
        }
    }

    public function loginPage(){
        return view('login');
    }

    public function signupPage(){
        return view('signup');
    }

    public function aboutusPage(){
        return view('aboutus');
    }

    public function servicePage(){
        return redirect('find-a-study');
    }

    public function providerPage(){
        return view('provider');
    }

    public function contactusPage(){
        return view('contactus');
    }

    public function forgotPassword(){
        return view('forgotpassword');
    }

    public function privatePolicy(){
        return view('private_policy');
    }

    public function termsCondition(){
        return view('terms_condition');
    }

    public function sendresetlink(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $token = time().rand();
        $email = $request->email;
        $data = ['email'=>$email,'token'=>$token];
        $ifValid = User::where('email',$email)->first();
        if($ifValid){
            // Send Reset Mail
            $mailData = ['name'=> $ifValid->firstname.' '.$ifValid->lastname,'url'=>url('changepassword').'/'.$token];
            Mail::to($email)->send(new ResetPasswordMail($mailData));
            $res = PasswordReset::insert($data);
            $msg = "Reset password link has been Sent to your email.";

        }else{
            // Send Info Back
            $msg = "This email ID is not found in our records.";
        }
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function changepassword($token){
        $getEmail = PasswordReset::where('token',$token)->first();
        if($getEmail){
            $email = $getEmail->email;
            return view('changepassword',['token'=>$token,'email'=>$email]);
        }else{
            $msg = "Token expired please try again.";
            Session::flash('msg', $msg); 
            return view('forgotpassword');
        }
    }

    public function dochangepassword(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'token' => 'required',
            'password' => ['required','confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $email = $request->email;
            $password = $request->password;
            $user = User::where('email',$email)->first();
            User::where('id',$user->id)->update(['password'=>Hash::make($password)]);
            $msg = "Your password has been changed successfully.";
            PasswordReset::where('email',$email)->delete();
        }
        Session::flash('msg', $msg);
        return redirect('dologin');
    }

    public function contact_us_process(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'category'  => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $recaptcha = $_REQUEST['g-recaptcha-response'];
        $res = Helper::reCaptcha($recaptcha);
        if(!$res['success']){
          $msg = "reCaptcha Not Validated. Please try again";
          Session::flash('msg', $msg); 
          return redirect()->back();
        }
        $data = ['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'category'=>$request->category,'message'=>$request->message,'remark'=>''];
        $res = ContactUs::insert($data);
        if($res){
             $msg = "Form has been submitted successfully. We will contact you soon.Thanks";
        }else{
             $msg = "Something went wrong please try after sometime.";
        }
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function setRole(Request $request, $role){
        $userObj = User::find(Auth::id());
        $userObj->role = $role;
        $userObj->save();
        $msg = "You have successfully set your role.";
        Session::flash('msg', $msg); 
        return redirect(route('Dashboard'));
    }

    public function reset(){
         Artisan::call('config:clear');
         Artisan::call('config:cache');
         Artisan::call('storage:link');
    }

    public function TokenSignupPatient($token){
        $patientRequest = PatientRequest::where('token',$token)->first();
        if($patientRequest){
            $patientData = User::find($patientRequest->patient_id);
            return view('tokenSignup.patientToken',['patient'=>$patientData,'token'=>$token]);
        }
        return view('tokenSignup.expirePage');
    }

    public function TokenSignupStaff($token){
        $staffRequest = StaffRequest::where('token',$token)->first();
        if($staffRequest){
            $staffData = User::find($staffRequest->staff_id);
            return view('tokenSignup.staffToken',['staff'=>$staffData,'token'=>$token,'parent_id'=>$staffRequest->created_by]);
        }
        return view('tokenSignup.expirePage');
    }

    public function TokenSignupUser($token){
        $UserRequest = UserRequest::where('token',$token)->first();
        if($UserRequest){
            $userData = User::find($UserRequest->user_id);
            return view('tokenSignup.userToken',['user_id'=>$userData,'token'=>$token,'parent_id'=>$UserRequest->created_by]);
        }
        return view('tokenSignup.expirePage');
    }
    
    public function savedInviteUser(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required',
            'sex' => 'required',
            'dob' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Save under User Table
        $userData = ['firstname'=>$request->fname,'lastname'=>$request->lname,'email'=>$request->email,'contact'=>$request->phone,'address'=>$request->address1.' '.$request->address2.' '.$request->city.' '.$request->zip,'password'=>Hash::make($request->password),'dob'=>$request->dob,'sex'=>'1','verified'=>'1'];
        $userId = User::where('id',$request->id)->update($userData);

        if($userId){
            UserRequest::where('token',$request->token)->update(['status'=>'2']);
        }

        $msg = "User Registered successfully.";
        Session::flash('msg', $msg); 
        return redirect(route('loginPage'));
    }

    public function savedInvitePatient(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required',
            'sex' => 'required',
            'dob' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Save under User Table
        $userData = ['firstname'=>$request->fname,'lastname'=>$request->lname,'email'=>$request->email,'contact'=>$request->phone,'address'=>$request->address1.' '.$request->address2.' '.$request->city.' '.$request->zip,'password'=>Hash::make($request->password),'dob'=>$request->dob,'sex'=>'1','verified'=>'1'];
        $userId = User::where('id',$request->id)->update($userData);

        if($userId){
            PatientRequest::where('token',$request->token)->update(['status'=>'2']);
        }

        $msg = "Patient Registered successfully.";
        Session::flash('msg', $msg); 
        return redirect(route('loginPage'));
    }

    public function savedInviteStaff(Request $request){

        $recaptcha = $_POST['g-recaptcha-response'];
        $res = Helper::reCaptcha($recaptcha);
        if(!$res['success']){
          return redirect()->back();
        }
        
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'phone' => 'required',
            // 'sex' => 'required',
            // 'dob' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Save under User Table
        if($request->role == '4'){
            $request->parent_id = 0;
        }
        $userData = ['firstname'=>$request->fname,'lastname'=>$request->lname,'email'=>$request->email,'password'=>Hash::make($request->password),'dob'=>$request->dob,'sex'=>'1','verified'=>'1','parent_id'=>$request->parent_id,'role'=>$request->role];
        $userId = User::where('id',$request->id)->update($userData);

        if($userId){
            StaffRequest::where('token',$request->token)->update(['status'=>'2']);
        }

        $msg = "Staff Registered successfully.";
        if($request->role == '4'){
            $msg = "Medical Monitor Registered successfully.";
        }
        Session::flash('msg', $msg); 
        return redirect(route('loginPage'));
    }

    public function activateAccount($email){
        User::where('email',$email)->update(['verified'=>'1']);
        $msg = "Account Activated successfully.";
        Session::flash('msg', $msg); 
        return redirect(route('loginPage'));
    }

    public function SubscribeNewsLetter(Request $request){
        $userObj = User::where('email',$request->email)->first();
        if($userObj){
            User::where('id',$userObj->id)->update(['subscribed'=>'1']);
            $msg = "News Letter Subscribe Successful.";
            Session::flash('msg', $msg); 
            return redirect(route('loginPage'));
        }else{
            $msg = "Email does not exist for this user. Please create an account.";
            Session::flash('msg', $msg); 
            return redirect(route('signupPage'));
        }
    }

    public function notification($id){
        $notification = Notification::where('id',$id)->first();
        if($notification){
            Notification::where('id',$id)->update(['status'=>'2']);
            return Redirect::to($notification->redirect);
        }
    }

    public function CCPA(Request $request){
        return view('ccpa');
    }
}
