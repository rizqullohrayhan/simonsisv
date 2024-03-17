<div class="modal fade" id="validasi_lpj{{ $tor[$m]->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Update Status LPJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form method="post" action="/lpj/validasi">
                    @csrf
                    {{ $tombol = '' }}
                    <p>Pilih salah satu untuk memperbarui status:</p>
                    @foreach ($trx_status_keu as $a)
                        @if ($a->id_tor == $tor[$m]->id)
                            @for ($s = 0; $s < count($status_keu); $s++)
                                @if ($a->id_status == $status_keu[$s]->id)
                                    @if ($status_keu[$s]->kategori == 'LPJ')
                                        @if ($status_keu[$s]->nama_status === 'Proses Pengajuan')
                                            <?php $tombol =
                                                '<div onclick="revisi(' . $tor[$m]->id . ')" 
                                                    class="custom-control custom-radio custom-radio-color-checked">
                                                    <input type="radio" name="id_status" id="revisi' . $tor[$m]->id . '"
                                                    value="13">
                                                    <label for="revisi' . $tor[$m]->id . '">Revisi</label>
                                                </div>
                                                <div onclick="verifikasi(' . $tor[$m]->id . ')"
                                                    class="custom-control custom-radio custom-radio-color-checked">
                                                    <input type="radio" name="id_status" id="verifikasi' . $tor[$m]->id . '"
                                                    value="12">
                                                    <label for="verifikasi' . $tor[$m]->id . '">Verifikasi</label>
                                                </div>'; ?>
                                        @elseif ($status_keu[$s]->nama_status === 'Revisi')
                                            <?php $tombol =
                                                '<div onclick="pengajuan(' . $tor[$m]->id . ')"
                                                    class="custom-control custom-radio custom-radio-color-checked">
                                                    <input type="radio" name="id_status" id="pengajuan' . $tor[$m]->id . '"
                                                    value="11">
                                                    <label for="pengajuan' . $tor[$m]->id . '" class=""> Proses Pengajuan</label>
                                                </div>'; ?>
                                        @elseif ($status_keu[$s]->nama_status === 'Verifikasi')
                                            <?php $tombol =
                                                '<div onclick="lpjselesai(' . $tor[$m]->id . ')"
                                                    class="custom-control custom-radio custom-radio-color-checked">
                                                    <input type="radio" name="id_status" id="selesai' . $tor[$m]->id . '" 
                                                    value="14">
                                                    <label for="selesai' . $tor[$m]->id . '" class=""> LPJ Selesai</label>
                                                </div>'; ?>
                                        @elseif ($status_keu[$s]->nama_status === 'LPJ Selesai')
                                            <?php $tombol = ''; ?>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        @endif
                    @endforeach
                    <?= $tombol ?>
                    <div id="revisilpj{{ $tor[$m]->id }}" style="display: none" class="form-group">
                        <label for="catatan">Catatan Revisi LPJ :</label>
                        <textarea class="ckeditor form-control" name="catatan" id="catatan" rows="5"></textarea>
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
