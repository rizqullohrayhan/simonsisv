<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Rab;
use App\Models\Tor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggaranController extends Controller
{
    // protected $table = 'anggaran';
    public function __construct()
    {
        $this->middleware('permission:anggaran_create', ['only' => 'add']);
        $this->middleware('permission:anggaran_delete', ['edit', 'delete']);
        $this->middleware('permission:anggaran_update', ['only' => 'update']);
    }
    // public function index()
    // {
    //     $anggaran = Anggaran::all();
    //     $tor = Tor::all();
    //     $kegiatan = Kegiatan::all();
    //     $userrole = User::join();
    //     $mak = DB::table('mak')->get();
    //     return view("dashboards.users.anggaran.anggaran")->with(['anggaran' => $anggaran, 'tor' => $tor, 'kegiatan' => $kegiatan, 'mak' => $mak, 'userrole' => $userrole]);
    // }

    // public function add()
    // {
    //     $anggaran = Anggaran::all();
    //     $tor = Tor::all();
    //     $kegiatan = Kegiatan::all();
    //     $mak = DB::table('mak')->get();
    //     return view("dashboards.users.anggaran.anggaran_create")->with(['anggaran' => $anggaran, 'tor' => $tor, 'kegiatan' => $kegiatan, 'mak' => $mak]);
    // }

    public function processAdd(Request $request)
    {
        $request->validate([]);

        $total = [$request->total_anggaran +  $request->anggaran]; //total anggaran
        $inserting = anggaran::create($request->except('_token', 'id_mak', 'id_kelompok', 'id_belanja', 'total_anggaran', 'id_tor', 'total_anggaran_tor'));
        if ($request->total_anggaran <= $request->total_anggaran_tor) {
            $inserting = DB::table('tor')->select('jumlah_anggaran')->where('id', $request->id_tor)->update(array('jumlah_anggaran' => $total[0]));
        }
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
        // return $request->id_tor;
    }

    public function update($id)
    {
        try {
            $anggaran = Anggaran::findOrFail($id);
            $tor = Tor::all();
            $rab = Rab::all();
            $mak = DB::table('mak')->get();
            return view("dashboards.users.anggaran.anggaran_update")->with([
                'anggaran' => $anggaran, 'rab' => $rab, 'tor' => $tor, 'mak' => $mak
            ]);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);
        $total = [$request->total_anggaran_tor -  $request->anggaran_sebelum_rev]; //anggaran sebelum rev
        $total2 = [$total[0] + $request->anggaran]; //ditambah anggaran yang telah diubah
        $inserting = anggaran::findOrFail($id)->update($request->except('_token', 'id_mak', 'id_kelompok', 'id_belanja', 'id_tor', 'total_anggaran_tor', 'anggaran_sebelum_rev'));
        $inserting = DB::table('tor')->select('jumlah_anggaran')->where('id', $request->id_tor)->update(array('jumlah_anggaran' => $total2[0]));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
        // return $total2;
    }

    public function delete(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            $process = Anggaran::findOrFail($id)->delete();
            $totaldiTor = [$request->totalAnggaranTor -  $request->anggaranDiHapus]; //menyimpan data ke table tor
            $process = DB::table('tor')->select('jumlah_anggaran')->where('id', $request->id_tor)->update(array('jumlah_anggaran' => $totaldiTor[0]));
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
        // return $totaldiTor[0];
    }
    public function search(Request $request)
    {
    }
    public function getKelompokMak($id)
    {
        $namakelompok = DB::table('kelompok_mak')->where('id_mak', $id)->get();
        return response()->json($namakelompok);
    }

    public function getBelanjaMak($id)
    {
        $namabelanja = DB::table('belanja_mak')->where('id_kelompok', $id)->get();
        return response()->json($namabelanja);
    }
    public function getDetailMak($id)
    {
        $namadetail = DB::table('detail_mak')->where('id_belanja', $id)->get();
        return response()->json($namadetail);
    }
    public function getDetailHargaMak($id)
    {
        $hargadetail = DB::table('detail_mak')->where('id', $id)->get();
        return response()->json($hargadetail);
    }
}
