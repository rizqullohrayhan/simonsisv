<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PICPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        $listPermission = [];

        foreach ($authorities as $label => $permission) {
            foreach ($permission as $permission) {
                // $listPermission[] = [
                //     'name' => $permission,
                //     'guard_name' => 'web',
                //     'created_at' => date('Y-m-d H:i:s'),
                //     'updated_at' => date('Y-m-d H:i:s'),
                // ];

                if (in_array($label, ['manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan', 'manage_pic'])) {
                    $prodiPermissions[] = [
                        'tor_show', 'tor_create', 'tor_update', 'tor_detail', 'tor_delete', 'tor_ajuan',
                        'rab_show', 'rab_create', 'rab_update', 'rab_detail', 'rab_delete',
                        'anggaran_show', 'anggaran_create', 'anggaran_update', 'anggaran_detail', 'anggaran_delete',
                        'ajuan_torrab', 'pic_show', 'pic_create', 'pic_update', 'pic_detail', 'pic_delete',
                    ];
                }
            }
        }

        //INSERT PERMISSION
        // Permission::insert($listPermission);

        $prodi = Role::where('name', 'Prodi')->first();

        $prodi->syncPermissions($prodiPermissions);
    }
}
