<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'anggaran';
    protected $guarded = [];

    public function Rab_Ang()
    {
        $rab_ang = DB::table('anggaran')
            ->leftjoin('rab', 'anggaran.id_rab', '=', 'rab.id')
            ->leftjoin('detail_mak', 'anggaran.id_detail_mak', '=', 'detail_mak.id')
            ->select('rab.id as id_rab', 'anggaran.anggaran', 'anggaran.*', 'detail_mak.detail')
            ->get('*');
        return $rab_ang;
    }
    public function total_anggaran_tw()
    {
        $total = DB::table('anggaran')
            ->leftjoin('rab', 'anggaran.id_rab', '=', 'rab.id')
            ->leftjoin('tor', 'rab.id_tor', '=', 'tor.id')
            ->leftjoin('triwulan', 'tor.id_tw', '=', 'triwulan.id')
            ->select(
                'rab.masukan as masukan_rab',
                'rab.id as id_rab',
                'anggaran.anggaran',
                'anggaran.id as id_anggaran',
                'tor.id as id_tor',
                'tor.id_tw',
                'triwulan.triwulan as triwulan',
                'tor.id_unit as id_unit_tor',
                'tor.tgl_mulai_pelaksanaan as tgl_mulai_pelaksanaan',
            )
            ->get('*');
        return $total;
    }
}
