<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /*protected function credentials(Request $request)
    {
        die('In');
        $credentials = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'verified' => 1
        );

        if (Auth::attempt($credentials)) 
        {
            return redirect()->intended('dashboard');
        }
        else
        {
            Session::flash('msg', 'Your account is not verified.'); 
            $checkIfUserExist = User::where('email',$request->get('email'))->count();
            if($checkIfUserExist){
               return redirect()->intended('dashboard');
            }
        }
    }*/

    function authenticated(Request $request, $user)
    {

        if ($user->verified != 1) {
            Auth::logout();
            Session::flash('msg', 'Your account is not verified.'); 
            return redirect(route('loginPage'));
        }

        if ($user->is_deleted != 1) {
            Auth::logout();
            Session::flash('msg', 'Your account is deleted.'); 
            return redirect(route('loginPage'));
        }
        
        if ($user->role != 7) { // UnAssigned
            return redirect(route('Dashboard'));
        }else{
            return redirect(route('home'));
        }
    }
}
