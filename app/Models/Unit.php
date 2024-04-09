<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'unit';
    protected $guarded = [];

    /**
     * Get the kaprodi associated with the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class, 'id_unit', 'id');
    }

    /**
     * Get all of the tor for the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tor()
    {
        return $this->hasMany(Tor::class, 'id_unit', 'id');
    }
}
