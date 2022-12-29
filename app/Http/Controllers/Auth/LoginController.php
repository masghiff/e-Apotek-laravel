<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    protected function redirectTo()
    {

        if(auth()->user()->role == "admin")
        {
            return route('admin.dashboard');
        }
        else
        {
            return route('pelanggan.dashboard');
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // return redirect()->route('login');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if(auth()->attempt(array('username'=>$username, 'password'=>$password)))
        {
            if(auth()->user()->role == "admin")
            {
                return redirect()->route('admin.dashboard');
            }
            else
            {
                return redirect()->route('pelanggan.dashboard');
            }
        }
        else
        {
            return redirect('/')->with('failed', 'Username and password are wrong');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
