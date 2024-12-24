<div class="modal fade" role="dialog" id="update_anggaran<?= $item->id ?>" style="overflow:hidden;">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Anggaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="{{ url('/anggaran/update/'.$item->id) }}">
          @csrf
          <input type="hidden" name="total_anggaran_tor" value="{{$tor->jumlah_anggaran}}">
          <input type="hidden" name="anggaran_sebelum_rev" value="{{$item->anggaran}}"> <!-- anggaran sebelum direvisi berapa? -->
          {{-- <input type="hidden" name="id_detail_mak" value="{{$item->id_detail_mak}}"> <!-- anggaran sebelum direvisi berapa? --> --}}
          <input type="hidden" name="id_tor" value="<?= $tor->id ?>">
          <div class="form-group">
            <label>RAB </label>
            <select name="id_rab" id="id_rab" class="form-control">
              <option value="{{$rab->id}}">{{$rab->masukan}}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nomor MAK</label>
            <input name="nomor_mak" id="nomor_mak" value="{{$item->nomor_mak}}" type="text" class="form-control" required>
            <span>Contoh: 51040101</span>
          </div>
          <div class="form-group">
              <label>Nama Belanja</label>
              <input name="nama_belanja" id="nama_belanja" value="{{$item->nama_belanja}}" type="text" class="form-control" required>
              <span>Contoh: Beban Perjalanan Dinas Pegawai-DN</span>
          </div>
          <div class="form-group">
              <label>Detail</label>
              <input name="detail" id="detail" value="{{$item->detail}}" type="text" class="form-control">
              <span>Contoh: 124266 | Transportasi Kegiatan Dalam Kota (PP) - Pegawai UNS</span>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Catatan</label>
            <small style="color: darkgreen">(Boleh dikosongi)</small>
            <textarea class="ckeditor form-control" name="catatan" id="catatan" value="{{old('catatan',$item->catatan)}}" rows="3">{{$item->catatan}}</textarea>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Kebutuan - Volume</label>
                <input name="kebutuhan_vol" id="kebutuhan_vol" value="{{old('kebutuhan_vol',$item->kebutuhan_vol)}}" type="text" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Kebutuan - Satuan</label>
                <input name="kebutuhan_sat" id="kebutuhan_sat" value="{{old('kebutuhan_sat',$item->kebutuhan_sat)}}" type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Frekuensi</label>
            <input name="frek" id="frek" type="text" value="{{old('frek',$item->frek)}}" class="form-control">
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Perhitungan - Volume</label>
                <input name="perhitungan_vol" id="perhitungan_vol" value="{{old('perhitungan_vol',$item->perhitungan_vol)}}" type="text" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Perhitungan - Satuan</label>
                <input name="perhitungan_sat" id="perhitungan_sat" value="{{old('kebutuhan_sat',$item->kebutuhan_sat)}}" type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Harga Satuan</label>
            <input name="harga_satuan" id="harga_satuan" value="{{old('harga_satuan',$item->harga_satuan)}}" type="text" placeholder="hai" class="form-control">
          </div>
          <div class="form-group">
            <label>Nominal</label>
            <input name="anggaran" id="anggaran" value="{{old('anggaran',$item->anggaran)}}" type="text" class="form-control">
          </div><?php $i = 1 ?>
          <input name="created_at" id="created_at" type="hidden" value="{{ $item->created_at }}">
          <input name="updated_at" id="updated_at" type="hidden" value="{{ date('Y:m:d H:i:s') }}">

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