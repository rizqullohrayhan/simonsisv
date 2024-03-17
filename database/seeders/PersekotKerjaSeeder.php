<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersekotKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persekot_kerja')->insert([
            [
                'id_tor'=>3,
                'alokasi_anggaran'=>4000000,
                'tgl_selesai'=>'2022-04-04'
            ]
            ]);
    }
}
