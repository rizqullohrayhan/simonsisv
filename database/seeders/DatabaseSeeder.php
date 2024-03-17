<?php

namespace Database\Seeders;

use Database\Seeders\LPJSeeder;
use Database\Seeders\RPDSeeder;
use Database\Seeders\SPJSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\PedomanSeeder;
use Database\Seeders\DokumenSPJSeeder;
use Database\Seeders\SPJKategoriSeeder;
use Database\Seeders\SPJSubKategoriSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        $this->call([
            // TahapAnggaranSeeder::class,
            UnitSeeder::class,
            PermissionTableSeeder::class,
            UserTableSeeder::class,
            TahunSeeder::class,
            TwSeeder::class,
            IKUSeeder::class,
            IKSeeder::class,
            KSeeder::class,
            SubKSeeder::class,
            TORSeeder::class,
            RABSeeder::class,
            SPJKategoriSeeder::class,
            MakSeeder::class,
            KelompokMakSeeder::class,
            BelanjaMakSeeder::class,
            DetailMakSeeder::class,
            AnggaranSeeder::class,
            StatusKegAngSeeder::class,
            TrxStatusTorSeeder::class,
            PaguSeeder::class,
            KomponenJadwalSeeder::class,
            MemoCairSeeder::class,
            DokumenSeeder::class,
            Status_KeuSeeder::class,
            PersekotKerjaSeeder::class,
            TrxStatusKeuSeeder::class,
            LPJSeeder::class,
            SPJSeeder::class,
            PedomanSeeder::class,

            SPJSubKategoriSeeder::class,
            DokumenSPJSeeder::class,


        ]);
        $this->command->info('| | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | |');
        $this->command->info('CAUTION PLEASE :)');
        // $this->command->warn('"Admin",email:'.$user->email);
        $this->command->warn('"Admin",email:admin@gmail.com, pass: vokasibergerak');
        $this->command->warn('"WD2",email:abdulazil@gmail.com, pass: vokasibergerak');
        $this->command->warn('"WD3",email:hermans@gmail.com, pass: vokasibergerak');
        $this->command->warn('"BPU",email:budi356@gmail.com, pass: vokasibergerak');
        $this->command->warn('"Staf Keuangan",email:iman@admin.com, pass: vokasibergerak');
        $this->command->warn('"Staf Perencanaan",email:azof@gmail.com, pass: vokasibergerak');
        $this->command->warn('"Prodi",email:sarieka@gmail.com, pass: vokasibergerak');
        $this->command->info('| | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | |');
    }
}
