<br />
<br />
<?php
$totanggaran1 = 0;
for ($r = 0; $r < count($rab); $r++) {
    if ($rab[$r]->id_tor == $tor[$t]->id) { ?>
        <div class="container center">
            <!-- <h5 style="text-align: center;">RINCIAN ANGGARAN BELANJA</h5> -->
            <?php for ($u = 0; $u < count($unit2); $u++) {
                if ($tor[$t]->id_unit == $unit2[$u]->id) {
                    $namaunit = $unit2[$u]->nama_unit;
                }
            } ?>
            <!-- <h5 style="text-align: center;">{{strtoupper($namaunit)}}</h5><br /> -->
            <!-- <br /> -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td colspan="8">
                                <h5 style="text-align: center;"><b>RINCIAN ANGGARAN BELANJA</b></h5>
                                <h5 style="text-align: center;"><b>{{strtoupper($namaunit)}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td width="28%"><b>Unit Kerja</b> </td>
                            <td width="2%">:</td>
                            <td colspan="5" width="50%">{{$namaunit}}</td>
                            <td width="15%"><b>Tahun</b></td>
                        </tr>

                        <tr>
                            <?php
                            $id_subk = 0;
                            $nama_subK = "";
                            $desk_subK = "";
                            $nama_k = "";
                            $desk_k = "";
                            foreach ($kategori_subK as $subK1) {
                                if ($subK1->id == $tor[$t]->id_subK) {
                                    $id_subk = $subK1->id;
                                    $nama_subK = $subK1->subK;
                                    $desk_subK = $subK1->deskripsi;
                                    $nama_k = $subK1->K;
                                    $desk_k = $subK1->deskripsi_k;
                                }
                            }
                            ?>
                            <td><b>Indikator Kegiatan</b> </td>
                            <td>:</td>
                            <td colspan="5">{{ $nama_k." : ".$desk_k}}</td>
                            <td rowspan="3">{{substr($tor[$t]->tgl_mulai_pelaksanaan,0,4)}}</td>
                        </tr>
                        <tr>
                            <td><b>Sub Kegiatan</b></td>
                            <td>:</td>
                            <td colspan="5">{{$nama_subK." : ". $desk_subK}}</td>
                        </tr>
                        <tr>
                            <td><b>Kegiatan</b></td>
                            <td>:</td>
                            <td colspan="5">{{$tor[$t]->nama_kegiatan}}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align: center;"><b>Indikator</b></td>
                            <td><b>Target Kinerja</b></td>
                        </tr>
                        <tr>
                            <td><b>Input (Masukan)</b></td>
                            <td>:</td>
                            <td colspan="5">{{$rab[$r]->masukan }}</td>
                            <td rowspan="2">{{$tor[$t]->target_IKU ."%"}}</td>
                        </tr>
                        <tr>
                            <td><b>Output (Keluaran)</b></td>
                            <td>:</td>
                            <td colspan="5">{{$rab[$r]->keluaran}}</td>
                        </tr>
                        <tr>
                            <th colspan="8" style="text-align: center;"><b>Anggaran Belanja</b></th>
                        </tr>
                        <tr>
                            <th rowspan="3" class="align-middle">Jenis Belanja</th>
                            <th colspan="6" style="text-align: center;">Rincian Biaya</th>
                            <th rowspan="3" class="align-middle" style="text-align: center;">Jumlah Anggaran (Rp)</th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align: center;">Kebutuhan</th>
                            <th rowspan="2" class="align-middle" style="text-align: center;">Frek</th>
                            <th colspan="2" style="text-align: center;">Perhitungan</th>
                            <th rowspan="2" class="align-middle" style="text-align: center;">Harga Satuan</th>
                        </tr>
                        <tr>
                            <th width="8%">Vol.</th>
                            <th width="10%">Sat.</th>
                            <th width="10%">Vol.</th>
                            <th width="10%">Sat.</th>
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
                                            // echo $anggaran[$i]->id_rab;
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
                                                <td style="text-align: justify;">
                                                    <b>{{$kodeKelompok}} </b><br />
                                                    {{$detail_mak[$j]->detail.". "}}
                                                    <h6><?= $anggaran[$i]->catatan ?></h6>
                                                </td>
                                                <td>{{$anggaran[$i]->kebutuhan_vol}}</td>
                                                <td>{{$anggaran[$i]->kebutuhan_sat}}</td>
                                                <td>{{$anggaran[$i]->frek}}</td>
                                                <td>{{$anggaran[$i]->perhitungan_vol}}</td>
                                                <td>{{$anggaran[$i]->perhitungan_sat}}</td>
                                                <td>{{"Rp. ".number_format($anggaran[$i]->harga_satuan,2,',',',')}}</td>
                                                <td>{{"Rp. ".number_format($anggaran[$i]->anggaran,2,',',',')}}</td>
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
                            <th colspan="7">Total</th>
                            <th>{{"Rp. ".number_format($totalAnggaranRab,2,',',',')}}</th>
                        </tr>
                        <!-- TANDA TANGAN -->
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;" width="50%">Kepala Program Studi
                                <br />
                                <br />
                                <br />
                                <br />
                                <?php
                                foreach ($users as $us) {
                                    foreach ($unit as $un) {
                                        if ($un->id == $us->id_unit) {
                                            foreach ($roles as $ro) {
                                                if ($ro->id == $us->role) {
                                                    if ($ro->name == "Kaprodi" && $un->nama_unit == $namaunit) {
                                                        echo "<b>" . $us->name . "</b><br />";
                                                        echo "NIP. " . $us->nip;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td colspan="4" style="text-align: center;" width="50%">Perencana/Penanggungjawab
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>{{$tor[$t]->nama_pic}}</b><br />
                                {{"NIP. ". Auth::user()->nip }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: center;">Menyetujui</td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="30%">Wakil Dekan Akademik, Riset, dan Kemahasiswaan
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>Agus Dwi Priyanto, S.S., M.CALL</b><br />
                                NIP. 197408182000121001
                            </td>
                            <td colspan="4">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi
                                <br />
                                <br />
                                <br />
                                <b>Dr. Eng. Herman Saputro, S.Pd., M.Pd., M.T.</b><br />
                                NIP. 198208112006041001
                            </td>
                            <td colspan="2">Wakil Dekan SDM, Keuangan, dan Logistik
                                <br />
                                <br />
                                <br />
                                <br />
                                <b> Abdul Aziz, S.Kom., M.Cs.</b><br />
                                NIP. 198104132005011001
                            </td>
                        </tr>
                        <!-- TANDA TANGAN -->
                    </tfoot>
                </table>


        <?php

    }
} ?>