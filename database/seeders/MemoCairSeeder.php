<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemoCairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('memo_cair')->insert([
            [
                'id' => 1,
                'id_tor' => '3',
                'nomor' => '1',
                'nominal' => 16000000
            ],

        ]);
    }
}
