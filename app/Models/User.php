<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasFactory;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'users';
    // protected $guarded = ['id'];
    protected $fillable = [
        'id_unit',
        'name',
        'email',
        'role',
        'multirole',
        'nip',
        'jabatan',
        'image',
        'is_aktif',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function roles()
    // {
    //     return $this->belongsTo('Spatie\Permission\Models\Role', 'role', 'id');
    // }
    public function join()
    {
        $joinUser = DB::table('users')
            ->leftjoin('roles', 'users.role', '=', 'roles.id')
            ->select('roles.name as name_role', 'users.name as name_users', 'users.*')
            ->get('*');
        return $joinUser;
    }
    public function namarole()
    {
        $joinUser = DB::table('users')
            ->leftjoin('roles', 'users.role', '=', 'roles.id')
            ->select(DB::raw('roles.name as name_role'))
            ->where('roles.id', 2)
            ->get();
        return $joinUser->toArray();
    }
    // public function pic($idunit)
    // {
    //     $joinUser = DB::table('users')
    //         ->leftjoin('roles', 'users.role', '=', 'roles.id')
    //         ->leftjoin('unit', 'users.id_unit', '=', 'unit.id')
    //         ->select('roles.name as name_role', 'users.name as name_users', 'users.*', 'unit.nama_unit')
    //         ->where('roles.name', 'PIC')
    //         ->where('unit.id', $idunit)
    //         ->get('*');
    //     return $joinUser;
    // }
    public function toRole()
    {
        // $this->relationsType("Model","Foreign_key","Local_key");
        return $this->belongsTo('Spatie\Permission\Models\Role', 'role', 'id');
    }
    /**
     * Get all of the trxStatusTor for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trxStatusTor()
    {
        return $this->hasMany(TrxStatusTor::class, 'create_by', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit', 'id');
    }
}
