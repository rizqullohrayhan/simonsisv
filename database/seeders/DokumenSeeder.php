<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokumen')->insert([
            [
                'id' => 1,
                'id_tor' => '3',
                'jenis' => 'Memo Cair',
                'name' => 'Profile.pdf',
                'path' => 'Profile.pdf'
            ],

        ]);
    }
}
