<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'indikator_subK';
    protected $guarded = [];

    public function Kategori_Sub()
    {
        $k = DB::table('indikator_subK')
            ->rightJoin('tor', 'indikator_subK.id', '=', 'tor.id_subK')
            ->leftjoin('indikator_k', 'indikator_subK.id_k', '=', 'indikator_k.id')
            ->leftjoin('indikator_ik', 'indikator_k.id_ik', '=', 'indikator_ik.id')
            ->leftjoin('indikator_iku', 'indikator_ik.id_iku', '=', 'indikator_iku.id')
            ->select(
                'tor.id as id_tor',
                'indikator_subK.*',
                'indikator_k.K',
                'indikator_k.deskripsi as deskripsi_k',
                'indikator_ik.IK',
                'indikator_ik.deskripsi as deskripsi_ik',
                'indikator_iku.IKU',
                'indikator_iku.deskripsi as deskripsi_iku',
            )
            ->get('*');
        return $k;
    }
    // public function nilai()
    // {
    //     // $this->relationsType("Model","Foreign_key","Local_key");
    //     return $this->hasMany('App\Models\Nilai', 'nim', 'nim');
    // }

    public function Kegiatan()
    {
        // $this->relationsType("Model","Foreign_key","Local_key");
        return $this->belongsTo('App\Models\KModel', 'id_k', 'id');
    }
}
