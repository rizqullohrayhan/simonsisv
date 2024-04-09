<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusKegAngSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'nama_status' => 'Belum Dinilai',
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Revisi',
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Sudah Revisi',
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Sudah Dinilai',
                'kategori' => 'TOR'
            ],
        ]);
    }
}
