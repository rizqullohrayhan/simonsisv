<?php

namespace App\Http\Controllers;

use App\Models\Tor;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\MemoCair;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class MemoCairController extends Controller
{
    private $filtertw = 0;
    private $filterTahun = 0;

    private function cekWulan()
    {
        $model = Tor::all();
        if (!isset($_REQUEST['filterTahun']) && !isset($_REQUEST['filterTw'])) {
            $tw = DB::table('triwulan')->where('periode_awal', '<=', date('Y-m-d'))->where('periode_akhir', '>=', date('Y-m-d'))->first() ?? Triwulan::OrderBy('id', 'desc')->first();
            $thn = DB::table('tahun')->where('tahun', date('Y'))->first() ?? DB::table('tahun')->OrderBy('id', 'desc')->first();
            $model = DB::table('tor')->where('id_tw', $tw->id)->get();
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
        $tahun = DB::table('tahun')->get();
        $tw = DB::table('triwulan')->get();

        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $triwulan = DB::table('triwulan')->get();
        $dokumen = DB::table('dokumen')->get();
        $data = MemoCair::all();
        $tabelRole =  Role::all();
        return view('keuangan.memo_cair.index_memocair', compact(
            'data',
            'tor',
            'trx_status_tor',
            'status',
            'prodi',
            'users',
            'roles',
            'triwulan',
            'dokumen',
            'tabelRole',
            'filtertw',
            'filterTahun',
            'tw',
            'tahun'
        ));
    }

    public function filter_tw(Request $request)
    {
        // $filtertw = $request->filterTw;
        $filtertw = base64_decode($request->filterTw);
        $filterTahun = base64_decode($request->filterTahun);
        // $tor = Tor::all();

        $filterNamaTahun = DB::table('tahun')->select('tahun')->where('id', $filterTahun)->get();
        if ($filterTahun != 0 && $filtertw != 0) {
            $tor = DB::table('tor')->where('id_tw', $filtertw)->get();
        } elseif ($filterTahun != 0 && $filtertw == 0) {
            $tor = DB::table('tor')->where('tgl_mulai_pelaksanaan', 'LIKE', $filterNamaTahun[0]->tahun . '%')->get();
        } elseif ($filterTahun == 0 && $filtertw != 0) {
            $tor = DB::table('tor')->where('id_tw', $filtertw)->get();
        } elseif ($filterTahun == 0 && $filtertw == 0) {
            $tor = DB::table('tor')->where('tgl_mulai_pelaksanaan', 'LIKE', date('Y') . '%')->get();
        }

        $tahun = DB::table('tahun')->get();
        $tw = DB::table('triwulan')->get();

        $tor = Tor::all();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $triwulan = DB::table('triwulan')->get();
        $dokumen = DB::table('dokumen')->get();
        $data = MemoCair::all();
        $tabelRole =  Role::all();
        return view('keuangan.memo_cair.index_memocair', compact(
            'data',
            'tor',
            'trx_status_tor',
            'status',
            'prodi',
            'users',
            'roles',
            'triwulan',
            'dokumen',
            'tabelRole',
            'filtertw',
            'filterTahun',
            'filterNamaTahun',
            'tahun',
            'tw'
        ));
    }

    public function getTwByTahun($id_thn)
    {
        $id_thn = base64_decode($id_thn);
        $tws = DB::table('triwulan')->where('id_tahun', $id_thn)->get();
        return response()->json($tws);
    }

    public function getTahunByTw($id_triwulan)
    {
        $id_triwulan = base64_decode($id_triwulan);
        if ($id_triwulan == 0 || empty($id_triwulan)) {
            $thn = DB::table('tahun')->get();
        } elseif ($id_triwulan != 0 || !empty($id_triwulan)) {
            $tahun = DB::table('triwulan')->select('id_tahun')->where('id', $id_triwulan)->get();
            $thn = DB::table('tahun')->where('id', $tahun[0]->id_tahun)->get();
        }
        return response()->json($thn);
    }

    public function store(Request $request)
    {
        if (!empty($request->file)) {
            //memvalidasi inputan
            $request->validate([]);
            //mengambil data file yang diupload
            $file           = $request->file('file');
            //mengambil nama file
            $nama_file      = $file->getClientOriginalName();
            $jenis          = $request->jenis;
            $id_tor         = $request->id_tor;
            //memindahkan file ke folder tujuan
            $file->move('documents', $file->getClientOriginalName());
        }
        if (empty($request->file)) {
            $nama_file      = Dokumen::where('id', $request->id_dokumen)->first()->name;
            $jenis          = $request->jenis;
            $id_tor         = $request->id_tor;
        }

        if (empty($request->id_dokumen)) {
            $upload         = new Dokumen;
        } else {
            $upload         = Dokumen::find($request->id_dokumen);
        }
        $upload->name    = $nama_file;
        $upload->path    = $nama_file;
        $upload->jenis   = $jenis;
        $upload->id_tor  = $id_tor;

        //menyimpan data ke database
        $upload->save();

        if (empty($request->id_memo)) {
            $upload2 = new MemoCair;
        }
        if (!empty($request->id_memo)) {
            $upload2 = MemoCair::findOrFail($request->id_memo);
        }
        $upload2->nomor   = $request->nomor;
        $upload2->nominal = $request->nominal;
        $upload2->id_tor  = $request->id_tor;
        $upload2->save();

        if ($upload2) {
            return redirect()->back()->with("success", "Sertifikat Memo Cair Sudah Terbit");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
        //kembali ke halaman sebelumnya
        return back();
    }

    public function datatable()
    {
        $filtertw = $_REQUEST['filtertw'];
        $filterTahun = $_REQUEST['filterTahun'];
        $filterNamaTahun = DB::table('tahun')->select('tahun')->where('id', $filterTahun)->get();
        if ($filterTahun != 0 && $filtertw != 0) {
            $tor = DB::table('tor')->where('id_tw', $filtertw)->get();
        } elseif ($filterTahun != 0 && $filtertw == 0) {
            $tor = DB::table('tor')->where('tgl_mulai_pelaksanaan', 'LIKE', $filterNamaTahun[0]->tahun . '%')->get();
        } elseif ($filterTahun == 0 && $filtertw != 0) {
            $tor = DB::table('tor')->where('id_tw', $filtertw)->get();
        } elseif ($filterTahun == 0 && $filtertw == 0) {
            $tor = DB::table('tor')->where('tgl_mulai_pelaksanaan', 'LIKE', date('Y') . '%')->get();
        }
        // var_dump($filtertw);
        // exit;
        $user = auth()->user();

        $return = [];
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $triwulan = DB::table('triwulan')->get();
        $dokumen = DB::table('dokumen')->get();
        $data = MemoCair::all();
        $nomor = 0;
        $namaprodi = '';
        $namatw = '';

        // Untuk inisialisasi Role
        foreach ($roles as $role) {
            if ($role->id == Auth::user()->role) {
                $RoleLogin = $role->name;
            }
        }
        // Inisialisasi TOR
        for ($m = 0; $m < count($tor); $m++) {
            $ada = 0; //sudah diajukan apa belum

            // S T A T U S
            $torVallidasi = "";
            $statusTor = [
                [
                    'tor' => '',
                    'status' => '',
                    'sudahUpload' => 0
                ]
            ];

            // Mengambil data Nama Kegiatan yang SUDAH DIVALIDASI WD 1 dari tabel TOR
            for ($tr = 0; $tr < count($trx_status_tor); $tr++) {
                if ($trx_status_tor[$tr]->id_tor == $tor[$m]->id) {
                    for ($s = 0; $s < count($status); $s++) {
                        if ($trx_status_tor[$tr]->id_status == $status[$s]->id) {
                            $statusTor[$ada]['tor'] = "TOR" . $tor[$m]->id;
                            $ada += 1;
                            for ($u = 0; $u < count($users); $u++) {
                                if ($trx_status_tor[$tr]->create_by == $users[$u]->id) {
                                    for ($r = 0; $r < count($roles); $r++) {
                                        if ($users[$u]->role == $roles[$r]->id) {
                                            $statusTor[0]['status'] = $status[$s]->nama_status . " - " . $trx_status_tor[$tr]->role_by;
                                            for ($d = 0; $d < count($dokumen); $d++) {
                                                if ($dokumen[$d]->id_tor  == $tor[$m]->id) {
                                                    $statusTor[0]['sudahUpload'] = 1;
                                                }
                                            }
                                            if ($statusTor[0]['status'] == "Validasi - WD 3") {

                                                // Mengambil data Nama Unit (Prodi) dari tabel TOR
                                                for ($v = 0; $v < count($prodi); $v++) {
                                                    if ($prodi[$v]->id == $tor[$m]->id_unit) {
                                                        $namaprodi = $prodi[$v]->nama_unit;
                                                        // Mengambil data Triwulan dari tabel TOR
                                                        for ($x = 0; $x < count($triwulan); $x++) {
                                                            if ($triwulan[$x]->id == $tor[$m]->id_tw) {
                                                                $namatw = $triwulan[$x]->triwulan;

                                                                $return[$m]['no'] = $nomor + 1;
                                                                $nomor += 1;
                                                                $return[$m]['nama_kegiatan'] = $tor[$m]->nama_kegiatan;
                                                                $return[$m]['prodi'] = $namaprodi;
                                                                $return[$m]['tw'] = $namatw;
                                                                if ($statusTor[0]['sudahUpload'] == 1) {
                                                                    $return[$m]['status'] =
                                                                        "<button type='button'
                                                                            class='btn iq-bg-primary btn-rounded btn-sm my-0'>Sudah
                                                                            Terbit
                                                                        </button>";
                                                                } else {
                                                                    $return[$m]['status'] =
                                                                        "<button type='button'
                                                                            class='btn iq-bg-danger btn-rounded btn-sm my-0'>Belum
                                                                            Terbit
                                                                        </button>";
                                                                }

                                                                $return[$m]['button'] = '';
                                                                if ($statusTor[0]['sudahUpload'] == 1) {
                                                                    if ($user->can('memo_detail')) :
                                                                        $return[$m]['button'] .=
                                                                            "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                title='Detail' data-toggle='modal'
                                                                                data-target='#detail_memocair{$tor[$m]->id}'>
                                                                                <i class='las la-external-link-alt'></i></i>
                                                                            </button>";
                                                                        // MODAL - Detail Memo Cair
                                                                        $return[$m]['button'] .=
                                                                            view('keuangan.memo_cair.detail_memocair', compact('tor', 'm', 'data', 'dokumen', 'u'))->render();
                                                                    // include('keuangan/memo_cair/detail_memocair');
                                                                    endif;
                                                                    if ($user->can('memo_edit')) :
                                                                        $return[$m]['button'] .=
                                                                            "<button class='btn btn-sm bg-warning rounded-pill' 
                                                                                title='Edit' data-toggle='modal'
                                                                                data-target='#edit_memocair{$tor[$m]->id}'>
                                                                                <i class='las la-edit'></i></i>
                                                                            </button>";
                                                                        // <!-- MODAL - Edit Memo Cair -->
                                                                        $return[$m]['button'] .=
                                                                            view('keuangan.memo_cair.edit_memocair', compact('tor', 'm', 'data', 'dokumen'))->render();
                                                                    // @include('keuangan/memo_cair/edit_memocair')
                                                                    endif;
                                                                } else {
                                                                    if ($RoleLogin === 'Prodi') {
                                                                        if ($user->can('memo_create')) :
                                                                            $return[$m]['button'] .=
                                                                                "<button type='button' class='btn bg-dark btn-rounded btn-sm my-0'
                                                                                    title='Upload File Memo Cair' data-toggle='modal'
                                                                                    data-target='#upload_memocair{$tor[$m]->id}'>
                                                                                    <i class='las la-upload'></i>
                                                                                </button>";

                                                                            // <!-- MODAL - Upload Memo Cair -->
                                                                            $return[$m]['button'] .=
                                                                                view('keuangan.memo_cair.upload_memocair', compact('tor', 'm'))->render();
                                                                        // @include('keuangan/memo_cair/upload_memocair')
                                                                        endif;
                                                                    } else {
                                                                        $return[$m]['button'] .= "<span class='badge border border-danger text-danger'>Prodi Belum Upload Memo Cair</span>";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return datatables()::of($return)->rawColumns(['status', 'button'])->tojson();
    }
}
