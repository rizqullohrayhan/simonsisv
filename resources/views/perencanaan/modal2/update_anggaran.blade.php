<div class="modal fade" role="dialog" id="update_anggaran<?= $anggaran[$i]->id ?>" style="overflow:hidden;">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Anggaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="{{ url('/anggaran/update/'.$anggaran[$i]->id) }}">
          @csrf
          <input type="hidden" name="total_anggaran_tor" value="{{$tor[$t]->jumlah_anggaran}}">
          <input type="hidden" name="anggaran_sebelum_rev" value="{{$anggaran[$i]->anggaran}}"> <!-- anggaran sebelum direvisi berapa? -->
          <input type="hidden" name="id_detail_mak" value="{{$anggaran[$i]->id_detail_mak}}"> <!-- anggaran sebelum direvisi berapa? -->
          <input type="hidden" name="id_tor" value="<?= $tor[$t]->id ?>">
          <div class="form-group">
            <label>RAB </label>
            <select name="id_rab" id="id_rab" class="form-control">
              <option value="{{$rab[$r]->id}}">{{$rab[$r]->masukan}}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Kategori MAK</label><br />
            <select class="js-example-basic-single1b" name="id_mak" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
              <?php
              foreach ($detail_mak as $detailMak) {
                if ($anggaran[$i]->id_detail_mak == $detailMak->id) {
                  foreach ($belanja_mak as $belanjaMak) {
                    if ($detailMak->id_belanja == $belanjaMak->id) {
                      foreach ($kelompok_mak as $kelompokMak) {
                        if ($kelompokMak->id == $belanjaMak->id_kelompok) {
                          foreach ($mak as $Mak) {
                            if ($kelompokMak->id_mak == $Mak->id) {
                              $MakPilih = $Mak->id;
                            }
                          }
                        }
                      }
                    }
                  }
                }
              } ?>
              <?php for ($e = 0; $e < count($mak); $e++) { ?>
                <option value="{{$mak[$e]->id}}" style="color:1px solid #f1f1f1;" {{$mak[$e]->id == $MakPilih ? 'selected' : ''}}>{{$mak[$e]->jenis_belanja}}</option>
              <?php } ?>
            </select>
          </div>
          <div class="container ml-2 mr-2">
            <div class="form-group">
              <label>Nama Kelompok</label>
              <select class="js-example-basic-single2b" name="id_kelompok" aria-hidden="true" data-select2-id="select2-data-58-6f8l" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                <?php
                foreach ($detail_mak as $detailMak) {
                  if ($anggaran[$i]->id_detail_mak == $detailMak->id) {
                    foreach ($belanja_mak as $belanjaMak) {
                      if ($detailMak->id_belanja == $belanjaMak->id) {
                        foreach ($kelompok_mak as $kelompokMak) {
                          if ($kelompokMak->id == $belanjaMak->id_kelompok) {
                ?>
                            <option value="{{$kelompokMak->id}}" style="color:1px solid #f1f1f1;">{{$kelompokMak->kelompok}}</option>
                <?php }
                        }
                      }
                    }
                  }
                } ?>
              </select>
            </div>
          </div>
          <div class="container ml-2 mr-2">
            <div class="form-group">
              <label>Nama Belanja</label>
              <select class="js-example-basic-single3b" name="id_belanja" aria-hidden="true" data-select2-id="select2-data-58-6f8l" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                <?php
                foreach ($belanja_mak as $belanjaMak) {
                  foreach ($detail_mak as $detailMak) {
                    if ($anggaran[$i]->id_detail_mak == $detailMak->id) {
                      if ($detailMak->id_belanja == $belanjaMak->id) { ?>
                        <option value="{{$belanjaMak->id}}" style="color:1px solid #f1f1f1;">{{$belanjaMak->belanja}}</option>
                <?php }
                    }
                  }
                } ?>
              </select>
            </div>
          </div>
          <div class="container ml-2 mr-2">
            <div class="form-group">
              <label>Nama Detail</label>
              <select class="js-example-basic-single4b" name="id_detail_mak" aria-hidden="true" data-select2-id="select2-data-58-6f8l" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                <?php foreach ($detail_mak as $detailMak) {
                  if ($anggaran[$i]->id_detail_mak == $detailMak->id) { ?>
                    <option value="{{old('id_detail',$detailMak->id)}}" style="color:1px solid #f1f1f1;">{{$detailMak->detail}}</option>
                <?php }
                } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Catatan</label>
            <small style="color: darkgreen">(Boleh dikosongi)</small>
            <textarea class="ckeditor form-control" name="catatan" id="catatan" value="{{old('catatan',$anggaran[$i]->catatan)}}" rows="3">{{$anggaran[$i]->catatan}}</textarea>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Kebutuan - Volume</label>
                <input name="kebutuhan_vol" id="kebutuhan_vol" value="{{old('kebutuhan_vol',$anggaran[$i]->kebutuhan_vol)}}" type="text" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Kebutuan - Satuan</label>
                <input name="kebutuhan_sat" id="kebutuhan_sat" value="{{old('kebutuhan_sat',$anggaran[$i]->kebutuhan_sat)}}" type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Frekuensi</label>
            <input name="frek" id="frek" type="text" value="{{old('frek',$anggaran[$i]->frek)}}" class="form-control">
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Perhitungan - Volume</label>
                <input name="perhitungan_vol" id="perhitungan_vol" value="{{old('perhitungan_vol',$anggaran[$i]->perhitungan_vol)}}" type="text" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Perhitungan - Satuan</label>
                <input name="perhitungan_sat" id="perhitungan_sat" value="{{old('kebutuhan_sat',$anggaran[$i]->kebutuhan_sat)}}" type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Harga Satuan</label>
            <input name="harga_satuan" id="harga_satuan" value="{{old('harga_satuan',$anggaran[$i]->harga_satuan)}}" type="text" placeholder="hai" class="form-control">
          </div>
          <div class="form-group">
            <label>Nominal</label>
            <input name="anggaran" id="anggaran" value="{{old('anggaran',$anggaran[$i]->anggaran)}}" type="text" class="form-control">
          </div><?php $i = 1 ?>
          <input name="created_at" id="created_at" type="hidden" value="<?= $anggaran[$i]->created_at ?>">
          <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y:m:d H:i:s') ?>">

          <button class="btn btn-primary mr-1" type="submit">Submit</button>

        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single4b').select2();
  });
</script>

<script>
  $(document).ready(function() {
    $('.js-example-basic-single1b').select2();
  });
</script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single2b').select2();
  });
</script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single3b').select2();
  });
</script>


<script>
  $(document).ready(function() {
    $('.js-example-basic-single1b').select2().on('change', function() {
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
            $('select[name="id_kelompok"]').append('<option hidden>Choose Course</option>');
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
    $('.js-example-basic-single2b').select2().on('change', function() {
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
            $('select[name="id_belanja"]').append('<option hidden>Choose Course</option>');
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
    $('.js-example-basic-single3b').select2().on('change', function() {
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
            $('select[name="id_detail_mak"]').append('<option hidden>Choose Course</option>');
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