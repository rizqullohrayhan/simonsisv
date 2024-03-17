<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class IKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indikator_IK')->insert([
            [
                'id' => '1',
                'IK' => 'IK01',
                'id_iku' => 8, 'deskripsi' => 'Persentase mahasiswa penerima KIP-Kuliah dan mahasiswa yang membayar UKT ≤ Rp. 1.000.000',
            ],
            [
                'id' => '2',
                'IK' => 'IK02',
                'id_iku' => 1, 'deskripsi' => 'Jumlah lulusan yang studi lanjut',
            ],
            [
                'id' => '3',
                'IK' => 'IK03',
                'id_iku' => 1, 'deskripsi' => 'Jumlah mahasiswa dan/atau lulusan yang berhasil menjadi wirausaha',
            ],
            [
                'id' => '4',
                'IK' => 'IK04',
                'id_iku' => 2, 'deskripsi' => 'Jumlah mahasiswa yang mengikuti kegiatan Merdeka Belajar',
            ],
            [
                'id' => '5',
                'IK' => 'IK05',
                'id_iku' => 2, 'deskripsi' => 'Jumlah mahasiswa yang berprestasi di tingkat nasional dan internasional',
            ],
            [
                'id' => '6',
                'IK' => 'IK06',
                'id_iku' => 2, 'deskripsi' => 'Jumlah medali yang diperoleh dari kejuaraan di tingkat nasional dan internasional',
            ],
            [
                'id' => '7',
                'IK' => 'IK07',
                'id_iku' => 7, 'deskripsi' => 'Persentase lulusan yang langsung bekerja dalam jangka waktu 1 tahun setelah kelulusan',
            ],
            [
                'id' => '8',
                'IK' => 'IK08',
                'id_iku' => 8, 'deskripsi' => 'Persentase prodi unggul (Ter Akreditasi A)',
            ],
            [
                'id' => '9',
                'IK' => 'IK09',
                'id_iku' => 9, 'deskripsi' => 'Jumlah prodi terakreditasi internasional',
            ],
            [
                'id' => '10',
                'IK' => 'IK10',
                'id_iku' => 2, 'deskripsi' => 'Jumlah prodi yang menerapkan pembelajaran Kampus Merdeka',
            ],
            [
                'id' => '11',
                'IK' => 'IK11',
                'id_iku' => 3, 'deskripsi' => 'Peringkat di QS World University Ranking',
            ],
            [
                'id' => '12',
                'IK' => 'IK12',
                'id_iku' => 3, 'deskripsi' => 'Peringkat di QS World University Ranking by Subject',
            ],
            [
                'id' => '13',
                'IK' => 'IK13',
                'id_iku' => 5, 'deskripsi' => 'Jumlah publikasi internasional',
            ],
            [
                'id' => '14',
                'IK' => 'IK14',
                'id_iku' => 5, 'deskripsi' => 'Jumlah jurnal bereputasi terindeks nasional',
            ],
            [
                'id' => '16',
                'IK' => 'IK16',
                'id_iku' => 5, 'deskripsi' => 'Jumlah sitasi karya ilmiah',
            ],
            [
                'id' => '17',
                'IK' => 'IK17',
                'id_iku' => 5, 'deskripsi' => 'Jumlah Kekayaan Intelektual yang didaftarkan',
            ],
            [
                'id' => '18',
                'IK' => 'IK18',
                'id_iku' => 5, 'deskripsi' => 'Jumlah Kekayaan Intelektual yang digunakan oleh industri',
            ],
            [
                'id' => '19',
                'IK' => 'IK19',
                'id_iku' => 4, 'deskripsi' => 'Persentase dosen berkualifikasi Doktor',
            ],
            [
                'id' => '20',
                'IK' => 'IK20',
                'id_iku' => 4, 'deskripsi' => 'Persentase dosen dengan jabatan guru besar',
            ],
            [
                'id' => '21',
                'IK' => 'IK21',
                'id_iku' => 4, 'deskripsi' => 'Persentase dosen yang memiliki pengalaman bekerja di industri atau lembaga profesi minimal 1 tahun dan/atau bekerja di luar negeri minimal 1 tahun',
            ],
            [
                'id' => '22',
                'IK' => 'IK22',
                'id_iku' => 9,
                'deskripsi' => 'Opini Penilaian Laporan Keuangan oleh Akuntan Publik'
            ],
            [
                'id' => '23',
                'IK' => 'IK23',
                'id_iku' => 6, 'deskripsi' => 'Nilai kontrak kerja sama dengan industri',
            ],
            [
                'id' => '24',
                'IK' => 'IK24',
                'id_iku' => 6, 'deskripsi' => 'Penghasilan yang diperoleh dari unit usaha',
            ],
            [
                'id' => '25',
                'IK' => 'IK25',
                'id_iku' => 6, 'deskripsi' => 'Dana abadi yang dikumpulkan',
            ],
            [
                'id' => '26',
                'IK' => 'IK26',
                'id_iku' => 10,
                'deskripsi' => 'Persentase tenaga kependidikan yang memiliki kualifikasi magister/doktor/sertifikat keahlian.'
            ],
            [
                'id' => '27',
                'IK' => 'IK27',
                'id_iku' => 7, 'deskripsi' => 'Persentase dosen yang memberikan kuliah dengan menggunakan pemecahan kasus (case method) dan/atau pembelajaran kelompok berbasis projek (team-based project)',
            ],
            [
                'id' => '29',
                'IK' => 'IK29',
                'id_iku' => 8, 'deskripsi' => 'Global ranking berbasis Teknologi Informasi dan Komunikasi',
            ],
            [
                'id' => '30',
                'IK' => 'IK30',
                'id_iku' => 10, 'deskripsi' => 'Nilai Indeks Kinerja Unit',
            ],

        ]);
    }
}
