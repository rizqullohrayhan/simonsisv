<?php
if (!empty($totalpertw)) {
    // $semuaanggaran = [0, 0, 0, 0];
    // for ($t2 = 0; $t2 < count($tor); $t2++) {
    //     for ($u = 0; $u < count($totalpertw); $u++) {
    //         if ($totalpertw[$u]->id_tor == $tor[$t2]->tor_id) {
    //             for ($an = 0; $an < 4; $an++) {
    //                 if (substr($totalpertw[$u]->triwulan, 14, 1) == $an + 1) {
    //                     if ($prodi != 0) {
    //                         if ($totalpertw[$u]->id_unit_tor == $prodi) {
    //                             if ($filtertahun != 0) {
    //                                 if (substr($totalpertw[$u]->tgl_mulai_pelaksanaan, 0, 4) == $filtertahun) {
    //                                     $semuaanggaran[$an]  += $totalpertw[$u]->anggaran;
    //                                 }
    //                             } else {
    //                                 $semuaanggaran[$an]  += $totalpertw[$u]->anggaran;
    //                             }
    //                         }
    //                     } elseif ($prodi == 0) {
    //                         if ($filtertahun != 0) {
    //                             if (substr($totalpertw[$u]->tgl_mulai_pelaksanaan, 0, 4) == $filtertahun) {
    //                                 $semuaanggaran[$an]  += $totalpertw[$u]->anggaran;
    //                             }
    //                         } else {
    //                             $semuaanggaran[$an]  += $totalpertw[$u]->anggaran;
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    $semuaanggaran = [0, 0, 0, 0];
    for ($t2 = 0; $t2 < count($join); $t2++) {
        // echo  "TOR " . $tor[$t2]->tor_id . " <br />" . $tor[$t2]->jumlah_anggaran . " - " . $tor[$t2]->triwulan .  " - " . "TW" . substr($tor[$t2]->triwulan, 14, 1) . "<br />";
    }

    if ($ada >= 1) {
?>
        <tr>
            <?php
            for ($am = 0; $am < 4; $am++) { ?>
                <!-- <td class="text-white" bgcolor="#20B2AA" colspan="3" style="font-size: medium;"> -->
                <!-- <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[$am], 2, ',', '.') ?></b> -->
                <!-- </td> -->
            <?php }
            ?>
        </tr>
<?php }
} ?>