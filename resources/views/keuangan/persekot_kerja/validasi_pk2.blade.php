<div class="modal fade" id="validasi_pk2<?= $tor[$m]->id ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Validasi Persekot Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form method="post" action="/persekot_kerja/validasi">
                    @csrf
                    <p>Pilih salah satu untuk memperbarui status:</p>
                    <div class="form-group">
                        <?php 
                        for ($a = 0; $a < count($status_keu); $a++) {
                            if ($status_keu[$a]->kategori == 'Persekot Kerja') {
                        if ($status_keu[$a]->nama_status == 'Transfer Uang') { ?>
                        <div class="custom-control custom-radio custom-radio-color-checked">
                            <input type="radio" name="id_status" id="id_status" value="{{ $status_keu[$s]->id }}">
                            <label class=""> Transfer Uang </label>
                        </div>
                        <?php }
                            }
                        } ?>
                    </div>
                    <input type="hidden" name="create_by" value="<?= Auth()->user()->id ?>">
                    <input type="hidden" name="id_tor" value="<?= $tor[$m]->id ?>">
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
