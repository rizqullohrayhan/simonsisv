<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxStatusKeu extends Model
{
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'trx_status_keu';
    protected $guarded = [];
}
