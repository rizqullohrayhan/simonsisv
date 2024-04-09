<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Rab extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'rab';
    protected $guarded = [];

    /**
     * Get the tor that owns the Rab
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tor()
    {
        return $this->belongsTo(Tor::class, 'id_tor', 'id');
    }
}
