<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
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

        $wd1->assignRole('WD 1');
        $wd2->assignRole('WD 2');
        $wd3->assignRole('WD 3');
    }
}
