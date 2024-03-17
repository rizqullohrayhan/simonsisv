<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenSPJ extends Model
{
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'dokumen_spj';
    protected $guarded = [];

    // public function tor()
    // {
    //     return $this->belongsTo(Tor::class);
    // }

    // public function spj_subkategori()
    // {
    //     return $this->belongsTo(SPJSubKategori::class);
    // }
}
