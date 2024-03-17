<div class="modal fade" id="input_lpj<?= $tor[$m]->id ?>" tabindex="-1" role="dialog" aria-labelledby="Input LPJ"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="input_lpj">Unggah Dokumen Laporan Pertanggungjawaban (LPJ)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                @endif
                <form class="needs-validation" method="post" enctype="multipart/form-data"
                    action="{{ url('/input_lpj') }}">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="control-label col-sm-5 align-self-center mb-0" for=" validationCustom01">Nama
                            Unit/Prodi/Ormawa</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="validationCustom01"
                                value="{{ $namaprodi }}" disabled>
                        </div>
                    </div>
                    <?php
                    for ($a = 0; $a < count($memo_cair); $a++) {
                        if ($memo_cair[$a]->id_tor == $tor[$m]->id) {
                    ?>
                    <div class="form-group row">
                        <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Nomor Memo
                            Cair</label>
                        <div class="col-sm-7"> <input type="text" class="form-control" id="validationCustom01"
                                value="{{ $memo_cair[$a]->nomor }}" disabled>
                        </div>
                    </div>
                    <?php
                        }
                    } ?>
                    <div class="form-group row">
                        <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Judul
                            Kegiatan</label>
                        <div class="col-sm-7"> <input type="text" class="form-control" id="validationCustom01"
                                value="{{ $tor[$m]->nama_kegiatan }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Nama
                            Penanggungjawab Kegiatan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="validationCustom01"
                                value="{{ $tor[$m]->nama_pic }}" disabled>
                        </div>
                        <input type="hidden" name="jenis" value="LPJ" class="custom-file-input" required>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-5 align-self-center mb-0" for="validationCustom01">Nomor HP
                            Penanggungjawab Kegiatan</label>
                        <div class="col-sm-7"> <input type="text" class="form-control" id="validationCustom01"
                                value="{{ $tor[$m]->kontak_pic }}" disabled>
                        </div>
                    </div>
                    <input type="hidden" name="id_tor" class="form-control" value="<?= $tor[$m]->id ?>">
                    <input type="hidden" name="id_status" class="form-control" value="11">
                    <input type="hidden" name="create_by" class="form-control" value="<?= Auth()->user()->id ?>">
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <div class="form-group">
                        <label for="validationCustom01">Nama Mitra Kerjasama
                            <br>
                            <small style="color: darkred">
                                Harap diisi dengan nama mitra jika kegiatan dilakukan bersama dengan mitra.
                            </small>
                        </label>
                        <input type="text" name="mitra" class="form-control" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Required!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom01">Nomor Dokumen Kerjasama (PKS)
                            <br>
                            <small style="color: darkred">
                                Harap tuliskan nomor dokumen kerjasama (PKS) yang menjadi referensi/dasar kerjasama
                                tersebut.
                            </small>
                        </label>
                        <input type="text" name="pks" class="form-control" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Required!
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Unggah Dokumen LPJ
                            <br>
                            <small style="color: darkred">
                                Seluruh dokumen dijadikan 1 file PDF dengan urutan sesuai dengan penjelasan pada menu
                                unduh Template LPJ.
                                Dokumen yang diunggah harus merupakan dokumen yang sudah lengkap secara formal dan
                                materiil!
                            </small>
                        </label>
                        <input type="file" class="form-control-file" name="file" id="file"
                            accept="application/pdf" required>
                        <div class="invalid-feedback">
                            Tolong tambahkan file sebelum submit!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);
</script>
