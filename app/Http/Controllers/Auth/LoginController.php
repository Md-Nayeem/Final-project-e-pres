<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo;

    public function redirectTo(){

        switch (Auth::user()->role->name) {
            
            case 'Admin':
                $this->redirectTo = '/admin-dc';
                return $this->redirectTo;
                break;

            case 'Doctor':
                $this->redirectTo = '/dc';
                return $this->redirectTo;
                break;

            case 'Staff':
                $this->redirectTo = '/st';
                return $this->redirectTo;
                break;
            
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
                break;
                
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
