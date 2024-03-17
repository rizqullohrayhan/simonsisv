<div class="modal fade bd-example-modal-lg" id="show_tf_spj<?= $tor[$m]->id ?>" tabindex="-1" role="dialog"
    aria-labelledby="Detail SPJ" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show_tf_spj">Detail Bukti Transfer SPJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">
                        Nama Unit/Prodi/Ormawa</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{ $namaprodi }}" disabled>
                    </div>
                </div>
                <?php
                    for ($a = 0; $a < count($memo_cair); $a++) {
                        if ($memo_cair[$a]->id_tor == $tor[$m]->id) {
                    ?>
                <div class="form-group row">
                    <label class="control-label col-sm-5 align-self-center mb-0">ID Ajuan Memo Cair</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{ $memo_cair[$a]->nomor }}" disabled>
                    </div>
                </div>
                <?php
                        }
                    } ?>
                <div class="form-group row">
                    <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Nama
                        Penanggungjawab Kegiatan</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="validationCustom01"
                            value="{{ $tor[$m]->nama_pic }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Nomor HP
                        Penanggungjawab Kegiatan</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="validationCustom01"
                            value="{{ $tor[$m]->kontak_pic }}" disabled>
                    </div>
                </div>
                <?php
                    for ($z = 0; $z < count($isiSPJ); $z++) {
                        if ($isiSPJ[$z]->id_tor == $tor[$m]->id) {
                ?>
                <div class="form-group row">
                    <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Nilai
                        Total SPJ</label>
                    <div class="col-sm-7">
                        <input type="text" name="nilai_total" class="form-control" id="validationCustom01"
                            value="{{ $isiSPJ[$z]->nilai_total }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Nilai
                        Pengembalian
                        <small style="color: darkred"><b>(Jika Ada)</b></small></label>
                    <div class="col-sm-7">
                        <input type="text" name="nilai_kembali" class="form-control" id="validationCustom01"
                            value="{{ $isiSPJ[$z]->nilai_kembali }}" disabled>
                    </div>
                </div>
                <?php }} ?>
                <hr style="border: 1px dashed black">
                <?php
                    for ($b = 0; $b < count($dokumen); $b++) {
                        if ($dokumen[$b]->id_tor == $tor[$m]->id) { 
                            if ($dokumen[$b]->jenis == "SPJ Bukti Transfer Pelunasan") {
                ?>
                <div class="form-group">
                    <h4 class="text-center"><b>Bukti Transfer Pelunasan</b></h4>
                    <br>
                    <embed src="{{ asset('documents/' . $dokumen[$b]->name) }}" type="application/pdf" width="100%"
                        height="500px"></embed>
                </div>
                <?php 
                    }}}
                ?>
            </div>
        </div>
    </div>
</div>
