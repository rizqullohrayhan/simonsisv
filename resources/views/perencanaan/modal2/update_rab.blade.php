<div class="modal fade" tabindex="-1" role="dialog" id="update_rab<?= $rabrev->id ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{ url('/rab/update/'.$rabrev->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>Masukan</label>
                        <textarea class="form-control" id="masukan" name="masukan" value="{{old('masukan',$rabrev->masukan)}}" rows="2" cols="50">{{$rabrev->masukan}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Keluaran</label>
                        <textarea class="form-control" id="keluaran" name="keluaran" value="{{old('keluaran',$rabrev->keluaran)}}" rows="2" cols="50">{{$rabrev->keluaran}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>TOR</label>
                        <select name="id_tor" id="id_tor" class="form-control">
                            <option value="{{$tItem->id}}">{{$tItem->nama_kegiatan}}</option>
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