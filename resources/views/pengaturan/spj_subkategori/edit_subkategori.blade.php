<div class="modal fade" tabindex="-1" role="dialog" id="update_subkategori{{ $spj_subkategori[$a]->id }}">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sub-Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post"
                    action="{{ url('/spj_subkategori/update/' . $spj_subkategori[$a]->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>Nama Sub-Kategori</label>
                        <input name="nama_subkategori" id="nama_subkategori"
                            value="{{ old('nama_subkategori', $spj_subkategori[$a]->nama_subkategori) }}" type="text"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <small style="color: darkgreen">(Boleh dikosongi)</small>
                        <textarea class="ckeditor form-control" name="catatan" id="catatan" rows="3" value="">
                        {{ $spj_subkategori[$a]->catatan }}</textarea>
                    </div>
                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
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
