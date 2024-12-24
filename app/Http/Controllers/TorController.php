<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Kaprodi;
use App\Models\Pagu;
use App\Models\Pedoman;
use App\Models\PIC;
use App\Models\SubKegiatan;
use App\Models\Tahun;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Triwulan;
use App\Models\User;
use App\Models\TrxStatusTor;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use TrxStatusKeu;
use Spatie\Permission\Models\Role;

class TorController extends Controller
{
    protected $table = 'tor';
    public function __construct()
    {
        $this->middleware('permission:tor_create', ['add', 'pengajuan2', 'createJadwal', 'updateJadwal', 'deleteJadwal']);
        $this->middleware('permission:tor_delete', ['only' => 'delete']);
        $this->middleware('permission:tor_update', ['only' => 'update']);
    }
    public function stepPengajuan()
    {
        if (auth()->user()->id_unit != 1) {
            $tor = Tor::where('id_unit', auth()->user()->id_unit)
                // ->where('tgl_pelaksanaan', 'LIKE', date('Y') . '%')
                ->simplepaginate(3);
        }
        if (auth()->user()->id_unit == 1) {
            $tor = DB::table('tor')->simplepaginate(3);
            // $tor = Tor::where('tgl_pelaksanaan', 'LIKE', date('Y') . '%')
            //     ->simplepaginate(3);
        }
        $data = 0;
        $filtertahun = date('Y');
        $filterprodi = 0;
        $unit = Unit::all();
        $user = new User();
        $userrole = $user->join();
        $tw = Triwulan::all();
        // $tahun = DB::table('tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $pagu = DB::table('pagu')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        $indikator_p = DB::table('indikator_p')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $roles2 = DB::table('roles')->get();
        $PIC = DB::table('pics')->where('id_unit', Auth::user()->id_unit)->get();
        $tabelRole =  Role::all();

        return view(
            "perencanaan.tor.stepPengajuan",
            [
                'tor' => $tor, 'unit' => $unit, 'tw' => $tw, 'userrole' => $userrole,
                'filtertahun' => $filtertahun, 'data' => $data, 'indikator_p' => $indikator_p,
                'filterprodi' => $filterprodi, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu,
                'users' => $users, 'roles' => $roles, 'roles2' => $roles2, 'pics' => $PIC, 'tabelRole' => $tabelRole
            ]
        );
        // return $PIC;
    }
    public function pengajuan2(Request $request)
    {
        $filtertahun = ($request->tahun) ? $request->tahun : date('Y');
        $filterprodi = 0;
        if (auth()->user()->id_unit != 1) {
            // $tor = Tor::where('id_unit', auth()->user()->id_unit)->simplePaginate(3);
            $torcount = Tor::where('tgl_mulai_pelaksanaan', 'LIKE',  $filtertahun . '%')
                ->where('id_unit', auth()->user()->id_unit)
                ->get();
            if ($torcount->count() % 2 == 0) {
                $h = 4;
            }
            if ($torcount->count() % 2 != 0) {
                $h = 6;
            }
            $tor = DB::table('tor')
                ->where('tgl_mulai_pelaksanaan', 'LIKE',  $filtertahun . '%')
                ->where('id_unit', auth()->user()->id_unit)
                ->orderBy('created_at', 'desc')->cursorPaginate($h);
            // ->where('tgl_pelaksanaan', 'LIKE', date('Y') . '%')
            // ->simplepaginate(3);
        }
        if (auth()->user()->id_unit == 1) {
            // $tor = Tor::where('tgl_pelaksanaan', 'LIKE', date('Y') . '%')
            $tor = Tor::orderBy('created_at', 'desc')->simplePaginate(3);
        }

        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        $subKegiatanStatic = new SubKegiatan();

        $rab = DB::table('rab')->get();
        $role = DB::table('roles')->get();
        $mak = DB::table('mak')->get();
        $anggaran = DB::table('anggaran')->get();
        $unit = Unit::all();
        $unit2 = Unit::all();
        $userrole = $userStatic->join();
        $user = User::all();
        $tw = Triwulan::all();
        $tw2 = Triwulan::all();
        $detail_mak = DB::table('detail_mak')->get();
        $tahun = DB::table('tor')->get();
        $tabeltahun = DB::table('tahun')->get();

        $idtahun = DB::table('tahun')->select('id')->where('tahun', date('Y'))->first() ?? DB::table('tahun')->select('id')->OrderBy('id', 'desc')->first();
        // dd($idtahun);
        $pagu = DB::table('pagu')->where('id_tahun', 'LIKE', $idtahun->id . '%')->get();
        $filterpagu = $idtahun->id;

        // $subkeg = DB::table('indikator_subK')->get();
        $indikator_p = DB::table('indikator_p')->get();
        $rab_ang = $anggaranStatic->Rab_Ang();
        $totalpertw = $anggaranStatic->total_anggaran_tw();
        $status = DB::table('status')->get();
        $status_keu = DB::table('status_keu')->get();
        // $kategori_subK =  $subKegiatanStatic->Kategori_Sub();
        $komponen_jadwal = DB::table('komponen_jadwal')->get();
        $indikator_iku = DB::table('indikator_iku')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $trx_status_keu = DB::table('trx_status_keu')->get();
        $pedoman = Pedoman::all();
        $tabelRole =  Role::all();

        // return $filterpagu[0]->id;
        return view(
            "perencanaan.tor.torab",
            [
                'tor' => $tor, 'unit' => $unit, 'unit2' => $unit2, 'tw' => $tw, 'tw2' => $tw2, 'userrole' => $userrole,  'detail_mak' => $detail_mak,
                'tahun' => $tahun,  'filtertahun' => $filtertahun, 'rab' => $rab, 'mak' => $mak, 'anggaran' => $anggaran,
                'filterprodi' => $filterprodi, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu,
                'rab_ang' => $rab_ang, 'totalpertw' => $totalpertw, 'user' => $user, 'status' => $status,
                'komponen_jadwal' => $komponen_jadwal, 'filterpagu' => $filterpagu,
                'indikator_iku' => $indikator_iku, 'trx_status_tor' => $trx_status_tor, 'role' => $role,
                'status_keu' => $status_keu, 'trx_status_keu' => $trx_status_keu, 'indikator_p' => $indikator_p, 'pedoman' => $pedoman,
                'tabelRole' => $tabelRole
            ]
        );
        // return $totalpertw;
    }
    public function lengkapitor($id) //DETAIL TOR
    {
        $id = base64_decode($id);
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?

        $unitTor = DB::table('tor')->select('id_unit')->where('id', $id)->get();
        if ($unitUser !=  $unitTor[0]->id_unit && $unitUser !=  1) {
            abort(403);
        }

        $userStatic = new User();
        $subKegiatanStatic = new SubKegiatan();

        // $tor = Tor::all();
        $tor = Tor::findOrFail($id);
        $unit = Unit::all();
        $namaunit = Unit::findOrFail($tor->id_unit);
        $rab = DB::table('rab')->where('id_tor', $id)->first();
        $mak = DB::table('mak')->get();
        $userrole = $userStatic->join();
        $tw = Triwulan::all();
        $detail_mak = DB::table('detail_mak')->get();
        $belanja_mak = DB::table('belanja_mak')->get();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $status = DB::table('status')->get();
        $roles = DB::table('roles')->get();
        $trx_status_tor = DB::table('trx_status_tor')->where('id_tor', $id)->get();
        $tabeltahun = DB::table('tahun')->get();
        $pagu = DB::table('pagu')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        // $kategori_subK =  $subKegiatanStatic->Kategori_Sub();
        $komponen_jadwal = DB::table('komponen_jadwal')->where('id_tor', $id)->get();
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
        // dd($indikator_p);
        $indikator_iku = DB::table('indikator_iku')->get();
        $users = User::all();
        $anggaran = DB::table('anggaran')->where('id_rab', $rab->id ?? '0')->get();
        // dd($anggaran);
        $tabelRole =  Role::all();
        $verifikator = User::where('multirole', $indikator_p->verifikator)->where('is_aktif', '1')->first();
        // $wd1 = User::where('role', '3')->first();
        // $wd2 = User::where('role', '4')->first();
        // $wd3 = User::where('role', '5')->first();

        return view(
            "perencanaan.tor.lengkapitor",
            compact(
                'tor',
                'rab',
                'unit',
                'tw',
                'userrole',
                'status',
                'tabeltahun',
                'pagu',
                // 'subkeg',
                // 'kategori_subK',
                'komponen_jadwal',
                'users',
                'indikator_p',
                'indikator_iku',
                'id',
                'trx_status_tor',
                'roles',
                'namaunit',
                'anggaran',
                'mak',
                'kelompok_mak',
                'belanja_mak',
                'detail_mak',
                'tabelRole',
                'verifikator',
            )
        );
    }

