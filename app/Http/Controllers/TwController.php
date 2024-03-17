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

class TwController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:triwulan_show', ['index', 'filter_tahun']);
    }
    public function index()
    {
        $filtertahun = 0;
        $pagu = DB::table('pagu')->get();
        $unit = Unit::all();
        $unit2 = Unit::all();
        $tabeltahun = DB::table('tahun')->get();
        $triwulan = DB::table('triwulan')->get();
        $tabelRole =  Role::all();

        return view(
            "pengaturan.triwulan.index",
            [
                'pagu' => $pagu, 'tabeltahun' => $tabeltahun, 'filtertahun' => $filtertahun,
                'unit' => $unit, 'unit2' => $unit2, 'triwulan' => $triwulan, 'tabelRole' => $tabelRole
            ]
        );
    }
    public function processAdd(Request $request)
    {
        $request->validate([]);
        $tahunDiPilih = Tahun::select('tahun')->where('id', $request->id_tahun)->first();
        $tahunDiPilih = (string) $tahunDiPilih->tahun;
        $namatw = $tahunDiPilih . "-" . $request->triwulan;
        $inserting = Triwulan::create([
            'id_tahun' => $request->id_tahun,
            'triwulan' => $namatw,
            'periode_awal' => $request->periode_awal,
            'periode_akhir' => $request->periode_akhir,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        // $inserting = DB::table('triwulan')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
        // return $namatw;
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);
        $tahunDiPilih = Tahun::select('tahun')->where('id', $request->id_tahun)->first();
        $tahunDiPilih = (string) $tahunDiPilih->tahun;
        $namatw = $tahunDiPilih . "-" . $request->triwulan;
        $process =  DB::table('triwulan')->where('id', $id)->update([
            'id_tahun' => $request->id_tahun,
            'triwulan' => $namatw,
            'periode_awal' => $request->periode_awal,
            'periode_akhir' => $request->periode_akhir,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
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
            $process =  DB::table('triwulan')->where('id', $id)->delete();
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
        $filtertahun = $request->tahun;
        $pagu = DB::table('pagu')->get();
        $unit = Unit::all();
        $unit2 = Unit::all();
        $tabeltahun = DB::table('tahun')->get();
        $tabelRole =  Role::all();

        if ($request->tahun == 0) {
            $triwulan = DB::table('triwulan')->get();
            redirect('/triwulan');
        }
        if (!empty($request->tahun)) {
            $triwulan = DB::table('triwulan')->where('id_tahun', 'LIKE', $filtertahun . '%')->get();
        }
        return view(
            "pengaturan.triwulan.index",
            [
                'pagu' => $pagu, 'tabeltahun' => $tabeltahun, 'filtertahun' => $filtertahun,
                'unit' => $unit, 'unit2' => $unit2, 'triwulan' => $triwulan, 'tabelRole' => $tabelRole
            ]
        );
    }
}
