<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triwulan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'triwulan';
    protected $guarded = [];

    public function tahun()
    {
        // $this->relationsType("Model","Foreign_key","Local_key");
        return $this->belongsTo('App\Models\Tahun', 'id_tahun', 'id');
    }
    public function tor()
    {
        return $this->hasMany('App\Models\Tor', 'id_tw', 'id');
    }
}
