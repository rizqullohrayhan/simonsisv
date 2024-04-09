<div class="modal fade" role="dialog" id="tambah_anggaran<?= $rab->id ?>" style="overflow:hidden;">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{ url('/anggaran/create') }}">
                    @csrf
                    <input type="hidden" name="total_anggaran_tor" value="{{$tor->jumlah_anggaran}}"> <!-- total anggaran di table tor -->
                    <input type="hidden" name="total_anggaran" value="{{$totalAnggaranRab}}"> <!-- total anggaran (hasil penjumlahan) yg ada di view -->
                    <input type="hidden" name="id_tor" value="<?= $tor->id ?>">
                    <div class="form-group">
                        <label>RAB {{"Rp. ".number_format($totalAnggaranRab,2,',',',')}}</label>
                        <select name="id_rab" id="id_rab" class="form-control">
                            <option value="{{$rab->id}}">{{$rab->masukan}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori MAK</label><br />
                        <select class="js-example-basic-single1" name="id_mak" id="mak" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                            <option hidden>Pilih Kategori MAK</option>
                            <?php for ($e = 0; $e < count($mak); $e++) { ?>
                                <option value="{{$mak[$e]->id}}" style="color:1px solid #f1f1f1;">{{$mak[$e]->jenis_belanja}}</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="container ml-2 mr-2">
                        <div class="form-group">
                            <label>Nama Kelompok</label>
                            <select class="js-example-basic-single2" name="id_kelompok" id="kelompok" aria-hidden="true" data-select2-id="select2-data-58-6f8l" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px"> </select>
                        </div>
                    </div>
                    <div class="container ml-2 mr-2">
                        <div class="form-group">
                            <label>Nama Belanja</label>
                            <select class="js-example-basic-single3" name="id_belanja" id="belanja" aria-hidden="true" data-select2-id="select2-data-58-6f8l" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px"></select>
                        </div>
                    </div>
                    <div class="container ml-2 mr-2">
                        <div class="form-group">
                            <label>Nama Detail</label>
                            <select class="js-example-basic-single4" name="id_detail_mak" id="id_detail_mak" aria-hidden="true" data-select2-id="select2-data-58-6f8l" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <small style="color: darkgreen">(Boleh dikosongi)</small>
                        <textarea class="ckeditor form-control" name="catatan" id="catatan" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Kebutuan - Volume</label>
                                <input name="kebutuhan_vol" id="kebutuhan_vol" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Kebutuan - Satuan</label>
                                <input name="kebutuhan_sat" id="kebutuhan_sat" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Frekuensi</label>
                        <input name="frek" id="frek" type="text" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Perhitungan - Volume</label>
                                <input name="perhitungan_vol" id="perhitungan_vol" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Perhitungan - Satuan</label>
                                <input name="perhitungan_sat" id="perhitungan_sat" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga Satuan</label>
                        <input name="harga_satuan" id="harga_satuan" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input name="anggaran" id="anggaran" type="text" class="form-control" required>
                    </div><?php $i = 1 ?>
                    <input name="created_at" type="hidden" value="<?= date('Y:m:d H:i:s') ?>">
                    <input name="updated_at" type="hidden" value="<?= date('Y:m:d H:i:s') ?>">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single3').select2();
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single4').select2();
    });
</script>


<script>
    $(document).ready(function() {
        $('.js-example-basic-single1').select2().on('change', function() {
            var id_mak = $(this).val();
            if (id_mak) {
                $.ajax({
                    url: '/getkelompokMak/' + id_mak,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="id_kelompok"]').empty();
                        $('select[name="id_kelompok"]').append('<option hidden>Pilih Kelompok MAK</option>');
                        $.each(data, function(key, namakelompok) {
                            $('select[name="id_kelompok"]').append('<option value="' + namakelompok.id + '">' + namakelompok.kelompok + '-' + namakelompok.id + '</option>');
                        });

                    }
                });
            } else {
                $('select[name="id_kelompok"]').empty();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single2').select2().on('change', function() {
            var id_kelompok = $(this).val();
            if (id_kelompok) {
                $.ajax({
                    url: '/getbelanjaMak/' + id_kelompok,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="id_belanja"]').empty();
                        $('select[name="id_belanja"]').append('<option hidden>Pilih Belanja MAK</option>');
                        $.each(data, function(key, namabelanja) {
                            $('select[name="id_belanja"]').append('<option value="' + namabelanja.id + '">' + namabelanja.belanja + '-' + namabelanja.id + '</option>');
                        });

                    }
                });
            } else {
                $('select[name="id_belanja"]').empty();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single3').select2().on('change', function() {
            var id_belanja = $(this).val();
            if (id_belanja) {
                $.ajax({
                    url: '/getdetailMak/' + id_belanja,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="id_detail_mak"]').empty();
                        $('select[name="id_detail_mak"]').append('<option hidden>Pilih Detail MAK</option>');
                        $.each(data, function(key, namadetail) {
                            $('select[name="id_detail_mak"]').append('<option value="' + namadetail.id + '">' + namadetail.detail + '-' + namadetail.id + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="id_detail_mak"]').empty();
            }
        });
    });
</script>