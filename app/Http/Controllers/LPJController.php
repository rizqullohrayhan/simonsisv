<?php

namespace App\Http\Controllers;

use App\Models\LPJ;
use App\Models\Tor;
use App\Models\Dokumen;
use App\Models\Pedoman;
use App\Models\MemoCair;
use App\Models\TrxStatusKeu;
use Illuminate\Http\Request;
use App\Models\PersekotKerja;
use App\Models\Triwulan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class LPJController extends Controller
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
        $memo_cair = MemoCair::all();
        $persekot_kerja = PersekotKerja::all();
        $lpj = LPJ::all();
        $status_keu =  DB::table('status_keu')->get();
        $trx_status_keu = TrxStatusKeu::all();
        $pedoman = Pedoman::all();
        $tabelRole =  Role::all();
        return view(
            'keuangan.lpj.index_lpj',
            compact(
                'memo_cair',
                'persekot_kerja',
                'tor',
                'trx_status_tor',
                'status',
                'prodi',
                'users',
                'roles',
                'triwulan',
                'dokumen',
                'lpj',
                'status_keu',
                'trx_status_keu',
                'pedoman',
                'tabelRole',
                'filtertw',
                'filterTahun',
                'tw',
                'tahun'
            )
        );
    }

    public function create(Request $request)
    {
        if (!empty($request->file)) {
            //mengambil data file yang diupload
            $file           = $request->file('file');
            //mengambil nama file
            $nama_file      = $file->getClientOriginalName();
            $jenis          = $request->jenis;
            $id_tor          = $request->id_tor;
            //memindahkan file ke folder tujuan
            $file->move('documents', $file->getClientOriginalName());
        }
        if (empty($request->file)) {
            $file      = "null";
            $nama_file      = "null";
            $jenis          = $request->jenis;
            $id_tor          = $request->id_tor;
        }

        $upload         = new Dokumen;
        $upload->name   = $nama_file;
        $upload->path   = $nama_file;
        $upload->jenis  = $jenis;
        $upload->id_tor  = $id_tor;

        //menyimpan data ke database
        $upload->save();

        $upload2 = new LPJ();
        $upload2->id_tor = $request->id_tor;
        $upload2->mitra = $request->mitra;
        $upload2->pks = $request->pks;
        $upload2->save();

        //Menyimpan ke TRX Status
        $upload2 = TrxStatusKeu::create([
            'id_status' => 11,
            'id_tor' => $request->id_tor,
            'catatan' => $request->catatan,
            'create_by' => $request->create_by,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        if ($upload2) {
            return redirect()->back()->with(
                "success",
                "Data berhasil ditambahkan"
            );
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function validasiLpj(Request $request)
    {
        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;
        if ($roleUser ==  2) {
            abort(403);
        }

        $request->validate([]);

        $inserting = DB::table('trx_status_keu')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Status Berhasil diubah");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
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

        $pedoman = Pedoman::all();
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
        return view('keuangan.lpj.index_lpj', compact(
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
            'tw',
            'pedoman'
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

        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $dokumen = DB::table('dokumen')->get();
        $memo_cair = MemoCair::all();
        $lpj = LPJ::all();
        $dataTabel = [];
        $status_keu =  DB::table('status_keu')->get();
        $trx_status_keu = TrxStatusKeu::all();

        // Mengetahui role user
        foreach ($roles as $role) {
            if ($role->id == Auth::user()->role) {
                $RoleLogin = $role->name;
            }
        }

        $nomor = 0;
        $namaprodi = '';
        for ($m = 0; $m < count($tor); $m++) {
            $ada = 0; //sudah diajukan apa belum
            $cektor = 0; //mengecek hanya ada 1 tor 
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
                            $ada += 1;
                            for ($u = 0; $u < count($users); $u++) {
                                if ($trx_status_tor[$tr]->create_by == $users[$u]->id) {
                                    for ($r = 0; $r < count($roles); $r++) {
                                        if ($users[$u]->role == $roles[$r]->id) {
                                            $statusTor[0]['status'] = $status[$s]->nama_status . " - " . $roles[$r]->name;
                                            for ($d = 0; $d < count($dokumen); $d++) {
                                                if ($dokumen[$d]->id_tor  == $tor[$m]->id) {
                                                    $statusTor[$ada]['tor'] = "TOR" . $tor[$m]->id;
                                                    $statusTor[0]['sudahUpload'] = 1;
                                                }
                                            }
                                            if ($statusTor[0]['sudahUpload'] == 1 && $cektor != $tor[$m]->id) {

                                                // Mengambil data Nama Unit (Prodi) dari tabel TOR
                                                for ($v = 0; $v < count($prodi); $v++) {
                                                    if ($prodi[$v]->id == $tor[$m]->id_unit) {
                                                        $namaprodi = $prodi[$v]->nama_unit;

                                                        // Menampilkan data
                                                        $dataTabel[$m]['no'] = $nomor + 1;
                                                        $nomor += 1;
                                                        for ($memo = 0; $memo < count($memo_cair); $memo++) {
                                                            if ($memo_cair[$memo]->id_tor == $tor[$m]->id) {
                                                                $dataTabel[$m]['no_memo'] = $memo_cair[$memo]->nomor;
                                                            }
                                                        }
                                                        $dataTabel[$m]['nama_kegiatan'] = $tor[$m]->nama_kegiatan;
                                                        $dataTabel[$m]['prodi'] = $namaprodi;
                                                        $dataTabel[$m]['pic'] = $tor[$m]->nama_pic;


                                                        // STATUS
                                                        $dataTabel[$m]['status'] = "<span class='badge border border-danger text-danger'>Belum ada status</span>";

                                                        foreach ($trx_status_keu as $a) {
                                                            if ($a->id_tor == $tor[$m]->id) {
                                                                foreach ($status_keu as $b) {
                                                                    // Jika semua Role kecuali Staf Perencanaan
                                                                    if ($a->id_status == $b->id && $b->kategori == 'LPJ') {
                                                                        $dataTabel[$m]['status'] =
                                                                            "<button type='button' 
                                                                                class='badge border border-primary text-primary' 
                                                                                data-toggle='modal' data-target='#status_lpj{$tor[$m]->id}'>{$b->nama_status}
                                                                            </button>";

                                                                        // Jika Role Staf Perencanaan
                                                                        if ($RoleLogin === 'Staf Perencanaan') {
                                                                            $dataTabel[$m]['status'] =
                                                                                "<button type='button' 
                                                                                class='badge border border-primary text-primary' 
                                                                                data-toggle='modal' data-target='#status_lpj{$tor[$m]->id}'>{$b->nama_status}
                                                                            </button>&nbsp" .
                                                                                "<span type='button' 
                                                                                class='badge badge-dark' 
                                                                                data-toggle='modal' data-target='#validasi_lpj{$tor[$m]->id}'>
                                                                                <i class='ri-edit-fill'></i>
                                                                            </span>";

                                                                            if ($b->nama_status == 'Revisi') {
                                                                                $dataTabel[$m]['status'] =
                                                                                    "<button type='button' 
                                                                                    class='badge border border-primary text-primary' 
                                                                                    data-toggle='modal' data-target='#status_lpj{$tor[$m]->id}'>{$b->nama_status}
                                                                                </button>&nbsp" .
                                                                                    "<span type='button' 
                                                                                    class='badge badge-secondary' data-toggle='modal' 
                                                                                    data-target='#revisi_lpj{$tor[$m]->id}'>
                                                                                    <i class='las la-comment'></i>
                                                                                </span>" .
                                                                                    "<span type='button' 
                                                                                    class='badge badge-dark' 
                                                                                    data-toggle='modal' data-target='#validasi_lpj{$tor[$m]->id}'>
                                                                                    <i class='ri-edit-fill'></i>
                                                                                </span>";
                                                                            } elseif ($b->nama_status == 'LPJ Selesai') {
                                                                                $dataTabel[$m]['status'] =
                                                                                    "<button type='button' 
                                                                                    class='badge border border-success text-success' 
                                                                                    data-toggle='modal' data-target='#status_lpj{$tor[$m]->id}'>{$b->nama_status}
                                                                                </button>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        // <!-- MODAL - Validasi LPJ -->
                                                        $dataTabel[$m]['status'] .= view('keuangan.lpj.validasi_lpj', compact('tor', 'm', 'trx_status_keu', 'status_keu'))->render();
                                                        // <!-- MODAL - Status LPJ -->
                                                        $dataTabel[$m]['status'] .= view('keuangan.lpj.status_lpj', compact('tor', 'm', 'trx_status_keu', 'status_keu', 'users', 'roles'))->render();
                                                        // <!-- MODAL - Revisi LPJ -->
                                                        $dataTabel[$m]['status'] .= view('keuangan.lpj.showrevisi_lpj', compact('tor', 'm', 'trx_status_keu', 'a'))->render();

                                                        // BUTTON
                                                        if ($RoleLogin === 'Prodi') {
                                                            $dataTabel[$m]['button'] =
                                                                "<button class='btn btn-sm bg-dark rounded-pill' 
                                                                title='Input LPJ' data-toggle='modal' 
                                                                data-target='#input_lpj{$tor[$m]->id}'>
                                                                <i class='las la-upload'></i>
                                                            </button>";
                                                        } else {
                                                            $dataTabel[$m]['button'] =
                                                                "<span class='badge border border-danger text-danger'>Prodi Belum Mengajukan SPJ</span>";
                                                        }

                                                        foreach ($trx_status_keu as $a) {
                                                            if ($a->id_tor == $tor[$m]->id) {
                                                                foreach ($status_keu as $b) {
                                                                    if ($a->id_status == $b->id && $b->kategori == 'LPJ') {
                                                                        if (($b->nama_status == 'Proses Pengajuan' || $b->nama_status == 'Revisi') && ($RoleLogin != 'Prodi' && $RoleLogin != 'PIC')) {
                                                                            $dataTabel[$m]['button'] =
                                                                                "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                    title='Detail' data-toggle='modal' 
                                                                                    data-target='#detail_lpj{$tor[$m]->id}'>
                                                                                    <i class='las la-external-link-alt'></i>
                                                                                </button>";

                                                                            // {{-- Jika Role Prodi --}}
                                                                        } elseif ($RoleLogin === 'Prodi' || $RoleLogin === 'PIC') {
                                                                            $dataTabel[$m]['button'] =
                                                                                "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                    title='Detail' data-toggle='modal' 
                                                                                    data-target='#detail_lpj{$tor[$m]->id}'>
                                                                                    <i class='las la-external-link-alt'></i>
                                                                                </button>&nbsp" .
                                                                                "<button class='btn btn-sm bg-warning rounded-pill' 
                                                                                    title='Edit' data-toggle='modal' 
                                                                                    data-target='#edit_lpj{$tor[$m]->id}'>
                                                                                    <i class='las la-edit'></i>
                                                                                </button>";

                                                                            if ($b->nama_status == 'Revisi') {
                                                                                $dataTabel[$m]['button'] =
                                                                                    "<button class='btn btn-sm bg-dark rounded-pill' 
                                                                                    itle='Input LPJ' data-toggle='modal' 
                                                                                    data-target='#input_lpj{$tor[$m]->id}'>
                                                                                    <i class='las la-upload'></i>
                                                                                </button>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        // <!-- MODAL - Edit LPJ -->
                                                        $dataTabel[$m]['button'] .= view('keuangan.lpj.edit_lpj', compact('tor', 'm', 'namaprodi', 'memo_cair', 'dokumen', 'lpj'))->render();

                                                        // <!-- MODAL - Detail LPJ -->
                                                        $dataTabel[$m]['button'] .= view('keuangan.lpj.detail_lpj', compact('tor', 'm', 'namaprodi', 'memo_cair', 'dokumen', 'lpj'))->render();

                                                        // <!-- MODAL - Input LPJ -->
                                                        $dataTabel[$m]['button'] .= view('keuangan.lpj.input_lpj', compact('tor', 'm', 'namaprodi', 'memo_cair', 'dokumen', 'lpj'))->render();
                                                    }
                                                }
                                            }
                                        }
                                        $cektor = $tor[$m]->id;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return datatables()::of($dataTabel)->rawColumns(['status', 'button'])->tojson();
    }
}
