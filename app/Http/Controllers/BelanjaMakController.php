<?php

namespace App\Http\Controllers;

use App\Models\BelanjaMak;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BelanjaMakController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:belanjamak_show', ['index', 'searchBelanja']);
        $this->middleware('permission:belanjamak_create', ['only' => 'processAdd']);
        $this->middleware('permission:belanjamak_update', ['only' => 'processUpdate']);
        $this->middleware('permission:belanjamak_delete', ['only' => 'delete']);
    }
    public function index()
    {
        $mak = DB::table('mak')->get();
        $tabelRole =  Role::all();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $belanja_mak = DB::table('belanja_mak')->get();
        // $join = BelanjaMak::joinKelompokMak();
        $joinKelompok = DB::table('belanja_mak')
            ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
            ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
            ->select('belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
            ->get();
        return view(
            "pengaturan.mak.belanja_mak.index",
            [
                'mak' => $mak, 'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'joinKelompok' => $joinKelompok,
                'tabelRole' => $tabelRole
            ]
        );
        // return ($joinKelompok);
    }
    public function processAdd(Request $request)
    {
        $request->validate([]);

        $inserting = DB::table('belanja_mak')->insert($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $process =  DB::table('belanja_mak')->where('id', $id)->update($request->except('_token'));
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
            $process =  DB::table('belanja_mak')->where('id', $id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }
    public function searchBelanja(Request $request)
    {
        $cariKelompok = $request->get('searchKelompok');
        $cariBelanja = $request->get('searchBelanja');

        $mak = DB::table('mak')->get();
        $kelompok_mak = DB::table('kelompok_mak')->get();

        if (is_null($cariKelompok) && is_null($cariBelanja)) {
            $belanja_mak = DB::table('belanja_mak')->simplePaginate(15);
            $joinKelompok = DB::table('belanja_mak')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->simplePaginate(15);
        }

        if (!is_null($cariKelompok) && is_null($cariBelanja)) {
            $belanja_mak = DB::table('belanja_mak')->where('belanja', 'LIKE', "%{$cariBelanja}%")->simplePaginate(15);
            $joinKelompok = DB::table('belanja_mak')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->where('kelompok', 'LIKE', "%{$cariKelompok}%")
                ->simplePaginate(15);
        }
        if (is_null($cariKelompok) && !is_null($cariBelanja)) {
            $belanja_mak = DB::table('belanja_mak')->get();
            $joinKelompok = DB::table('belanja_mak')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->where('belanja', 'LIKE', "%{$cariBelanja}%")
                ->simplePaginate(15);
        }
        if (!is_null($cariKelompok) && !is_null($cariBelanja)) {
            $belanja_mak = DB::table('belanja_mak')->where('belanja', 'LIKE', "%{$cariBelanja}%")->simplePaginate(15);
            $joinKelompok = DB::table('belanja_mak')
                ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
                ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
                ->select('belanja_mak.id as idBelanja', 'belanja_mak.belanja', 'mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok',)
                ->where('kelompok', 'LIKE', "%{$cariKelompok}%")
                ->where('belanja', 'LIKE', "%{$cariBelanja}%")
                ->simplePaginate(15);
        }
        return view(
            "pengaturan.mak.belanja_mak.index",
            [
                'mak' => $mak, 'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'joinKelompok' => $joinKelompok
            ]
        );
    }
}
