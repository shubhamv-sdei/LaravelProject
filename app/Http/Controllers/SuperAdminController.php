<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Model\SocialLinks;
use App\Model\ContentMeta;
use App\Model\UserRequest;
use App\Model\SavedTrials;
use App\Model\NewsLetter;
use App\Mail\InviteUsers as Invite;
use Session;
use Validator;
use Helper;
use Mail;

class SuperAdminController extends Controller
{

    public function InviteUsers(Request $request){

        $validator = Validator::make($request->all(), [
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
        $userRequest = ['created_by'=>Helper::getParentId(),'user_id'=>$userId,'token'=>$token,'created_at'=>date("Y-m-d h:m:s"),'updated_at'=>date("Y-m-d h:m:s")];
        UserRequest::insert($userRequest);

        /*******Send Mail Code*******/
        $mailData = ['name'=> $request->fname.' '.$request->lname,'url'=>url('signupInviteUsers').'/'.$token,'role'=>$request->role];
        Mail::to($request->email)->send(new Invite($mailData));
        /*******Send Mail Code End******/

        $msg = "You have successfully sent invitation to User.";
        Session::flash('msg', $msg); 
        return redirect(route('Dashboard.SuperAdmin.userList'));
    }

    public function userList(Request $request){
    	$data['all'] = User::whereIn('role',['1','2','5'])->where('is_deleted','1')->get();
    	$data['physician'] = User::where('role','1')->where('is_deleted','1')->get();
    	$data['patient'] = User::where('role','2')->where('is_deleted','1')->get();
    	$data['principal_inv'] = User::where('role','5')->where('is_deleted','1')->get(); 
    	return view('dashboardPages.users.userslist',$data);
    }

    public function approveUser(Request $request, $id){
    	User::where('id',$id)->update(['verified'=>'1']);
    	return response('User approved successfully', 200)
                   ->header('Content-Type', 'text/plain');
    }

    public function disapproveUser(Request $request, $id){
    	User::where('id',$id)->update(['verified'=>'2']);
    	return response('User Un-Approved successfully', 200)
                   ->header('Content-Type', 'text/plain');
    }

    public function doLogin(Request $request, $id){
    	Auth::loginUsingId($id);
    	return redirect(route('Dashboard'));
    }

    public function sociallinks(Request $request){
        $checkIf = SocialLinks::where('id','1')->count();
        if($checkIf){
            $data = SocialLinks::where('id','1')->first();
        }else{
            $data['linkdIn'] = '';
            $data['instagram'] = '';
            $data['facebook'] = '';
            $data['twitter'] = '';
        }
        return view('dashboardPages.contentMng.socialLinks',$data);
    }

    public function updateSocialLinks(Request $request){
        $checkIf = SocialLinks::where('id','1')->count();
        if($checkIf){
            SocialLinks::where('id','1')->update(['id'=>'1','linkdIn'=>$request->linkdIn,'facebook'=>$request->facebook,'instagram'=>$request->instagram,'twitter'=>$request->twitter]);
        }else{
            SocialLinks::insert(['id'=>'1','linkdIn'=>$request->linkdIn,'facebook'=>$request->facebook,'instagram'=>$request->instagram,'twitter'=>$request->twitter]);
        }
        $msg = "Links updated successfully.";
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function aboutus(Request $request){
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
        return view('dashboardPages.contentMng.aboutus',$data);
    }

    public function updateAboutus(Request $request){
        $flag1 = ContentMeta::where('meta_name','our_story')->count();
        $flag2 = ContentMeta::where('meta_name','our_team')->count();
        if($flag1){
            ContentMeta::where('meta_name','our_story')->update(['meta_value'=>$request->our_story]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'our_story','meta_value'=>$request->our_story]);
        }

        if($flag2){
            ContentMeta::where('meta_name','our_team')->update(['meta_value'=>$request->our_team]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'our_team','meta_value'=>$request->our_team]);
        }

        $msg = "Content Updated Successfully.";
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function providernetwork(Request $request){
        $flag1 = ContentMeta::where('meta_name','provider_network_title_block_1')->count();
        $flag2 = ContentMeta::where('meta_name','provider_network_content_block_1')->count();
        $flag3 = ContentMeta::where('meta_name','provider_network_title_block_2')->count();
        $flag4 = ContentMeta::where('meta_name','provider_network_content_block_2')->count();
        $flag5 = ContentMeta::where('meta_name','provider_network_title_block_3')->count();
        $flag6 = ContentMeta::where('meta_name','provider_network_content_block_3')->count();
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

        return view('dashboardPages.contentMng.providerNetwork',$data);
    }

    public function updateprovidernetwork(Request $request){

        $flag1 = ContentMeta::where('meta_name','provider_network_title_block_1')->count();
        $flag2 = ContentMeta::where('meta_name','provider_network_content_block_1')->count();
        $flag3 = ContentMeta::where('meta_name','provider_network_title_block_2')->count();
        $flag4 = ContentMeta::where('meta_name','provider_network_content_block_2')->count();
        $flag5 = ContentMeta::where('meta_name','provider_network_title_block_3')->count();
        $flag6 = ContentMeta::where('meta_name','provider_network_content_block_3')->count();
        if($flag1){
            ContentMeta::where('meta_name','provider_network_title_block_1')->update(['meta_value'=>$request->provider_network_title_block_1]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'provider_network_title_block_1','meta_value'=>$request->provider_network_title_block_1]);
        }

        if($flag2){
            ContentMeta::where('meta_name','provider_network_content_block_1')->update(['meta_value'=>$request->provider_network_content_block_1]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'provider_network_content_block_1','meta_value'=>$request->provider_network_content_block_1]);
        }

        if($flag3){
            ContentMeta::where('meta_name','provider_network_title_block_2')->update(['meta_value'=>$request->provider_network_title_block_2]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'provider_network_title_block_2','meta_value'=>$request->provider_network_title_block_2]);
        }

