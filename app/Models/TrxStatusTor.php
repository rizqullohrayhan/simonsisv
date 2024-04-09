<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrxStatusTor extends Model
{
    use HasFactory;
    protected $table = 'trx_status_tor';
    protected $guarded = ['id'];
    public function TrxStatus($id)
    {
        $trx = DB::table('trx_status_tor')
            ->leftjoin('tor', 'trx_status_tor.id_tor', '=', 'tor.id')
            ->leftjoin('status', 'trx_status_tor.id_status', '=', 'status.id')
            ->leftjoin('users', 'trx_status_tor.create_by', '=', 'users.id')
            ->leftjoin('roles', 'users.role', '=', 'roles.id')
            ->select('tor.id as idTor', 'status.nama_status', 'roles.name')
            ->where('tor.id', $id)
            ->get('*');
        return $trx;
    }
    public function StatusPerbaikan($id)
    {
        $trx = DB::table('trx_status_tor')
            ->leftjoin('tor', 'trx_status_tor.id_tor', '=', 'tor.id')
            ->leftjoin('status', 'trx_status_tor.id_status', '=', 'status.id')
            ->leftjoin('users', 'trx_status_tor.create_by', '=', 'users.id')
            ->leftjoin('roles', 'users.role', '=', 'roles.id')
            ->select('tor.id as idTor', 'status.nama_status', 'roles.name')
            ->where('tor.id', $id)
            ->where('status.nama_status', "Pengajuan Perbaikan")
            ->get('*');
        return $trx;
    }
    public function Revisi($id)
    {
        $trx = DB::table('trx_status_tor')
            ->leftjoin('tor', 'trx_status_tor.id_tor', '=', 'tor.id')
            ->leftjoin('status', 'trx_status_tor.id_status', '=', 'status.id')
            ->leftjoin('users', 'trx_status_tor.create_by', '=', 'users.id')
            ->leftjoin('roles', 'users.role', '=', 'roles.id')
            ->select('tor.id as idTor', 'status.nama_status', 'roles.name')
            ->where('tor.id', $id)
            ->where('status.nama_status', "Revisi")
            ->get('*');
        return $trx;
    }

    /**
     * Get the status that owns the TrxStatusTor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id');
    }
    /**
     * Get the user that owns the TrxStatusTor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'create_by', 'id');
    }
}
