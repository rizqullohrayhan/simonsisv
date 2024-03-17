<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrxStatusKeuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trx_status_keu')->insert([
            [
                'id_status' => 1,
                'id_tor' => 3,
                'create_by' => 1
            ],
            [
                'id_status' => 4,
                'id_tor' => 3,
                'create_by' => 1
            ]
        ]);
    }
}
