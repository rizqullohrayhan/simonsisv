<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Unit;
use App\Models\Tor;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


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
    protected function redirectTo()
    {
        if (Auth()->user()->role == 1) { //admin
            return route('admin.dashboard');
        } elseif (Auth()->user()->role != 1) { //selain admin
            return route('sv.dashboard');
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
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            // DB::table('users')->where('id', auth()->user()->id)->update(
            //     [
            //         'role' => $request->role
            //     ]
            // );

            if (auth()->user()->role == 1) {
                return redirect()->route(
                    'admin.dashboard',
                );
            } elseif (auth()->user()->role != 1) { //selain admin
                return redirect()->route(
                    'sv.dashboard',
                );
            }
        } else {
            session()->flash('error', 'Alamat Email atau Password Anda salah!.');
            return redirect()->route('login');
        }
    }

    public function loginDev()
    {
      	return view('login');
    }

  	public function proses_loginDev(Request $request)
    {
      	$email = $request->email;
      	$password = $request->password;
        if (Auth::attempt(array('email' => $email, 'password' => $password))) {

            if (auth()->user()->role == 1) {
                return redirect('/home');
            } elseif (auth()->user()->role != 1) { //selain admin
                return redirect()->route(
                    'sv.dashboard',
                );
            }
        } else {
            session()->flash('error', 'Alamat Email atau Password Anda salah!.');
            return redirect()->route('login');
        }
    }

    public function gantiRole(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            DB::table('users')->where('id', auth()->user()->id)->update(
                [
                    'role' => $request->pilihrole
                ]
            );

            if (auth()->user()->role == 1) {
                return redirect()->route(
                    'admin.dashboard',
                );
            } elseif (auth()->user()->role != 1) { //selain admin
                return redirect()->route(
                    'sv.dashboard',
                );
            }
        } else {
            session()->flash('error', 'Alamat Email atau Password Anda salah!.');
            return redirect()->route('login');
        }
    }

    // public function chooseRole()
    // {
    //     return route('pilih_role');
    // }
}
