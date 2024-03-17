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


        <!-- RAB (RINCIAN ANGGARAN BELANJA) -->
        <!-- RAB (RINCIAN ANGGARAN BELANJA) -->
        <!-- RAB (RINCIAN ANGGARAN BELANJA) -->

        <?php
        $totanggaran1 = 0;
        for ($r = 0; $r < count($rab); $r++) {
            if ($rab[$r]->id_tor == $tor[$t]->id) { ?>
                <table>
                    <thead>
                        <tr>
                            <td width="150px"></td>
                            <td width="20px"></td>
                            <?php for ($b = 0; $b < 6; $b++) { ?>
                                <td width="51px"></td>
                            <?php } ?>
                            <td width="130px"></td>
                            <td width="130px"></td>
                        </tr>
                        <tr>
                            <td colspan="10" style="text-align: center;">
                                <b>RINCIAN ANGGARAN BELANJA</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10" style="text-align: center;">
                                <?php for ($u = 0; $u < count($unit2); $u++) {
                                    if ($tor[$t]->id_unit == $unit2[$u]->id) {
                                        $namaunit = $unit2[$u]->nama_unit;
                                    }
                                } ?>
                                <b>{{strtoupper($namaunit)}}</b>
                            </td>
                        </tr>
                        <tr>
                            <td width="130px"></td>
                            <td width="20px"></td>
                            <?php for ($b = 0; $b < 6; $b++) { ?>
                                <td width="51px"></td>
                            <?php } ?>
                            <td width="82px"></td>
                            <td width="82px"></td>
                        </tr>
                        <tr>
                            <td height="40px" style="vertical-align: middle;"><b>Unit Kerja</b></td>
                            <td colspan="1"> : </td>
                            <td colspan="7"> {{$namaunit}}
                            </td>
                            <td colspan="1">Tahun</td>
                        </tr>
                        <?php
                        $K = '';
                        $SUBK = '';
                        foreach ($indikator_subk as $sub) {
                            if ($sub->id == $tor[$t]->id_subK) {
                                $ID_SUBK = $sub->id_k;
                                $SUBK = $sub->subK . " - " . $sub->deskripsi;
                            }
                        }
                        foreach ($indikator_ks as $xK) {
                            if ($ID_SUBK == $xK->id) {
                                $K = $xK->K . " - " . $xK->deskripsi;
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="1" height="40px"><b>Kegiatan</b></td>
                            <td colspan="1"> : </td>
                            <td colspan="7">{{$K }}</td>
                            <td colspan="1" rowspan="3">{{substr($tor[$t]->tgl_mulai_pelaksanaan,0,4)}}</td>
                        </tr>
                        <tr>
                            <td colspan="1" height="40px"><b>Sub Kegiatan</b></td>
                            <td colspan="1"> : </td>
                            <td colspan="7"> {{$SUBK}}</td>
                        </tr>
                        <tr>
                            <td colspan="1" height="40px"><b>Judul Kegiatan</b></td>
                            <td colspan="1"> : </td>
                            <td colspan="7">{{$tor[$t]->nama_kegiatan}}</td>
                        </tr>
                        <tr>
                            <td colspan="9" style="text-align: center;" height="40px"><b>Indikator</b></td>
                            <td colspan="1"><b>Target Kinerja</b></td>
                        </tr>
                        <tr>
                            <td colspan="1" height="40px"><b>Input (Masukan)</b></td>
                            <td colspan="1">:</td>
                            <td colspan="7">{{$rab[$r]->masukan }}</td>
                            <td rowspan="2">{{$tor[$t]->target_IKU ."%"}}</td>
                        </tr>
                        <tr>
                            <td colspan="1" height="40px"><b>Output (Keluaran)</b></td>
                            <td colspan="1">: </td>
                            <td colspan="7"> {{$rab[$r]->keluaran}}</td>
                        </tr>
                        <tr>
                            <td colspan="10" style="text-align: center;"><b>Anggaran Belanja</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="3"><b>Jenis Belanja</b></td>
                            <td colspan="6" style="text-align: center;"><b>Rincian Biaya</b></td>
                            <td rowspan="1" style="text-align: center;"><b>Jumlah Anggaran (Rp)</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;"><b>Kebutuhan</b></td>
                            <td rowspan="2" style="text-align: center;"><b>Frek</b></td>
                            <td colspan="2" style="text-align: center;"><b>Perhitungan</b></td>
                            <td rowspan="2" style="text-align: center;"><b>Harga Satuan</b></td>
                        </tr>
                        <tr>
                            <td><b>Vol.</b></td>
                            <td><b>Sat.</b></td>
                            <td><b>Vol.</b></td>
                            <td><b>Sat.</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalAnggaranRab = 0;
                        $urut = 1;
                        for ($i = 0; $i < count($anggaran); $i++) {
                            if ($anggaran[$i]->anggaran != 0) {
                                if ($anggaran[$i]->id_rab == $rab[$r]->id) {
                                    $totanggaran1 += $anggaran[$i]->anggaran;
                                    for ($j = 0; $j < count($detail_mak); $j++) {
                                        if ($anggaran[$i]->id_detail_mak == $detail_mak[$j]->id) {
                        ?>
                                            <?php
                                            $kodeKelompok = '';
                                            foreach ($belanja_mak as $belanja) {
                                                if ($belanja->id == $detail_mak[$j]->id_belanja) {
                                                    foreach ($kelompok_mak as $kelompoks) {
                                                        if ($belanja->id_kelompok == $kelompoks->id) {
                                                            $kodeKelompok = $kelompoks->kelompok;
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="3" style="word-wrap: break-word;">
                                                    <b>{{$kodeKelompok}} </b>
                                                    {{$detail_mak[$j]->detail. " ".  $anggaran[$i]->catatan}}
                                                </td>
                                                <td height="80px">{{$anggaran[$i]->kebutuhan_vol}}</td>
                                                <td>{{$anggaran[$i]->kebutuhan_sat}}</td>
                                                <td>{{$anggaran[$i]->frek}}</td>
                                                <td>{{$anggaran[$i]->perhitungan_vol}}</td>
                                                <td>{{$anggaran[$i]->perhitungan_sat}}</td>
                                                <td width="100px">{{"Rp. ".number_format($anggaran[$i]->harga_satuan,2,',',',')}}</td>
                                                <td width="100px">{{"Rp. ".number_format($anggaran[$i]->anggaran,2,',',',')}}</td>
                                            </tr>

                        <?php
                                            $totalAnggaranRab += $anggaran[$i]->anggaran;
                                            $urut += 1;
                                        }
                                    }
                                }
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">Total</td>
                            <td colspan="1">{{"Rp. ".number_format($totalAnggaranRab,2,',',',')}}</td>
                        </tr>
                        <tr>
                            <?php for ($i = 0; $i < 10; $i++) { ?>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <!-- TANDA TANGAN -->
                        <tr>
                            <td colspan="3">Kepala Program Studi</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">Perencana/Penanggungjawab</td>
                            <td></td>
                        </tr>
                        <?php for ($j = 0; $j < 5; $j++) { ?>
                            <tr>
                                <?php for ($i = 0; $i < 10; $i++) { ?>
                                    <td></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" height="45px">
                                <?php
                                foreach ($users as $us) {
                                    foreach ($unit as $un) {
                                        if ($un->id == $us->id_unit) {
                                            foreach ($roles as $ro) {
                                                if ($ro->id == $us->role) {
                                                    if ($ro->name == "Kaprodi" && $un->nama_unit == $namaunit) {
                                                        echo  $us->name . "<br />";
                                                        echo "NIP. " . $us->nip;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3" height="45px">
                                {{$tor[$t]->nama_pic}} <br />
                                {{"NIP. ". Auth::user()->nip }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10"></td>
                        </tr>
                        <tr>
                            <td colspan="10" style="text-align: center;">Menyetujui</td>
                        </tr>
                        <tr>
                            <td colspan="10"></td>
                        </tr>
                        <tr>
                            <td style="word-wrap: break-word;" colspan="3" rowspan="2">Wakil Dekan Akademik, Riset, dan Kemahasiswaan

                            </td>
                            <td style="word-wrap: break-word;" colspan="4" rowspan="2">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi

                            </td>
                            <td style="word-wrap: break-word;" colspan="3" rowspan="2">Wakil Dekan SDM, Keuangan, dan Logistik

                            </td>
                        </tr>
                        <?php for ($j = 0; $j < 5; $j++) { ?>
                            <tr>
                                <?php for ($i = 0; $i < 10; $i++) { ?>
                                    <td></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td style="word-wrap: break-word;" colspan="3" rowspan="2">
                                Agus Dwi Priyanto, S.S., M.CALL <br />
                                NIP. 197408182000121001
                            </td>
                            <td style="word-wrap: break-word;" colspan="4" rowspan="2">
                                Dr. Eng. Herman Saputro, S.Pd., M.Pd., M.T.<br />
                                NIP. 198208112006041001
                            </td>
                            <td style="word-wrap: break-word;" colspan="3" rowspan="2">
                                Abdul Aziz, S.Kom., M.Cs.<br />
                                NIP. 198104132005011001
                            </td>
                        </tr>
                        <!-- TANDA TANGAN -->
                    </tfoot>
                </table>
        <?php

            }
        } ?>
        <!-- END RAB (RINCIAN ANGGARAN BELANJA) -->
        <!-- END RAB (RINCIAN ANGGARAN BELANJA) -->
        <!-- END RAB (RINCIAN ANGGARAN BELANJA) -->

<?php }
} ?>