<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'indikator_p';
    protected $guarded = [];

    public function IndikatorIK()
    {
        // $this->relationsType("Model","Foreign_key","Local_key");
        return $this->belongsTo('App\Models\IKModel', 'id_ik', 'id');
    }
    // public function sub_kegiatan()
    // {
    //     // $this->relationsType("Model","Foreign_key","Local_key");
    //     return $this->hasMany('App\Models\SubKegiatan', 'id_subk', 'id');
    // }
}
