<!-- MODAL AJUKAN TOR -->
<div class="modal fade" tabindex="-1" role="dialog" id="status{{ $tItem->id }}">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffc107;color:white">
                <h5 class="modal-title" style="color:white"><b>Status Pengajuan TOR & RAB</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="iq-card-body">

                    <ul class="iq-timeline">
                        <?php
                        $indexwarna = 0;
                        $wstatus;
                        $warnaLingkar;

                        $ada = 0;
                        if (!empty($trx_status_tor)) {
                            for ($q = 0; $q < count($trx_status_tor); $q++) {
                                if ($trx_status_tor[$q]->id_tor == $tItem->id) {
                                    $ada =   $trx_status_tor[$q]->id_status ?>
                                    <li>
                                        <?php for ($st = 0; $st < count($status); $st++) {
                                            if ($status[$st]->id == $trx_status_tor[$q]->id_status) {
                                                $wstatus = $status[$st]->nama_status;
                                                if ($wstatus == 'Belum Dinilai') {
                                                    $warnaLingkar = 'timeline-dots';
                                                } elseif ($wstatus == 'Revisi') {
                                                    $warnaLingkar = 'timeline-dots  border-danger';
                                                } elseif ($wstatus == 'Sudah Revisi') {
                                                    $warnaLingkar = 'timeline-dots';
                                                } elseif ($wstatus == 'Sudah Dinilai') {
                                                    $warnaLingkar = 'timeline-dots border-success';
                                                }
                                        ?>

                                                <div class="{{ $warnaLingkar }}"><i class="ri-check-fill" style="color:black"></i></div>
                                                <h6 class="float-left mb-1">
                                            <?php
                                                //nama status
                                                echo '<b>' . '' . '</b>' . $status[$st]->nama_status;
                                                for ($u = 0; $u < count($user); $u++) {
                                                    if ($user[$u]->id == $trx_status_tor[$q]->create_by) {
                                                        for ($rl = 0; $rl < count($role); $rl++) {
                                                            if ($role[$rl]->id == $user[$u]->role) {
                                                                echo '<br/>' . ' - create by : ' . $user[$u]->name . ' - ' . $trx_status_tor[$q]->role_by;
                                                                // $pengvalidasi = $role[$rl]->id;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                            ?>
                                                </h6>
                                                <small class="float-right mt-1">{{ $trx_status_tor[$q]->created_at }}</small>
                                                <div class="d-inline-block w-100">
                                                </div>
                                    </li>
                        <?php }
                            }
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>