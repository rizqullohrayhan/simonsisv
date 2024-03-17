<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedoman;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class PedomanController extends Controller
{
    //
    public function index()
    {
        $pedoman = Pedoman::all();
        $tabelRole =  Role::all();
        return view(
            "pengaturan.pedoman.index",
            compact('pedoman', 'tabelRole')
        );
    }
    public function store(Request $request)
    {
        $file           = $request->file('file');
        //mengambil nama file
        $nama_file      = $file->getClientOriginalName();
        $nama          = $request->nama;
        $jenis          = $request->jenis;
        $tahun          = $request->tahun;
        //memindahkan file ke folder tujuan
        $file->move('pedoman', $file->getClientOriginalName());

        $upload         = new Pedoman();
        $upload->nama   = $nama;
        $upload->file   = $nama_file;
        $upload->tahun   = $tahun;
        $upload->path   = $nama_file;
        $upload->jenis  = $jenis;

        //menyimpan data ke database
        $upload->save();

        //kembali ke halaman sebelumnya
        return back();
    }
    public function processUpdate(Request $request, $id)
    {
        $request->validate([]);

        $filepedoman = Pedoman::where('id', $id)->first();
        File::delete('pedoman/' . $filepedoman->file);

        if (!empty($request->file)) {
            $file           = $request->file('file');
            //mengambil nama file
            $nama_file      = $file->getClientOriginalName();
            $file->move('pedoman', $file->getClientOriginalName());
        }
        if (empty($request->file)) {
            $nama_file      = Pedoman::all()->where('id', $id)->get('file');
        }
        $nama          = $request->nama;
        $jenis          = $request->jenis;
        $tahun          = $request->tahun;
        //memindahkan file ke folder tujuan

        if (!empty($request->file)) {
            $process = Pedoman::findOrFail($id)->update([
                'nama'  => $nama,
                'file'  => $nama_file,
                'tahun'  => $tahun,
                'path'  => $nama_file,
                'jenis' => $jenis,
            ]);
        }
        if (empty($request->file)) {
            $process = Pedoman::findOrFail($id)->update([
                'nama'  => $nama,
                'tahun'  => $tahun,
                'jenis' => $jenis,
            ]);
        }


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
            // hapus file
            $filepedoman = Pedoman::where('id', $id)->first();
            File::delete('pedoman/' . $filepedoman->file);

            // hapus data
            $process =  DB::table('pedoman')->where('id', $id)->delete();
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
