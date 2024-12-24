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
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function profil()
    {
        $unit = Unit::all();
        $role = Role::all();
        $namaroles = Role::all();
        $tabelRole =  Role::all();
        return view(
            "pengaturan.user.profile",
            ['unit' => $unit, 'role' => $role, 'namaroles' => $namaroles, 'tabelRole' => $tabelRole]
        );
    }

    public function editprofil(Request $request)
    {
        $request->validate([]);
        $fileprofil = DB::table('users')->select('image')->where('id', auth()->user()->id)->get();
        $nama_file = $fileprofil[0]->image;
        if ($request->has('file')) {
            File::delete('imageprofil/' . $fileprofil[0]->image);
            $file           = $request->file('file');
            $nama_file      = $file->getClientOriginalName();
            $file->move('imageprofil', $file->getClientOriginalName());
        }

        // $process =  DB::table('users')->where('id', $request->id)->update($request->except('_token', 'password'));
        $process = User::where('id', Auth()->user()->id)->update([
            'id_unit'  => Auth()->user()->id_unit,
            'name'  => $request->name,
            'email'  => $request->email,
            'role'  => Auth()->user()->role,
            'nip'  => $request->nip,
            'jabatan'  => $request->jabatan,
            'image'  => $nama_file,
        ]);
        if ($process) {
            return redirect()->back()->with("success", "Data berhasil diperbarui");
            // return $nama_file;
        } else {
            // return $request->all();
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
        // return $fileprofil[0]->image;
    }
    public function editpassword(Request $request, User $user)
    {

        // if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
        //     // The passwords matches
        //     // return redirect()->back()->with("error", "Your current password does not matches with the password.");
        //     return "tidak sama";
        // }
        // if ((Hash::check($request->get('current_password'), Auth::user()->password))) {
        //     // The passwords matches
        //     // return redirect()->back()->with("success", "matches");
        //     return "sama";
        // }

        // if (strcmp($request->current_password, $request->password) == 0) {
        //     // Current password and new password same
        //     return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        // }

        // $validatedData = $request->validate([
        //     'current-password' => 'required',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        // $user->save();

        return redirect()->back()->with("successPass", "Password successfully changed!");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ganti(Request $request) //beralih ke role lain
    {
        DB::table('users')->where('id', auth()->user()->id)->update(
            [
                'role' => $request->pilihrole
            ]
        );
        return redirect()->route(
            'home',
        );
    }
}
