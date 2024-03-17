<div class="modal fade" id="status_spj<?= $tor[$m]->id ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status SPJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="iq-timeline">
                    <?php
                            $indexwarna = 0;
                            $warnaLingkar = [
                                'timeline-dots border-primary',
                                'timeline-dots border-info',
                                'timeline-dots border-success',
                                'timeline-dots border-danger',
                            ];
                            $ada = 0;
                            if (!empty($trx_status_keu)) {
                                for ($q = 0; $q < count($trx_status_keu); $q++) {
                                    if ($trx_status_keu[$q]->id_tor == $tor[$m]->id) {
                                        $ada =   $trx_status_keu[$q]->id_status ?>
                    <li>

                        <?php
                        $indexwarna += 1;
                        if ($indexwarna > 3) {
                            $indexwarna = 0;
                        }
        
                            for ($st = 0; $st < count($status_keu); $st++) {
                                if ($status_keu[$st]->id == $trx_status_keu[$q]->id_status) {
                                    if ($status_keu[$st]->kategori == 'SPJ') {?>
                        <div class="{{ $warnaLingkar[$indexwarna] }}"><i class="ri-check-fill" style="color:black"></i>
                        </div>
                        <h6 class="float-left mb-1">
                            <?php
                            echo '<b>' . '' . '</b>' . $status_keu[$st]->nama_status;

                            for ($u = 0; $u < count($users); $u++) { if ($users[$u]->id ==
                                $trx_status_keu[$q]->create_by) {
                                for ($rl = 0; $rl < count($roles); $rl++) { if ($roles[$rl]->id == $users[$u]->role) {
                                    echo '<br />' . ' - Create by : ' . $users[$u]->name . ' - ' . $roles[$rl]->name;
                                    $pengvalidasi = $roles[$rl]->id;

                                    ?>
                        </h6>
                        <small class="float-right mt-1">{{ $trx_status_keu[$q]->created_at }}</small>
                        <div class="d-inline-block w-100">
                        </div>
                        <?php }
                                                }
                                            }
                                        }
                                    }
                                }
                            } ?>
                    </li>
                    <?php }
                                }
                            } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
