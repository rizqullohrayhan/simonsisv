<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class IKUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indikator_IKU')->insert([
            [
                'id' => '1',
                'iku' => 'IKU001',
                'deskripsi' => 'Persentase lulusan S1 dan Program Diploma yang berhasil dapat pekerjaan, melanjutkan studi, atau menjadi wiraswasta dengan penghasilan cukup',
            ],
            [
                'id' => '2',
                'iku' => 'IKU002',
                'deskripsi' => 'Persentase mahasiswa S1 dan D4/D3/D2 yang menghabiskan paling tidak 20 SKS di luar kampus atau meraih prestasi minimal tingkat nasional',
            ],
            [
                'id' => '3',
                'iku' => 'IKU003',
                'deskripsi' => 'Persentase dosen yang berkegiatan tridharma di kampus lain di QS 100 (berdasarkan ilmu), bekerja sebagai praktisi di dunia industri atau membina mahasiswa yang berhasil meraih prestasi paling rendah tingkat nasional dalam 5 (lima) tahun terakhir
                Screen reader support enabled.',
            ],
            [
                'id' => '4',
                'iku' => 'IKU004',
                'deskripsi' => 'Persentase dosen tetap berkualifikasi akademik S3, memiliki sertifikasi kompetensi/profesi yang diakui oleh industri atau dunia kerja, atau berasal dari kalangan praktisi profesional, dunia industri dan dunia kerja',
            ],
            [
                'id' => '5',
                'iku' => 'IKU005',
                'deskripsi' => 'Jumlah keluaran penelitian yang berhasil mendapat rekognisi internasional atau diterapkan oleh masyarakat per jumlah dosen',
            ],
            [
                'id' => '6',
                'iku' => 'IKU006',
                'deskripsi' => 'Persentase program studi S1 dan D4/D3/D2 yang melaksanakan kerja sama dengan mitra',
            ],
            [
                'id' => '7',
                'iku' => 'IKU007',
                'deskripsi' => 'Persentase mata kuliah S1 dan Diploma yang menggunakan metode pembelajaran pemecahan kasus (case method) atau pembelajaran kelompok berbasis projek (team-based project) sebagai sebagian bobot evaluasi',
            ],
            [
                'id' => '8',
                'iku' => 'IKU008',
                'deskripsi' => 'Persentase prodi S1 dan Diploma yang memiliki akreditas atau sertifikasi internasional diakui pemerintah',
            ],
            [
                'id' => '9',
                'iku' => 'IKU009',
                'deskripsi' => 'Rata-rata predikat SAKIP Satker minimal BB',
            ],
            [
                'id' => '10',
                'iku' => 'IKU010',
                'deskripsi' => 'Rata-rata nilai Kinerja Anggaran atas Pelaksanaan RKA-K/L Satker minimal 80',
            ],
        ]);
    }
}
