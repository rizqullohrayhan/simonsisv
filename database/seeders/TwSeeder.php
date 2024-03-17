<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('triwulan')->insert([
            [
                'id_tahun' => '2', //2021
                'periode_awal' => '2021-01-01',
                'periode_akhir' => '2021-03-31',
                'triwulan' => '2021-triwulan-1',
            ],
            [
                'id_tahun' => '2',
                'periode_awal' => '2021-04-01',
                'periode_akhir' => '2021-06-30',
                'triwulan' => '2021-triwulan-2',
            ],
            [
                'id_tahun' => '2',
                'periode_awal' => '2021-07-01',
                'periode_akhir' => '2021-09-30',
                'triwulan' => '2021-triwulan-3',
            ],
            [
                'id_tahun' => '2',
                'periode_awal' => '2021-10-01',
                'periode_akhir' => '2021-12-30',
                'triwulan' => '2021-triwulan-4',
            ],
            [
                'id_tahun' => '3', //2022
                'periode_awal' => '2022-01-01',
                'periode_akhir' => '2022-03-31',
                'triwulan' => '2022-triwulan-1',
            ],
            [
                'id_tahun' => '3',
                'periode_awal' => '2022-04-01',
                'periode_akhir' => '2022-06-30',
                'triwulan' => '2022-triwulan-2',
            ],
            [
                'id_tahun' => '3',
                'periode_awal' => '2022-07-01',
                'periode_akhir' => '2022-09-30',
                'triwulan' => '2022-triwulan-3',
            ],
            [
                'id_tahun' => '3',
                'periode_awal' => '2022-10-01',
                'periode_akhir' => '2022-12-30',
                'triwulan' => '2022-triwulan-4',
            ],
        ]);
    }
}
