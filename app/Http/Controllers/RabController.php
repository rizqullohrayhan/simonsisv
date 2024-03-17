<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\Anggaran;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Triwulan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RabController extends Controller
{
    protected $table = 'rab';
    public function __construct()
    {
        $this->middleware('permission:rab_create', ['only' => 'add']);
        $this->middleware('permission:rab_delete', ['edit', 'delete']);
        $this->middleware('permission:rab_update', ['only' => 'update']);
        $this->middleware('permission:rab_detail', ['only' => 'detail']);
    }
    // public function perencanaan()
    // {

    //     return view(
    //         "dashboards.users.xrab.xpengajuan.pengajuan"
    //     );
    // }

    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = Rab::create($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "RAB berhasil ditambahkan, Segera Lengkapi Data TOR & Anggaran");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }


    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process = Rab::findOrFail($id)->update($request->except('_token'));
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
            $process = Rab::findOrFail($id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }
    // public function detail($id)
    // {
    //     $userLogin = Auth()->user()->id;
    //     $unitUser = Auth()->user()->id_unit; //prodi mana?

    //     $idtor = DB::table('rab')->select('id_tor')->where('id', $id)->get(); // id tor di rab?
    //     $unitTor = DB::table('tor')->select('id_unit')->where('id', $idtor[0]->id_tor)->get();
    //     if ($unitUser !=  $unitTor[0]->id_unit && $unitUser !=  1) { //$unitUser 1 adalah sekolah vokasi
    //         abort(403);
    //     }
    //     $id = $id;
    //     $rab = DB::table('rab')->get();
    //     $tor = Tor::all();
    //     $anggaran = DB::table('anggaran')->get();
    //     $status = DB::table('status')->get();
    //     $unit = Unit::all();
    //     $unit2 = Unit::all();
    //     $userrole = User::join();
    //     $user = User::all();
    //     $detail_mak = DB::table('detail_mak')->get();
    //     $subkeg = DB::table('indikator_subK')->get();
    //     $rab_ang = Anggaran::Rab_Ang();
    //     $mak = DB::table('mak')->get();
    //     $trx_status_tor = DB::table('trx_status_tor')->get();
    //     return view(
    //         "perencanaan.rab.lengkapirab",
    //         [
    //             'id' => $id, 'tor' => $tor, 'unit' => $unit, 'unit2' => $unit2,  'userrole' => $userrole,  'detail_mak' => $detail_mak,
    //             'rab' => $rab, 'anggaran' => $anggaran, 'subkeg' => $subkeg,  'rab_ang' => $rab_ang,
    //             'user' => $user,  'status' => $status, 'mak' => $mak, 'trx_status_tor' => $trx_status_tor
    //         ]
    //     );
    //     // return $totalpertw;
    //     // return  $unitTor;
    // }
}
