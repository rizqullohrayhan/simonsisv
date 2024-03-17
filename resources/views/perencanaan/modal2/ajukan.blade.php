<!-- MODAL AJUKAN TOR -->
<div class="modal fade" tabindex="-1" role="dialog" id="ajukan{{ $tor[$t]->id }}">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffc107;color:white">
                <h5 class="modal-title" style="color:white"><b>Pengajuan TOR & RAB ke Sekolah Vokasi</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <h4 class="card-title">Pengajuan TOR & RAB ke Sekolah Vokasi</h4> -->
                <form method="post" action="/validasi/pengajuanProdi">
                    @csrf
                    <div class="form-group">
                        <i>Lengkapi Data TOR & RAB Sebelum Diajukan</i>
                        <h6>
                            <label for="exampleFormControlSelect1"></label><br />

                            <?php
                            $jenisDiajukan = ""; // apakah sudah diajukan prodi
                            if (!empty($trx_status_tor)) {
                                foreach ($trx_status_tor as $trxstatus) {

                                    if ($trxstatus->id_tor == $tor[$t]->id) {
                            ?>
                                        <?php foreach ($status as $sts) {
                                            if ($sts->id == $trxstatus->id_status) {
                                                if ($sts->nama_status == "Proses Pengajuan") {
                                                    $jenisDiajukan = "Baru";
                                                }
                                                if ($sts->nama_status == "Pengajuan Perbaikan") {
                                                    $jenisDiajukan = "Perbaikan";
                                                }
                                            }
                                        }
                                    }
                                    if ($trxstatus->id_tor != $tor[$t]->id) {
                                        $jenisDiajukan = "Belum Diajukan";
                                    }
                                }
                            } else {
                                $jenisDiajukan = "";
                            }
                            for ($s = 0; $s < count($status); $s++) {
                                if ($status[$s]->kategori == 'TOR') {
                                    if ($jenisDiajukan == "Belum Diajukan") {
                                        if ($status[$s]->nama_status == 'Proses Pengajuan') { ?>
                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{ $status[$s]->id }}" autocomplete=" off">
                                            <label class="" for="danger-outlined">{{ $status[$s]->nama_status }}
                                                Baru</label><br />
                                    <?php }
                                    } ?>

                                    <?php
                                    if ($jenisDiajukan == "Baru") {
                                        if ($status[$s]->nama_status == 'Pengajuan Perbaikan') { ?>
                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{ $status[$s]->id }}" autocomplete=" off">
                                            <label class="" for="danger-outlined"><b>{{ $status[$s]->nama_status }}</b></label><br />
                                        <?php }
                                    }
                                    if ($jenisDiajukan == "Perbaikan") {
                                        if ($status[$s]->nama_status == 'Pengajuan Perbaikan') { ?>
                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{ $status[$s]->id }}" autocomplete=" off">
                                            <label class="" for="danger-outlined"><b>{{ $status[$s]->nama_status }}</b></label><br />
                            <?php }
                                    }
                                }
                            } ?>
                            <!-- {{$jenisDiajukan}} -->
                            <input type="hidden" name="create_by" value="<?= Auth()->user()->id ?>">
                            @foreach($role as $roleby)
                            @if(Auth()->user()->role == $roleby->id)
                            <input type="hidden" name="role_by" value="<?= $roleby->name ?>">
                            @endif
                            @endforeach
                            <input type="hidden" name="id_tor" value="<?= $tor[$t]->id ?>">
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                            <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                            <br /><button class="btn btn-primary btn-sm" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>