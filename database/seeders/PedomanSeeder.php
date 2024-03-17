<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedomanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedoman')->insert([
            [
                'nama' => 'Standar Biaya Masukan Kegiatan 2022',
                'jenis' => 'SBM',
                'file' => '60_PMK.02_2021.pdf',
                'tahun' => '2022',
                'path' => '60_PMK.02_2021.pdf',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Peraturan Rektor Nomor 30 Tahun 2021 dan Lampiran Standar Biaya Masukan (SBM) UNS TA 2022',
                'jenis' => 'SPJ Dasar Hukum',
                'file' => 'PeraturanRektorNomor30Tahun2021danLampiranStandarBiayaMasukanSBMUNSTA2022.pdf',
                'tahun' => '2021',
                'path' => 'PeraturanRektorNomor30Tahun2021danLampiranStandarBiayaMasukanSBMUNSTA2022.pdf',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'SALINAN Peraturan Rektor No.38 Tahun 2021 tentang Pengadaan Barang Jasa Universitas Sebelas Maret',
                'jenis' => 'SPJ Dasar Hukum',
                'file' => 'PeraturanRektorNomor30Tahun2021danLampiranStandarBiayaMasukanSBMUNSTA2022.pdf',
                'tahun' => '2021',
                'path' => 'PeraturanRektorNomor30Tahun2021danLampiranStandarBiayaMasukanSBMUNSTA2022.pdf',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Panduan SPJ 2022',
                'jenis' => 'SPJ Panduan',
                'file' => '0_SPJ2022.pdf',
                'tahun' => '2022',
                'path' => '0_SPJ2022.pdf',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Panduan Kelengkapan SPJ 2022',
                'jenis' => 'SPJ Panduan',
                'file' => '0_PanduanKelengkapanSPJ2022.pdf',
                'tahun' => '2022',
                'path' => '0_PanduanKelengkapanSPJ2022.pdf',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Daftar Hadir dan Tanda Terima',
                'jenis' => 'SPJ Template',
                'file' => '1. Daftar Hadir dan Tanda Terima.xlsx',
                'tahun' => '2022',
                'path' => '1. Daftar Hadir dan Tanda Terima.xlsx',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Format Kwitansi dengan Nota-Struk-Bukti Pembelian Kurang 10jt',
                'jenis' => 'SPJ Template',
                'file' => '2. Format Kwitansi dg nota-struk-bukti pembelian 2022 Kurang 10jt.doc',
                'tahun' => '2022',
                'path' => '2. Format Kwitansi dg nota-struk-bukti pembelian 2022 Kurang 10jt.doc',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Format Kwitansi Belanja Barang dan Jasa Kurang 10jt',
                'jenis' => 'SPJ Template',
                'file' => '2. Kwitansi Belanja Barang dan Jasa kurang 10jt.xlsx',
                'tahun' => '2022',
                'path' => '2. Kwitansi Belanja Barang dan Jasa kurang 10jt.xlsx',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Format Kwitansi Bantuan Transport',
                'jenis' => 'SPJ Template',
                'file' => '3. KWITANSI BANTUAN TRANSPORT.xlsx',
                'tahun' => '2022',
                'path' => '3. KWITANSI BANTUAN TRANSPORT.xlsx',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Format Kwitansi Honor, Bantuan Transport, Uang Pembinaan (1 ORANG)',
                'jenis' => 'SPJ Template',
                'file' => '4. Kwitansi Honor, bantuan transport, uang pembinaan 1 ORANG.xlsx',
                'tahun' => '2022',
                'path' => '4. Kwitansi Honor, bantuan transport, uang pembinaan 1 ORANG.xlsx',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Format Kwitansi Honor (Lebih 1 ORANG)',
                'jenis' => 'SPJ Template',
                'file' => '5. KWITANSI HONOR LEBIH 1 ORANG.xlsx',
                'tahun' => '2022',
                'path' => '5. KWITANSI HONOR LEBIH 1 ORANG.xlsx',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Format Kwitansi SPDD',
                'jenis' => 'SPJ Template',
                'file' => '6. Kuitansi SPPD.xlsx',
                'tahun' => '2022',
                'path' => '6. Kuitansi SPPD.xlsx',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
            [
                'nama' => 'Template LPJ',
                'jenis' => 'LPJ',
                'file' => 'Sistematika Laporan Kegiatan 2022.docx',
                'tahun' => '2022',
                'path' => 'Sistematika Laporan Kegiatan 2022.docx',
                'created_at' => '2022-06-05 10:15:58',
                'updated_at' => '2022-06-05 10:15:58',
            ],
        ]);
    }
}
