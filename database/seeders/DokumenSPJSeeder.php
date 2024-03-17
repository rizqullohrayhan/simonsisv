<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSPJSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokumen_spj')->insert([
            [
                'id' => 1,
                'id_tor' => 3,
                'id_subkategori' => 1,
                'name' => 'Profile.pdf',
                'path' => 'Profile.pdf'
            ]
        ]);
    }
}
