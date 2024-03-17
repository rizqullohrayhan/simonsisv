<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Anggaran;
use App\Models\IKUModel;
use App\Models\IKModel;
use App\Models\SubKegiatan;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Pagu;
use App\Models\Triwulan;
use App\Models\TrxStatusKeu;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class MonitoringIKUController extends Controller
{

    private $filtertw = 0;
    private $filterTahun = 0;

    private function cekWulan()
    {
        $model = Tor::all();
        if (!isset($_REQUEST['filterTahun']) && !isset($_REQUEST['filterTw'])) {
            $tw = DB::table('triwulan')->where('periode_awal', '<=', date('Y-m-d'))->where('periode_akhir', '>=', date('Y-m-d'))->first() ?? Triwulan::OrderBy('id', 'desc')->first();
            $thn = DB::table('tahun')->where('tahun', date('Y'))->first() ?? DB::table('tahun')->OrderBy('id', 'desc')->first();
            $model = DB::table('tor')
                ->where('id_tw', $tw->id)
                ->where('tgl_mulai_pelaksanaan', 'LIKE',  date('Y') . '%')
                ->get();
            $this->filtertw = $tw->id;
            $this->filterTahun = $thn->id;
        }

        return $model;
    }

    public function index()
    {
        $tor = $this->cekWulan();

        $filtertw = $this->filtertw;
        $filterTahun = $this->filterTahun;

        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        $tabelRole =  Role::all(); //untuk menampilkan pilihan multi role di topbar
        if (Auth::user()->getroleNames()[0] == 'Kaprodi' || Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
            $ang_iku = DB::table('tor')
                ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                ->where('id_tw', $filtertw)
                ->where('id_unit', $unitUser)
                ->where('tgl_mulai_pelaksanaan', 'LIKE',  date('Y') . '%')
                ->get();
            $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                ->select('id_tor', 'id_status')
                ->get();
            $prodi = Unit::all()->where('id', $unitUser);
        } else {
            $ang_iku = DB::table('tor')
                ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                ->where('id_tw', $filtertw)
                ->where('tgl_mulai_pelaksanaan', 'LIKE',  date('Y') . '%')
                ->get();
            $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                ->select('id_tor', 'id_status')
                ->get();
            $prodi = Unit::all();
        }
        $pagus = Pagu::all();
        $subk = SubKegiatan::all();
        $iku = IKUModel::all();
        $ik = IKModel::all();
        $triwulan = Triwulan::all();
        $status = DB::table('status')->get();
        $tahun = DB::table('tahun')->get();
        return view(
            "perencanaan.monitoringIKU.index",
            compact(
                'tabelRole',
                'prodi',
                'pagus',
                'ang_iku',
                'subk',
                'iku',
                'ik',
                'pengajuan',
                'status',
                'triwulan',
                'tahun',
                'filtertw',
                'filterTahun'
            )
        );
        // return $filterTahun;
    }
    public function filter_tw(Request $request)
    {
        // $filtertw = $request->filterTw;
        $filtertw = base64_decode($request->filterTw);
        $filterTahun = base64_decode($request->filterTahun);
        // $tor = Tor::all();

        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        $tabelRole =  Role::all(); //untuk menampilkan pilihan multi role di topbar

        $subk = SubKegiatan::all();
        $iku = IKUModel::all();
        $ik = IKModel::all();
        $triwulan = Triwulan::all();
        $status = DB::table('status')->get();
        $tahun = DB::table('tahun')->get();

        $filterNamaTahun = DB::table('tahun')->select('tahun')->where('id', $filterTahun)->get();
        $filteridThn = DB::table('triwulan')->select('id_tahun')->where('id', $filtertw)->get();
        if ($filterTahun != 0 && $filtertw != 0) {
            if (Auth::user()->getroleNames()[0] == 'Kaprodi' || Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('id_tw', $filtertw)
                    ->where('id_unit', $unitUser)
                    ->where('tgl_mulai_pelaksanaan', 'LIKE',  date('Y') . '%')
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = DB::table('unit')->where('id', $unitUser)->get();
            } else {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('id_tw', $filtertw)
                    ->where('tgl_mulai_pelaksanaan', 'LIKE',  date('Y') . '%')
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = Unit::all();
            }
            $pagus = DB::table('pagu')
                ->where('id_tahun', $filterTahun)
                ->get();
        } elseif ($filterTahun != 0 && $filtertw == 0) {
            if (Auth::user()->getroleNames()[0] == 'Kaprodi' || Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('id_unit', $unitUser)
                    ->where('tgl_mulai_pelaksanaan', 'LIKE', $filterNamaTahun[0]->tahun . '%')
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = DB::table('unit')->where('id', $unitUser)->get();
            } else {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('tgl_mulai_pelaksanaan', 'LIKE', $filterNamaTahun[0]->tahun . '%')
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = Unit::all();
            }
            $pagus = DB::table('pagu')
                ->where('id_tahun', $filterTahun)
                ->get();
        } elseif ($filterTahun == 0 && $filtertw != 0) {
            if (Auth::user()->getroleNames()[0] == 'Kaprodi' || Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('id_tw', $filtertw)
                    ->where('id_unit', $unitUser)
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = DB::table('unit')->where('id', $unitUser)->get();
            } else {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('id_tw', $filtertw)
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = Unit::all();
            }
            $tor = DB::table('tor')->where('id_tw', $filtertw)->get();
            $pagus = DB::table('pagu')
                ->where('id_tahun', $filteridThn)
                ->get();
        } elseif ($filterTahun == 0 && $filtertw == 0) {
            if (Auth::user()->getroleNames()[0] == 'Kaprodi' || Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('tgl_mulai_pelaksanaan', 'LIKE', date('Y') . '%')
                    ->where('id_tw', $filtertw)
                    ->where('id_unit', $unitUser)
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = DB::table('unit')->where('id', $unitUser)->get();
            } else {
                $ang_iku = DB::table('tor')
                    ->select('id', 'nama_kegiatan', 'id_unit', 'id_subK', 'jumlah_anggaran', 'id_tw')
                    ->where('tgl_mulai_pelaksanaan', 'LIKE', date('Y') . '%')
                    ->where('id_tw', $filtertw)
                    ->get();
                $pengajuan = DB::table('trx_status_tor') //tor yg sudah diajukan
                    ->select('id_tor', 'id_status')
                    ->get();
                $prodi = Unit::all();
            }
            $pagus = DB::table('pagu')
                ->where('id_tahun', $filteridThn)
                ->get();
        }
        return view(
            "perencanaan.monitoringIKU.index",
            compact(
                'tabelRole',
                'prodi',
                'pagus',
                'ang_iku',
                'subk',
                'iku',
                'ik',
                'pengajuan',
                'status',
                'triwulan',
                'tahun',
                'filtertw',
                'filterTahun'
            )
        );
        // return $tor;
    }
}
