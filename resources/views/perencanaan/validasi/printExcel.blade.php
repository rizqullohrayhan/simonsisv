<?php for ($t = 0; $t < count($tor); $t++) {
    if ($tor[$t]->id == $id) {
?>
        <!-- SUB K -->
        <?php
        if (!empty($kategori_subK)) {
            for ($k = 0; $k < count($kategori_subK); $k++) {
                if ($kategori_subK[$k]->id_tor == $tor[$t]->id) {
                    $sub_k =  $kategori_subK[$k]->subK;
                    $deskripsi_sub_k =  $kategori_subK[$k]->deskripsi;

                    $indikator_k =  $kategori_subK[$k]->K;
                    $deskripsi_indikator_k =  $kategori_subK[$k]->deskripsi_k;

                    $iku = $kategori_subK[$k]->IKU;
                    $deskripsi_iku = $kategori_subK[$k]->deskripsi_iku;
                    $ik = $kategori_subK[$k]->IK;
                    $deskripsi_ik = $kategori_subK[$k]->deskripsi_ik;
                }
            }
        }

        ?>
        <!-- PRODI -->
        <?php for ($u = 0; $u < count($unit); $u++) { ?>
            <?php if ($tor[$t]->id_unit == $unit[$u]->id) {
                $prodi = $unit[$u]->nama_unit;
            } ?>
        <?php } ?>
        <table style="border: 1px solid black;
  border-collapse: collapse;">
            <thead>
                <tr>
                    <?php for ($a = 0; $a < 3; $a++) { ?>
                        <td width="25px"></td>
                    <?php } ?>
                    <td width="127px"></td>
                    <?php for ($b = 0; $b < 18; $b++) { ?>
                        <td width="25px"></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td colspan="21" style="text-align: center;font-weight: bold;">
                        KERANGKA ACUAN KERJA (KAK) / TERM OF REFERENCE (ToR)
                    </td>
                </tr>
                <tr>
                    <td colspan="21" style="text-align: center; font-weight: bold;">
                        PROGRAM STUDI {{strtoupper($prodi)}}
                    </td>
                </tr>
                <tr>
                    <td colspan="21" style="text-align: center; font-weight: bold;">SEKOLAH VOKASI UNIVERSITAS SEBELAS</td>
                </tr>
                <tr>
                    <td colspan="21"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="25px" style="font-weight: bold;">1.</td>
                    <td colspan="3" style="font-weight: bold;">Indikator Kinerja Utama</td>
                    <td style="font-weight: bold;">:</td>
                    <td colspan="2" style="font-weight: bold;">{{$iku}}</td>
                    <td colspan="14" style=" word-wrap: break-word;" height="50px">{{$deskripsi_iku}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">2.</td>
                    <td style="font-weight: bold;" colspan="3">Indikator Kegiatan (IK)</td>
                    <td style="font-weight: bold;">:</td>
                    <td style="font-weight: bold;" colspan="2">{{$ik}}</td>
                    <td colspan="14" style=" word-wrap: break-word;" height="50px">{{$deskripsi_ik}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">3.</td>
                    <td style="font-weight: bold;" colspan="3">Kegiatan</td>
                    <td style="font-weight: bold;">:</td>
                    <td style="font-weight: bold;" colspan="2">{{$indikator_k}}</td>
                    <td colspan="14" style=" word-wrap: break-word;" height="50px">{{$deskripsi_indikator_k}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">4.</td>
                    <td style="font-weight: bold;" colspan="3">Sub Kegiatan</td>
                    <td style="font-weight: bold;">:</td>
                    <td style="font-weight: bold;" colspan="2">{{$sub_k}}</td>
                    <td colspan="14" style=" word-wrap: break-word;" height="50px">{{$deskripsi_sub_k}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">5.</td>
                    <td style="font-weight: bold;" colspan="3">Judul Kegiatan</td>
                    <td style="font-weight: bold;">:</td>
                    <td colspan="16" style="word-wrap: break-word;" height="30px">{{$tor[$t]->nama_kegiatan}}</td>
                </tr>

                <!-- Latar Belakang -->
                <tr>
                    <td style="font-weight: bold;">6.</td>
                    <td style="font-weight: bold;word-wrap: break-word;" colspan="20">Latar Belakang</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="20" style="word-wrap: break-word;" height="100px">{!!$tor[$t]->latar_belakang!!}</td>
                </tr>

                <!-- Rasionalisasi -->
                <tr>
                    <td style="font-weight: bold;">7.</td>
                    <td style="font-weight: bold;" colspan="20">Rasionalisasi</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="20" style="word-wrap: break-word;" height="100px">{!!$tor[$t]->rasionalisasi!!}</td>
                </tr>

                <!-- Tujuan -->
                <tr>
                    <td style="font-weight: bold;">8.</td>
                    <td style="font-weight: bold;" colspan="20">Tujuan</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="20" style="word-wrap: break-word;" height="100px">{!!$tor[$t]->tujuan!!}</td>
                </tr>

                <!-- Mekanisme dan Rancangan -->
                <tr>
                    <td style="font-weight: bold;">9.</td>
                    <td style="font-weight: bold;" colspan="20">Mekanisme dan Rancangan</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="20" style="word-wrap: break-word; vertical-align: middle;" height="100px">{!!$tor[$t]->mekanisme!!}</td>
                </tr>

                <!-- Jadwal Pelaksanaan -->
                <tr>
                    <td style="font-weight: bold;">10.</td>
                    <td style="font-weight: bold;" colspan="20">Jadwal Pelaksanaan</td>
                </tr>

                <?php
                if (!empty($komponen_jadwal)) {
                ?>
                    <tr>
                        <td></td>
                        <td style="font-weight: bold;text-align: center; vertical-align: middle;" colspan="8" rowspan="2">Komponen Input</td>
                        <td style="font-weight: bold;text-align: center; vertical-align: middle;" colspan="12">{{substr($tor[$t]->tgl_mulai_pelaksanaan,0,4)}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                    </tr>

                    <?php
                    for ($j = 0; $j < count($komponen_jadwal); $j++) {
                        if ($komponen_jadwal[$j]->id_tor == $tor[$t]->id) { ?>
                            <tr height="40px">
                                <td></td>
                                <td colspan="8" style="word-wrap: break-word;" height="30px">{{$komponen_jadwal[$j]->komponen}}</td>
                                <?php for ($b = 1; $b < $komponen_jadwal[$j]->bulan_awal; $b++) { ?>
                                    <td></td>
                                <?php } ?>
                                <?php for ($kj = 0; $kj <= ($komponen_jadwal[$j]->bulan_akhir - $komponen_jadwal[$j]->bulan_awal); $kj++) { ?>
                                    <td bgcolor="black" style="background-color:#000; color: #000;border:1px solid #000;"></td>
                                <?php }
                                for ($c = 12; $c > $komponen_jadwal[$j]->bulan_akhir; $c--) { ?>
                                    <td></td>
                                <?php } ?>

                            </tr>
                    <?php }
                    }
                    ?>
                <?php } ?>

                <!-- Indikator Kinerja Utama (IKU) -->
                <tr>
                    <td>11.</td>
                    <td style="font-weight: bold;" colspan="21">Indikator Kinerja Utama (IKU)</td>
                </tr>

                <tr>
                    <td></td>
                    <td style="font-weight: bold;text-align: center;" colspan="14" height="40px">Indikator</td>
                    <td style="font-weight: bold;text-align: center;" colspan="3">Realisasi <br /> {{substr($tor[$t]->tgl_mulai_pelaksanaan,0,4)-1}}</td>
                    <td style="font-weight: bold;text-align: center;" colspan="3">Target <br /> {{substr($tor[$t]->tgl_mulai_pelaksanaan,0,4)}}</td>
                </tr>

                <tr height="40px">
                    <td></td>
                    <td colspan="14" style="word-wrap: break-word;" height="40px">{{$iku ." ".$deskripsi_ik}}</td>
                    <td colspan="3">{{$tor[$t]->realisasi_IK ."%"}}</td>
                    <td colspan="3">{{$tor[$t]->target_IK ."%"}}</td>
                </tr>

                <!-- Indikator Kinerja Kegiatan (IK) -->
                <tr>
                    <td>12.</td>
                    <td colspan="21" style="font-weight: bold;"> Indikator Kinerja Kegiatan (IK)</td>
                </tr>

                <tr>
                    <td></td>
                    <td style="font-weight: bold;text-align: center; vertical-align: middle;" colspan="14" height="40px">Indikator</td>
                    <td style="font-weight: bold;text-align: center; vertical-align: middle;" colspan="3">Realisasi <br /> {{substr($tor[$t]->tgl_mulai_pelaksanaan,0,4)-1}}</td>
                    <td style="font-weight: bold;text-align: center; vertical-align: middle;" colspan="3">Target <br /> {{substr($tor[$t]->tgl_mulai_pelaksanaan,0,4)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="14" style="word-wrap: break-word;" height="40px">{{$iku ." ".$deskripsi_ik}}</td>
                    <td colspan="3">{{$tor[$t]->realisasi_IK ."%"}}</td>
                    <td colspan="3">{{$tor[$t]->target_IK ."%"}}</td>
                </tr>


                <!-- Keberlanjutan -->
                <tr>
                    <td style="font-weight: bold;">14.</td>
                    <td style="font-weight: bold;" colspan="20">Keberlanjutan</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="20" style="word-wrap: break-word;" height="60px">{!!$tor[$t]->keberlanjutan!!}</td>
                </tr>

                <!-- Penanggungjawab -->
                <tr>
                    <td style="font-weight: bold;">15.</td>
                    <td style="font-weight: bold;" colspan="20">Penanggungjawab</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;"></td>
                    <?php
                    $usernip = '';
                    foreach ($users as $usnip) {
                        if ($usnip->name == $tor[$t]->nama_pic) {
                            $usernip = $usnip->nip;
                        }
                    }
                    ?>
                    <td style="word-wrap: break-word;" colspan="20" height="30px">Penanggung jawab dari kegiatan ini adalah {{$tor[$t]->nama_pic ." NIP.". $usernip}} </td>
                </tr>
                <tr>
                    <td colspan="21"></td>
                </tr>
                <!-- TANDA TANGAN -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="8">Surakarta,
                        <?= date_format(date_create($tor[$t]->created_at), 'd-m-Y') ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Kepala Program Studi </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="8">Perencana/Penanggungjawab</td>
                </tr>
                <?php for ($j = 0; $j < 5; $j++) { ?>
                    <tr>
                        <?php for ($i = 0; $i < 21; $i++) { ?>
                            <td></td>
                        <?php } ?>
                    </tr>
                <?php } ?>

                <?php
                $kaprodi = "";
                $NIP = "";
                foreach ($users as $us) {
                    foreach ($unit as $un) {
                        if ($un->id == $us->id_unit) {
                            foreach ($roles as $ro) {
                                if ($ro->id == $us->role) {
                                    if ($ro->name == "Kaprodi"  && $un->nama_unit == $prodi) {
                                        $kaprodi = $us->name;
                                        $NIP = $us->nip;
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">
                        {{$kaprodi}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="8">
                        {{$tor[$t]->nama_pic}}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">
                        {{"NIP. " . $NIP}}
                    </td>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td colspan="8">
                        {{"NIP. " . Auth::user()->nip }}
                    </td>
                </tr>
                <tr>
                    <td colspan="21"></td>
                </tr>
                <tr>
                    <td colspan="21" style="text-align: center;">Menyetujui</td>
                </tr>
                <tr>
                    <td colspan="21"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="word-wrap: break-word;" colspan="5" rowspan="2">Wakil Dekan Akademik, Riset, dan Kemahasiswaan

                    </td>
                    <td style="word-wrap: break-word;" colspan="8" rowspan="2">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi

                    </td>
                    <td style="word-wrap: break-word;" colspan="7" rowspan="2">Wakil Dekan SDM, Keuangan, dan Logistik

                    </td>
                </tr>
                <?php for ($j = 0; $j < 5; $j++) { ?>
                    <tr>
                        <?php for ($i = 0; $i < 21; $i++) { ?>
                            <td></td>
                        <?php } ?>
                    </tr>
                <?php } ?>

                <tr>
                    <td></td>
                    <td style="word-wrap: break-word;" colspan="5" rowspan="2">
                        Agus Dwi Priyanto, S.S., M.CALL
                    </td>
                    <td style="word-wrap: break-word;" colspan="8" rowspan="2">
                        Dr. Eng. Herman Saputro, S.Pd., M.Pd., M.T.
                    </td>
                    <td style="word-wrap: break-word;" colspan="7" rowspan="2">
                        Abdul Aziz, S.Kom., M.Cs.
                    </td>
                </tr>
                <tr>
                    <?php for ($i = 0; $i < 21; $i++) { ?>
                        <td></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td></td>
                    <td style="word-wrap: break-word;" colspan="5">
                        NIP. 197408182000121001
                    </td>
                    <td style="word-wrap: break-word;" colspan="8">
                        NIP. 198208112006041001
                    </td>
                    <td style="word-wrap: break-word;" colspan="7">
                        NIP. 198104132005011001
                    </td>
                </tr>

                <!-- TANDA TANGAN -->
            </tbody>
        </table>

        <br />


<?php }
} ?>