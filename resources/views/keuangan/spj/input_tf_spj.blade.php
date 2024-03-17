<div class="modal fade bd-example-modal-lg" id="input_tf_spj{{ $tor[$m]->id }}" tabindex="-1" role="dialog"
    aria-labelledby="Upload Bukti Transfer Pelunasan Pembayaran SPJ" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="input_tf_spj">Formulir Upload Bukti Transfer Pelunasan
                    Pembayaran SPJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
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
                <form class="needs-validation" enctype="multipart/form-data" method="post"
                    action="{{ url('/spj/input_buktitransfer') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="control-label col-sm-4 align-self-center mb-0">
                            Nama Kegiatan
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $tor[$m]->nama_kegiatan }}" disabled>
                        </div>
                    </div>
                    <input type="hidden" name="id_tor" class="form-control" value="{{ $tor[$m]->id }}">
                    <input type="hidden" name="id_status" class="form-control" value="7">
                    <input type="hidden" name="jenis" value="SPJ Bukti Transfer" class="custom-file-input" required>
                    <input type="hidden" name="create_by" class="form-control" value="{{ Auth()->user()->id }}">
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <input name="created_at" id="created_at" type="hidden" value="{{ date('Y-m-d H:i:s') }}">
                    <input name="updated_at" id="updated_at" type="hidden" value="{{ date('Y-m-d') }}">

                    <div class="form-group row">
                        <label class="control-label col-sm-4 align-self-center mb-0">Jenis</label>
                        <div class="col-sm-8">
                            <div onclick="belumselesai({{ $tor[$m]->id }})">
                                <input type="radio" name="sebel" id="unfinish{{ $tor[$m]->id }}">
                                <label for="unfinish{{ $tor[$m]->id }}">Pelunasan Pembayaran (Input Bukti TF)</label>
                            </div>
                            <div onclick="selesai({{ $tor[$m]->id }})">
                                <input type="radio" name="sebel" id="finish{{ $tor[$m]->id }}">
                                <label for="finish{{ $tor[$m]->id }}">SPJ Selesai</label>
                            </div>
                        </div>
                    </div>

                    <div id="input_tf{{ $tor[$m]->id }}" style="display: none" class="form-group">
                        <label>Unggah Bukti Transfer
                            <br>
                            <small style="color: darkred">
                                Upload bukti transfer berupa file Dokumen maupun Gambar.
                            </small>
                        </label>
                        <input type="file" class="form-control-file" name="file" id="file"
                            accept="application/pdf, application/msword, image/*">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Dropdown on Click Radio Button --}}
<script>
    function belumselesai() {
        document.getElementById('input_tf').style.display = 'block';
    }

    function selesai() {
        document.getElementById('input_tf').style.display = 'none';
    }
</script>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);
</script>
