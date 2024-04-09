<?php if ($ada != 0) { ?>
    <tr bgcolor="white">
        <?php
        $nama_tw = "";
        for ($tr = 0; $tr < count($tw2); $tr++) {
            if ($tor[$a]->id_tw == $tw2[$tr]->id) {
                $nama_tw = $tw2[$tr]->triwulan;
                $nama_tw = substr($nama_tw, 14, 1);
            }
        }
        if ($nama_tw == 2) {
            for ($e = 1; $e < 4; $e++) { ?>
                <td align="center" bgcolor=" white"></td>
        <?php }
        } ?>

        <?php
        if ($nama_tw == 3) {
            for ($e = 1; $e < 7; $e++) { ?>
                <td bgcolor="white"></td>
        <?php }
        } ?>

        <?php
        if ($nama_tw == 4) {
            for ($e = 1; $e < 10; $e++) { ?>
                <td bgcolor="white"></td>
        <?php }
        } ?>

        <!-- 
  -------------------------------------------------------------------------
                                 MODAL KEGIATAN
  -------------------------------------------------------------------------
 -->

        <!-- ANGGARAN -->
        <?php if ($ada > 0) { ?>
            <td colspan="3" bgcolor="white">
                <?php
                $totanggaran1 = 0;

                $nomer_anggaran = 1;
                for ($i = 0; $i < count($anggaran); $i++) {
                    if ($anggaran[$i]->anggaran != 0) {
                        if ($anggaran[$i]->id_rab == $rab[$b]->id) {
                            $totanggaran1 += $anggaran[$i]->anggaran;
                            for ($j = 0; $j < count($belanja_mak); $j++) {
                                if ($anggaran[$i]->id_belanja_mak == $belanja_mak[$j]->id) {
                ?>
                                    <h6 align="left" style="font-size: smaller;">
                                        <span><?= $nomer_anggaran . ". " . " <b>" . $belanja_mak[$j]->belanja . " - " . "</b>" .
                                                    "Rp. " .  number_format($anggaran[$i]->anggaran, 2, ',', '.') ?>
                                            <?php $nomer_anggaran += 1; ?>


                                            <!-- <button class="badge badge-info rounded" data-toggle="modal" title="Detail Anggaran" data-original-title="Detail Anggaran" data-target="#detailang{{$anggaran[$i]->id}}">
                                                    <i class="fa fa-tasks"></i>
                                                </button> -->
                                            <!-- include('validasi/modal/anggaran/detail') -->

                                            <br />
                                            <!-- MODAL UPDATE DI ANGGARAN -->
                                        </span>
                                    </h6>
                <?php
                                }
                            }
                        }
                    }
                } ?>
                <a href="#" class="badge iq-bg-primary"> Total = <?= $nama_tw . " Rp. " .  number_format($totanggaran1, 2, ',', '.'); ?></a>
            </td>
        <?php } ?>
        <?php if ($ada == 0) {
            $totanggaran1 = 0 ?>
        <?php } ?>
        <!-- modal detail validasi kegiatan -->
        <!-- include('validasi/modal/kegiatan/detail') -->

        <?php
        if ($nama_tw == 1) {
            for ($e = 1; $e < 9; $e++) { ?>
                <td align="center" bgcolor=" white"></td>
        <?php }
        } ?>
        <?php
        if ($nama_tw == 2) {
            for ($e = 1; $e < 7; $e++) { ?>
                <td align="center" bgcolor=" white"></td>
        <?php }
        } ?>
        <?php
        if ($nama_tw == 3) {
            for ($e = 1; $e < 4; $e++) { ?>
                <td bgcolor="white"></td>
        <?php
            }
        }
        ?>
    </tr>
<?php } ?>