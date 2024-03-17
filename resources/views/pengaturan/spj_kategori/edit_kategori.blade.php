<div class="modal fade" tabindex="-1" role="dialog" id="update_kategori<?= $spj_kategori[$a]->id ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post"
                    action="{{ url('/spj_kategori/update/' . $spj_kategori[$a]->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input name="nama_kategori" id="nama_kategori"
                            value="{{ old('nama_unit', $spj_kategori[$a]->nama_unit) }}" type="text"
                            class="form-control">
                    </div>
                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
