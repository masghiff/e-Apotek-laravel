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
use App\Helper\Uuid;
use App\Helper\Storage;

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

    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $message = '';

        $uuid = Uuid::getId();

        $username = $request->username;
        $password = $request->password;
        $nama = $request->nama;

        if(empty($username) || empty($nama))
        {
            Alert::error('Failed!', 'Harus di isi semua');
            return redirect()->route('register.dashboard');
        }

        if(strlen($request->password) < 8 )
        {
            Alert::error('Failed!', 'Password minimal 8 karakter');
            return back();
        }

        $data = User::select('username')->where('username', $request->username)->first();

        if(!empty($data['username']))
        {
            Alert::error('Failed', 'Username sudah ada.');
            return back();
        }

        $user = new User();
        $user->id = $uuid;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->nama = $request->nama;
        if($request->hasFile('image'))
        {
            $uploadImage = Storage::uploadImageUser($request->file('image'));
            $user->foto = $uploadImage;
        }
        $user->role = 'pelanggan';
        $user->membership = 'SILVER';
        $user->point = '0';
        $user->save();


        return back();

    }
}
