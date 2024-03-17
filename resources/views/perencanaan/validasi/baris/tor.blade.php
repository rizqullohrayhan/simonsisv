<tr>
    <?php
    $blok = 0;
    $ada2 = 0;
    $tdkada2 = 0;
    $statuskeg;
    $badge;
    for ($stk2 = 0; $stk2 < count($trx_status_tor); $stk2++) {
        if ($trx_status_tor[$stk2]->id_tor == $tor[$a]->id) {
            $ada2 += 1;
            if ($trx_status_tor[$stk2]->id_status == 1) {
                $statuskeg = "Pengajuan Prodi";
                $badge = "badge-warning";
            } elseif ($trx_status_tor[$stk2]->id_status == 2) {
                $statuskeg = "Diverifikasi";
                $badge = "badge-success";
            } elseif ($trx_status_tor[$stk2]->id_status == 3) {
                $statuskeg = "Revisi";
                $badge = "badge-danger";
            } elseif ($trx_status_tor[$stk2]->id_status == 4) {
                $statuskeg = "Divalidasi";
                $badge = "badge-info";
            } else {
                $statuskeg = "n";
            }
        } else {
        }
    }
    ?>
    <?php if ($ada2 >= 1) { ?>
        <th class="bg-secondary" colspan="13">
            <h6 id="tornya" style="color: white;"><b>{{"TOR"." - ". strtoupper($tor[$a]->nama_kegiatan)}}</b>
                <!-- AKSI TOR  -->
                <?php $total_per_tor = 0;
                $pengvalidasi = "p";
                $sireva = "a";
                for ($l = 0; $l < count($totalpertw); $l++) {
                    if ($totalpertw[$l]->id_tor == $tor[$a]->id) {
                        $total_per_tor += $totalpertw[$l]->anggaran; ?>
                <?php
                    }
                }
                ?>
                <a class="badge iq-bg-primary">
                    <h5>
                        <?= "Rp. " .  number_format($total_per_tor, 2, ',', '.') ?>
                    </h5>
                </a>

            </h6>
            <!-- VALIDASI TOR -->
            <button class="badge badge-info" data-toggle="modal" data-placement="top" data-target="#detail_tor{{$tor[$a]->id}}">
                <i class="fa fa-tasks"></i>
            </button>
            @include('perencanaan/validasi/modal/tor/detail')

            <?php
            if (!empty($trx_status_tor)) {
                for ($q3 = 0; $q3 < count($trx_status_tor); $q3++) {
                    if ($trx_status_tor[$q3]->id_tor == $tor[$a]->id) {
                        for ($st3 = 0; $st3 < count($status); $st3++) {
                            if ($status[$st3]->id == $trx_status_tor[$q3]->id_status) {
                                for ($u = 0; $u < count($user); $u++) {
                                    if ($user[$u]->id == $trx_status_tor[$q3]->create_by) {
                                        for ($rl = 0; $rl < count($role); $rl++) {
                                            if ($role[$rl]->id == $user[$u]->role) {
                                                $pengvalidasi = $role[$rl]->name;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            ?>
            }
            <?php if ($ada2 > 0) { ?>
                <div class="badge badge-pill badge-warning">{{$statuskeg." - ".$pengvalidasi}}</div>
                <?php
                if ($statuskeg == "Divalidasi" &&  $pengvalidasi == "WD 3") {
                    $sireva = "yes"; ?>
                    <!-- <div class="badge badge-pill">Silahkan Input ke Sireva</div> -->
                <?php } else { ?>

                    <button class="badge badge-info" data-toggle="modal" data-placement="top" data-target="#veriftor{{$tor[$a]->id}}">Verifikasi</button>
                    @include('perencanaan/validasi/modal/tor/verif')

                    <button class="badge badge-success}}" data-toggle="modal" data-placement="top" data-target="#validtor{{$tor[$a]->id}}">Validasi</button>
                    @include('perencanaan/validasi/modal/tor/valid')

                <?php }
                ?>
            <?php } else { ?>

                @can('tor_verifikasi')
                <button class="badge badge-info" data-toggle="modal" data-placement="top" data-target="#veriftor{{$tor[$a]->id}}">Verifikasi</button>
                @include('perencanaan/validasi/modal/tor/verif')
                @endcan

                @can('tor_verifikasi')
                <button class="badge badge-success}}" data-toggle="modal" data-placement="top" data-target="#validtor{{$tor[$a]->id}}">Validasi</button>
                @include('perencanaan/validasi/modal/tor/valid')
                @endcan

            <?php } ?>
        </th>
    <?php } ?>
</tr>