<?php

namespace App\Http\Controllers;

use App\Models\Pengusulan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PengusulanController extends Controller
{
    protected $table = 'pengusulan';
    public function index()
    {
    }

    // public function add()
    // {
    //     $pengusulan = Pengusulan::all();
    //     return view("dashboards.users.tor.tor_index")->with(['pengusulan' => $pengusulan]);
    // }

    public function pengusulan(Request $request)
    {
        $request->validate([]);

        $inserting = Pengusulan::create($request->except('_token'));
        if ($inserting) {
            return redirect()->back()->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function update($id)
    {
    }

    public function processUpdate(Request $request, $id)
    {
    }

    public function delete($id)
    {
    }
    public function search(Request $request)
    {
    }
}
