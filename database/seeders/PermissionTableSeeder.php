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
        // $bpuPermissions = [];
        $wd3Permissions = [];
        $wd2Permissions = [];
        // $stafperencanaanPermissions = [];
        // $stafkeuPermissions = [];

        foreach ($authorities as $label => $permission) {
            foreach ($permission as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                // $adminPermissions[] = $permission;
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
                        'user_show', 'user_create', 'user_update', 'user_detail', 'user_delete'
                    ];
                }

                //kaprodi
                // if (in_array($label, ['manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan'])) {
                //     $kaprodiPermissions[] = [
                //         'tor_show', 'tor_create', 'tor_update', 'tor_detail', 'tor_delete', 'tor_ajuan',
                //         'rab_show', 'rab_create', 'rab_update', 'rab_detail', 'rab_delete',
                //         'anggaran_show', 'anggaran_create', 'anggaran_update', 'anggaran_detail', 'anggaran_delete',
                //         'ajuan_torrab', 'tor_verifikasi_kaprodi'
                //     ];
                // }

                //prodi
                if (in_array($label, ['manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan', 'manage_pic'])) {
                    $prodiPermissions[] = [
                        'tor_show', 'tor_create', 'tor_update', 'tor_detail', 'tor_delete', 'tor_ajuan',
                        'rab_show', 'rab_create', 'rab_update', 'rab_detail', 'rab_delete',
                        'anggaran_show', 'anggaran_create', 'anggaran_update', 'anggaran_detail', 'anggaran_delete',
                        'ajuan_torrab', 'pic_show', 'pic_create', 'pic_update', 'pic_detail', 'pic_delete',
                    ];
                }
                //pic
                // if (in_array($label, ['manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan'])) {
                //     $picPermissions[] = [
                //         'tor_show', 'tor_create', 'tor_update', 'tor_detail', 'tor_delete', 'tor_ajuan',
                //         'rab_show', 'rab_create', 'rab_update', 'rab_detail', 'rab_delete',
                //         'anggaran_show', 'anggaran_create', 'anggaran_update', 'anggaran_detail', 'anggaran_delete',
                //         'ajuan_torrab'
                //     ];
                // }
                //BPU
                // if (in_array($label, [
                //     'manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan',
                //     'manage_tahun', 'manage_triwulan', 'manage_unit', 'manage_pagu', 'manage_mak', 'manage_kelompokmak',
                //     'manage_belanjamak', 'manage_detailmak', 'manage_iku', 'manage_ik', 'manage_k', 'manage_subk',
                //     'manage_roles', 'manage_users'
                // ])) {
                //     $bpuPermissions[] = [
                //         'tor_show', 'tor_detail', 'rab_show', 'rab_detail', 'anggaran_show', 'anggaran_detail',
                //         'tor_verifikasi', 'ajuan_monitoringUsulan', 'ajuan_monitoringIKU', 'ajuan_validasi'
                //     ];
                // }
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
                //staf_perencanaan
                // if (in_array($label, [
                //     'manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan',
                //     'manage_tahun', 'manage_triwulan', 'manage_unit', 'manage_pagu', 'manage_mak', 'manage_kelompokmak',
                //     'manage_belanjamak', 'manage_detailmak', 'manage_iku', 'manage_ik', 'manage_k', 'manage_subk',
                //     'manage_roles', 'manage_users'
                // ])) {
                //     $stafperencanaanPermissions[] = [
                //         'tor_show', 'tor_detail', 'rab_show', 'rab_detail', 'anggaran_show', 'anggaran_detail',
                //         'ajuan_monitoringUsulan', 'ajuan_monitoringIKU', 'ajuan_validasi'
                //     ];;
                // }
                //staf_keuangan
                // if (in_array($label, [
                //     'manage_tor', 'manage_rab', 'manage_anggaran', 'manage_buttonpengajuan',
                //     'manage_tahun', 'manage_triwulan', 'manage_unit', 'manage_pagu', 'manage_mak', 'manage_kelompokmak',
                //     'manage_belanjamak', 'manage_detailmak', 'manage_iku', 'manage_ik', 'manage_k', 'manage_subk',
                //     'manage_roles', 'manage_users'
                // ])) {
                //     $stafkeuPermissions[] = [
                //         'tor_show', 'tor_detail', 'rab_show', 'rab_detail', 'anggaran_show',
                //         'anggaran_detail', 'ajuan_monitoringUsulan', 'ajuan_monitoringIKU', 'ajuan_validasi'
                //     ];;
                // }
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
        // dd($listPermission);

        // dd("admin", $adminPermissions);
        // dd("fakultas", $fakultasPermissions);

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
        // $bpu = Role::create([
        //     'name' => "BPU",
        //     'guard_name' => 'web',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
        $wd3 = Role::create([
            'name' => "WD 3",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // $staf_perencanaan = Role::create([
        //     'name' => "Staf Perencanaan",
        //     'guard_name' => 'web',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
        // $staf_keu = Role::create([
        //     'name' => "Staf Keuangan",
        //     'guard_name' => 'web',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
        $wd2 = Role::create([
            'name' => "WD 2",
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
        // $pic = Role::create([
        //     'name' => "PIC",
        //     'guard_name' => 'web',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // $kaprodi = Role::create([
        //     'name' => "Kaprodi",
        //     'guard_name' => 'web',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // Role -> permission
        $admin->givePermissionTo($adminPermissions);
        $prodi->givePermissionTo($prodiPermissions);
        // $bpu->givePermissionTo($bpuPermissions);
        $wd3->givePermissionTo($wd3Permissions);
        // $staf_perencanaan->givePermissionTo($stafperencanaanPermissions);
        // $staf_keu->givePermissionTo($stafkeuPermissions);
        $wd2->givePermissionTo($wd2Permissions);
        $wd1->givePermissionTo($wd1Permissions);
        // $pic->givePermissionTo($picPermissions);
        // $kaprodi->givePermissionTo($kaprodiPermissions); //revisi : penambahan role kaprodi

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
        // $useradmin2 = User::create([
        //     'id' => 2,
        //     'id_unit' => '1',
        //     'name' => 'Wulan aja',
        //     'email' => 'wdari@gmail.com',
        //     'role' => 1, //admin
        //     'multirole' => '1',
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userwd2 = User::create([
        //     'id' => 3,
        //     'id_unit' => '1',
        //     'name' => 'Abdul Aziz,S.Kom.,M.Cs',
        //     'email' => 'abdulazil@gmail.com',
        //     'role' => 7, //wd2
        //     'multirole' => 7,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userwd3 = User::create([
        //     'id' => 4,
        //     'id_unit' => '1',
        //     'name' => 'Dr.Eng.Herman',
        //     'email' => 'hermans@gmail.com',
        //     'role' => 4, //wd3
        //     'multirole' => 4,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userwd1 = User::create([
        //     'id' => 5,
        //     'id_unit' => '1',
        //     'name' => 'Agus Dwi Priyanto, S.S.,M.CALL',
        //     'email' => 'agusdwi@gmail.com',
        //     'role' => 8, //wd1
        //     'multirole' => 8,
        //     'image' => 'anth.jfif',
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userbpu = User::create([
        //     'id' => 6,
        //     'id_unit' => '1',
        //     'name' => 'Nur Chayati',
        //     'email' => 'nurchayati@gmail.com',
        //     'role' => 3, //bpu
        //     'multirole' => 3,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userstaf_keu = User::create([
        //     'id' => 7,
        //     'id_unit' => '1',
        //     'name' => 'Iman',
        //     'email' => 'iman@admin.com',
        //     'role' => 6, //staf keu
        //     'multirole' => 6,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userstaf_perencanaan = User::create([
        //     'id' => 8,
        //     'id_unit' => '1',
        //     'name' => 'Rangga Azof',
        //     'email' => 'azof@gmail.com',
        //     'role' => 5, //staf perencanaan
        //     'multirole' => 5,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);

        // kaprodi d3 ti
        // $userkaprodi = User::create([
        //     'id' => 25,
        //     'id_unit' => '2',
        //     'name' => 'Hartatik, S.Si., M.Si.',
        //     'email' => 'hartatik@gmail.com',
        //     'role' => 10, //kaprodi
        //     'multirole' => 10,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);

        // $userprodi = User::create([
        //     'id' => 9,
        //     'id_unit' => '3',
        //     'name' => 'Lusi Ismayenti, S.T.,M.Kes.',
        //     'email' => 'lusiismayenti@gmail.com',
        //     'role' => 2, //prodi
        //     'multirole' => 2,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userprodi2 = User::create([
        //     'id' => 10,
        //     'id_unit' => '16',
        //     'name' => 'Rosita Mei Damayanti, S.E.,M.Rech',
        //     'email' => 'rosita@gmail.com',
        //     'role' => 2, //prodi
        //     'multirole' => 2,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userprodi3 = User::create([
        //     'id' => 11,
        //     'id_unit' => '16',
        //     'name' => 'Lina Nur Ardila, SE., M.AK.',
        //     'email' => 'linanur@gmail.com',
        //     'role' => 2, //prodi
        //     'multirole' => 2,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userprodi4 = User::create([
        //     'id' => 12,
        //     'id_unit' => '2',
        //     'name' => 'Sari Eka',
        //     'email' => 'sarienm2001@gmail.com',
        //     'role' => 2, //prodi
        //     'multirole' => 2,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userprodi5 = User::create([
        //     'id' => 13,
        //     'id_unit' => '21',
        //     'name' => 'Juairiah Nastiti S,S.Pd.,M.TCSOL',
        //     'email' => 'JuairiahNastiti@gmail.com',
        //     'role' => 2, //prodi
        //     'multirole' => 2,
        //     'is_aktif' => 1,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $userprodi6 = User::create([
        //     'id' => 14,
        //     'id_unit' => '8',
        //     'name' => 'Oktavia Kurnianingsih, S.T.,M.T.',
        //     'email' => 'oktavia@gmail.com',
        //     'role' => 2, //prodi
        //     'multirole' => 2,
        //     'is_aktif' => 1,
        //     'image' => 'irish.jpg',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);

        // $user7 = User::create([
        //     'id' => 15,
        //     'id_unit' => '8',
        //     'name' => 'Coba PIC 1',
        //     'email' => 'pic@gmail.com',
        //     'role' => 9,
        //     'multirole' => 9,
        //     'image' => 'NULL',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $user8 = User::create([
        //     'id' => 16,
        //     'id_unit' => '1',
        //     'name' => 'Coba Staf WD',
        //     'email' => 'stafwd1@gmail.com',
        //     'role' => 8,
        //     'multirole' => 8,
        //     'image' => 'NULL',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $user9 = User::create([
        //     'id' => 17,
        //     'id_unit' => '2',
        //     'name' => 'Agus Purbayu, S.Si., M.Kom.',
        //     'email' => 'pakbayu@gmail.com',
        //     'role' => 9,
        //     'multirole' => 9,
        //     'image' => 'pakbayu.jpg',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $user10 = User::create([
        //     'id' => 18,
        //     'id_unit' => '2',
        //     'name' => 'Sahirul Alim Tri Bawono, S.Kom., M.Eng.',
        //     'email' => 'paksahirul@gmail.com',
        //     'role' => 9,
        //     'multirole' => 9,
        //     'image' => 'NULL',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $user11 = User::create([
        //     'id' => 23,
        //     'id_unit' => '2',
        //     'name' => 'Nanang Maulana Yoeseph, S.Si., M.Cs.',
        //     'email' => 'paknanang@gmail.com',
        //     'role' => 9,
        //     'multirole' => 9,
        //     'image' => 'NULL',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        // $user11 = User::create([
        //     'id' => 24,
        //     'id_unit' => '2',
        //     'name' => 'Wulan coba',
        //     'email' => 'wabcd19@gmail.com',
        //     'role' => 2,
        //     'multirole' => '2,3,4',
        //     'image' => 'NULL',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('vokasibergerak'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);


        $role = $admin;

        $useradmin->assignRole([$admin]);
        // $useradmin2->assignRole([$admin]);
        // $userwd1->assignRole([$wd1]);
        // $userwd2->assignRole([$wd2]);
        // $userwd3->assignRole([$wd3]);
        // $userbpu->assignRole([$bpu]);
        // $userstaf_keu->assignRole([$staf_keu]);
        // $userstaf_perencanaan->assignRole([$staf_perencanaan]);
        // $userprodi->assignRole([$prodi]);
        // $userprodi2->assignRole([$prodi]);
        // $userprodi3->assignRole([$prodi]);
        // $userprodi4->assignRole([$prodi]);
        // $userprodi5->assignRole([$prodi]);
        // $userprodi6->assignRole([$prodi]);
        // $user7->assignRole([$pic]);
        // $user8->assignRole([$wd1]);
        // $user9->assignRole([$pic]);
        // $user10->assignRole([$pic]);
        // $user10->assignRole([$pic]);
        // $user10->assignRole([$prodi]);
        // $userkaprodi->assignRole([$kaprodi]);
    }
}
