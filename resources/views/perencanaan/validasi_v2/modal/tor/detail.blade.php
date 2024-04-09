<div class="modal fade" tabindex="-1" role="dialog" id="detail_tor{{$tor->id}}">
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
                        $ada = 0;
                        ?>
                        @foreach ($trx_status_tor as $trx_status)
                            @if ($trx_status->id_tor == $tor->id)
                                <li>
                                    <?php foreach ($status as $stat) {
                                        if ($stat->id == $trx_status->id_status) {
                                            $wstatus = $stat->nama_status;
                                            if ($wstatus == 'Belum Dinilai') {
                                                $warnaLingkar = 'timeline-dots';
                                            } elseif ($wstatus == 'Sudah Dinilai') {
                                                $warnaLingkar = 'timeline-dots border-success';
                                            } elseif ($wstatus == 'Revisi') {
                                                $warnaLingkar = 'timeline-dots  border-danger';
                                            } elseif ($wstatus == 'Sudah Revisi') {
                                                $warnaLingkar = 'timeline-dots';
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="{{$warnaLingkar}}"><i class="ri-check-fill" style="color:black"></i></div>
                                    <?php
                                    $indexwarna += 1;
                                    if ($indexwarna > 3) {
                                        $indexwarna = 0;
                                    }
                                    ?>
                                    <div class="{{$warnaLingkar}}"><i class="ri-check-fill" style="color:black"></i></div>
                                    <?php
                                    $indexwarna += 1;
                                    if ($indexwarna > 3) {
                                        $indexwarna = 0;
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col">
                                            <h6 style="text-align:left;">
                                                <?php
                                                for ($st3 = 0; $st3 < count($status); $st3++) {
                                                    if ($status[$st3]->id == $trx_status->id_status) {
                                                        echo  $status[$st3]->nama_status;
                                                        for ($u = 0; $u < count($user); $u++) {
                                                            if ($user[$u]->id == $trx_status->create_by) {
                                                                for ($rl = 0; $rl < count($role); $rl++) {
                                                                    if ($role[$rl]->id == $user[$u]->role) {
                                                                        echo "<br/>" . " - create by : " . $user[$u]->name;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </h6>
                                        </div>
                                        <div class="col">
                                            <small style="font-size: smaller;color:grey" class="float-right mt-1">{{$trx_status->created_at}}</small>
                                        </div>
                                    </div>
                                </li>
                                <br />
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>