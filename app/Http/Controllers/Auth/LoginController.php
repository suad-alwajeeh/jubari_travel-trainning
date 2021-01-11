<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    protected function credentials(Request $request)
    {
        return [
            'email'=>request()->email,
            'password'=>request()->password,
            'is_active'=>1,
            'is_delete'=>0,
        ];
    }

    protected  function authenticated(Request $req ,$user){
        if($user->hasRole('sale_executive')){
            return redirect('/service/sales_repo');
        }
        if($user->hasRole('admin')){
            return redirect('/');
        }
        if($user->hasRole('sale_manager')){
            return redirect('/displaySalesManager');
        }
        if($user->hasRole('accountant')){
            return redirect('/accountant');
        }
    }
    //protected $redirectTo = RouteServiceProvider::HOME;
  
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout()
    {
        $this->guard('web_buyer')->logout();

        return redirect('login');
    }
}
