<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class KaprodiController extends Controller
{
    protected $table = 'kaprodis';
    public function __construct()
    {
        $this->middleware('permission:kaprodi_create');
        $this->middleware('permission:kaprodi_delete');
        $this->middleware('permission:kaprodi_detail');
        $this->middleware('permission:kaprodi_show');
        $this->middleware('permission:kaprodi_update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usernya = new User();
        $userrole = $usernya->join();
        $tabelRole =  Role::all();
        $unit = Unit::findOrFail(Auth::user()->id_unit)->id;
        $hasKaprodi = Kaprodi::where('id_unit', $unit)->first();
        return view("pengaturan.kaprodi.kaprodi_index")->with([
            'userrole' => $userrole, 'tabelRole' => $tabelRole, 'hasKaprodi' => $hasKaprodi
        ]);
    }

    public function list()
    {
        $kaprodi = Kaprodi::where('id_unit', Auth::user()->id_unit)->get();

        return DataTables::of($kaprodi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $aksi = '<button type="button" class="btn btn-warning btn-edit" data-id="' . $row->id . '" title="Edit Kaprodi"><i class="ri-pencil-line"></i></a>';
                // $aksi .= '<button type="button" class="btn btn-danger btn-delete" data-id="' . $row->id . '" title="Hapus Kaprodi"><i class="ri-delete-bin-line"></i></a>';
                return '<div class="row ml-3"><div class="flex align-items-center list-user-action"><div class="row">' . $aksi . '</div></div></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'nip' => ['required', 'numeric'],
        ], [
            'required' => ':attribute wajib diisi!',
            'numeric' => ':attribute tidak Valid!',
        ], [
            'name' => 'Nama Kaprodi',
            'nip' => 'NIP',
        ]);

        try {
            Kaprodi::create([
                'id_unit' => Auth::user()->id_unit,
                'name' => $request->name,
                'nip' => $request->nip,
            ]);
            return response()->json(['status' => true, 'message' => 'Kaprodi Berhasil Ditambahkan'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Terjadi Kesalahan'], 500);
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pic = Kaprodi::findOrFail($id);
        return response()->json($pic, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'nip' => ['required', 'numeric'],
        ], [
            'required' => ':attribute wajib diisi!',
            'numeric' => ':attribute tidak Valid!',
        ], [
            'name' => 'Nama PIC',
            'nip' => 'NIP',
        ]);

        try {
            Kaprodi::findOrFail($id)->update([
                'id_unit' => Auth::user()->id_unit,
                'name' => $request->name,
                'nip' => $request->nip,
            ]);
            return response()->json(['status' => true, 'message' => 'Data Kaprodi Berhasil Diupdate'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Terjadi Kesalahan'], 500);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            PIC::findOrFail($id)->delete();
            return response()->json(['status' => true, 'message' => 'Data PIC Berhasil Dihapus'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Terjadi Kesalahan'], 500);
            //throw $th;
        }
    }
}
