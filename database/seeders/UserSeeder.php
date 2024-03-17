<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // $user = User::all();
        // $user = DB::table('users')->create([
        //     [
        //         'name' => 'XX',
        //         'email' => 'admin@gmail.com',
        //         'role' => 1, //admin
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$llPcvyVbOKx9DbIDubyKlOwyMEC.8ThhNW9hitGpoWO9gO36EJ.36', //wulandari
        //         'remember_token' => 'GIiCppjOxvNbqWL6NeRJ1VIZRhlOPWE8rOhWQrV5Y0RNH3aEIoKEnqhtM56f'
        //     ],
        //     [
        //         'name' => 'Tri Wulandari',
        //         'email' => 'wdari0161@gmail.com',
        //         'role' => 1, //admin
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$7TzP2/qm.YiVtp9lO/M5v.CRdAqAsEvWgqWa1Gkwow6eTes1T3zh2', //wulandari
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'Abdul Aziz,S.Kom.,M.Cs',
        //         'email' => 'abdulazil@gmail.com',
        //         'role' => 7, //wd2
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$llPcvyVbOKx9DbIDubyKlOwyMEC.8ThhNW9hitGpoWO9gO36EJ.36', //wulandari
        //         'remember_token' => 'GIiCppjOxvNbqWL6NeRJ1VIZRhlOPWE8rOhWQrV5Y0RNH3aEIoKEnqhtM56f'
        //     ],
        //     [
        //         'name' => 'Dr.Eng.Herman',
        //         'email' => 'hermans@gmail.com',
        //         'role' => 4, //wd3
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$llPcvyVbOKx9DbIDubyKlOwyMEC.8ThhNW9hitGpoWO9gO36EJ.36', //wulandari
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'Budi',
        //         'email' => 'budi356@gmail.com',
        //         'role' => 3, //bpu
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$llPcvyVbOKx9DbIDubyKlOwyMEC.8ThhNW9hitGpoWO9gO36EJ.36', //wulandari
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'Iman',
        //         'email' => 'iman@admin.com',
        //         'role' => 6, //Staf keuangan
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$pa8GQTUxwwvdxUk2TInRx.7FdaGi0cv83AcDko08t3pXOr0Sdi3aC', //wulandari
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'Rangga Azof',
        //         'email' => 'azof@gmail.com',
        //         'role' => 5, //staf perencanaan
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$kplOWz5qMxUxrp0GWPBJWui856p.CCENe2vhW7GSTHOgFv1766vX2', //wulandari
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'Sari Eka',
        //         'email' => 'sarieka@gmail.com',
        //         'role' => 7, //prodi
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$VLH3oYWs0EfJceSPR5.e7u50NZb928XZW3JVYuy9tpsyMFzW7rSEW', //wulandari
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'Andry Herata',
        //         'email' => 'andry@gmail.com',
        //         'role' => 7, //prodi
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$oCNqqKZP8p84qffcMcwTLuQD2DNXHOj0rJGgaTALkXOdUJkHp6k0O', //wulandari
        //         'remember_token' => null
        //     ],


        // ]);
        // $user->find('role', 1)->assignRole('Admin');
        // $user->find('role', 2)->assignRole('Prodi');
        // $user->find('role', 3)->assignRole('BPU');
        // $user->find('role', 4)->assignRole('WD 3');
        // $user->find('role', 5)->assignRole('Staf Perencanaan');
        // $user->find('role', 6)->assignRole('Staf Keuangan');
        // $user->find('role', 7)->assignRole('WD 2');
        // $user = User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'role' => 1, //admin
        //     'is_aktif' => 1,
        //     'email_verified_at' => null,
        //     'password' => '$2y$10$llPcvyVbOKx9DbIDubyKlOwyMEC.8ThhNW9hitGpoWO9gO36EJ.36', //wulandari
        //     'remember_token' => 'GIiCppjOxvNbqWL6NeRJ1VIZRhlOPWE8rOhWQrV5Y0RNH3aEIoKEnqhtM56f'
        // ],); //guys user seeder g bisa masuk
        // $user->find('role', 1)->assignRole('Admin');
    }
}
