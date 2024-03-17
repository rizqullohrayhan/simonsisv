<?php

namespace App\Http\Controllers;

use App\Exports\MultiExport;
use App\Models\Rab;
use App\Models\Anggaran;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Triwulan;
use App\Models\User;
use App\Models\SubKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Facades\Excel;
// use PDF;
use Dompdf\Dompdf;
use Excel;
use App\Exports\TORExport;

class ValidasiController extends Controller
{
    // protected $table = 'tor';
    public function __construct()
    {
        $this->middleware('permission:ajuan_validasi', ['only' => 'index']);
        $this->middleware('permission:tor_verifikasi', ['only' => 'verifKegiatan']);
        $this->middleware('permission:tor_validasi', ['only' => 'validKegiatan']);
    }
    public function index()
    {
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        $role = DB::table('roles')->get();

        // if ($roleUser ==  2) {
        //     abort(403);
        // }

        $unit = Unit::all();
        $rab = Rab::all();
        $tabelanggaran = Anggaran::all();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $tor = DB::table('tor')->get();
        $user = DB::table('users')->get();
        $triwulan = DB::table('triwulan')->get();
        $torStatic = new Tor();
        $notifikasiTor = $torStatic->notifikasi();
        $tabelRole =  Role::all();

        return view(
            "perencanaan.validasi.index",
            [
                'unit' => $unit, 'rab' => $rab, 'tabelanggaran' => $tabelanggaran, 'trx_status_tor' => $trx_status_tor,
                'status' => $status, 'tor' => $tor, 'triwulan' => $triwulan, 'notifikasiTor' => $notifikasiTor,
                'role' => $role, 'user' => $user, 'tabelRole' => $tabelRole
            ]
        );
        // return $notifikasi;
    }
    public function ajuan($prodi)
    {
        $prodi = base64_decode($prodi);
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        // if (Auth::user()->getroleNames() == 'Prodi' || Auth::user()->getroleNames() == 'PIC') {
        //     abort(403);
        // }
        $filterTahun = (DB::table('tahun')->where('tahun', date('Y'))->first() ?? DB::table('tahun')->OrderBy('id', 'desc')->first())->id;
        $filtertw = (DB::table('triwulan')->where('periode_awal', '<=', date('Y-m-d'))->where('periode_akhir', '>=', date('Y-m-d'))->first() ?? DB::table('triwulan')->OrderBy('id', 'desc')->first())->id;

        if ($prodi != 0) {
            $join = DB::table('tor')
                ->where('id_unit', $prodi)
                ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
                ->join('status', 'trx_status_tor.id_status', '=', 'status.id')
                ->where('status.nama_status', "Proses Pengajuan")
                ->where('tor.id_tw', $filtertw)
                ->select('tor.id as tor_id', 'trx_status_tor.id as trx_id', 'tor.*', 'trx_status_tor.*')->get();
        }
        if ($prodi == 0) {
            $join = DB::table('tor')
                ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
                ->join('status', 'trx_status_tor.id_status', '=', 'status.id')
                ->join('triwulan', 'tor.id_tw', '=', 'triwulan.id')
                ->where('status.nama_status', "Proses Pengajuan")
                ->where('tor.id_tw', $filtertw)
                ->select('tor.id as tor_id', 'trx_status_tor.id as trx_id', 'tor.*', 'trx_status_tor.*', 'triwulan.triwulan')->get();
        }
        $ajuanTW =  DB::table('tor')
            ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
            ->join('triwulan', 'tor.id_tw', '=', 'triwulan.id')
            ->where('tor.id_tw', $filtertw)
            ->select('tor.id as tor_id', 'trx_status_tor.id as trx_id', 'tor.*', 'trx_status_tor.*', 'triwulan.triwulan')->get();
        $filterprodi = $prodi;
        $unit = Unit::all();
        $unit2 = Unit::all();
        $userrole = $userStatic->join();
        $user = User::all();
        $tw = Triwulan::all();
        $tw2 = Triwulan::all();
        $rab = Rab::all();
        $anggaran = $anggaranStatic->Rab_Ang();
        $totalpertw = $anggaranStatic->total_anggaran_tw();
        $detail_mak = DB::table('detail_mak')->get();
        // $tahun = DB::table('tor')->get();
        $tabeltor = DB::table('tor')->get();
        $role = DB::table('roles')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodipilih = $prodi;
        $tabeltahun = DB::table('tahun')->get();
        $triwulan = DB::table('triwulan')->get();
        $tabelRole =  Role::all();
        return view(
            "perencanaan.validasi.ajuan3",
            [
                'tabeltor' => $tabeltor, 'join' => $join, 'unit' => $unit, 'unit2' => $unit2, 'tw' => $tw, 'tw2' => $tw2, 'userrole' => $userrole, 'rab' => $rab, 'anggaran' => $anggaran, 'detail_mak' => $detail_mak,
                'totalpertw' => $totalpertw, 'trx_status_tor' => $trx_status_tor, 'status' => $status, 'filterTahun' => $filterTahun, 'triwulan' => $triwulan,
                'prodi' => $prodipilih, 'tabeltahun' => $tabeltahun, 'user' => $user, 'role' => $role, 'ajuanTW' => $ajuanTW, 'filtertw' => $filtertw, 'filterprodi' => $filterprodi,
                'tabelRole' => $tabelRole
            ]
        );
        // return Auth::user()->getroleNames();
    }
    public function verifTor(Request $request)
    {
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        if (Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
            abort(403);
        }
        $request->validate([]);

        $inserting = DB::table('trx_status_tor')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function pengajuanProdi(Request $request)
    {
        $request->validate([]);

        $inserting = DB::table('trx_status_tor')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }
    public function validTor(Request $request)
    {
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        if (Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
            abort(403);
        }

        $request->validate([]);

        $inserting = DB::table('trx_status_tor')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function detail($id) //DETAIL TOR
    {
        $id = base64_decode($id);
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        if (Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
            abort(403);
        }

        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        $subKegiatanStatic = new SubKegiatan();

        $tor = Tor::all();
        $unit = Unit::all();
        $unit2 = Unit::all();
        $rab = DB::table('rab')->get();
        $userrole = $userStatic->join();
        $tw = Triwulan::all();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $belanja_mak = DB::table('belanja_mak')->get();
        $detail_mak = DB::table('detail_mak')->get();
        $status = DB::table('status')->get();
        $roles = DB::table('roles')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $pagu = DB::table('pagu')->get();
        $subkeg = DB::table('indikator_subK')->get();
        $kategori_subK =  $subKegiatanStatic->Kategori_Sub();
        $komponen_jadwal = DB::table('komponen_jadwal')->get();
        $indikator_iku = DB::table('indikator_iku')->get();
        $users = User::all();
        $anggaran = DB::table('anggaran')->get();
        $subkeg = DB::table('indikator_subK')->get();
        $rab_ang = $anggaranStatic->Rab_Ang();
        $tabelRole =  Role::all();
        return view(
            "perencanaan.validasi.detail_tor",
            [
                'tor' => $tor, 'rab' => $rab, 'unit' => $unit, 'unit2' => $unit2, 'tw' => $tw, 'userrole' => $userrole,
                'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'detail_mak' => $detail_mak,
                'status' => $status, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu, 'subkeg' => $subkeg,
                'kategori_subK' => $kategori_subK, 'komponen_jadwal' => $komponen_jadwal, 'users' => $users,
                'indikator_iku' => $indikator_iku, 'id' => $id, 'trx_status_tor' => $trx_status_tor, 'roles' => $roles,
                'anggaran' => $anggaran, 'subkeg' => $subkeg,  'rab_ang' => $rab_ang, 'detail_mak' => $detail_mak,
                'tabelRole' => $tabelRole, 'id' => $id
            ]
        );
    }
    public function detailRab($id)
    {
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        if (Auth::user()->getroleNames() == 'Prodi' || Auth::user()->getroleNames() == 'PIC') {
            abort(403);
        }

        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        $subKegiatanStatic = new SubKegiatan();

        $id = $id;
        $rab = DB::table('rab')->get();
        $tor = Tor::all();
        $anggaran = DB::table('anggaran')->get();
        $status = DB::table('status')->get();
        $unit = Unit::all();
        $unit2 = Unit::all();
        $userrole = $userStatic->join();
        $user = User::all();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $belanja_mak = DB::table('belanja_mak')->get();
        $detail_mak = DB::table('detail_mak')->get();
        $subkeg = DB::table('indikator_subK')->get();
        $rab_ang = $anggaranStatic->Rab_Ang();
        return view(
            "perencanaan.validasi.detail_rab",
            [
                'id' => $id, 'tor' => $tor, 'unit' => $unit, 'unit2' => $unit2,  'userrole' => $userrole,
                'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'detail_mak' => $detail_mak,
                'rab' => $rab, 'anggaran' => $anggaran, 'subkeg' => $subkeg,  'rab_ang' => $rab_ang,
                'user' => $user, 'status' => $status
            ]
        );
        // return $totalpertw;
    }

    public function filter_tahun(Request $request)
    {
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        if (Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
            abort(403);
        }

        $filterprodi = base64_decode($request->prodi);
        $filterTw =  base64_decode($request->filterTw);
        $filterTahun =  base64_decode($request->filterTahun);
        $filterNamaTw = DB::table('triwulan')->select('triwulan')->where('id', $filterTw)->get();
        $filterNamaTahun = DB::table('tahun')->select('tahun')->where('id', $filterTahun)->get();

        if ($filterprodi == 0) {
            if ($filterTw == 0 && $filterTahun == 0) {
                redirect('back');
            }
            if ($filterTw != 0 && $filterTahun != 0) {
                // $tor = DB::table('tor')->where('tgl_mulai_pelaksanaan', 'LIKE', $request->tahun . '%')->simplepaginate(3);
                $join = DB::table('tor')
                    ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
                    ->join('triwulan', 'tor.id_tw', '=', 'triwulan.id')
                    ->join('status', 'trx_status_tor.id_status', '=', 'status.id')
                    ->select('tor.id as tor_id', 'trx_status_tor.id as trx_id', 'tor.*', 'trx_status_tor.*', 'triwulan.triwulan')
                    ->where('status.nama_status', "Proses Pengajuan")
                    ->where('triwulan.triwulan', 'LIKE', $filterNamaTw[0]->triwulan)
                    ->get();
            }
            if ($filterTw == 0 && $filterTahun != 0) {
                $join = DB::table('tor')
                    ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
                    ->join('triwulan', 'tor.id_tw', '=', 'triwulan.id')
                    ->join('status', 'trx_status_tor.id_status', '=', 'status.id')
                    ->select('tor.id as tor_id', 'trx_status_tor.id as trx_id', 'tor.*', 'trx_status_tor.*', 'triwulan.triwulan')
                    ->where('status.nama_status', "Proses Pengajuan")
                    ->where('tgl_mulai_pelaksanaan', 'LIKE', $filterNamaTahun[0]->tahun . '%')
                    ->get();
            }
        } elseif ($filterprodi != 0) {
            if ($filterTw == 0 && $filterTahun == 0) {
                redirect('back');
            }
            if ($filterTw != 0 && $filterTahun != 0) {
                // $tor = DB::table('tor')->where('tgl_mulai_pelaksanaan', 'LIKE', $request->tahun . '%')->simplepaginate(3);
                $join = DB::table('tor')
                    ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
                    ->join('triwulan', 'tor.id_tw', '=', 'triwulan.id')
                    ->join('status', 'trx_status_tor.id_status', '=', 'status.id')
                    ->select('tor.id as tor_id', 'trx_status_tor.id as trx_id', 'tor.*', 'trx_status_tor.*', 'triwulan.triwulan')
                    ->where('status.nama_status', "Proses Pengajuan")
                    ->where('id_unit', $filterprodi)
                    ->where('triwulan.triwulan', 'LIKE', $filterNamaTw[0]->triwulan)
                    ->get();
            }
            if ($filterTw == 0 && $filterTahun != 0) {
                $join = DB::table('tor')
                    ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
                    ->join('triwulan', 'tor.id_tw', '=', 'triwulan.id')
                    ->join('status', 'trx_status_tor.id_status', '=', 'status.id')
                    ->select('tor.id as tor_id', 'trx_status_tor.id as trx_id', 'tor.*', 'trx_status_tor.*', 'triwulan.triwulan')
                    ->where('status.nama_status', "Proses Pengajuan")
                    ->where('id_unit', $filterprodi)
                    ->where('tgl_mulai_pelaksanaan', 'LIKE', $filterNamaTahun[0]->tahun . '%')
                    ->get();
            }
        }

        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        $subKegiatanStatic = new SubKegiatan();

        $unit = Unit::all();
        $unit2 = Unit::all();
        $userrole = $userStatic->join();
        $user = User::all();
        $role = DB::table('roles')->get();
        $tw = Triwulan::all();
        $tw2 = Triwulan::all();
        $rab = Rab::all();
        $anggaran =  $anggaranStatic->Rab_Ang();
        $tabeltor = DB::table('tor')->get();
        $totalpertw = $anggaranStatic->total_anggaran_tw();
        $detail_mak = DB::table('detail_mak')->get();
        $tabeltahun = DB::table('tahun')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $triwulan = DB::table('triwulan')->get();
        $tabelRole =  Role::all();
        return view(
            "perencanaan.validasi.ajuan3",
            [
                'tabeltor' => $tabeltor, 'unit' => $unit, 'unit2' => $unit2, 'tw' => $tw, 'tw2' => $tw2, 'userrole' => $userrole, 'rab' => $rab, 'anggaran' => $anggaran, 'detail_mak' => $detail_mak,
                'totalpertw' => $totalpertw, 'trx_status_tor' => $trx_status_tor, 'status' => $status,  'filterprodi' => $filterprodi, 'filterTahun' => $filterTahun,
                'tabeltahun' => $tabeltahun, 'join' => $join, 'user' => $user, 'role' => $role, 'filtertw' => $filterTw, 'triwulan' => $triwulan, 'tabelRole' => $tabelRole
            ]
        );
        // return $join;
    }

    // Generate PDF
    public function createPDF($id)
    {
        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        $subKegiatanStatic = new SubKegiatan();

        $id = base64_decode($id);;
        // $tor = Tor::all();
        $tor = Tor::findOrFail($id);
        $judulTOR =  DB::table('tor')->select('nama_kegiatan')->where('id', $id)->get();
        $judulTOR2 = $judulTOR[0]->nama_kegiatan;
        $unit = Unit::where('id', Auth::user()->id_unit)->first();
        $unit2 = Unit::all();
        $rab = DB::table('rab')->where('id_tor', $id)->first();
        $userrole = $userStatic->join();
        $tw = Triwulan::all();
        $belanja_mak = DB::table('belanja_mak')->get();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $detail_mak = DB::table('detail_mak')->get();
        // $tahun = DB::table('tor')->get();
        $status = DB::table('status')->get();
        $roles = DB::table('roles')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $pagu = DB::table('pagu')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        // $kategori_subK =  $subKegiatanStatic->Kategori_Sub();
        $indikator_p = DB::table('indikator_p')
            ->select(
                'tor.id as id_tor',
                // 'indikator_subK.*',
                'indikator_p.*',
                // 'indikator_p.deskripsi as deskripsi_p',
                'indikator_ik.IK',
                'indikator_ik.deskripsi as deskripsi_ik',
                'indikator_iku.IKU',
                'indikator_iku.deskripsi as deskripsi_iku',
            )
            ->where('indikator_p.id', $tor->id_p)
            ->rightJoin('tor', 'indikator_p.id', '=', 'tor.id_p')
            ->leftjoin('indikator_ik', 'indikator_p.id_ik', '=', 'indikator_ik.id')
            ->leftjoin('indikator_iku', 'indikator_ik.id_iku', '=', 'indikator_iku.id')
            ->first();
        $komponen_jadwal = DB::table('komponen_jadwal')->get();
        $indikator_iku = DB::table('indikator_iku')->get();
        $users = DB::table('users')->get();
        $anggaran = DB::table('anggaran')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        $rab_ang = $anggaranStatic->Rab_Ang();
        $tabelRole =  Role::all();
        $data =
            [
                'tor' => $tor, 'rab' => $rab, 'unit' => $unit, 'unit2' => $unit2, 'tw' => $tw, 'userrole' => $userrole,
                'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'detail_mak' => $detail_mak,
                'status' => $status, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu,
                'indikator_p' => $indikator_p, 'komponen_jadwal' => $komponen_jadwal, 'users' => $users,
                'indikator_iku' => $indikator_iku, 'id' => $id, 'trx_status_tor' => $trx_status_tor, 'roles' => $roles,
                'anggaran' => $anggaran, 'rab_ang' => $rab_ang, 'tabelRole' => $tabelRole, 'id' => $id
            ];

        // return view(
        //     "perencanaan.validasi.printPDF",
        //     $data
        // );
        $datas =  view(
            "perencanaan.validasi.printPDF",
            $data
        );
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($datas);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream("TOR & RAB" . " - " . $judulTOR2 . " - " . date('Y-m-d_H-i-s') . ".pdf");
        // return $judulTOR[0]->nama_kegiatan;
    }

    function createExcel($id)
    {
        $ids = base64_decode($id);;

        $judulTOR =  DB::table('tor')->select('nama_kegiatan')->where('id', $ids)->get();
        $judulTOR2 = $judulTOR[0]->nama_kegiatan;
        $nama_file = 'TOR & RAB'  . " - " . $judulTOR2 . " - " . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new MultiExport($id), $nama_file);
    }
}
