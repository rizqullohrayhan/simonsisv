<?php

namespace App\Http\Controllers;

use App\Models\SPJKategori;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SPJKategoriController extends Controller
{
    public function index()
    {
        $spj_kategori = SPJKategori::all();
        $role = Role::all();
        $tabelRole =  Role::all();
        return view(
            "pengaturan.spj_kategori.index_spjkategori",
            [
                'spj_kategori' => $spj_kategori,
                'role' => $role, 'tabelRole' => $tabelRole
            ]
        );
    }
    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = new SPJKategori();
        $inserting->nama_kategori = $request->nama_kategori;
        $inserting->save();
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process = DB::table('spj_kategori')->where('id', $id)->update($request->except('_token'));
        if ($process) {
            return redirect()->back()->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
    {
        try {
            $process = DB::table('spj_kategori')->where('id', $id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
        // return $id;
    }
}
