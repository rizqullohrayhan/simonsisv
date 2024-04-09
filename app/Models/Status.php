<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    /**
     * Get all of the trxStatusTor for the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trxStatusTor()
    {
        return $this->hasMany(TrxStatusTor::class, 'id_status', 'id');
    }
}
