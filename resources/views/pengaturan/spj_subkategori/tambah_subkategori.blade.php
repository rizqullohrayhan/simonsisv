<div class="modal fade" id="add_kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sub-Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{ url('/spj_subkategori/add') }}">
                    @csrf
                    <label>Kategori</label>
                    <select name="id_kategori" id="id_kategori" class="form-control">
                        @foreach ($spj_kategori as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label>Nama Sub-Kategori</label>
                        <input name="nama_subkategori" id="nama_subkategori" type="text" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <small style="color: darkgreen">(Boleh dikosongi)</small>
                        <textarea class="ckeditor form-control" name="catatan" id="catatan" rows="2"></textarea>
                    </div>
                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
