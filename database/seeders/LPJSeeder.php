<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LPJSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lpj')->insert([
            [
                'id_tor' => 3,
                'mitra' => 'Kominfo',
                'pks' => '53321'
            ]
        ]);
    }
}
