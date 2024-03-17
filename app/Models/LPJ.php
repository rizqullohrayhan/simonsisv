<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPJ extends Model
{
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'lpj';
    protected $guarded = [];
}
