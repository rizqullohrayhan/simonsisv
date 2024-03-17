<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BelanjaMak extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'belanja_mak';
    protected $guarded = [];

    public function joinKelompokMak()
    {
        $join = DB::table('belanja_mak')
            ->join('kelompok_mak', 'belanja_mak.id_kelompok', '=', 'kelompok_mak.id')
            ->join('mak', 'kelompok_mak.id_mak', '=', 'mak.id')
            ->select('mak.id as idMak', 'mak.jenis_belanja', 'kelompok_mak.id as idKelompok', 'kelompok_mak.kelompok', 'belanja_mak.id as idBelanja', 'belanja_mak.belanja')
            ->get('*');
        return $join;
    }
}
