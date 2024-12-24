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
                        <label>Nomor MAK</label>
                        <input name="nomor_mak" id="nomor_mak" type="text" class="form-control" required>
                        <span>Contoh: 51040101</span>
                    </div>
                    <div class="form-group">
                        <label>Nama Belanja</label>
                        <input name="nama_belanja" id="nama_belanja" type="text" class="form-control" required>
                        <span>Contoh: Beban Perjalanan Dinas Pegawai-DN</span>
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input name="detail" id="detail" type="text" class="form-control">
                        <span>Contoh: 124266 | Transportasi Kegiatan Dalam Kota (PP) - Pegawai UNS</span>
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
                                <input name="kebutuhan_vol" id="kebutuhan_vol" type="number" class="form-control" required>
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
                        <input name="frek" id="frek" type="number" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Perhitungan - Volume</label>
                                <input name="perhitungan_vol" id="perhitungan_vol" type="number" value="0" class="form-control" readonly>
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
                        <input name="harga_satuan" id="harga_satuan" type="number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input name="anggaran" id="anggaran" type="number" value="0" class="form-control" readonly>
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
    function updateValues() {
        let kebutuhan_vol = parseInt($('#kebutuhan_vol').val()) || 0;
        let frekuensi = parseInt($('#frek').val()) || 0;
        let harga_satuan = parseInt($('#harga_satuan').val()) || 0;

        let perhitungan_vol = kebutuhan_vol * frekuensi;
        $('#perhitungan_vol').val(perhitungan_vol);

        if (!isNaN(harga_satuan)) {
            $('#anggaran').val(harga_satuan * perhitungan_vol);
        }
    }

    $('#kebutuhan_vol, #frek, #harga_satuan').on('change', updateValues);
</script>

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