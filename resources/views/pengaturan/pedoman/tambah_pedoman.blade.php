<div class="modal fade" tabindex="-1" role="dialog" id="tambahpedoman" aria-labelledby="Upload Pedoman" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pedoman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" enctype="multipart/form-data" method="post"
                    action="{{ url('/pedomans/create') }}">
                    @csrf
                    <div class="form-group">
                        <label>Jenis</label>
                        <div id="sbm">
                            <input type="radio" name="jenis" class="btn-check" id="jenis" value="SBM"
                                autocomplete="off">
                            <label>Standar Biaya
                                Masukan</label>
                        </div>
                        <div id="torrab">
                            <input type="radio" name="jenis" class="btn-check" id="jenis" value="TorRab"
                                autocomplete="off">
                            <label>Template TOR & RAB</label>
                        </div>
                        <div id="spj"><input type="radio" name="jenis" class="btn-check" id="jenis"
                                value="SPJ" autocomplete="off">
                            <label>SPJ</label>
                        </div>
                        <div id="lpj">
                            <input type="radio" name="jenis" class="btn-check" id="jenis" value="LPJ"
                                autocomplete="off">
                            <label>LPJ</label>
                        </div>
                    </div>
                    <div id="list" class="form-group">
                        <label>Kategori File SPJ</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option selected="" disabled="">Pilih Kategori</option>
                            <option value="SPJ Dasar Hukum">Dasar Hukum</option>
                            <option value="SPJ Panduan">Panduan</option>
                            <option value="SPJ Template">Template</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom01">Nama File</label>
                        <input name="nama" id="nama" type="text" class="form-control" id="validationCustom01"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Tahun File</label>
                        <input name="tahun" id="tahun" type="text" class="form-control">
                    </div>
                    <input type="file" class="form-control-file" name="file" id="file" required>
                    @error('file')
                        <div class="alert text-white bg-success" role="alert">
                            <div class="iq-alert-icon">
                                <i class="ri-alert-line"></i>
                            </div>
                            <div class="alert alert-danger mt-1 mb-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="invalid-feedback">
                            Tolong tambahkan file sebelum submit!
                        </div>
                    </div>

                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
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
    const lpj = document.getElementById("lpj");
    const spj = document.getElementById("spj");
    const sbm = document.getElementById("sbm");
    const torrab = document.getElementById("torrab");
    const list = document.getElementById("list");
    list.style.display = "none";
    spj.addEventListener("click", (event) => {
        if (list.style.display = "none") {
            list.style.display = "block";
        } else {
            list.style.display = "none";
        }
    })
    lpj.addEventListener("click", (event) => {
        list.style.display = "none";
    })
    sbm.addEventListener("click", (event) => {
        list.style.display = "none";
    })
    torrab.addEventListener("click", (event) => {
        list.style.display = "none";
    })
</script>
