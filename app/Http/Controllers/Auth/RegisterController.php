<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User as Usernya;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

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
        // Usernya::all()->where('name', $data['name'])->first()->assignRole('Prodi');
        $inserting = Usernya::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 1, //admin
            'password' => Hash::make($data['password']),
            'id_unit' => 1
        ]);
        $inserting->assignRole('Admin');
    }

    public function createAdmin(array $data)
    {
        // Usernya::all()->where('name', $data['name'])->first()->assignRole('Prodi');
        $inserting = Usernya::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role' => 1, //admin
            'password' => Hash::make($data['password']),
            'id_unit' => 1
        ]);
        $inserting->assignRole('Admin');
    }
}
