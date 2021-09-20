<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Mail\AccountVerify;
use Session;
use Helper;
use Mail;
use App\Rules\IsValidPassword;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password' => [
                            'required',
                            'string',
                             new isValidPassword(),
                            'confirmed'
                            ]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['fname'],
            'lastname' => $data['lname'],
            'email' => $data['email'],
            'role' => '7',
            'password' => Hash::make($data['password']),
            'subscribed' => ($data['email_notifications'] == "on" ? '1' : '0')
        ]);
    }

    public function register(Request $request)
    {
        $recaptcha = $_POST['g-recaptcha-response'];
        $res = Helper::reCaptcha($recaptcha);
        if(!$res['success']){
          return redirect()->back();
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //Send Mail
        $mailData = ['name'=> $request->fname.' '. $request->lname,'url'=>url('activateAccount').'/'.$request->email_confirmation];
        Mail::to($request->email_confirmation)->send(new AccountVerify($mailData));

        //End Mail Code
        // $this->guard()->login($user);
        Session::flash('msg', 'You have successfully registered. Please check your email to activate your account.'); 
        return $this->registered($request, $user)
                        ?: redirect('dologin');
    }
}
