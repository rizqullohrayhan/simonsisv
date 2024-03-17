<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPJSubKategori extends Model
{
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'spj_subkategori';
    protected $guarded = [];
}
