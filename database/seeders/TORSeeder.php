<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TORSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tor')->insert([
            [
                'id' => '1',
                'id_unit' => '3',
                'id_tw' => '6',
                'id_subK' => '1',
                'nama_kegiatan' => 'Keikutsertaan Prodi dalam Asosiasi Perguruan Tinggi Vokasi K3',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => 'Permasalahan di bidang K3 terus berkembang, program studi perlu menjalin
                komunikasi dan networking yang baik dengan Program Studi K3 lainnya dalam Asosiasi untuk penyelesaian
                masalah-masalah K3.',
                'rasionalisasi' => 'Jika kegiatan ini terlaksana, maka dapat mendukung IKU 3 dan meningkatkan
                presentase dosen yang aktif di asosiasi profesi',
                'tujuan' => '1) program studi aktif ikut serta dalam asosiasi profesi, 2) Meningkatkan presentase dosen prodi
                yang aktif sebagai anggota asosiasi',
                'mekanisme' => 'rapat anggota, sesuai rumusan AD ART, pembayaran iuaran',
                'keberlanjutan' => 'Dengan dibayarkannya iuaran keanggotaan, maka program studi otomatis dapat terlibat
                aktif dalam asosiasi.',
                'realisasi_IKU' => '41',
                'target_IKU' => '71',
                'realisasi_IK' => '0',
                'target_IK' => '0',
                'nama_pic' => 'Lusi Ismayenti, S.T.,M.Kes',
                'email_pic' => '-',
                'kontak_pic' => '-',
                'tgl_mulai_pelaksanaan' => '2022-02-03',
                'tgl_akhir_pelaksanaan' => '2022-02-03',
                'jumlah_anggaran' => '8000000',
                'create_by' => 1,
                'update_by' => 1,
                'created_at' => '2022-01-15 22:24:06',
                'updated_at' => '2022-01-15 22:24:06',
            ],
            [
                'id' => '2',
                'id_unit' => '16',
                'id_tw' => '6',
                'id_subK' => '5',
                'nama_kegiatan' => 'Pelatihan dan Ujian Sertifikasi Kompetensi "Credit Officer"',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => 'Untuk mendukung upaya peningkatan kualitas lulusan pendidikan,
                diperlukan adanya dosen yang memberikan pengetahuan kepada mahasiswa mengenai kasus-kasus
                riil yang berkembang di dunia bisnis dan perbankan.',
                'rasionalisasi' => 'Sertifikasi kompetensi memberikan pengetahuan yang lebih kepada dosen untuk
                mempelajari isu yang berkembang dalam dunia bisnis dan perbankan',
                'tujuan' => '1. Meningkatkan kompetensi dosen, 2) Dosen lebih mampu untuk memberikan pengajaran dalam bentuk
                Case Based Learning dan Project Based Method',
                'mekanisme' => '1. Melakukan kegiatan pelatihan kompetensi Credit Officer pada tanggal 9 dan 10 Maret 2022,
                2. Melakukan Kegiatan Uji sertifiaksi kompetensi Credit Officer pada tanggal 12 Maret 2022',
                'keberlanjutan' => 'Kegiatan ini dilaksanakan setiap periode secara berkelanjutan dengan menggunakan
                dana yang bersumber dari pagu program studi',
                'realisasi_IKU' => '80',
                'target_IKU' => '100',
                'realisasi_IK' => '4',
                'target_IK' => '6',
                'nama_pic' => 'Rosita Mei Damayanti, S.E.,M.Rech',
                'email_pic' => '-',
                'kontak_pic' => '-',
                'tgl_mulai_pelaksanaan' => '2022-05-03',
                'tgl_akhir_pelaksanaan' => '2022-05-08',
                'jumlah_anggaran' => '14700000',
                'create_by' => 1,
                'update_by' => 1,
                'created_at' => '2022-04-25 22:24:06',
                'updated_at' => '2022-04-25 22:24:06',
            ],
            [
                'id' => '3',
                'id_unit' => '17',
                'id_tw' => '6',
                'id_subK' => '5',
                'nama_kegiatan' => 'Monev KMM dan MBKM',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => '<p>Program Studi Diploma III Akuntansi berkomitmen untuk dapat menyesuaikan kebijakan yang telah ditetapkan oleh Sekolah Vokasi UNS salah satunya terkait upaya untuk menghasilkan lulusan yang adaptif dan berdaya saing melalui kurikulum yang berorientasi pada kebutuhan pasar atau industri. Oleh karena itu,Program Studi Diploma III Akuntansi menerapkan model pembelajaran 3:2:1. Saat ini seluruh mahasiswa semester IV dan semester VI sedang menempuh pembelajaran di luar kelas melalui kegiatan Magang MBKM dan Kegiatan Magang Mahasiswa (KMM) baik di entitas sektor publik maupun entitas sektor privat yang ada di berbagai daerah. Untuk memastikan terlaksananya kegiatan pembelajaran di luar kelas tersebut dapat sesuai dengan tujuan dan standar yang ditetapkan maka Prodi Diploma III Akuntansi memandang perlu dilakukannya kegiatan monitoring dan evaluasi dengan melibatkan dosen pembimbing yang ditugaskan oleh prodi.</p>',
                'rasionalisasi' => '<p>Penerapan model pembelajaran 3:2:1 menjadi salah satu upaya prodi untuk dapat mengoptimalkan pelaksanaan pembelajaran di luar kelas yang diharapkan dapat memberikan bekal bagi&nbsp; mahasiswa dalam pembelajaran praktik terapan langsung pada dunia usaha dan industri. Dengan demikian, mahasiswa memiliki pengalaman , kompetensi, kesiapann dalam memasuki dunia kerja. Namun demikia, pembelajaran di luar kelas yang diselenggarakan melalui kegiatan magang mahasiswa untuk semester VI dan kegiatan magang MBKM untuk semester IV haruslah memenuhi standar yang telah ditetapkan agar tujuan yan ditetapkan dapat tercapai. Oleh karena itu, monitoring dan evaluasi yang melibatkan peran serta dosen pembimbing atas kegiatan tersebut perlu dilakukan agar kegiatan praktik magang terlaksana secara kondusif, efektif, efisien dan berkualitas.</p>',
                'tujuan' => '<p>1. Memantau dan mengevaluasi pelaksanaan kegiatan magang mahasiswa dan magang MBKM</p>

                <p>2. Menjamin terlaksanakn kegiatan magang mahasiswa dan magang MBKM yang berkualitas</p>
                
                <p>3. Mengidentifikasi kendala dan mencari penyelesaian atas persoalan&nbsp; yang mungkin dihadapi terakit pelaksanaan kegiatan magang mahasiswa dan magang MBKM.</p>
                
                <p>4. Melakukan penyesuaian rencana kegiatan mendatang berdasarkan hasil evaluasi dan identifikasi yang dilakukan sebelumnya.</p>',
                'mekanisme' => '<p>1. Melakukan pendataaan mitra industri magang dan mahasiswa yang melaksanakan KMM dan Magang MBKM</p>

                <p>2. Menetapkan daftar ploting dosen pembimibing dan Membuat SK Dosen Pembimibing</p>
                
                <p>3 Memberikan dan menjadwalkan penugasan monev pada dosen pembimibing</p>
                
                <p>4. Membuatkan Surat Tugas Monitoring dan Evaluasi</p>
                
                <p>5. Dosen pembimibing melaksanakan tugas monitoring dan evaluasi ke tempat magang mahasiswa yan gberlokasi di wilayah Soloraya, Jawa Tengah, Jawa TImur, dan Yogjakarta.</p>',
                'keberlanjutan' => '<p>Kegiatan ini merupakan upaya untuk mematikan kegiatan pembelajaran di luar kelas melalui KMM dan Magang MBKM dapat berjalan secara efektfi dan efisien dehingga dapat dihasilkan lulusan yang berkualitas, adaptif, dan berdaya saing.&nbsp;</p>',
                'realisasi_IKU' => null,
                'target_IKU' => null,
                'realisasi_IK' => null,
                'target_IK' => null,
                'nama_pic' => 'Lina Nur Ardila, SE., M.AK.',
                'email_pic' => '-',
                'kontak_pic' => '-',
                'tgl_mulai_pelaksanaan' => '2022-05-03',
                'tgl_akhir_pelaksanaan' => '2022-05-08',
                'jumlah_anggaran' => ' 22780000',
                'create_by' => 1,
                'update_by' => 1,
                'created_at' => '2022-04-25 22:24:06',
                'updated_at' => '2022-04-25 22:24:06',
            ],
            [
                'id' => '8',
                'id_unit' => '21',
                'id_tw' => '6',
                'id_subK' => '1',
                'nama_kegiatan' => 'Kunjungan Industri',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => 'Pelaksanaan program MBKM Prodi D-3 Bahasa Mandari dilaksanakan dalam bentuk program kuliah industri di perusahaan yang menggunakan bahasa mandarin secara aktif. Kondisi pandemi yang masih belum stabil membuat pengelola Prodi D-3 Bahasa Mandarin masih mengutamakan kerja sama dengan perusahaan-perusahaan yang ada di Jawa Tengah. Perusahaan yang akan dikunjungi yaitu PT Hisheng Luggage Accessory Semarang dan PT. Wanho Industries Indonesia Batang pada minggu kelima bulan Maret 2022. Kunjungan industri sebgai langkah awal untuk mengawai kerja sama dengan perusahaan, mengkomunikasikan kegiatan kuliah industri sehingga perusahaan mendapat gambaran yang jelas mengenai pelaksanaan MBKM - Kuliah Industri. Melalui kegiatan kunjungan industri diharapkan perusahaan dan prodi D-3 Bahasa Mandarin dapat menandatangani kerja sama MoU yang dapat mendukung ketercapaian IKU 6 dan IK 23. Selain itu, melalui kunjungan industri Prodi secara tidak langsung sedang melakukan penjajakan awal mengenai kesiapan perusahaan untuk menerima mahasiswa Prodi D3 Bahasa Mandarin melaksanakan kuliah industri di perusahan tersebut.',
                'rasionalisasi' => '<p>Melalui kunjungan industri, perusahaan dapat mengetahui keberadaan Prodi D-3- Bahasa Mandarin dan bersedia bekerja sama dalam pelaksanaan kuliah industri. Kerja sama dengan dua perusahaan tersebut akan menambah jumlah kerja sama serta pengembangan jejaring kerja sama berbasis industri oleh Prodi D-3-Bahasa Mandarin dengan dunia kerja dalam hal ini PT Hisheng Luggage Accessory Semarang dan PT Wanho Industries Indonesia Batang sesuai dengan kegiatan KK 22 dalam mewujudkan ketercapaian IKU 6.</p>',
                'tujuan' => '<p>1. Menambah jejaring kerja sama Prodi dengan dunia kerja</p>

                <p>2. Menyediakan tempat kuliah industri bagi mahasiswa</p>',
                'mekanisme' => '<p>1. Menyiapkan proposal penawaran kerja sama</p>

                <p>2. Mengumpulkan data dan menghubungi perusahaan</p>
                
                <p>3. Melakukan kunjungan industri</p>',
                'keberlanjutan' => '<p>Kegiatan ini merupakan langkah awal dari peningkatan presentase pelaksanaan kerja sama dnegan mitra dan Program Studi Diploma Tiga (D3) Bahasa Mandarin Sekolah Vokasi UNS. Kegiatan berikutnya setelah ini dilakukan penandatangan Mou dan PKS antara pihak mitra dan pihak kampus.</p>',
                'realisasi_IKU' => '80',
                'target_IKU' => '100',
                'realisasi_IK' => '2',
                'target_IK' => '5',
                'nama_pic' => 'Juairiah Nastiti S, S.Pd., M.TCSOL',
                'email_pic' => '-',
                'kontak_pic' => '-',
                'tgl_mulai_pelaksanaan' => '2022-04-01',
                'tgl_akhir_pelaksanaan' => '2022-04-03',
                'jumlah_anggaran' => '4261000',
                'create_by' => 1,
                'update_by' => 1,
                'created_at' => '2022-03-25 22:24:06',
                'updated_at' => '2022-03-25 22:24:06',
            ],
            [
                'id' => '9',
                'id_unit' => '8',
                'id_tw' => '6',
                'id_subK' => '5',
                'nama_kegiatan' => 'Pemantauan Kegiatan Merdeka Belajar Oleh Dosen Pembimbing',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => '<p>Prodi D-3 Teknik Sipil merupakan prodi yang menyelenggarakan kegiatan merdeka belajar -kampus merdeka (MBKM) diperusahaan yang bergerak dibidang konstruksi. Pada tahun 2022, prodi mengawali program MBKM yang dilakukan mahasiswa tentu ada pembimbing yaitu dosen yang ditugasi oleh kaprodi yang akan bertanggungjawab pada kegiatan MBKM di perusahaan yang menjadi rekanan. Perusahaan yang menjadi rekanan adalah CV.Sokogi Reksa Cipta, PT. Verna Matra Arsitektura, CV.Widwipa Karya, PT.Nusa Indah, sehingga dosen melakukan kunjungan ke perusahaan temmpat mahasiswa melaksankan kegiatan MBKM yang akan menjadikan prodi D3 Teknik Sipil menambah pengetahuan dunia konstruksi.</p>',
                'rasionalisasi' => '<p>Program MBKM mewajibkanmahasiswa untuk belajar diluar kampus, untuk itu dosen pembimibing yang telah ditunjuk oleh prodi melakukan monitoring kegiatan mahasiswa selama melaksankan kegiatan MBKM diperusahaan konsultan dan kontraktor yang menjadi reknanan. Sehingga dosen mengetahui perkembangan proyek konstruksi yang akan menambah kompetensi dan juga menjalin kerjasama.</p>',
                'tujuan' => '<p>1. Mengetahui mata kuliah yang sudah diplot ke perusahaan sudah sesuai dan meliha aktivitas mahasiswa saat kegiatan MBKM.</p>

                <p>2. Peningkatan pengetahuan dosen dalam dunia konstruksi dengan mitra prodi</p>',
                'mekanisme' => '<ol>
                <li>Menentukan perusahaan untuk MBKM</li>
                <li>Memilih mahasiswa yang melaksanakan MBKM</li>
                <li>Membagi dosen sebagai dosen pembimbing sesuai keahlian
                <ol>
                    <li>Pelaksanaan monitoring pada bulan mei sampai juni 2022 dengan jadwal sebagai berikut :
                    <table border="1" cellpadding="1" cellspacing="1" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Mitra</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Jumat,13 Mei 2022</td>
                                <td>CV. Sokogi Reksa Cipta</td>
                                <td>&nbsp;</td>
                                <td>Oktavia Kurnianingsih, S.T.,M.T.</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Ardia Tara Rahmi, S.T.,M.T.</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Senin, 16 Mei 2022</td>
                                <td>CV. Widbipa Karya</td>
                                <td>&nbsp;</td>
                                <td>Ardia Tara Rahmi, S.T.,M.T.</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Oktavia Kurnianingsih, S.T.,M.T.</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Senin, 16 Mei 2022</td>
                                <td>PT. Vema Matra Arsitektura</td>
                                <td>&nbsp;</td>
                                <td>Kholis Hapsari Pratiwi, S.T.,M.T.Msc</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Fendi Hari Yanto, S.T.,M.T.</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Budi Yulianto, S.T.,M.Sc,Ph.D.,MCIHT</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Jumat, 20 Mei 2022</td>
                                <td>PT. Nusa Indah Kontraktor Utama</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Jumat, 03 Juni 2022</td>
                                <td>CV. Sokogi Reksa Cipta</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Senin, 06 Juni 2022</td>
                                <td>CV. Widbipa Karya</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><em>ContohContohContohContohContoh</em></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
            
                    <p>&nbsp;</p>
                    </li>
                </ol>
                </li>
            </ol>',
                'keberlanjutan' => '<p>Program MBKM ini merupakan aktivitas yang akan terus dilaksanakan pada semester 4 dan 5. Dari MBKM ini diharapkan prodi bisa menjalin kerjasama dengan konsultasn dan konstraktor dan bisa memenuhi kebutuhan sebagai bekal di proyek oleh mahasiswa.</p>',
                'realisasi_IKU' => '0',
                'target_IKU' => '50',
                'realisasi_IK' => '0',
                'target_IK' => '50',
                'nama_pic' => 'Oktavia Kurnianingsih,S.T.,M.T',
                'email_pic' => '-',
                'kontak_pic' => '-',
                'tgl_mulai_pelaksanaan' => '2022-04-08',
                'tgl_akhir_pelaksanaan' => '2022-04-09',
                'jumlah_anggaran' => '3900000',
                'create_by' => 4,
                'update_by' => 4,
                'created_at' => '2022-03-25 22:24:06',
                'updated_at' => '2022-03-25 22:24:06',
            ],

            [
                'id' => '10',
                'id_unit' => '2',
                'id_tw' => '2',
                'id_subK' => '9',
                'nama_kegiatan' => 'Pengiriman Mahasiswa Untuk Melakukan Sertifikasi Kompetensi',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => '<p>Sertifikasi di bidang TI bagi dunia pendidikan sangat berguna dalam memperlancar kegiatan belajar mengajar, khususnya bagi mahasiswa untuk mengetahui kemampuannya di bidang TI serta sebagai bekal dalam menghadapi dunia kerja selepas meneyelesaikan pendidikannya di perguruan tinggi. Mahasisswa vokasi diharapkan ketika lulus perkuliahan diharapkan langsung dapat bekerja. Pengajuan kemampuan seseorang dapat bekerja dapat melalui dua jalur. Jalur pertama adalah jalur akademis yaitu berupa ijazah setelah mahasiswa menyelesaikan perkuliahannya. Jalur kedua adalah melalui pengujian kompetensi. Pengujian kompetensi dapat diberikan oleh provider produk tertentu atau oleh badan yang didirikan oleh pemerintah yaitu BNSP (Badan Nasional Sertifikasi Profesi) sesuai dengan PP No.23 tahun 2004. Dengan pemberian sertifikasi kompetensi maka mahasiswa memiliki 2 pengakuan atas kompetensi sekaligus sehingga diharapkan dapat langsung diakui oleh perusahaan untuk diterima menjadi karyawan. Dengan tingkat terserapnya mahasiswa di dunia kerja setelah lulus sesuai dengan IKU 1 yaitu serapan lulusan dalam bekerja kurang dari 6 bulan dan juga berwirausaha. Sertifikasi kompetensi utamanya bidang TI ditujukan untuk menunjukkan jika lulusan merupakan lulusan yang berkompeten di bidang TI, dan adanya sertifikat akan memudahkan perusahaan memilah alumni D3TI berkompeten disuatu bidang yang dibutuhkan.</p>',
                'rasionalisasi' => '<p>Dengan mahasisswa diikutkan dalam ujian kompetensi yang diadakan oleh BNSP sebgai badan yang dibentuk ooleh pemerintah untuk dapat memberikan Sertifikat kompetensi maka telah melaksankan IKK K03-05. Penyelenggaraan uji sertifikasi kompetensi mahasiswa.</p>',
                'tujuan' => '<p>1. Pengukuran kompetensi spesifik mahasiswa</p>

                <p>2. Mendapatkan bukti kompetensi mahasiswa berupa sertifikat kompetensi</p>',
                'mekanisme' => '<p>1.Membagi kompetensi besar mahasiswa yaitu programmer, administrasi jaringan dan pengembang web</p>

                <p>2. Melakukan pendataan mahasiswa dengan memilih kompetensi yang sudah ditentukan</p>
                
                <p>3. Mendaftarkan mahasiswa kepada Lembaga Sertifikasi Kompetensi sesuai dengan kompetensi yang dipilih</p>
               <p>4. Mahasiswa melakukan ujian kompetensi sesuai dengan kompetensi yang dipilih</p>
                <p>Bidang sertifikasi kompetensi yang akan dilaksanakan bagi angkatan 2019 adalah :</p>
                <p>- (Pemrogam) LSP UNS</p> <p>- (Junior Network Administrator) LSP UNS</p>
               <p>- (Pengembang Web) LSP INFORMATIKA</p>',
                'keberlanjutan' => '<p>Kegiatan ini merupakan titik awal dari peningkatan kualitas tenaga pendidik di Program Studi Diploma Tiga (D3) Teknik Infromatika Sekolah Vokasi UNS. Kegiatan berikutnya setelah ini dilakukan monitoring dan evaluasi kegiatan tingkat kelulusan ujian kompetensi mahasiswa yang dapat diasosiakan dengan tingkat keberhasilan proses pembelajaran dalam perkuliahan.</p>',
                'realisasi_IKU' => '80',
                'target_IKU' => '100',
                'realisasi_IK' => '6',
                'target_IK' => '7',
                'nama_pic' => 'Sahirul Alim Tri Bawono, S.Kom., M.Eng.',
                'email_pic' => 'paksahirul@gmail.com',
                'kontak_pic' => '081278902345',
                'tgl_mulai_pelaksanaan' => '2022-06-23',
                'tgl_akhir_pelaksanaan' => '2022-06-30',
                'jumlah_anggaran' => '18750000',
                'create_by' => 18,
                'update_by' => '18',
                'created_at' => '2022-06-18 22:24:06',
                'updated_at' => '2022-06-18 22:24:06',
            ],
            [
                'id' => '12',
                'id_unit' => '2',
                'id_tw' => '6',
                'id_subK' => '1',
                'nama_kegiatan' => 'Coba Kegiatan 2',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => '<table align="center" border="1" cellpadding="1" cellspacing="1" style="width:500px">
                <caption>tabel x</caption>
                <tbody>
                    <tr>
                        <td>no</td>
                        <td>nama</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            
            <p>&nbsp;</p>',
                'rasionalisasi' => '<p><img alt="Murottal Trio Qori Muzammil Hasballah, Taqy Malik, Ibrohim Elhaq Al Waqiah  - Data Islami" src="https://3.bp.blogspot.com/-e5Rgg96pqis/WhJOM7TLDsI/AAAAAAAAAto/hj5Ds_H9lO84VSUzv2VtTu7GyrUkmCn1ACLcBGAs/s1600/trio%2Bqori.jpg" /></p>',
                'tujuan' => '<p>x</p>',
                'mekanisme' => '<p>x</p>',
                'keberlanjutan' => '<p>x</p>',
                'realisasi_IKU' => '80',
                'target_IKU' => '100',
                'realisasi_IK' => '89',
                'target_IK' => '100',
                'nama_pic' => 'Sahirul Alim Tri Bawono, S.Kom., M.Eng.',
                'email_pic' => 'paksahirul@gmail.com',
                'kontak_pic' => '081278902345',
                'tgl_mulai_pelaksanaan' => '2021-06-19',
                'tgl_akhir_pelaksanaan' => '2021-06-20',
                'jumlah_anggaran' => '0',
                'create_by' => 18,
                'update_by' => 18,
                'created_at' => '2022-06-01 22:24:06',
                'updated_at' => '2022-06-01 22:24:06',
            ],
            [
                'id' => '13',
                'id_unit' => '2',
                'id_tw' => '5',
                'id_subK' => '1',
                'nama_kegiatan' => 'Coba Kegiatan 4',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => '<table align="center" border="1" cellpadding="1" cellspacing="1" style="width:500px">
                <caption>tabel x</caption>
                <tbody>
                    <tr>
                        <td>no</td>
                        <td>nama</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            
            <p>&nbsp;</p>',
                'rasionalisasi' => '<p><img alt="Murottal Trio Qori Muzammil Hasballah, Taqy Malik, Ibrohim Elhaq Al Waqiah  - Data Islami" src="https://3.bp.blogspot.com/-e5Rgg96pqis/WhJOM7TLDsI/AAAAAAAAAto/hj5Ds_H9lO84VSUzv2VtTu7GyrUkmCn1ACLcBGAs/s1600/trio%2Bqori.jpg" /></p>',
                'tujuan' => '<p>x</p>',
                'mekanisme' => '<p>x</p>',
                'keberlanjutan' => '<p>x</p>',
                'realisasi_IKU' => '100',
                'target_IKU' => '100',
                'realisasi_IK' => '100',
                'target_IK' => '100',
                'nama_pic' => 'Sahirul Alim Tri Bawono, S.Kom., M.Eng.',
                'email_pic' => 'paksahirul@gmail.com',
                'kontak_pic' => '081278902345',
                'tgl_mulai_pelaksanaan' => '2022-06-19',
                'tgl_akhir_pelaksanaan' => '2022-06-19',
                'jumlah_anggaran' => '0',
                'create_by' => 18,
                'update_by' => 18,
                'created_at' => '2022-03-18 09:18:35',
                'updated_at' => '2022-03-18 09:18:35',
            ],
            [
                'id' => '14',
                'id_unit' => '2',
                'id_tw' => '5',
                'id_subK' => '1',
                'nama_kegiatan' => 'Coba Kegiatan 5',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => '<table align="center" border="1" cellpadding="1" cellspacing="1" style="width:500px">
                <caption>tabel x</caption>
                <tbody>
                    <tr>
                        <td>no</td>
                        <td>nama</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            
            <p>&nbsp;</p>',
                'rasionalisasi' => '<p><img alt="Murottal Trio Qori Muzammil Hasballah, Taqy Malik, Ibrohim Elhaq Al Waqiah  - Data Islami" src="https://3.bp.blogspot.com/-e5Rgg96pqis/WhJOM7TLDsI/AAAAAAAAAto/hj5Ds_H9lO84VSUzv2VtTu7GyrUkmCn1ACLcBGAs/s1600/trio%2Bqori.jpg" /></p>',
                'tujuan' => '<p>x</p>',
                'mekanisme' => '<p>x</p>',
                'keberlanjutan' => '<p>x</p>',
                'realisasi_IKU' => '100',
                'target_IKU' => '100',
                'realisasi_IK' => '100',
                'target_IK' => '100',
                'nama_pic' => 'Sahirul Alim Tri Bawono, S.Kom., M.Eng.',
                'email_pic' => 'paksahirul@gmail.com',
                'kontak_pic' => '081278902345',
                'tgl_mulai_pelaksanaan' => '2022-06-19',
                'tgl_akhir_pelaksanaan' => '2022-06-19',
                'jumlah_anggaran' => '0',
                'create_by' => 18,
                'update_by' => 18,
                'created_at' => '2022-03-18 09:18:35',
                'updated_at' => '2022-03-18 09:18:35',
            ],
            [
                'id' => '15',
                'id_unit' => '2',
                'id_tw' => '6',
                'id_subK' => '143',
                'nama_kegiatan' => 'Membangung Sistem Penjaminan Mutu',
                'jenis_ajuan' => 'Baru',
                'latar_belakang' => '<p>Sumber daya manusia yang kompeten akan semakin banyak dibutuhkan oleh dunia usaha dan dunia industri pada masa kini hingga mendatang. Untuk memenuhi kebutuhan tersebut, Direktorat Jenderal Pendidikan Vokasi Kemendikbud terus berupaya melakukan berbagai macam terobosan baru melalui berbagai program dan kebijakan.</p>',
                'rasionalisasi' => '<p>Sebagai upaya untuk mewujudkan pengembangan Program studi melalui proses upgrade D3 menjadi Sarjana Terapan (D4) maka dilakukan beberapa tahapan.</p>',
                'tujuan' => '<ol>
                <li>Mengetahui kebutuhan/ serapan industri atas lulusan sarjanan terapan yang akan dihasilkan&nbsp;</li>
                <li>persiapan penyusunan dan perumusan kurikulum D4</li>
                <li>Persiapan penyusunan draft borang upgrade D4</li>
            </ol>',
                'mekanisme' => '<ol>
                <li>Diskusi dengan lembaga terkait</li>
                <li>Penyusunan dokumen borang upgrade dari D3 ke D4</li>
            </ol>',
                'keberlanjutan' => '<p>Kegiatan ini merupakan bagian dari proses penyusunan borang upgrade D4 oleh D3 Teknik Informatika.</p>',
                'realisasi_IKU' => '80',
                'target_IKU' => '100',
                'realisasi_IK' => '0',
                'target_IK' => '1',
                'nama_pic' => 'Nanang Maulana Yoeseph, S.Si., M.Cs.',
                'email_pic' => 'paknanang@gmail.com',
                'kontak_pic' => '081278902345',
                'tgl_mulai_pelaksanaan' => '2022-06-29',
                'tgl_akhir_pelaksanaan' => '2022-06-29',
                'jumlah_anggaran' => '2200000',
                'create_by' => 23,
                'update_by' => 23,
                'created_at' => '2022-06-21 16:13:00',
                'updated_at' => '2022-06-21 16:13:00',
            ],
        ]);
    }
}
