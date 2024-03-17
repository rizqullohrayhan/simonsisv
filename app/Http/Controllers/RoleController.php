<?php

namespace App\Http\Controllers;

// use App\Models\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\User;
use App\Models\User as Usernya;
use App\Models\Unit;
use App\Models\Tor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role_create', ['only' => 'create']);
        $this->middleware('permission:role_delete', ['edit', 'delete']);
        $this->middleware('permission:role_update', ['only' => 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i  = Role::all()->where('id', Auth()->user()->role);
        $unit = Unit::all();
        $tor = Tor::all();
        $tabelRole =  Role::all();
        $user = new Usernya();
        // $namarole = $i[Auth()->user()->role - 1]->name;
        return view('pengaturan.roles.index', [
            'roles' => Role::all(), 'userrole' =>  $user->join(), 'namerole' => $user->namarole(),
            'unit' => $unit, 'tor' => $tor, 'tabelRole' => $tabelRole
        ]);
        // dd(Auth()->user()->roles->pluck('name'));
        // return response()->json($i[Auth()->user()->role - 1]->name);
        // return var_dump(Auth()->user()->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tabelRole =  Role::all();
        return view('pengaturan.roles.create', [
            'authorities' => config('permission.authorities'), 'tabelRole' => $tabelRole
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:50|unique:roles,name",
                'permissions' => "required"
            ],
            [],
            $this->attributes()
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }
        // dd($request->all());

        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $role->givePermissionTo($request->permissions);
            //alert
            // return redirect()->route('pengaturan.roles.index');
            // dd($role);
            if ($role) {
                return redirect('roles')->with("success", "Data berhasil ditambahkan");
            } else {
                return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $role = new Role();
        $role = role::all()->where('id', $id)->first();
        $tabelRole =  Role::all();
        return view('pengaturan.roles.detail', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'rolePermissions' => $role->permissions->pluck('name')->toArray(),
            'tabelRole' => $tabelRole
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $role = new Role();
        $role = role::all()->where('id', $id)->first();
        $tabelRole =  Role::all();
        return view('pengaturan.roles.update', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'permissionChecked' => $role->permissions()->pluck('name')->toArray(),
            'tabelRole' => $tabelRole
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:50|unique:roles,name," . $role->id,
                'permissions' => "required"
            ],
            [],
            $this->attributes()
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $role->name = $request->name;
            $role->syncPermissions($request->permissions);
            $role->save();
            //alert

            if ($role) {
                return redirect('roles')->with("success", "Data berhasil diupdate");
            } else {
                return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = base64_decode($id);
        $role = new Role();
        $role = role::all()->where('id', $id)->first();
        DB::beginTransaction();
        try {
            $role->revokePermissionTo($role->permissions->pluck('name')->toArray());
            $role->delete();
            //alert
            // dd($role);
        } catch (\Throwable $th) {
            DB::rollBack();
        } finally {
            DB::commit();
        }
        return redirect()->back()->with("success", "Data berhasil dihapus");
    }
    private function attributes()
    {
        return [
            'name' => "Nama",
            'permissions' => "Hak Akses",
        ];
    }
}
