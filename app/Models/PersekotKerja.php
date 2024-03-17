<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersekotKerja extends Model
{
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'persekot_kerja';
    protected $guarded = [];
}
