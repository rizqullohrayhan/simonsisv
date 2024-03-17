<?php

namespace App\Http\Controllers;

use StatusKeu;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Dokumen;
use App\Models\MemoCair;
use App\Models\TrxStatusKeu;
use Illuminate\Http\Request;
use App\Models\PersekotKerja;
use App\Models\Triwulan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class PersekotKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        // $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $tw = DB::table('triwulan')->get();
        $dokumen = DB::table('dokumen')->get();
        $memo_cair = MemoCair::all();
        $persekot_kerja = PersekotKerja::all();
        $status_keu =  DB::table('status_keu')->get();
        $trx_status_keu = TrxStatusKeu::all();
        $tabelRole =  Role::all();

        $userLogin = Auth()->user()->id;
        $unitUser = Auth()->user()->id_unit; //prodi mana?
        $roleUser = Auth()->user()->role;

        if (Auth::user()->getroleNames()[0] == 'Kaprodi' || Auth::user()->getroleNames()[0] == 'Prodi' || Auth::user()->getroleNames()[0] == 'PIC') {
            $toShow = DB::table('tor')
                ->where('id_tw', $filtertw)
                ->where('id_unit', $unitUser)
                ->where('tgl_mulai_pelaksanaan', 'LIKE',  date('Y') . '%')
                ->get();
            $prodi = Unit::all()->where('id', $unitUser);
        } else {
            $toShow = DB::table('tor')
                ->where('id_tw', $filtertw)
                ->where('tgl_mulai_pelaksanaan', 'LIKE',  date('Y') . '%')
                ->get();
            $prodi = Unit::all();
        }

        return view(
            'keuangan.persekot_kerja.index_persekotkerja',
            compact(
                'filtertw',
                'filterTahun',
                'memo_cair',
                'persekot_kerja',
                'tor',
                'trx_status_tor',
                'status',
                'prodi',
                'users',
                'roles',
                'tw',
                'dokumen',
                'status_keu',
                'trx_status_keu',
                'tabelRole',
                'tahun',
                'toShow'
            )
        );
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

        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $tw = DB::table('triwulan')->get();
        $dokumen = DB::table('dokumen')->get();
        $memo_cair = MemoCair::all();
        $persekot_kerja = PersekotKerja::all();
        $status_keu =  DB::table('status_keu')->get();
        $trx_status_keu = TrxStatusKeu::all();
        $tabelRole =  Role::all();
        return view(
            'keuangan.persekot_kerja.index_persekotkerja',
            compact(
                'filtertw',
                'filterTahun',
                'filterNamaTahun',
                'memo_cair',
                'persekot_kerja',
                'tor',
                'trx_status_tor',
                'status',
                'prodi',
                'users',
                'roles',
                'tw',
                'dokumen',
                'status_keu',
                'trx_status_keu',
                'tabelRole',
                'tahun'
            )
        );
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

    public function create(Request $request)
    {
        $request->validate([]);

        $upload2 = new PersekotKerja();
        $upload2->id_tor = $request->id_tor;
        $upload2->alokasi_anggaran = $request->alokasi_anggaran;
        $upload2->tgl_selesai = $request->tgl_selesai;
        $upload2->save();

        $upload2 = TrxStatusKeu::create([
            'id_status' => 1,
            'id_tor' => $request->id_tor,
            'create_by' => $request->create_by,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        if ($upload2) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function validasiPK(Request $request)
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

    public function input_transferPK(Request $request)
    {
        $request->validate([]);

        //mengambil data file yang diupload
        $file           = $request->file('file');
        //mengambil nama file
        $nama_file      = $file->getClientOriginalName();
        $jenis          = $request->jenis;
        $id_tor          = $request->id_tor;
        //memindahkan file ke folder tujuan
        $file->move('documents', $file->getClientOriginalName());

        $input_tf         = new Dokumen;
        $input_tf->name   = $nama_file;
        $input_tf->path   = $nama_file;
        $input_tf->jenis  = $jenis;
        $input_tf->id_tor  = $id_tor;

        //menyimpan data ke database
        $input_tf->save();

        $input_tf2 = TrxStatusKeu::create([
            'id_status' => 3,
            'id_tor' => $request->id_tor,
            'create_by' => $request->create_by,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        if ($input_tf2) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function dana_sendiri(Request $request)
    {
        $change_status = TrxStatusKeu::create([
            'id_status' => 4,
            'id_tor' => base64_decode($request->idtor),
            'create_by' => Auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if ($change_status) {
            return redirect()->back()->with("success", "Status Berhasil diubah");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
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

        $user = auth()->user();
        $totalRecord = Tor::all()->count();
        $pk = [];
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $status = DB::table('status')->get();
        $prodi = DB::table('unit')->get();
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        $status_keu =  DB::table('status_keu')->get();
        $trx_status_keu = TrxStatusKeu::all();
        $dokumen = DB::table('dokumen')->get();
        $data = MemoCair::all();
        $persekot_kerja = PersekotKerja::all();
        $nomor = 0;
        $namaprodi = '';
        $memo_cair = MemoCair::all();

        // Untuk inisialisasi Role
        foreach ($roles as $role) {
            if ($role->id == Auth::user()->role) {
                $RoleLogin = $role->name;
            }
        }
        // Inisialisasi TOR
        $namaprodi = '';
        for ($m = 0; $m < count($tor); $m++) {
            $ada = 0; //sudah diajukan apa belum
            $cektor = 0; //mengecek hanya ada 1 tor 
            // S T A T U S
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

                                                        $pk[$m]['no'] = $nomor + 1;
                                                        $nomor += 1;
                                                        $pk[$m]['nama_kegiatan'] = $tor[$m]->nama_kegiatan;
                                                        $pk[$m]['prodi'] = $namaprodi;
                                                        $pk[$m]['pic'] = $tor[$m]->nama_pic;

                                                        // STATUS
                                                        $pk[$m]['status'] = "<span class='badge border border-danger text-danger'>Belum ada status</span>";
                                                        // untuk mengambil data dari trx_status_keu yang mana id nya harus sama dengan TOR
                                                        foreach ($trx_status_keu as $a) {
                                                            if ($a->id_tor == $tor[$m]->id) {
                                                                foreach ($status_keu as $b) {
                                                                    if ($a->id_status == $b->id && $b->kategori == 'Persekot Kerja') {
                                                                        $pk[$m]['status'] =
                                                                            "<button type='button' 
                                                                                class='badge border border-primary text-primary' 
                                                                                data-toggle='modal' 
                                                                                data-target='#status_pk{$tor[$m]->id}'>{$b->nama_status}
                                                                            </button>";
                                                                        // jika status Dana Prodi
                                                                        if ($b->nama_status == 'Dana Prodi') {
                                                                            $pk[$m]['status'] =
                                                                                "<button type='button' 
                                                                                    class='badge border border-dark text-dark' 
                                                                                    data-toggle='modal' 
                                                                                    data-target='#status_pk{$tor[$m]->id}'>{$b->nama_status}
                                                                                </button>";
                                                                            // jika status Validasi
                                                                        } elseif ($b->nama_status == 'Validasi') {
                                                                            $pk[$m]['status'] =
                                                                                "<button type='button' 
                                                                                    class='badge border border-success text-success' 
                                                                                    data-toggle='modal' 
                                                                                    data-target='#status_pk{$tor[$m]->id}'>{$b->nama_status}
                                                                                </button>";
                                                                            // jika Role yang login adalah WD 2
                                                                        } elseif ($RoleLogin === 'WD 1') {
                                                                            $pk[$m]['status'] =
                                                                                "<button type='button' 
                                                                                    class='badge border border-primary text-primary' 
                                                                                    data-toggle='modal' 
                                                                                    data-target='#status_pk{$tor[$m]->id}'>{$b->nama_status}
                                                                                </button>&nbsp" .
                                                                                "<span type='button' 
                                                                                    class='badge badge-dark' 
                                                                                    data-toggle='modal' 
                                                                                    data-target='#validasi_pk{$tor[$m]->id}'><i class='ri-edit-fill'></i>
                                                                                </span>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        // <!-- MODAL - Validasi Persekot Kerja -->
                                                        $pk[$m]['status'] .=
                                                            view('keuangan.persekot_kerja.validasi_pk', compact('tor', 'm', 'status_keu'))->render();
                                                        // <!-- MODAL - Status Persekot Kerja -->
                                                        $pk[$m]['status'] .=
                                                            view('keuangan/persekot_kerja/status_pk', compact('tor', 'm', 'trx_status_keu', 'users', 'roles', 'status_keu'))->render();

                                                        // BUTTON
                                                        if ($RoleLogin === 'Prodi') {
                                                            $pk[$m]['button'] =
                                                                "<button class='btn btn-sm bg-danger rounded-pill' 
                                                                    title='Pilih Jenis Penggunaan Dana' 
                                                                    data-toggle='modal' 
                                                                    data-target='#jenis_ajuan{$tor[$m]->id}'>
                                                                    <i class='las la-upload'></i>
                                                                </button>";
                                                        } else {
                                                            $pk[$m]['button'] = "<span class='badge border border-danger text-danger'>Prodi Belum Mengajukan PK</span>";
                                                        }

                                                        foreach ($trx_status_keu as $a) {
                                                            if ($a->id_tor == $tor[$m]->id) {
                                                                foreach ($status_keu as $b) {
                                                                    if ($a->id_status == $b->id && $b->kategori == 'Persekot Kerja') {
                                                                        // Semua Role selain Prodi dan Staf Keu
                                                                        $pk[$m]['button'] =
                                                                            "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                title='Detail' data-toggle='modal' 
                                                                                data-target='#detail_pk{$tor[$m]->id}'>
                                                                                <i class='las la-external-link-alt'></i>
                                                                            </button>";

                                                                        // Jika Role Prodi
                                                                        if ($RoleLogin === 'Prodi') {
                                                                            $pk[$m]['button'] =
                                                                                "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                    title='Detail' data-toggle='modal' 
                                                                                    data-target='#detail_pk{$tor[$m]->id}'>
                                                                                    <i class='las la-external-link-alt'></i>
                                                                                </button>&nbsp" .
                                                                                "<button class='btn btn-sm bg-warning rounded-pill' 
                                                                                    title='Edit' data-toggle='modal 
                                                                                    data-target='#edit_pk{$tor[$m]->id}>
                                                                                    <i class='las la-edit'></i>
                                                                                </button>";
                                                                            // Jika status Dana Prodi
                                                                            if ($b->nama_status == 'Dana Prodi') {
                                                                                $pk[$m]['button'] = '-';
                                                                                // Jika status Validasi
                                                                            } elseif ($b->nama_status == 'Validasi') {
                                                                                $pk[$m]['button'] =
                                                                                    "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                        title='Detail' data-toggle='modal' 
                                                                                        data-target='#detail_pk{$tor[$m]->id}'>
                                                                                        <i class='las la-external-link-alt'></i>
                                                                                    </button>";
                                                                                // Jika status Transfer Uang
                                                                            } elseif ($b->nama_status == 'Transfer Uang') {
                                                                                $pk[$m]['button'] =
                                                                                    "<button class='btn btn-sm bg-success rounded-pill' 
                                                                                        title='Lihat Bukti Transfer' data-toggle='modal' 
                                                                                        data-target='#show_tf_pk{$tor[$m]->id}'>
                                                                                        <i class='las la-money-check-alt'></i>&nbsp
                                                                                    </button>";
                                                                            }

                                                                            // Jika Role Staf Keuangan
                                                                        } elseif ($RoleLogin === 'Staf Keuangan') {
                                                                            $pk[$m]['button'] =
                                                                                "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                    title='Detail' data-toggle='modal' 
                                                                                    data-target='#detail_pk{$tor[$m]->id}'>
                                                                                    <i class='las la-external-link-alt'></i>
                                                                                </button>";
                                                                            // Jika status Dana Prodi
                                                                            if ($b->nama_status == 'Dana Prodi') {
                                                                                $pk[$m]['button'] = '-';
                                                                                // Jika status Validasi
                                                                            } elseif ($b->nama_status == 'Validasi') {
                                                                                $pk[$m]['button'] =
                                                                                    "<button class='btn btn-sm bg-info rounded-pill' 
                                                                                    title='Detail' data-toggle='modal' 
                                                                                    data-target='#detail_pk{$tor[$m]->id}'>
                                                                                    <i class='las la-external-link-alt'></i>
                                                                                </button>&nbsp" .
                                                                                    "<button class='btn btn-sm btn-info rounded-pill' 
                                                                                    title='Input Bukti Transfer' data-toggle='modal' 
                                                                                    data-target='#input_tf_pk{$tor[$m]->id}'>
                                                                                    <i class='las la-money-check-alt'></i>
                                                                                </button>";
                                                                                // Jika status Transfer Uang
                                                                            } elseif ($b->nama_status == 'Transfer Uang') {
                                                                                $pk[$m]['button'] =
                                                                                    "<button class='btn btn-sm bg-success rounded-pill' 
                                                                                    title='Lihat Bukti Transfer' data-toggle='modal' 
                                                                                    data-target='#show_tf_pk{$tor[$m]->id}'>
                                                                                    <i class='las la-money-check-alt'></i>
                                                                                </button>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        // <!-- MODAL - Input Bukti TF Persekot Kerja -->
                                                        $pk[$m]['button'] .=
                                                            view('keuangan/persekot_kerja/input_tf_pk', compact('tor', 'm', 'status_keu', 's'))->render();
                                                        // <!-- MODAL - Show Bukti TF Persekot Kerja -->
                                                        $pk[$m]['button'] .=
                                                            view('keuangan/persekot_kerja/show_tf_pk', compact('tor', 'm', 'status_keu', 's', 'namaprodi', 'memo_cair', 'persekot_kerja', 'dokumen'))->render();
                                                        // <!-- MODAL - Detail Persekot Kerja -->
                                                        $pk[$m]['button'] .=
                                                            view('keuangan/persekot_kerja/detail_pk', compact('tor', 'm', 'namaprodi', 'memo_cair', 'persekot_kerja'))->render();
                                                        // <!-- MODAL - Edit Persekot Kerja -->
                                                        $pk[$m]['button'] .=
                                                            view('keuangan/persekot_kerja/edit_pk', compact('tor', 'm', 'namaprodi', 'memo_cair', 'persekot_kerja'))->render();
                                                        // <!-- MODAL - Jenis Ajuan -->
                                                        $pk[$m]['button'] .=
                                                            view('keuangan/persekot_kerja/jenis_inputPK', compact('tor', 'm', 'namaprodi', 'memo_cair', 'persekot_kerja', 'dokumen'))->render();
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
        }
        return datatables()::of($pk)->rawColumns(['status', 'button'])->tojson();
    }
}
