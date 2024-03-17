<?php

namespace App\Http\Controllers;

use App\Models\SPJ;
use App\Models\Tor;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\User as Usernya;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    //
    function index()
    {
        $role = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $role->name;
        $user = Usernya::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $unit = Unit::all();
        $tor = Tor::all();
        $spj = SPJ::all();
        // dd($user->roles);

        $tabelRole =  Role::all();

        $userStatic = new User();
        $userrole = $userStatic->join();
        return view('dashboards.users.index', ['userrole' => $userrole, 'unit' => $unit, 'tor' => $tor, 'spj' => $spj, 'tabelRole' => $tabelRole]);
    }
}
