<div class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" id="detail_tor<?= $tItem->id ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Tor <?= $tItem->id ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Nama TOR : {{$tItem->nama_kegiatan}} <br />
                Unit :
                <?php
                for ($h = 0; $h < count($unit); $h++) {
                    if ($unit[$h]->id == $tItem->id_unit) {
                        echo $unit[$h]->nama_unit;
                    }
                }
                ?><br />

            </div>
        </div>
    </div>
</div>