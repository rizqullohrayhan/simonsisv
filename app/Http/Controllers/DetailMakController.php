<?php

namespace App\Http\Controllers;

use App\Models\BelanjaMak;
use App\Models\DetailMak;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DetailMakController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:detailmak_show', ['index', 'searchDetail']);
        $this->middleware('permission:detailmak_create', ['only' => 'processAdd']);
        $this->middleware('permission:detailmak_update', ['only' => 'processUpdate']);
        $this->middleware('permission:detailmak_delete', ['only' => 'delete']);
    }
    public function index()
    {
        $mak = DB::table('mak')->get();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $belanja_mak = DB::table('belanja_mak')->get();
        $detail_mak = DB::table('detail_mak')->simplePaginate(15);
        $tabelRole =  Role::all();
        // $join = BelanjaMak::joinKelompokMak();
        $joinDetail = DB::table('detail_mak')
            ->join('belanja_mak', 'detail_mak.id_belanja', '=', 'belanja_mak.id')
            ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
            ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
            ->select('detail_mak.id as idDetail', 'detail_mak.detail', 'belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
            ->simplePaginate(15);
        return view(
            "pengaturan.mak.detail_mak.index",
            [
                'mak' => $mak, 'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'joinDetail' => $joinDetail,
                'detail_mak' => $detail_mak,   'tabelRole' => $tabelRole
            ]
        );
        // return ($joinDetail);
    }
    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = DB::table('detail_mak')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process =  DB::table('detail_mak')->where('id', $id)->update($request->except('_token'));
        if ($process) {
            return redirect()->back()->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
    {
        $id = base64_decode($id);

        try {
            $process =  DB::table('detail_mak')->where('id', $id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }
    public function searchDetail(Request $request)
    {
        $cariDetail = $request->get('searchDetail');
        $cariBelanja = $request->get('searchBelanja');
        $belanja_mak = DB::table('belanja_mak')->get();
        $mak = DB::table('mak')->get();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $tabelRole =  Role::all();

        if (is_null($cariDetail) && is_null($cariBelanja)) {
            $detail_mak = DB::table('detail_mak')->simplePaginate(15);
            $joinDetail = DB::table('detail_mak')
                ->join('belanja_mak', 'detail_mak.id_belanja', '=', 'belanja_mak.id')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('detail_mak.id as idDetail', 'detail_mak.detail', 'belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->simplePaginate(15);
        }
        if (!is_null($cariDetail) && is_null($cariBelanja)) {
            $detail_mak = DB::table('detail_mak')->where('detail', 'LIKE', "%{$cariDetail}%")->simplePaginate(15);
            $joinDetail = DB::table('detail_mak')
                ->join('belanja_mak', 'detail_mak.id_belanja', '=', 'belanja_mak.id')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('detail_mak.id as idDetail', 'detail_mak.detail', 'belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->where('detail', 'LIKE', "%{$cariDetail}%")
                ->simplePaginate(15);
        }
        if (is_null($cariDetail) && !is_null($cariBelanja)) {
            $idcariBelanja =
                $detail_mak = DB::table('detail_mak')->get();
            $joinDetail = DB::table('detail_mak')
                ->join('belanja_mak', 'detail_mak.id_belanja', '=', 'belanja_mak.id')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('detail_mak.id as idDetail', 'detail_mak.detail', 'belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->where('belanja', 'LIKE', "%{$cariBelanja}%")
                ->simplePaginate(15);
        }
        if (!is_null($cariDetail) && !is_null($cariBelanja)) {
            $detail_mak = DB::table('detail_mak')->where('detail', 'LIKE', "%{$cariDetail}%")->simplePaginate(15);
            $joinDetail = DB::table('detail_mak')
                ->join('belanja_mak', 'detail_mak.id_belanja', '=', 'belanja_mak.id')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('detail_mak.id as idDetail', 'detail_mak.detail', 'belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->where('belanja', 'LIKE', "%{$cariBelanja}%")
                ->where('detail', 'LIKE', "%{$cariDetail}%")
                ->simplePaginate(15);
        }
        return view(
            "pengaturan.mak.detail_mak.index",
            [
                'mak' => $mak, 'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'joinDetail' => $joinDetail,
                'detail_mak' => $detail_mak,  'tabelRole' => $tabelRole
            ]
        );
        // return $joinDetail;
    }
}
