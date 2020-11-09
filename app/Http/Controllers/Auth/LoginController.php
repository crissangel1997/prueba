<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
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


 
    public function login(Request $request){

        $this->validateLogin($request);
        
    
        if (Auth::attempt(['usu' => $request->usu,'password' => $request->password,'active'=>1])){

            return redirect()->route('home');

        }
        
        return back()->withErrors(['usu' => trans('auth.failed')]);

    }   
        
        protected function validateLogin(Request $request){
             

            $this->validate($request,[
                'usu' => 'required|string',
                'password' => 'required|string'
            ]);
        }

       


    
}
  