        if($flag4){
            ContentMeta::where('meta_name','provider_network_content_block_2')->update(['meta_value'=>$request->provider_network_content_block_2]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'provider_network_content_block_2','meta_value'=>$request->provider_network_content_block_2]);
        }

        if($flag5){
            ContentMeta::where('meta_name','provider_network_title_block_3')->update(['meta_value'=>$request->provider_network_title_block_3]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'provider_network_title_block_3','meta_value'=>$request->provider_network_title_block_3]);
        }

        if($flag6){
            ContentMeta::where('meta_name','provider_network_content_block_3')->update(['meta_value'=>$request->provider_network_content_block_3]);
        }else{
            ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'provider_network_content_block_3','meta_value'=>$request->provider_network_content_block_3]);
        }

        $msg = "Provider Network Updated Successfully.";
        Session::flash('msg', $msg); 
        return redirect()->back();
        
    }

    public function landingpage(){
        for($i=1;$i<=9;$i++){
             $flag[$i] = ContentMeta::where('meta_name','landing_block_'.$i)->count();
             if($flag[$i]){
                $data['landing_block_'.$i] = ContentMeta::where('meta_name','landing_block_'.$i)->first()->meta_value;
            }else{
                 $data['landing_block_'.$i] = '';
            }
        }
        return view('dashboardPages.contentMng.landingPage',$data);
    }

    public function updatelandingpage(Request $request){
        for($i=1;$i<=9;$i++){
             $flag[$i] = ContentMeta::where('meta_name','landing_block_'.$i)->count();
            if($flag[$i]){
                ContentMeta::where('meta_name','landing_block_'.$i)->update(['meta_value'=>$request['landing_block_'.$i]]);
            }else{
                ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'landing_block_'.$i,'meta_value'=>$request['landing_block_'.$i]]);
            }
        }

        $msg = "Landing Page Updated Successfully.";
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function contactuspage(Request $request){
        $flag1 = ContentMeta::where('meta_name','contactus_block_1')->count();
        $flag2 = ContentMeta::where('meta_name','contactus_block_2')->count();
        if($flag1){
            $data['contactus_block_1'] = ContentMeta::where('meta_name','contactus_block_1')->first()->meta_value;
        }else{
            $data['contactus_block_1'] = '';
        }
        if($flag2){
            $data['contactus_block_2'] = ContentMeta::where('meta_name','contactus_block_2')->first()->meta_value;
        }else{
            $data['contactus_block_2'] = '';
        }
        return view('dashboardPages.contentMng.contactus',$data);
    }

    public function updatecontactuspage(Request $request){
        for($i=1;$i<=2;$i++){
            $flag[$i] = ContentMeta::where('meta_name','contactus_block_'.$i)->count();
            if($flag[$i]){
                ContentMeta::where('meta_name','contactus_block_'.$i)->update(['meta_value'=>$request['contactus_block_'.$i]]);
            }else{
                ContentMeta::insert(['user_id'=>Auth::id(),'meta_name'=>'contactus_block_'.$i,'meta_value'=>$request['contactus_block_'.$i]]);
            }
        }
        $msg = "Contact Us Updated Successfully.";
        Session::flash('msg', $msg); 
        return redirect()->back();
    }

    public function getSavedTrial(Request $request){
        $trial = SavedTrials::with('getAssignment')->get();
        return view('dashboardPages.superadmin.triallist',['trial'=>$trial]);   
    }

    public function professionalInfo($id){
        $data = Helper::getUserMeta($id);
        $user = User::find($id);
        return view('dashboardPages.users.userDetails',['data'=>$data, 'user'=>$user]);
    }

    public function deleteUser(Request $request, $id){
        $email = User::find($id)->email;
        User::where('id',$id)->update(['is_deleted'=>'2','email'=>'del_'.$email]);
        return response('User Deleted successfully', 200)
                   ->header('Content-Type', 'text/plain');
    }

    public function newsLetter(Request $request){
        $data['news_letters']=NewsLetter::where('created_by',Auth::id())->get();
        return view('dashboardPages.newsLetter.index',$data);
    }

    public function addNewsLetterPage(Request $request){
        return view('dashboardPages.newsLetter.addNewsLetter');
    }

    public function addNewsletter(Request $request){
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = ['created_by'=>Auth::id(),'status'=>$request->status,'title'=>$request->title,'html_body'=>$request->body,'created_at'=>date('Y-m-d h:m:i'),'updated_at'=>date('Y-m-d h:m:i')];
        if(isset($request->id)){
            $msg = "News Letter Updated Successfully.";
            $userId = NewsLetter::where('id',$request->id)->update($data);
        }else{
            $msg = "News Letter Added Successfully.";
            $userId = NewsLetter::insertGetId($data);
        }

        
        Session::flash('msg', $msg); 
        return redirect(route('superadmin.newsletter'));
    }

    public function editNewsLetter($id){
        $data['newsLetter'] = NewsLetter::where('id',$id)->first();
        return view('dashboardPages.newsLetter.addNewsLetter',$data);
    }

    public function deleteNewsLetter($id){
        NewsLetter::where('id',$id)->delete();
        return response('News Letter Deleted successfully', 200)
                   ->header('Content-Type', 'text/plain');
    }

    public function newsLetterMail($id){
        $newsletter = NewsLetter::where('id',$id)->first();
        $details = [
            'subject' => 'News Letter',
            'newsLetter' => $newsletter
        ];

        // send all mail in the queue.
        $job = (new \App\Jobs\SendBulkQueueEmail($details))
            ->delay(
                now()
                ->addSeconds(2)
            ); 

        dispatch($job);

        $msg = 'News Letter has been added into queue for sending.';
        Session::flash('msg', $msg); 
        return redirect(route('superadmin.newsletter'));
    }
}
