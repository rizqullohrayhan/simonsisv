<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unit;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    protected $table = 'user';
    public function __construct()
    {
        $this->middleware('permission:user_create', ['only' => 'add']);
        $this->middleware('permission:user_delete', ['only' => 'delete']);
        $this->middleware('permission:user_detail', ['only' => 'show']);
        $this->middleware('permission:user_show', ['only' => 'index']);
        $this->middleware('permission:user_update', ['only' => 'update']);
    }
    public function index()
    {
        $user = User::all();
        $unit = Unit::all();
        $role = Role::all();
        $usernya = new User;
        $userrole = $usernya->join();
        $tabelRole =  Role::all();
        return view("pengaturan.user.user_index")->with([
            'user' => $user, 'userrole' => $userrole, 'role' => $role,
            'unit' => $unit, 'tabelRole' => $tabelRole
        ]);
        // return Auth::user()->getroleNames();
        // return Auth::user()->getAllPermissions();
    }

    public function add()
    {
        $tor = User::all();
        $role = Role::all();
        $user = new User;
        $userrole = $user->join();
        $unit = Unit::all();
        $tabelRole =  Role::all();

        return view("pengaturan.user.user_create")->with(['tor' => $tor, 'userrole' => $userrole, 'role' => $role, 'unit' => $unit, 'tabelRole' => $tabelRole]);
    }

    public function processAdd(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string|max:30",
                "role" => "required",
                "email" => "required|email|unique:users,email",
                // "password" => "required|min:6|confirmed"
                // google_id
                // username
            ],
        );
        // if ($validator->fails()) {
        //     $request['role'] = Role::select('id', 'name')->find($request->role);
        //     return redirect()
        //         ->back()
        //         ->withInput($request->all)
        //         ->withErrors($validator);
        // }
        $role = DB::table('roles')->where('id', $request->role[0])->first();
        $assignrole = $role->name;
        // return ($role->name);
        // return $request->all();
        $input = $request->all();
        $rol = $input['role'];
        DB::beginTransaction();
        try {
            $inserting = new User;
            $inserting->id_unit = $request->id_unit;
            $inserting->name = $request->name;
            $inserting->nip = $request->nip;
            $inserting->email = $request->email;
            $inserting->role = $request->role[0];
            $inserting->multirole = implode(',', $rol);
            // $inserting->nip = $request->nip;
            $inserting->email_verified_at = now();
            // $inserting->password = Hash::make($request->password);
            $inserting->password = Hash::make("vokasibergerak");
            $inserting->remember_token = Str::random(10);
            $inserting->created_at = $request->created_at;
            $inserting->updated_at = $request->updated_at;

            $inserting->save();

            $inserting->assignRole($assignrole);
            //allert
            if ($inserting) {
                return redirect('/user')->with("success", "Data berhasil ditambahkan");
            } else {
                return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            // $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        } finally {
            DB::commit();
        }
        // dd(implode(',', $rol));
    }

    public function show($id)
    {
        $id = base64_decode($id);
        $user = new User;
        $user = User::all()->where('id', $id)->first();
        $role =  DB::table('roles')->select('name')->where('id', $user->role)->first();
        $authorities =  config('permission.authorities');
        $permissionChecked = $user->getAllPermissions()->pluck('name')->toArray();
        $tabelRole =  Role::all();
        return view('pengaturan.user.user_detail', [
            'user' => $user,
            'role' => $role,
            'authorities' => $authorities,
            'permissionChecked' => $permissionChecked,
            'tabelRole' => $tabelRole
        ]);
        // return $user;
        // $user2 = encrypt($user);
        // return decrypt($user2);
        // return $permissionChecked;
    }

    public function update($id)
    {
        $id = base64_decode($id);
        $user = new User;
        $user = User::all()->where('id', $id)->first();
        try {
            $role = Role::all();
            $unit = Unit::all();
            $userrole = $user->join();
            $tabelRole =  Role::all();
            return view("pengaturan.user.user_update")->with(['tabelRole' => $tabelRole, 'user' => $user, 'unit' => $unit, 'userrole' => $userrole, 'role' => $role, 'roleSelected' => $user->roles->first()]);
            // return $user->getAllPermissions();
            // return ($user->role);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function processUpdate(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "role" => "required",
            ],
            [],
            $this->attributes()
        );
        if ($validator->fails()) {
            $request['role'][0] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
        // dd($request->all());

        $role = DB::table('roles')->where('id', $request->role[0])->first();
        $assignrole = $role->name;
        DB::beginTransaction();
        // dd($assignrole);

        try {
            $user->name = $request->name;
            $user->nip = $request->nip;
            $user->email = $request->email;
            $user->id_unit = $request->id_unit;

            $input = $request->all();
            $therole = $input['role'];

            $user->multirole = implode(',', $therole);
            if (empty($request->password)) {
            }
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->role = $request->role[0];
            // $user->image   = $nama_file;
            $user->syncRoles($assignrole);
            $user->save();
            //allert
            if ($user) {
                return redirect('/user')->with("success", "Data berhasil diupdate");
            } else {
                return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $request['role'][0] = Role::select('id', 'name')->find($request->role[0]);
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    public function delete($id)
    {
        // try {
        //     $process = User::findOrFail($id)->delete();
        //     if ($process) {
        //         return redirect()->back()->with("success", "Data berhasil dihapus");
        //     } else {
        //         return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
        //     }
        // } catch (\Exception $e) {
        //     abort(404);
        // }
        $id = base64_decode($id);
        $user = new User;
        $user = User::all()->where('id', $id)->first();
        $role = DB::table('roles')->where('id', $user->role)->first();
        $assignrole = $role->name;
        DB::beginTransaction();
        // dd($assignrole);


        try {
            $user->removeRole($assignrole);
            $user->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
        } finally {
            DB::commit();
        }
        return redirect()->back()->with("success", "Data berhasil dihapus");
    }
    public function search(Request $request)
    {
    }
    public function attributes()
    {
        return
            [
                "name" => "Nama",
                "role" => "Role",
                "email" => "Email",
                "password" => "Password",
            ];
    }
    public function isAktif(Request $request)
    {
        $user = User::find($request->id);
        $user->is_aktif = $request->is_aktif;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
