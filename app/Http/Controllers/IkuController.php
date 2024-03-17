<?php

namespace App\Http\Controllers;

use App\Imports\IKUImport;
use App\Models\Anggaran;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class IkuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:iku_show', ['only' => 'index']);
        $this->middleware('permission:iku_create', ['only' => 'processAdd']);
        $this->middleware('permission:iku_update', ['only' => 'processUpdate']);
        $this->middleware('permission:iku_delete', ['only' => 'delete']);
    }
    public function index()
    {
        $filtertahun = 0;
        $iku = DB::table('indikator_iku')->get();
        $ik = DB::table('indikator_ik')->get();
        $k = DB::table('indikator_p')->get();
        // $subk = DB::table('indikator_subk')->get();
        $tabeltahun = DB::table('tahun')->get();
        $tabelRole =  Role::all();
        return view(
            "pengaturan.iku.index",
            [
                'iku' => $iku, 'ik' => $ik, 'k' => $k, 'tabeltahun' => $tabeltahun,
                'tabelRole' => $tabelRole
            ]
        );
        // return $iku;
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');
        // $nama_file = rand() . $file->getClientOriginalName();
        // $file->move('import/k',$nama_file);

        $import = Excel::import(new IKUImport, $file);

        if ($import) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withErrors("Terjadi kesalahan");
        }
    }
    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = DB::table('indikator_iku')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process =  DB::table('indikator_iku')->where('id', $id)->update($request->except('_token'));
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
            $process =  DB::table('indikator_iku')->where('id', $id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }
    public function filter_tahun(Request $request)
    {
    }
}
