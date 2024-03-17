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
                'nama_status' => 'Proses Pengajuan',
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Verifikasi', //DIVERIFIKASI BPU
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Revisi',
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Validasi', //DIVALIDASI WD 2
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Pengajuan Perbaikan',
                'kategori' => 'TOR'
            ],
            [
                'nama_status' => 'Verifikasi Kaprodi',
                'kategori' => 'TOR'
            ],
            // [
            //     'nama_status' => 'Review',
            //     'kategori' => 'TOR'
            // ],
        ]);
    }
}
