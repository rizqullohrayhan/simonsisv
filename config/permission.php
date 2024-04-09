<?php

return [
    'authorities' => [

        // MENU KEUANGAN
        'manage_buttonkeuangan' => [
            'dashboard',
            'keu_memocair',
            'keu_persekot',
            'keu_spj',
            'keu_lpj',
            'keu_monitoring',
        ],

        // Memo Cair
        'manage_memocair' => [
            'memo_create',
            'memo_edit',
            'memo_detail'
        ],

        // Persekot Kerja
        'manage_pk' => [
            'pk_create',
            'pk_edit',
            'pk_detail',
            'pk_validasi',
            'pk_transfer'
        ],

        // SPJ
        'manage_spj' => [
            'spj_create',
            'spj_edit',
            'spj_detail',
            'spj_revisi',
            'spj_verifikasi',
            'spj_transfer'
        ],

        // LPJ
        'manage_lpj' => [
            'lpj_create',
            'lpj_edit',
            'lpj_detail',
            'lpj_revisi',
            'lpj_verifikasi',
            'lpj_selesai'
        ],

        //penambahan
        'manage_buttonpengajuan' => [
            'ajuan_monitoringUsulan',
            'ajuan_monitoringIKU',
            'ajuan_torrab',
            'ajuan_validasi'
        ],
        'manage_tor' => [
            'tor_show',
            'tor_create',
            'tor_update',
            'tor_detail',
            'tor_delete',
            'tor_ajuan',
            'tor_verifikasi_kaprodi',
            'tor_verifikasi',
            'tor_revisi',
            'tor_validasi'
        ],
        'manage_rab' => [
            'rab_show',
            'rab_create',
            'rab_update',
            'rab_detail',
            'rab_delete',
            // 'rab_verifikasi',
            // 'rab_validasi'
        ],
        'manage_anggaran' => [
            'anggaran_show',
            'anggaran_create',
            'anggaran_update',
            'anggaran_detail',
            'anggaran_delete',
        ],
        'manage_tahun' => [
            'tahun_show',
            'tahun_create',
            'tahun_update',
            'tahun_detail',
            'tahun_delete'
        ],
        'manage_spjkategori' => [
            'spjkategori_show',
            'spjkategori_create',
            'spjkategori_update',
            'spjkategori_detail',
            'spjkategori_delete'
        ],
        'manage_spjsubkategori' => [
            'spjsubkategori_show',
            'spjsubkategori_create',
            'spjsubkategori_update',
            'spjsubkategori_detail',
            'spjsubkategori_delete'
        ],
        'manage_pedoman' => [
            'pedoman_show',
            'pedoman_create',
            'pedoman_update',
            'pedoman_detail',
            'pedoman_delete'
        ],
        'manage_triwulan' => [
            'triwulan_show',
            'triwulan_create',
            'triwulan_update',
            'triwulan_detail',
            'triwulan_delete'
        ],
        'manage_unit' => [
            'unit_show',
            'unit_create',
            'unit_update',
            'unit_detail',
            'unit_delete'
        ],
        'manage_pagu' => [
            'pagu_show',
            'pagu_create',
            'pagu_update',
            'pagu_detail',
            'pagu_delete'
        ],
        'manage_mak' => [
            'mak_show',
            'mak_create',
            'mak_update',
            'mak_detail',
            'mak_delete'
        ],
        'manage_kelompokmak' => [
            'kelompokmak_show',
            'kelompokmak_create',
            'kelompokmak_update',
            'kelompokmak_detail',
            'kelompokmak_delete'
        ],
        'manage_belanjamak' => [
            'belanjamak_show',
            'belanjamak_create',
            'belanjamak_update',
            'belanjamak_detail',
            'belanjamak_delete'
        ],
        'manage_detailmak' => [
            'detailmak_show',
            'detailmak_create',
            'detailmak_update',
            'detailmak_detail',
            'detailmak_delete'
        ],
        'manage_iku' => [
            'iku_show',
            'iku_create',
            'iku_update',
            'iku_detail',
            'iku_delete'
        ],
        'manage_ik' => [
            'ik_show',
            'ik_create',
            'ik_update',
            'ik_detail',
            'ik_delete'
        ],
        'manage_k' => [
            'k_show',
            'k_create',
            'k_update',
            'k_detail',
            'k_delete'
        ],
        'manage_subk' => [
            'subk_show',
            'subk_create',
            'subk_update',
            'subk_detail',
            'subk_delete'
        ],
        'manage_roles' => [
            'role_show',
            'role_create',
            'role_update',
            'role_detail',
            'role_delete'
        ],
        'manage_users' => [
            'user_show',
            'user_create',
            'user_update',
            'user_detail',
            'user_delete'
        ],
        'manage_pic' => [
            'pic_show',
            'pic_create',
            'pic_update',
            'pic_detail',
            'pic_delete',
        ],
        'manage_kaprodi' => [
            'kaprodi_show',
            'kaprodi_create',
            'kaprodi_update',
            'kaprodi_detail',
            'kaprodi_delete',
        ],
    ],

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false, if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true the package implements teams using the 'team_foreign_key'. If you want
     * the migrations to register the 'team_foreign_key', you must set this to true
     * before doing the migration. If you already did the migration then you must make a new
     * migration to also add 'team_foreign_key' to 'roles', 'model_has_roles', and
     * 'model_has_permissions'(view the latest version of package's migration file)
     */

    'teams' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],
];
