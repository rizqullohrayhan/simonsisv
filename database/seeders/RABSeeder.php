<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RABSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rab')->insert([
            [
                'id' => 1,
                'id_tor' => 1,
                'masukan' => 'Dana, SDM, metode kerja, sistem, sarana dan prasaran, data dan informasi, modul, laporan, dll',
                'keluaran' => 'Anggota APTVK3',
                'created_at' => '2022-03-11 22:08:42',
                'updated_at' => '2022-03-11 22:08:42',
            ],
            [
                'id' => 2,
                'id_tor' => 2,
                'masukan' => 'Dana, SDM, metode kerja, sistem, sarana dan prasaran, data dan informasi, modul, laporan, dll',
                'keluaran' => 'Sertifikat Kompetensi Dosen',
                'created_at' => '2022-03-11 22:08:43',
                'updated_at' => '2022-03-11 22:08:43',
            ],
            [
                'id' => 3,
                'id_tor' => 3,
                'masukan' => 'Dana,SDM, metode kerja, sistem, sarana dan prasarana, data dan informasi, modul, laporan, dll',
                'keluaran' => 'Jumlah mahasiswa yang mengikuti kegiatan magang KMM dan MBKM',
                'created_at' => '2022-03-11 22:08:44',
                'updated_at' => '2022-03-11 22:08:44',
            ],
            [
                'id' => 6,
                'id_tor' => 8,
                'masukan' => 'Dana,SDM, metode kerja, sistem, sarana dan prasarana, data dan informasi, modul, laporan, dll',
                'keluaran' => 'Sertifikat Kompetensi Dosen',
                'created_at' => '2022-03-11 22:08:45',
                'updated_at' => '2022-03-11 22:08:45',
            ],
            [
                'id' => 7,
                'id_tor' => 9,
                'masukan' => 'Dana, Mahasiswa, Mata Kuliah, Pembimbing, Industri, Laporan, Moduul,dll',
                'keluaran' => 'Jumlah mahasiswa yang mengikuti kegiatan merdeka belajar',
                'created_at' => '2022-03-11 22:08:46',
                'updated_at' => '2022-03-11 22:08:46',
            ],
            [
                'id' => 8,
                'id_tor' => 10,
                'masukan' => 'Dana, SDM, metode kerja, sistem, sarana, dan prasarana, data, dan informasi, modul,laporan, dll',
                'keluaran' => 'Sertifikat Kompetensi Mahasiswa',
                'created_at' => '2022-06-15 00:00:00',
                'updated_at' => '2022-06-15 00:00:00',
            ],
            [
                'id' => 9,
                'id_tor' => 12,
                'masukan' => 'x',
                'keluaran' => 'x',
                'created_at' => '2022-06-18 00:00:00',
                'updated_at' => '2022-06-18 00:00:00',
            ],
            [
                'id' => 11,
                'id_tor' => 15,
                'masukan' => 'K28-04 Persiapan pembukaan program studi baru: studi kelayakan',
                'keluaran' => 'Draft borang upgrade D3 ke D4',
                'created_at' => '2022-06-21 00:00:00',
                'updated_at' => '2022-06-21 00:00:00',
            ],
            [
                'id' => 13,
                'id_tor' => 14,
                'masukan' => 'x',
                'keluaran' => 'x',
                'created_at' => '2022-06-24 00:00:00',
                'updated_at' => '2022-06-24 00:00:00',
            ],
        ]);
    }
}
