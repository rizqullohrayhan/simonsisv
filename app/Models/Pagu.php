<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagu extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'pagu';
    protected $guarded = [];

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'id_unit');
    }

    public function tor()
    {
        return $this->hasMany(Tor::class, 'id_unit', 'id_unit');
    }
}
