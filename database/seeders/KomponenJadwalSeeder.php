<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KomponenJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('komponen_jadwal')->insert([
            [
                'id_tor' => '1',
                'komponen' => 'Rapat APTV',
                'bulan_awal' => '2',
                'bulan_akhir' => '4',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '1',
                'komponen' => 'Pembayaran Iuran',
                'bulan_awal' => '3',
                'bulan_akhir' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '1',
                'komponen' => 'Evaluasi',
                'bulan_awal' => '4',
                'bulan_akhir' => '4',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '2',
                'komponen' => 'Pelatihan Credit Officeer',
                'bulan_awal' => '3',
                'bulan_akhir' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '2',
                'komponen' => 'Uji Sertifikasi Kompetensi Credit Officeer',
                'bulan_awal' => '3',
                'bulan_akhir' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '3',
                'komponen' => 'Melakukan pendataan mitra industri magang dan
                 mahasiswa yang melaksanakan KMM dan Magang MBKM',
                'bulan_awal' => '1',
                'bulan_akhir' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '3',
                'komponen' => 'Menetapkan daftar ploting dosen pembimbing dan membuat SK Dosen Pembimbing',
                'bulan_awal' => '1',
                'bulan_akhir' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '3',
                'komponen' => 'Memberikan dan menjadwalkan penugasan monev pada dosen pembimbing',
                'bulan_awal' => '2',
                'bulan_akhir' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '3',
                'komponen' => 'Membuatkan Surat Tugas Monitoring dan Evaluasi',
                'bulan_awal' => '2',
                'bulan_akhir' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '3',
                'komponen' => 'Dosen pembimbing melaksankan tugas monitoring dan evaluasi kegiatan magang di industri secara langsung berttemu dengan mahasiswa dan pembimibing lainnya',
                'bulan_awal' => '2',
                'bulan_akhir' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '8',
                'komponen' => 'Menyiapkan proposal penawaran kerja sama',
                'bulan_awal' => '1',
                'bulan_akhir' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '8',
                'komponen' => 'Mengumpulkan data dan menghubungi perusahaan',
                'bulan_awal' => '2',
                'bulan_akhir' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '8',
                'komponen' => 'Melakukan kunjungan industri',
                'bulan_awal' => '2',
                'bulan_akhir' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '9',
                'komponen' => 'Menentukan perusahaan untuk MBKM',
                'bulan_awal' => '1',
                'bulan_akhir' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '9',
                'komponen' => 'Memilih mahasiswa yang melaksanakan MBKM',
                'bulan_awal' => '2',
                'bulan_akhir' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '9',
                'komponen' => 'Membagi dosen sebagai dosen pembimbing sesuai keahlian',
                'bulan_awal' => '2',
                'bulan_akhir' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '9',
                'komponen' => 'Pelaksanaan monitoring pada bulan meii sampai juni 2022 dengan jadwal sebagai berikut',
                'bulan_awal' => '3',
                'bulan_akhir' => '7',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
            [
                'id_tor' => '10',
                'komponen' => 'Membagi kompetensi besar mahasiswa yaitu programmer, administrasi jaringan, dan pengembang web',
                'bulan_awal' => '4',
                'bulan_akhir' => '5',
                'created_at' => '2022-06-15 18:34:21',
                'updated_at' => '2022-06-15 19:03:05',
            ],
            [
                'id_tor' => '10',
                'komponen' => 'Melakukan pendataan mahasiswa dengan memilih kompetensi yang sudah ditentukan',
                'bulan_awal' => '4',
                'bulan_akhir' => '5',
                'created_at' => '2022-06-15 18:34:21',
                'updated_at' => '2022-06-15 19:03:05',
            ],
            [
                'id_tor' => '10',
                'komponen' => 'Mendaftarkan mahasiswa kepada Lemabga Sertifiaksi Kompetensi sesuai dengan kompetensi yang dipilih',
                'bulan_awal' => '4',
                'bulan_akhir' => '5',
                'created_at' => '2022-06-15 18:34:21',
                'updated_at' => '2022-06-15 19:03:05',
            ],
            [
                'id_tor' => '10',
                'komponen' => 'mahasiswa melakukan ujian kompetensi sesuai dengan kompetensi yang dipilih',
                'bulan_awal' => '6',
                'bulan_akhir' => '6',
                'created_at' => '2022-06-17 00:00:00',
                'updated_at' => '2022-06-17 21:48:17',
            ],
            [
                'id_tor' => '12',
                'komponen' => 'c',
                'bulan_awal' => '1',
                'bulan_akhir' => '1',
                'created_at' => '2022-06-18 10:12:21',
                'updated_at' => '2022-06-18 10:12:21',
            ],

            [
                'id_tor' => '15',
                'komponen' => 'Diskusi dengan lembaga terkait',
                'bulan_awal' => '6',
                'bulan_akhir' => '7',
                'created_at' => '2022-06-21 16:27:06',
                'updated_at' => '2022-06-21 16:27:06',
            ],

            [
                'id_tor' => '14',
                'komponen' => 'b',
                'bulan_awal' => '1',
                'bulan_akhir' => '1',
                'created_at' => '2022-06-24 10:09:10',
                'updated_at' => '2022-06-24 10:09:10',
            ],
        ]);
    }
}
