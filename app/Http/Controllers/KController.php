<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Imports\Indikator_kImport;
use Maatwebsite\Excel\Facades\Excel;

class KController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:k_show', ['only' => 'index']);
        $this->middleware('permission:k_create', ['only' => 'processAdd']);
        $this->middleware('permission:k_update', ['only' => 'processUpdate']);
        $this->middleware('permission:k_delete', ['only' => 'delete']);
    }
    public function index()
    {
        $filtertahun = 0;
        $iku = DB::table('indikator_iku')->get();
        $ik = DB::table('indikator_ik')->get();
        $k = DB::table('indikator_p')
            ->select('indikator_iku.IKU', 'indikator_ik.IK', 'indikator_p.*')
            ->leftJoin('indikator_ik', 'indikator_p.id_ik', '=', 'indikator_ik.id')
            ->leftJoin('indikator_iku', 'indikator_ik.id_iku', '=', 'indikator_iku.id')
            ->orderBy('indikator_iku.IKU')
            ->orderBy('indikator_ik.IK')
            ->orderBy('indikator_p.P')
            ->get();
        // $subk = DB::table('indikator_subk')->get();
        // $tabeltahun = DB::table('tahun')->get();
        $tabelRole =  Role::all();
        return view(
            "pengaturan.iku.k.index",
            [
                'iku' => $iku,
                'ik' => $ik,
                'k' => $k,
                // 'tabeltahun' => $tabeltahun,
                'tabelRole' => $tabelRole
            ]
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');
        // $nama_file = rand() . $file->getClientOriginalName();
        // $file->move('import/k',$nama_file);

        $import = Excel::import(new Indikator_kImport, $file);

        if ($import) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = DB::table('indikator_k')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process =  DB::table('indikator_k')->where('id', $id)->update($request->except('_token'));
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
            $process =  DB::table('indikator_k')->where('id', $id)->delete();
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
