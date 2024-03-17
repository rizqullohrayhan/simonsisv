<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tahun')->insert([
            [
                'tahun' => '2020',
                'is_aktif' => 1
            ],
            [
                'tahun' => '2021',
                'is_aktif' => 1
            ],
            [
                'tahun' => '2022',
                'is_aktif' => 1
            ],
        ]);
    }
}
