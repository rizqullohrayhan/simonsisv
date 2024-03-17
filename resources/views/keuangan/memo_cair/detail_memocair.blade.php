<div class="modal fade" id="detail_memocair<?= $tor[$m]->id ?>" tabindex="-1" role="dialog"
    aria-labelledby="Detail Memo Cair" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="detail_memocair">DETAIL MEMO CAIR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    $cek=1;
                    $cekdok=1;
                    for ($a = 0; $a < count($data); $a++) {
                        $cek+=1;
                        if ($data[$a]->id_tor == $tor[$m]->id) {
                            for ($b = 0; $b < count($dokumen); $b++) {
                                $cekdok+=1;
                                if ($dokumen[$b]->id_tor == $tor[$m]->id) { 
                                    if ($dokumen[$b]->jenis == "Memo Cair") {
                            if($cek=1 ){         
                    ?>
                <b>
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 20%">1. &ensp; Nomor Memo Cair</td>
                            <td style="width: 5%">:</td>
                            <td>{{ $data[$a]->nomor }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%">2. &ensp; Nominal Memo Cair Valid</td>
                            <td style="width: 5%">:</td>
                            <td>{{ 'Rp ' . number_format($data[$a]->nominal, 2, ',', '.') }}</td>
                        </tr>
                        <?php $persen = ($data[$a]->nominal / $tor[$m]->jumlah_anggaran) * 100; ?>
                        <tr>
                            <td style="width: 20%">3. &ensp; Persentase Dana Cair</td>
                            <td style="width: 5%">:</td>
                            <td>{{ number_format($persen) . '%' }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%">4. &ensp; Sertifikat Memo Cair</td>
                            <td style="width: 5%">:</td>
                        </tr>
                        <tr>
                            <td colspan="3"><embed src="{{ asset('documents/' . $dokumen[$b]->name) }}"
                                    type="application/pdf" width="100%" height="500px"></embed></td>
                        </tr>
                    </table>
                </b>
                <?php
                    }
                        }
                    }       
                    }
                        }
                    
                    }?>
            </div>
        </div>
    </div>
</div>
