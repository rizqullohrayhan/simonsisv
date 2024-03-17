<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Tahun;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TahunController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tahun_show', ['index']);
    }
    public function index()
    {
        $filtertahun = 0;
        $tahun = DB::table('tahun')->get();
        $tabelRole =  Role::all();
        return view(
            "pengaturan.tahun.index",
            [
                'tahun' => $tahun,  'filtertahun' => $filtertahun, 'tabelRole' => $tabelRole
            ]
        );
    }
    public function isAktif(Request $request)
    {
        $tahun = Tahun::find($request->id);
        $tahun->is_aktif = $request->is_aktif;
        $tahun->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = DB::table('tahun')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process =  DB::table('tahun')->where('id', $id)->update($request->except('_token'));
        if ($process) {
            return redirect()->back()->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
    {
        $id = base64_decode($id);

        try {
            $process =  DB::table('tahun')->where('id', $id)->delete();
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
