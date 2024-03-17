<?php

namespace App\Http\Controllers;

use App\Models\SPJ;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\User as Usernya;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
        return view(
            "dashboards.users.index",
            [
                'userrole' => $userrole, 'tor' => $tor, 'trx_status_tor' => $trx_status_tor, 'prodi' => $prodi,
                'status' => $status, 'unit' => $unit, 'users' => $users, 'role' => $role, 'torAll' => $torAll,
                'dokMemo' => $dokMemo, 'trx_status_keu' => $trx_status_keu, 'status_keu' => $status_keu,
                'tw' => $tw, 'filtertw' => $filtertw, 'tahun' => $tahun, 'spj' => $spj, 'tabelRole' => $tabelRole
            ]
        );
    }

    public function datatable()
    {
        $data = [];
        $spj = SPJ::all();
        $prodi = DB::table('unit')->get();
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $tor = Tor::offset($start)->limit($length)->get();
        $totalRecord = Tor::all()->count();

        $no = $start + 1;
        for ($m = 0; $m < count($tor); $m++) {
            $realisasi = 0;
            $sisa = 0;
            $anggaran = $tor[$m]->jumlah_anggaran;

            $data[$m]['no'] = $no++;
            $data[$m]['nama_kegiatan'] = $tor[$m]->nama_kegiatan;
            for ($v = 0; $v < count($prodi); $v++) {
                if ($prodi[$v]->id == $tor[$m]->id_unit) {
                    $namaprodi = $prodi[$v]->nama_unit;
                    $data[$m]['namaprodi'] = $namaprodi;
                }
            }
            $data[$m]['nama_pic'] = $tor[$m]->nama_pic;
            $data[$m]['anggaran'] = 'Rp ' . number_format($anggaran);
            list($realisasi, $sisa) = 0;
            foreach ($spj as $nominal) :
                if ($tor[$m]->id == $nominal->id_tor) :
                    $realisasi = $nominal->nilai_total;
                    $sisa = $anggaran - $realisasi;
                endif;
            endforeach;
            $data[$m]['realisasi'] = 'Rp ' . number_format($realisasi);
            $data[$m]['sisa'] = 'Rp ' . number_format($sisa);
        }

        return datatables()::of($data)->skipPaging()->setTotalRecords($totalRecord)->tojson();
    }
}
