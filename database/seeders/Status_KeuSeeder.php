<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Status_KeuSeeder extends Seeder
{
    public function run()
    {
        DB::table('status_keu')->insert([
            [
                //Status Persekot Kerja
                'nama_status' => 'Proses Pengajuan',
                'kategori' => 'Persekot Kerja'
            ],
            [
                'nama_status' => 'Validasi', //Divalidasi Staff Keuangan
                'kategori' => 'Persekot Kerja'
            ],
            [
                'nama_status' => 'Transfer Uang', //oleh Staff Keuangan
                'kategori' => 'Persekot Kerja'
            ],
            [
                'nama_status' => 'Dana Prodi', //oleh Staff Keuangan
                'kategori' => 'Persekot Kerja'
            ],

            //Status SPJ
            [
                'nama_status' => 'Proses Pengajuan',
                'kategori' => 'SPJ'
            ],
            [
                'nama_status' => 'Verifikasi', //Diverifikasi Staff Keuangan
                'kategori' => 'SPJ'
            ],
            [
                'nama_status' => 'Revisi',
                'kategori' => 'SPJ'
            ],
            [
                'nama_status' => 'Pelunasan Pembayaran',
                'kategori' => 'SPJ'
            ],
            [
                'nama_status' => 'Pengembalian Dana',
                'kategori' => 'SPJ'
            ],
            [
                'nama_status' => 'SPJ Selesai',
                'kategori' => 'SPJ'
            ],

            //Status LPJ
            [
                'nama_status' => 'Proses Pengajuan',
                'kategori' => 'LPJ'
            ],
            [
                'nama_status' => 'Verifikasi', //Diverifikasi BPU
                'kategori' => 'LPJ'
            ],
            [
                'nama_status' => 'Revisi',
                'kategori' => 'LPJ'
            ],
            [
                'nama_status' => 'LPJ Selesai',
                'kategori' => 'LPJ'
            ],
        ]);
    }
}
