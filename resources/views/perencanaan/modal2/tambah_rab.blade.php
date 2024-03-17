<div class="modal fade" tabindex="-1" role="dialog" id="tambah_rab<?= $tor[$t]->id ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container ">
                    <form class="form-horizontal" method="post" action="{{ url('/rab/create/') }}">
                        @csrf
                        <div class="form-group">
                            <label>Masukan</label>
                            <textarea class="form-control" id="masukan" name="masukan" rows="2" cols="50" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Keluaran</label>
                            <textarea class="form-control" id="keluaran" name="keluaran" rows="2" cols="50" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>TOR</label>
                            <select name="id_tor" id="id_tor" class="form-control">
                                <option value="{{$tor[$t]->id}}">{{$tor[$t]->nama_kegiatan}}</option>
                            </select>
                        </div>
                        <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                        <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>