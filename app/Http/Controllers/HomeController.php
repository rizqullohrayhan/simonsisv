<?php

namespace App\Http\Controllers;

use App\Models\SPJ;
use App\Models\Tahun;
use App\Models\Tor;
use App\Models\Triwulan;
use App\Models\TrxStatusTor;
use App\Models\Unit;
use App\Models\User as Usernya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rolenm = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $rolenm->name;
        $user = Usernya::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $unit = Unit::all();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $tabelRole =  Role::all();
        $tw = DB::table('triwulan')->get();
        $tahun = DB::table('tahun')->get();
        $dokMemo = DB::table('dokumen')->get();
        $trx_status_keu = DB::table('trx_status_keu')->get();
        $status_keu = DB::table('status_keu')->get();
        $filtertw = 0;
        $spj = SPJ::all();
        $usernya = new Usernya();
        $userrole = $usernya->join();
        $tor = Tor::limit(1)->get();
        $torAll = Tor::all();

        $idTorDiSetujui = TrxStatusTor::where('id_status', '4')->get();
        $ajuans = [];
        foreach ($idTorDiSetujui as $id) {
            $ajuans[] = $id['id_tor'];
        }
        $torDiSetujui = Tor::whereIn('id', $ajuans)->get();

        $ajuan = Tor::where('validator', Auth::user()->role)->get();
        $ajuans = [];
        foreach ($ajuan as $id) {
            $ajuans[] = $id['id'];
        }
        // dd($ajuan);
        $filter = TrxStatusTor::selectRaw('id_tor, MAX(id_status) AS status')->whereIn('id_tor', $ajuans)->groupBy('id_tor')->get();
        $ajuan_belum_dinilai = $filter->where('status', '1')->count();
        $ajuan_revisi = $filter->where('status', '2')->count();
        $ajuan_sudah_revisi = $filter->where('status', '3')->count();
        $ajuan_sudah_dinilai = $filter->where('status', '4')->count();
        // $status = DB::table('status')->where('id', $id_status)->first()->nama_status;

        return view(
            "dashboards.users.index",
            [
                'userrole' => $userrole, 'tor' => $tor, 'trx_status_tor' => $trx_status_tor, 'prodi' => $prodi,
                'status' => $status, 'unit' => $unit, 'users' => $users, 'role' => $role, 'torAll' => $torAll,
                'dokMemo' => $dokMemo, 'trx_status_keu' => $trx_status_keu, 'status_keu' => $status_keu,
                'tw' => $tw, 'filtertw' => $filtertw, 'tahun' => $tahun, 'spj' => $spj, 'tabelRole' => $tabelRole,
                // ''
                'belum_dinilai' => $ajuan_belum_dinilai, 'revisi' => $ajuan_revisi, 'sudah_revisi' => $ajuan_sudah_revisi,
                'sudah_dinilai' => $ajuan_sudah_dinilai, 'torDiSetujui' => $torDiSetujui,
            ]
        );
    }

    public function getTriwulan(Request $request) {
        $idTahun = base64_decode($request->id);
        $triwulan = Triwulan::where('id_tahun', $idTahun)->orderBy('triwulan')->get();

        return response()->json($triwulan, 200);
    }

    public function getData(Request $request) {
        $idTahun = base64_decode($request->id_tahun);
        $idTriwulan = $request->id_triwulan;

        $tahun = Tahun::find($idTahun)->tahun;

        $ajuan = Tor::where('validator', Auth::user()->role)->get();
        $ajuans = [];
        foreach ($ajuan as $id) {
            $ajuans[] = $id['id'];
        }
        // dd($ajuan);
        $filter = TrxStatusTor::selectRaw('id_tor, MAX(id_status) AS status')->whereIn('id_tor', $ajuans)->groupBy('id_tor')->get();
        $ajuan_belum_dinilai = $filter->where('status', '1')->count();
        $ajuan_revisi = $filter->where('status', '2')->count();
        $ajuan_sudah_revisi = $filter->where('status', '3')->count();
        $ajuan_sudah_dinilai = $filter->where('status', '4')->count();

        $data = [
            'belum_dinilai' => $ajuan_belum_dinilai,
            'revisi' => $ajuan_revisi,
            'sudah_revisi' => $ajuan_sudah_revisi,
            'sudah_dinilai' => $ajuan_sudah_dinilai,
        ];

        return response()->json($data, 200);
    }

    public function datatable(Request $request)
    {
        $idTahun = base64_decode($request->tahun);
        $idTriwulan = $request->triwulan;
        $tahun = Tahun::find($idTahun)->tahun;

        if (Auth::user()->role == '2') {
            $tor = Tor::with('unit', 'pic', 'statusMany', 'validator')->where('id_unit', Auth::user()->id_unit)->whereYear('tgl_mulai_pelaksanaan', $tahun);
        } else {
            $tor = Tor::with('unit', 'pic', 'statusMany', 'validator')->whereYear('tgl_mulai_pelaksanaan', $tahun);
        }

        if ($idTriwulan != '0') {
            $tor = $tor->where('id_tw', $idTriwulan);
        }
        $tor = $tor->get();

        return DataTables::of($tor)
        ->addIndexColumn()
        ->editColumn('nama_kegiatan', function ($row){
            return wordwrap($row->nama_kegiatan,20,"<br>");
        })
        ->addColumn('nama_unit', function ($row){
            return wordwrap($row->unit->nama_unit,20,"<br>");
        })
        ->addColumn('tgl_ajuan', function ($row){
            return Carbon::parse($row->created_at)->translatedFormat('d F Y');
        })
        ->addColumn('nama_pic', function ($row){
            return wordwrap($row->pic->name,20,"<br>");
        })
        ->addColumn('current_status', function ($row) {
            $jumlahstatus = count($row->statusMany);
            $current_status = $row->statusMany[$jumlahstatus-1]->nama_status;
            return $current_status .
                    '<button class="badge badge-info btn-detail" data-id="' . base64_encode($row->id) . '">
                    <i class="fa fa-tasks"></i>
                </button>';
        })
        ->addColumn('id_status', function ($row) {
            $jumlahstatus = count($row->statusMany);
            return $row->statusMany[$jumlahstatus-1]->id;
        })
        ->rawColumns(['nama_kegiatan', 'nama_unit', 'tgl_ajuan', 'nama_pic', 'current_status'])
        ->toJson();
    }
}