    public function add()
    {
        $unit = Unit::all();
        $tw = Triwulan::all();
        $tabelRole =  Role::all();
        return view("perencanaan.tor_create", ['unit' => $unit, 'tw' => $tw, 'tabelRole' => $tabelRole]);
    }

    public function processAdd(Request $request)
    {
        $request->validate([
            'nama_kegiatan'  => 'required',
            'jenis_ajuan'  => 'required',
            'latar_belakang'  => 'required',
            'rasionalisasi'  => 'required',
            'tujuan'  => 'required',
            'mekanisme'  => 'required',
            'keberlanjutan' => 'required',
            'realisasi_IKU' => 'required',
            'target_IKU' => 'required',
            'realisasi_IK' => 'required',
            'target_IK' => 'required',
            'nama_pic' => 'required',
            'email_pic' => 'required',
            'kontak_pic' => 'required',
            'tgl_mulai_pelaksanaan' => 'required',
            'tgl_akhir_pelaksanaan' => 'required',
            'jumlah_anggaran' => 'required',
        ]);

        // $inserting = Tor::create($request->except('_token'));
        $inserting = Tor::create(
            [
                'id_tw' => $request->id_tw,
                'id_unit' => $request->id_unit,
                'id_p' => $request->id_p,
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_ajuan' => $request->jenis_ajuan,
                'latar_belakang' => $request->latar_belakang,
                'rasionalisasi' => $request->rasionalisasi,
                'tujuan' => $request->tujuan,
                'mekanisme' => $request->mekanisme,
                'keberlanjutan' => $request->keberlanjutan,
                'realisasi_IKU' => $request->realisasi_IKU,
                'target_IKU' => $request->target_IKU,
                'realisasi_IK' => $request->realisasi_IK,
                'target_IK' => $request->target_IK,
                'nama_pic' => $request->nama_pic,
                'email_pic' => $request->email_pic,
                'kontak_pic' => $request->kontak_pic,
                'tgl_mulai_pelaksanaan' => $request->tgl_mulai_pelaksanaan,
                'tgl_akhir_pelaksanaan' => $request->tgl_akhir_pelaksanaan,
                'jumlah_anggaran' => $request->jumlah_anggaran,
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
            ]
        );


        $data = 1;
        if ($inserting) {
            return redirect('/torab')->with("success", "Data TOR berhasil ditambahkan, \n Segera Tambah RAB & Lengkapi Data");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }
    public function update($id)
    {
        $id = base64_decode($id);
        $tor = Tor::findOrFail($id);
        // $userLogin = Auth()->user()->name;
        // $roleLogin2 = DB::table('roles')->select('name')->where('id', Auth()->user()->role)->get();

        // $pic = DB::table('tor')->select('nama_pic')->where('id', $id)->get();
        // // pic tidak bisa mengakses update tor jika bukan tanggung jawabnya
        // if ($roleLogin2[0]->name == "PIC" && $userLogin != $pic[0]->nama_pic) {
        //     abort(403);
        // }

        $trxStatusTorStatic = new TrxStatusTor();
        $userStatic = new User();

        $statusTor =  json_decode($trxStatusTorStatic->TrxStatus($id), true); //ingin tau statusnya apa saja
        //jika TOR sudah diajukan oleh prodi, jangan dibolehkan untuk update
        if (!empty($statusTor[0]['nama_status'])) {
            if ($statusTor[0]['nama_status'] == "Proses Pengajuan") {
                abort(403);
            }
        }

        $id = $id;
        $data = 0;
        $filtertahun = date('Y');
        $filterprodi = 0;
        $unit = Unit::all();
        $userrole = $userStatic->join();
        $tw = Triwulan::all();
        $mak = DB::table('mak')->get();
        $tahun = DB::table('tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $pagu = DB::table('pagu')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        $indikator_p = DB::table('indikator_p')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $roles2 = DB::table('roles')->get();
        $status = DB::table('status')->get();
        $tabelRole =  Role::all();
        $PIC = DB::table('pics')->where('id_unit', Auth::user()->id_unit)->get();

        return view(
            "perencanaan.tor.update",
            [
                'tor' => $tor, 'unit' => $unit, 'tw' => $tw, 'userrole' => $userrole,  'mak' => $mak,
                'tahun' => $tahun,  'filtertahun' => $filtertahun, 'data' => $data, 'id' => $id,
                'filterprodi' => $filterprodi, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu,
                'users' => $users, 'roles' => $roles, 'roles2' => $roles2, 'trx_status_tor' => $trx_status_tor,
                'status' => $status, 'tabelRole' => $tabelRole, 'indikator_p' => $indikator_p, 'pics' => $PIC,
            ]
        );
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);
        // dd($request->input());
        $process = Tor::findOrFail($id)->update($request->except('_token', 'files'));
        if ($process) {
            return redirect('/torab')->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function revisi($id, Request $request)
    {
        $id = base64_decode($id);
        $tor = Tor::findOrFail($id);
        $userLogin = Auth()->user()->name;
        $roleLogin2 = DB::table('roles')->select('name')->where('id', Auth()->user()->role)->get();

        $pic = DB::table('tor')->select('nama_pic')->where('id', $id)->get();
        // pic tidak bisa mengakses update tor jika bukan tanggung jawabnya
        if (($roleLogin2[0]->name != "PIC" && $roleLogin2[0]->name != "Prodi")
            ||
            ($roleLogin2[0]->name == "PIC" && $userLogin != $pic[0]->nama_pic)
            || empty($request->akses)
        ) {
            abort(403);
        }

        // kalo sudah ada perbaikan, tidak boleh ada lagi
        $trxStatusTorStatic = new TrxStatusTor();
        $statusTOR =  $trxStatusTorStatic->TrxStatus($id)->toArray();
        $perbaikan =  $trxStatusTorStatic->StatusPerbaikan($id)->toArray();
        $revisi =  $trxStatusTorStatic->Revisi($id)->toArray();

        /* ABORT : tidak ada revisi,
         ABORT : ada revisi, tapi ada perbaikan */
        if (count($revisi) == count($perbaikan)) {
            abort(403);
        }

        $userStatic = new User();

        // $id = $id;
        $data = 0;
        $filtertahun = date('Y');
        $filterprodi = 0;
        $unit = Unit::all();
        $userrole = $userStatic->join();
        $tw = Triwulan::all();
        $mak = DB::table('mak')->get();
        $tahun = DB::table('tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $trx_status_tor = DB::table('trx_status_tor')->where('id_tor', $id)->get();
        $pagu = DB::table('pagu')->get();
        $indikator_p = DB::table('indikator_p')->get();
        $users = User::all();
        $roles = DB::table('roles')->get();
        $roles2 = DB::table('roles')->get();
        $status = DB::table('status')->get();
        $PIC = DB::table('pics')->where('id_unit', Auth::user()->id_unit)->get();
        $tabelRole =  Role::all();
        // dd($tor);

        return view(
            "perencanaan.tor.revisi",
            [
                'tor' => $tor, 'unit' => $unit, 'tw' => $tw, 'userrole' => $userrole,  'mak' => $mak,
                'tahun' => $tahun,  'filtertahun' => $filtertahun, 'data' => $data, 'id' => $id,
                'filterprodi' => $filterprodi, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu,
                'users' => $users, 'roles' => $roles, 'roles2' => $roles2, 'trx_status_tor' => $trx_status_tor,
                'status' => $status, 'tabelRole' => $tabelRole, 'indikator_p' => $indikator_p,
                'pics' => $PIC
            ]
        );
        // return ($perbaikan);
    }

    public function processRevisi(Request $request, $id)
    {
        // dd($request->input());
        $id = base64_decode($id);
        $request->validate([]);
        $process = Tor::findOrFail($id)->update($request->except('_token', 'files'));
        if ($process) {
            return redirect('/lengkapitor/' . base64_encode($id))->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
    {
        $id = base64_decode($id);
        $userLogin = Auth()->user()->name;
        $roleLogin2 = DB::table('roles')->select('name')->where('id', Auth()->user()->role)->get();

        $pic = DB::table('tor')->select('nama_pic')->where('id', $id)->get();
        // pic tidak bisa mengakses update tor jika bukan tanggung jawabnya
        if ($roleLogin2[0]->name == "PIC" && $userLogin != $pic[0]->nama_pic) {
            abort(403);
        } else {
            try {
                $process = Tor::findOrFail($id)->delete();
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
    public function search(Request $request)
    {
    }
    public function changeStatus(Request $request)
    {
        $tor = Tor::find($request->id);
        $tor->status = $request->status;
        $tor->save();

        return back();
    }
    public function filter_tahun(Request $request)
    {
        // $tor = Tor::where('tgl_pelaksanaan', 'LIKE', $request->tahun . '%')->get();
        // // return response()->json(['tor', $tor]);
        // return json_encode(($tor));
        if ($request->tahun == 0) {
            redirect('/tor');
        }
        if (auth()->user()->id_unit != 1) {
            if (!empty($request->tahun)) {
                $torcount = Tor::where('id_unit', auth()->user()->id_unit)
                    ->where('tgl_mulai_pelaksanaan', 'LIKE',  '%' . $request->tahun . '%')->get();
                if ($torcount->count() % 2 == 0) {
                    $h = 4;
                }
                if ($torcount->count() % 2 != 0) {
                    $h = 6;
                }
                $tor = DB::table('tor')->where('id_unit', auth()->user()->id_unit)
                    ->where('tgl_mulai_pelaksanaan', 'LIKE',  '%' . $request->tahun . '%')
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate($h);
            }
            if (empty($request->tahun) || $request->tahun == 0) {
                $torcount = DB::table('tor')->where('id_unit', auth()->user()->id_unit)->get();
                if ($torcount->count() % 2 == 0) {
                    $h = 4;
                }
                if ($torcount->count() % 2 != 0) {
                    $h = 6;
                }
                $tor = DB::table('tor')->where('id_unit', auth()->user()->id_unit)
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate($h);
            }
        }

        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        $subKegiatanStatic = new SubKegiatan();

        $filterpagu = $request->pagu;
        $filtertahun = $request->tahun;
        $filterprodi = $request->prodi;
        $rab = DB::table('rab')->get();
        $mak = DB::table('mak')->get();
        $anggaran = DB::table('anggaran')->get();
        $unit = Unit::all();
        $unit2 = Unit::all();
        $userrole = $userStatic->join();
        $user = User::all();
        $role = DB::table('roles')->get();
        $tw = Triwulan::all();
        $tw2 = Triwulan::all();
        $detail_mak = DB::table('detail_mak')->get();
        $tahun = DB::table('tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $pagu = DB::table('pagu')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        $rab_ang = $anggaranStatic->Rab_Ang();
        $totalpertw = $anggaranStatic->total_anggaran_tw();
        $status = DB::table('status')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        $kategori_subK =  $subKegiatanStatic->Kategori_Sub();
        $komponen_jadwal = DB::table('komponen_jadwal')->get();
        $indikator_iku = DB::table('indikator_iku')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $pedoman = Pedoman::all();
        $tabelRole =  Role::all();

        return view(
            "perencanaan.tor.torab",
            [
                'tor' => $tor, 'unit' => $unit, 'tw' => $tw, 'unit2' => $unit2, 'tw2' => $tw2, 'userrole' => $userrole,  'detail_mak' => $detail_mak,
                'tahun' => $tahun,  'filtertahun' => $filtertahun, 'rab' => $rab, 'mak' => $mak, 'anggaran' => $anggaran,
                'filterprodi' => $filterprodi, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu,
                'rab_ang' => $rab_ang, 'totalpertw' => $totalpertw, 'status' => $status, 'user' => $user, 'role' => $role,
                'kategori_subK' => $kategori_subK, 'komponen_jadwal' => $komponen_jadwal, 'filterpagu' => $filterpagu,
                'indikator_iku' => $indikator_iku, 'trx_status_tor' => $trx_status_tor, 'pedoman' => $pedoman, 'tabelRole' => $tabelRole
            ]
        );
        // return $tor;
    }
    public function filter_pagu(Request $request)
    {
        if (auth()->user()->id_unit != 1) {
            $tor = Tor::where('id_unit', auth()->user()->id_unit)->orderBy('created_at', 'desc')->simplepaginate(5);
        }
        if (auth()->user()->id_unit == 1) {
            $tor = DB::table('tor')
                ->simplepaginate(5);
        }

        $userStatic = new User();
        $anggaranStatic = new Anggaran();
        $subKegiatanStatic = new SubKegiatan();

        $filterpagu = $request->pagu;
        $filtertahun = 0;
        $filterprodi = 0;
        $rab = DB::table('rab')->get();
        $role = DB::table('roles')->get();
        $mak = DB::table('mak')->get();
        $anggaran = DB::table('anggaran')->get();
        $unit = Unit::all();
        $unit2 = Unit::all();
        $userrole = $userStatic->join();
        $user = User::all();
        $tw = Triwulan::all();
        $tw2 = Triwulan::all();
        $detail_mak = DB::table('detail_mak')->get();
        $tahun = DB::table('tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $pagu = DB::table('pagu')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        $rab_ang = $anggaranStatic->Rab_Ang();
        $totalpertw = $anggaranStatic->total_anggaran_tw();
        $status = DB::table('status')->get();
        // $subkeg = DB::table('indikator_subK')->get();
        // $kategori_subK =  $subKegiatanStatic->Kategori_Sub();
        $komponen_jadwal = DB::table('komponen_jadwal')->get();
        $indikator_p = DB::table('indikator_p')->get();
        $indikator_iku = DB::table('indikator_iku')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $pedoman = Pedoman::all();
        $tabelRole =  Role::all();

        if ($filterpagu == 0) {
            $pagu = DB::table('pagu')->get();
            redirect('/torab');
        }
        if (!empty($filterpagu)) {
            $pagu = DB::table('pagu')->where('id_tahun', 'LIKE', $request->pagu . '%')->get();
        }
        return view(
            "perencanaan.tor.torab",
            [
                'tor' => $tor, 'unit' => $unit, 'unit2' => $unit2, 'tw' => $tw, 'tw2' => $tw2, 'userrole' => $userrole,  'detail_mak' => $detail_mak,
                'tahun' => $tahun,  'filtertahun' => $filtertahun, 'rab' => $rab, 'mak' => $mak, 'anggaran' => $anggaran,
                'filterprodi' => $filterprodi, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu,
                'rab_ang' => $rab_ang, 'totalpertw' => $totalpertw, 'user' => $user, 'status' => $status,
                'komponen_jadwal' => $komponen_jadwal, 'filterpagu' => $filterpagu,
                'indikator_iku' => $indikator_iku, 'trx_status_tor' => $trx_status_tor, 'role' => $role,
                'indikator_p' => $indikator_p, 'pedoman' => $pedoman,
                'tabelRole' => $tabelRole
            ]
        );
    }
    public function ajuanProdi(Request $request)
    {
        $request->validate([]);

        $inserting = DB::table('trx_status_kegiatan')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    // J A D W A L    P A D A    T O R
    public function createJadwal(Request $request)
    {
        $request->validate([]);
        $inserting = DB::table('komponen_jadwal')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }
    public function updateJadwal(Request $request, $id)
    {
        $request->validate([]);

        $process = DB::table('komponen_jadwal')->where('id', $id)->update($request->except('_token'));
        if ($process) {
            return redirect()->back()->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }
    public function deleteJadwal($id)
    {
        $id = base64_decode($id);

        try {
            $process = DB::table('komponen_jadwal')->where('id', $id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function getEmailPIC($namapic)
    {
        $pic = DB::table('pics')->where('id', $namapic)->get();
        return response()->json($pic, 200);
    }
}
