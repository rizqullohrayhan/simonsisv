<?php

namespace App\Http\Controllers;

use App\Models\SPJKategori;
use Illuminate\Http\Request;
use App\Models\SPJSubKategori;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SPJSubKategoriController extends Controller
{
    public function index()
    {
        $spj_kategori = SPJKategori::all();
        $spj_subkategori = SPJSubKategori::all();
        $tabelRole =  Role::all();
        return view(
            "pengaturan.spj_subkategori.index_spjsubkategori",
            [
                'spj_kategori' => $spj_kategori,
                'spj_subkategori' => $spj_subkategori,
                'tabelRole' => $tabelRole
            ]
        );
    }
    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = SPJSubKategori::create([
            'id_kategori' => $request->id_kategori,
            'nama_subkategori' => $request->nama_subkategori,
            'catatan' => $request->catatan,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process = DB::table('spj_subkategori')->where('id', $id)->update($request->except('_token'));
        if ($process) {
            return redirect()->back()->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
    {
        try {
            $process = DB::table('spj_subkategori')->where('id', $id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
