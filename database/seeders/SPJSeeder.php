<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SPJSeeder extends Seeder
{
    public function run()
    {
        DB::table('spj')->insert([
            [
                'id_tor' => 3,
                'nilai_total' => '22000000',
                'nilai_kembali' => '780000'
            ]
        ]);
    }
}
