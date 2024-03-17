<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'spj';
    protected $guarded = [];
}
