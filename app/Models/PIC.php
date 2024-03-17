<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    use HasFactory;

    protected $table = 'pics';
    protected $guarded = ['id'];

    /**
     * Get all of the tor for the PIC
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tor()
    {
        return $this->hasMany(Tor::class, 'nama_pic', 'id');
    }
}
