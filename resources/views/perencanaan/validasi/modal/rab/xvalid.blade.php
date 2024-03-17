<div class="modal fade" tabindex="-1" role="dialog" id="validrab{{$rab[$b]->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Verifikasi</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Status Pengajuan RAB</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">

                        <ul class="iq-timeline">
                            <?php
                            $ada = 0;
                            if (!empty($trx_status_rab)) {
                                for ($q = 0; $q < count($trx_status_rab); $q++) {
                                    if ($trx_status_rab[$q]->id_rab == $rab[$b]->id) {
                                        $ada =   $trx_status_rab[$q]->id_status ?>
                                        <li>
                                            <div class="timeline-dots border-danger"><i class="ri-pantone-line"></i></div>
                                            <h6 class="float-left mb-1">
                                                <?php
                                                for ($st = 0; $st < count($status); $st++) {
                                                    if ($status[$st]->id == $trx_status_rab[$q]->id_status) {
                                                        echo "<b>" . "" . "</b>" . $status[$st]->nama_status;
                                                    }
                                                }
                                                ?>
                                            </h6>
                                            <small class="float-right mt-1">{{$trx_status_rab[$q]->created_at}}</small>
                                            <div class="d-inline-block w-100">
                                                <!-- <p>$trx_status_rab[$q]->komentar}}</p> -->
                                            </div>
                                        </li>
                            <?php }
                                }
                            } ?>

                        </ul>
                    </div>
                </div>
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Validasi RAB</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form method="post" action="/validasi/createValRab">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pilih Status Verifikasi</label><br />
                                <?php for ($s = 1; $s < count($status); $s++) {
                                    if ($status[$s]->kategori == "RAB") { ?>
                                        <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status[$s]->id}}" autocomplete=" off">
                                        <label class="" for="danger-outlined">{{$status[$s]->nama_status}}</label>
                                <?php }
                                } ?>
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control" id="komentar" name="komentar" rows="2"></textarea>
                                </div>
                                <input type="hidden" name="create_by" value="<?= Auth()->user()->id ?>">
                                <input type="hidden" name="id_rab" value="<?= $rab[$b]->id ?>">
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                                <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                <button class="btn btn-primary btn-sm" type="submit">OK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>