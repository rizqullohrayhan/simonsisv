<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SPJKategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('spj_kategori')->insert([
            [
                'nama_kategori' => 'Konsumsi Kegiatan',
                'is_aktif' => 1
            ],
            [
                'nama_kategori' => 'Kontribusi/Registrasi Pelatihan/Sekom',
                'is_aktif' => 1
            ],
            [
                'nama_kategori' => 'Honor Narasumber Kegiatan',
                'is_aktif' => 1
            ],
            [
                'nama_kategori' => 'Pembelian Barang dan Jasa',
                'is_aktif' => 1
            ],
            [
                'nama_kategori' => 'Honor Magang Mahasiswa/Asisten Praktikum',
                'is_aktif' => 1
            ],
            [
                'nama_kategori' => 'Bantuan Transport/Transport Lokal (Karesidenan Surakarta)',
                'is_aktif' => 1
            ],
            [
                'nama_kategori' => 'SPDD',
                'is_aktif' => 1
            ]
        ]);
    }
}
