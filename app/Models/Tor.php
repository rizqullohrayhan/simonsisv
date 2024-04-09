<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'tor';
    protected $guarded = [];

    public function tor_unit_user()
    {
        $tor_unit_user = DB::table('tor')
            ->leftjoin('unit', 'tor.id_unit', '=', 'unit.id')
            ->select('tor.*', 'tor.id ', 'unit.*', 'unit.id as id_unit_tor')
            ->get('*');
        return $tor_unit_user;
    }
    public function status()
    {
        $status = DB::table('tor')
            ->rightjoin('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
            ->select('tor.*', 'trx_status_tor.*')
            ->get('*');
        return $status;
    }
    public function notifikasi()
    {
        $status = DB::table('tor')
            ->join('trx_status_tor', 'tor.id', '=', 'trx_status_tor.id_tor')
            ->join('roles', 'trx_status_tor.create_by', '=', 'roles.id')
            ->join('status', 'trx_status_tor.id_status', '=', 'status.id')
            ->select(
                'tor.*',
                'trx_status_tor.id as id_trx',
                'trx_status_tor.id_status',
                'trx_status_tor.create_by',
                'roles.name as reviewer',
                'status.id as id_sts',
                'status.nama_status as nama_status'
            )
            ->get('*');
        return $status;
    }

    public function dokumen()
    {
        return $this->hasOne(Dokumen::class);
    }

    public function spj()
    {
        return $this->hasOne(SPJ::class, 'id_tor', 'id');
    }

    public function lastStatus()
    {
        return $this->hasOne(TrxStatusTor::class, 'id_tor', 'id')->orderBy('id', 'desc');
    }

    public function triwulan()
    {
        return $this->belongsTo('App\Models\Triwulan', 'id_tw', 'id');
    }

    public function rab()
    {
        return $this->hasOne(Rab::class, 'id_tor', 'id');
    }

    public function pic()
    {
        return $this->belongsTo(PIC::class, 'nama_pic', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit', 'id');
    }
}
