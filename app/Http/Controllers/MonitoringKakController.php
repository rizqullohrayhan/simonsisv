<?php

namespace App\Http\Controllers;

use App\Models\Tor;
use App\Models\MemoCair;
use App\Models\Pagu;
use App\Models\SPJ;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class MonitoringKakController extends Controller
{
    private $filtertw = [];
    private $tahuntw = [];
    private $id_tahun = '';

    private function cekWulan()
    {
        $model = Tor::all();
        if (!isset($_REQUEST['filterTw'])) {
            $tw = DB::table('triwulan')->where('periode_awal', '<=', date('Y-m-d'))->where('periode_akhir', '>=', date('Y-m-d'))->first() ?? Triwulan::OrderBy('id', 'desc')->first();
            $model = DB::table('tor')->where('id_tw', $tw->id)->get();
            $this->filtertw = $tw->id;
            $this->id_tahun = $tw->id_tahun;
            $this->tahuntw = substr($tw->triwulan, 0, 4);
            $this->triwulantw = substr($tw->triwulan, -1, 1);
        }
        return $model;
    }

    public function index()
    {
        $tor = $this->cekWulan();
        // $tor = DB::table('tor')->where('id_tw', $filtertw)->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $tw = DB::table('triwulan')->get();
        $tahun = DB::table('tahun')->get();
        $pagu = Pagu::where('id_tahun', $this->id_tahun)->get();
        $dokMemo = DB::table('dokumen')->get();
        $trx_status_keu = DB::table('trx_status_keu')->get();
        $status_keu = DB::table('status_keu')->get();
        $filtertw = $this->filtertw;
        $data = MemoCair::all();
        $spj = SPJ::all();
        $tabeltahun = DB::table('tahun')->get();
        $tabelRole =  Role::all(); //untuk menampilkan pilihan multi role di topbar
        $getTahun = $this->tahuntw;
        $getTriwulan = $this->triwulantw;

        return view(
            'keuangan.monitoring_kak.index_kak',
            compact(
                'tor',
                'trx_status_tor',
                'status',
                'prodi',
                'users',
                'roles',
                'dokMemo',
                'trx_status_keu',
                'status_keu',
                'tw',
                'filtertw',
                'tahun',
                'pagu',
                'data',
                'tabeltahun',
                'spj',
                'tabelRole',
                'getTahun',
                'getTriwulan',
            )

        );
    }

    public function filter_tw(Request $request)
    {
        $tahunTw = base64_decode($request->tahunTw);
        $triwulanTw = base64_decode($request->triwulanTw);
        if ($tahunTw == 'jY')
            $tahunTw = '';
        if ($triwulanTw == 'jY')
            $triwulanTw = '';
        $model = Triwulan::where('triwulan', 'like', '%' . $tahunTw . '%' . $triwulanTw . '%')->get();

        $filtertw = [];
        foreach ($model as $isi) :
            $filtertw[] = $isi->id;
        endforeach;

        $tor = Tor::all();
        if (empty($filtertw)) {
            // return redirect('/monitoring_kak');
            $tor = Tor::all();
        } elseif ($filtertw != 0) {
            $tor = DB::table('tor')->wherein('id_tw', $filtertw)->get();
        }
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $tw = DB::table('triwulan')->get();
        if (!empty($filtertw)) {
            // $this->tahuntw = Triwulan::wherein('id', $filtertw)->first()->id_tahun;
            foreach (Triwulan::wherein('id', $filtertw)->get() as $isi) :
                $this->tahuntw[] = $isi->id_tahun;
            endforeach;
            $pagu = Pagu::wherein('id_tahun', $this->tahuntw)->get();
        } else {
            $pagu = Pagu::all();
        }
        $tahun = DB::table('tahun')->get();
        $dokMemo = DB::table('dokumen')->get();
        $trx_status_keu = DB::table('trx_status_keu')->get();
        $status_keu = DB::table('status_keu')->get();
        $data = MemoCair::all();
        $spj = SPJ::all();
        $tabeltahun = DB::table('tahun')->get();
        $tabelRole =  Role::all(); //untuk menampilkan pilihan multi role di topbar

        if (count($filtertw) == 1) :
            $filtertw = $filtertw[0];
        endif;
        // var_dump(base64_decode($request->tahunTw));
        // exit;
        return view(
            "keuangan.monitoring_kak.index_kak",
            [
                'tor' => $tor, 'trx_status_tor' => $trx_status_tor, 'status' => $status,
                'prodi' => $prodi, 'users' => $users, 'roles' => $roles, 'dokMemo' => $dokMemo,
                'trx_status_keu' => $trx_status_keu, 'status_keu' => $status_keu, 'tw' => $tw,
                'filtertw' => $filtertw, 'tahun' => $tahun, 'pagu' => $pagu, 'data' => $data, 'tabeltahun' => $tabeltahun,
                'tabelRole' => $tabelRole, 'spj' => $spj, 'getTahun' => base64_decode($request->tahunTw), 'getTriwulan' => base64_decode($request->triwulanTw)
            ]
        );
    }

    public function datatableAll()
    {
        $filtertw = $this->filtertw;
        if (!empty($filtertw)) {
            // $this->tahuntw = Triwulan::wherein('id', $filtertw)->first()->id_tahun;
            foreach (Triwulan::wherein('id', $filtertw)->get() as $isi) :
                $this->tahuntw[] = $isi->id_tahun;
            endforeach;
            $pagu = Pagu::wherein('id_tahun', $this->tahuntw)->get();
        } else {
            $pagu = Pagu::all();
        };
        $totalRecord = Tor::all()->count();
        $i = 0;
        $data1 = [];
        // Pagu dialiaskan sebagai 'isi'
        foreach ($pagu as $isi) :
            $pagu = number_format($isi->pagu);
            $unit = $isi->unit->nama_unit;
            $rpd1 = number_format($isi->tw1);
            $rpd2 = number_format($isi->tw2);
            $rpd3 = number_format($isi->tw3);
            $rpd4 = number_format($isi->tw4);
            $nominal = 0;
            $anggaran = 0;
            $sisa = 0;
            $persen = 0;
            // ngambil tor
            foreach ($isi->tor as $tor) {
                if (!empty($tor->spj->nilai_total) && in_array($tor->id_tw, $filtertw)) {
                    // mengambil nilai total dari tabel spj yang memiliki id tor
                    $nominal += $tor->spj->nilai_total;
                }
                $anggaran = $tor->jumlah_anggaran;
            }
            // nilai sisa = pagu - realisasi
            $sisa = $isi->pagu - $nominal;
            $sisa = number_format($sisa);
            // nilai persentase
            $persen = ($nominal / $isi->pagu) * 100;
            $persen = number_format($persen, 2) . ' %';
            // nilai realisasi anggaran dari spj
            $nominal = number_format($nominal);

            $data1[$pagu]['no'] = $i + 1;
            $i += 1;
            $data1[$pagu]['unit'] = $unit;
            $data1[$pagu]['pagu'] = $pagu;
            $data1[$pagu]['rpd1'] = $rpd1;
            $data1[$pagu]['rpd2'] = $rpd2;
            $data1[$pagu]['rpd3'] = $rpd3;
            $data1[$pagu]['rpd4'] = $rpd4;
            $data1[$pagu]['nominal'] = $nominal;
            $data1[$pagu]['sisa'] = $sisa;
        endforeach;
        return datatables()::of($data1)->tojson();
    }

    public function datatableTw()
    {
        $filtertw = $this->filtertw;
        if (!empty($filtertw)) {
            // $this->tahuntw = Triwulan::wherein('id', $filtertw)->first()->id_tahun;
            foreach (Triwulan::wherein('id', $filtertw)->get() as $isi) :
                $this->tahuntw[] = $isi->id_tahun;
            endforeach;
            $pagu = Pagu::wherein('id_tahun', $this->tahuntw)->get();
        } else {
            $pagu = Pagu::all();
        };
        $totalRecord = Tor::all()->count();
        $nomorTw = 0;
        $i = 0;
        $data2 = [];

        // Pagu dialiaskan sebagai 'isi'
        foreach ($pagu as $isi) :
            $pagu = number_format($isi->pagu);
            $unit = $isi->unit->nama_unit;
            $field = "tw$nomorTw";
            $rpd = number_format($isi->$field);
            $nominal = 0;
            $revisi = 0;
            $review = 0;
            $anggaran = 0;
            $sisa = 0;
            $persen = 0;
            // ngambil tor
            foreach ($isi->tor as $tor) {
                if (empty($tor->lastStatus)) {
                    $status_tor = 0;
                } else {
                    $status_tor = $tor->lastStatus->id_status;
                }
                if (!empty($tor->jumlah_anggaran) && $tor->id_tw == $filtertw && !is_array($filtertw)) {
                    // mengambil nilai total dari tabel spj yang memiliki id tor
                    if ($status_tor == 4) {
                        $nominal += $tor->jumlah_anggaran;
                    }
                    if ($status_tor == 3) {
                        $revisi += $tor->jumlah_anggaran;
                    }
                    if ($status_tor == 1) {
                        $revisi += $tor->jumlah_anggaran;
                    }
                }
                $anggaran = $tor->jumlah_anggaran;
            }
            // nilai sisa = pagu - realisasi
            $sisa = $isi->pagu - $nominal;
            $sisa = number_format($sisa);
            // nilai persentase
            $persen = ($nominal / $isi->pagu) * 100;
            $persen = number_format($persen, 2) . ' %';
            // nilai realisasi anggaran dari spj
            $nominal = number_format($nominal);

            $data2[$pagu]['no'] = $i + 1;
            $i += 1;
            $data2[$pagu]['unit'] = $unit;
            $data2[$pagu]['pagu'] = $pagu;
            $data2[$pagu]['rpd'] = $rpd;
            $data2[$pagu]['nominal'] = $nominal;
            $data2[$pagu]['review'] = $review;
            $data2[$pagu]['revisi'] = $revisi;
            $data2[$pagu]['sisa'] = $sisa;
        endforeach;
        return datatables()::of($data2)->tojson();
    }
}
