<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $authorities = config('permission.authorities');

        $listPermission = [];
        $adminPermissions = [];
        $prodiPermissions = [];
        $wd3Permissions = [];
        $wd2Permissions = [];

        foreach ($authorities as $label => $permission) {
            foreach ($permission as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                //admin
                if (in_array($label, [
                    'manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan',
                    'manage_tahun', 'manage_triwulan', 'manage_unit', 'manage_pagu', 'manage_mak', 'manage_kelompokmak',
                    'manage_belanjamak', 'manage_detailmak', 'manage_iku', 'manage_ik', 'manage_k', 'manage_subk',
                    'manage_roles', 'manage_users'
                ])) {
                    $adminPermissions[] = [
                        'ajuan_monitoringUsulan', 'ajuan_monitoringIKU', 'tahun_show', 'triwulan_show', 'unit_show', 'pagu_show', 'mak_show',
                        'kelompokmak_show', 'belanjamak_show', 'detailmak_show', 'iku_show', 'ik_show', 'k_show',
                        'subk_show', 'role_show', 'role_create', 'role_update', 'role_detail', 'role_delete',
                        'user_show', 'user_create', 'user_update', 'user_detail', 'user_delete',
                        'kaprodi_show', 'kaprodi_create', 'kaprodi_update', 'kaprodi_detail', 'kaprodi_delete',
                    ];
                }

                //prodi
                if (in_array($label, ['manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan', 'manage_pic', 'manage_kaprodi'])) {
                    $prodiPermissions[] = [
                        'tor_show', 'tor_create', 'tor_update', 'tor_detail', 'tor_delete', 'tor_ajuan',
                        'rab_show', 'rab_create', 'rab_update', 'rab_detail', 'rab_delete',
                        'anggaran_show', 'anggaran_create', 'anggaran_update', 'anggaran_detail', 'anggaran_delete',
                        'ajuan_torrab', 'pic_show', 'pic_create', 'pic_update', 'pic_detail', 'pic_delete',
                        'kaprodi_show', 'kaprodi_create', 'kaprodi_update', 'kaprodi_detail', 'kaprodi_delete',
                    ];
                }
                //wd3
                if (in_array($label, [
                    'manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan',
                    'manage_tahun', 'manage_triwulan', 'manage_unit', 'manage_pagu', 'manage_mak', 'manage_kelompokmak',
                    'manage_belanjamak', 'manage_detailmak', 'manage_iku', 'manage_ik', 'manage_k', 'manage_subk',
                    'manage_roles', 'manage_users'
                ])) {
                    $wd3Permissions[] = [
                        'tor_show', 'tor_detail', 'rab_show', 'rab_detail', 'anggaran_show',
                        'anggaran_detail',  'tor_validasi', 'ajuan_monitoringUsulan', 'ajuan_monitoringIKU', 'ajuan_validasi'
                    ];;
                }
                //wd2
                if (in_array($label, [
                    'manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan',
                    'manage_tahun', 'manage_triwulan', 'manage_unit', 'manage_pagu', 'manage_mak', 'manage_kelompokmak',
                    'manage_belanjamak', 'manage_detailmak', 'manage_iku', 'manage_ik', 'manage_k', 'manage_subk',
                    'manage_roles', 'manage_users'
                ])) {
                    $wd2Permissions[] = [
                        'tor_show', 'tor_detail', 'rab_show', 'rab_detail', 'anggaran_show',
                        'anggaran_detail', 'tor_validasi', 'ajuan_monitoringUsulan', 'ajuan_monitoringIKU', 'ajuan_validasi'
                    ];
                }
                //wd1
                if (in_array($label, [
                    'manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan',
                    'manage_tahun', 'manage_triwulan', 'manage_unit', 'manage_pagu', 'manage_mak', 'manage_kelompokmak',
                    'manage_belanjamak', 'manage_detailmak', 'manage_iku', 'manage_ik', 'manage_k', 'manage_subk',
                    'manage_roles', 'manage_users'
                ])) {
                    $wd1Permissions[] = [
                        'tor_show', 'tor_detail', 'rab_show', 'rab_detail', 'anggaran_show',
                        'anggaran_detail', 'tor_validasi', 'ajuan_monitoringUsulan', 'ajuan_monitoringIKU', 'ajuan_validasi'
                    ];
                }
            }
        }

        //INSERT PERMISSION
        Permission::insert($listPermission);

        //Admin
        $admin = Role::create([
            'name' => "Admin",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $prodi = Role::create([
            'name' => "Prodi",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $wd1 = Role::create([
            'name' => "WD 1",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $wd2 = Role::create([
            'name' => "WD 2",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $wd3 = Role::create([
            'name' => "WD 3",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Role -> permission
        $admin->givePermissionTo($adminPermissions);
        $prodi->givePermissionTo($prodiPermissions);
        $wd3->givePermissionTo($wd3Permissions);
        $wd2->givePermissionTo($wd2Permissions);
        $wd1->givePermissionTo($wd1Permissions);

        // User::find(1)->assignRole("Admin");
        $useradmin = User::create([
            'id' => 1,
            'id_unit' => '1',
            'name' => 'admin',
            'email' => 'rizqullohrayhan@student.uns.ac.id',
            'role' => 1, //admin
            'multirole' => '1, 2, 3, 4, 5',
            'is_aktif' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('vokasibergerak'),
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        $wd1 = User::create([
            'id' => 2,
            'id_unit' => '1',
            'name' => 'Agus Dwi Priyanto, S.S.,M.CALL',
            'email' => 'apriyanto@staff.uns.ac.id',
            'role' => 3, //admin
            'multirole' => '3',
            'is_aktif' => 1,
            'nip' => '',
            'email_verified_at' => now(),
            'password' => Hash::make('vokasibergerak'),
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        $wd2 = User::create([
            'id' => 3,
            'id_unit' => '1',
            'name' => 'Abdul Aziz, S.Kom., M.Cs.',
            'email' => 'aaziz@staff.uns.ac.id',
            'role' => 4, //admin
            'multirole' => '4',
            'is_aktif' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('vokasibergerak'),
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        $wd3 = User::create([
            'id' => 4,
            'id_unit' => '1',
            'name' => 'Dr. Eng. Herman Saputro, S.Pd., M.Pd., M.T.',
            'email' => 'hermansaputro@staff.uns.ac.id',
            'role' => 5, //admin
            'multirole' => '5',
            'is_aktif' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('vokasibergerak'),
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);


        $role = $admin;

        // $useradmin->assignRole([$admin]);
    }
}
