<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    public function field(Request $request)
    {
        $email = $request->username;
        return filter_var($email, FILTER_VALIDATE_EMAIL) ?'email' : 'username';
    }

    public function check(Request $request){
        $field = $this->field($request);
        $request->validate([
           'username'=>'required|string',
           'password'=>'required|string'
        ]);
        //dd($request->all());
        $creds=[
            $field  => $request->username,
            'password' => $request->password,
         ];


        //$creds = $request->only($field,'password');
        $remember=isset($request->remember)?true:false;
        if(Auth::guard('admin')->attempt($creds, $remember) ){
            //dd('ok');
            Session::flash('message', 'Selamat datang kembali '.auth('admin')->user()->name); 
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('login')->withErrors('Incorrect credentials');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
