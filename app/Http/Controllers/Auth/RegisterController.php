<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Alert;
use DB;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $message = '';

        $username = $request->username;
        $password = $request->password;
        $nama = $request->nama;

        if(!$username|| !$password)
        {
            Alert::error('Failed!', 'Harus di isi semua');
        }

        if(strlen($request->password) < 8 )
        {
            Alert::error('Failed!', 'Password minimal 8 karakter');
        }

        $result = DB::transaction(function () use ($request, $message) {
            $user = new User();
            $user->username = $request->username;
            $user->password = $request->password;
            $user->nama = $request->nama;
            $user->role = 'pelanggan';
            $user->save();

            $membership = new Membership();
            $membership->nama = 'SILVER';
            $membership->point = '0';
            $membership->users_username = $request->username;
            $membership->save();

            $message = "OK";

        });

        if($message == "OK")
        {
            return route('pelanggan.home');
        }
        else
        {
            Alert::error('Failed!', 'Register gagal, mohon coba lagi.');
        }


    }
}
