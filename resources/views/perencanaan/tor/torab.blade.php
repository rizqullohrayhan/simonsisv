<?php

use Illuminate\Support\Facades\Auth;
?>
@include('dashboards/users/layouts/script')
<!-- cek doang -->

<body>
  <div id="loading">
    <div id="loading-center">
    </div>
  </div>
  <div class="wrapper">
    <?php $notifikasi = 0;
    ?>

    @include('dashboards/users/layouts/navbar')
    @include('dashboards/users/layouts/sidebar')

    <!-- Page Content  -->
    <div id="content-page" class="content-page">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="iq-card">
              <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                  <h4 class="card-title">PENGAJUAN TOR & RAB
                  </h4>
                  <!-- MODAL TAMBAH RAB  -->
                  @include('perencanaan/modal2/tambah_tor')
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                  <div class="dropdown">
                    <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                      <i class="ri-more-fill"></i>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                      <a class="dropdown-item" href="" onclick="printDiv()"><i class="ri-printer-fill mr-2" onclick="printDiv()"></i>Print</a>
                      <!-- <button class="dropdown-item" id="generatePDF"><i class="ri-file-download-fill mr-2" id="generatePDF"></i>Download</button> -->
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <div class="row ml-3">
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body iq-box-relative">
                      <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-primary">
                        <i class="ri-database-2-line"></i>
                      </div>
                      <p class="text-secondary">Total Pagu</p>
                      <form action="http://127.0.0.1:8000/filterpagu" method="GET">
                        <div class="row mr-3">
                          <div class="col mr-1">
                            <select class="form-control filter sm-8" name="pagu" id="input">
                              <option value="0">All</option>
                              <?php for ($t2 = 0; $t2 < count($tabeltahun); $t2++) {
                                if ($tabeltahun[$t2]->is_aktif == 1) {                                              ?>
                                  <option value="{{$tabeltahun[$t2]->id}}" {{$filterpagu==$tabeltahun[$t2]->id  ? 'selected':''}}>{{$tabeltahun[$t2]->tahun}}</option>
                              <?php }
                              } ?>
                            </select>
                          </div>
                          <input type="submit" class="btn btn-primary btn-sm" value="OK">
                        </div>
                      </form>
                      <div class="d-flex align-items-center justify-content-between mt-2" style="position: relative;">
                        <div class="row ml-1">
                          <?php for ($pg = 0; $pg < count($pagu); $pg++) {
                            if ($pagu[$pg]->id_unit == Auth()->user()->id_unit) {
                              for ($t3 = 0; $t3 < count($tabeltahun); $t3++) {
                                if ($pagu[$pg]->id_tahun == $tabeltahun[$t3]->id) { ?>
                                  <div class="badge badge-pill badge-success">Tahun {{$tabeltahun[$t3]->tahun}}</div>
                                  <h6>
                                    {{"Pagu : Rp. ".number_format($pagu[$pg]->pagu,2,',','.')}}<br />
                                    {{"Triwulan 1 : "."Rp. ".number_format($pagu[$pg]->tw1,2,',','.')}}<br />
                                    {{"Triwulan 2 : "."Rp. ".number_format($pagu[$pg]->tw2,2,',','.')}}<br />
                                    {{"Triwulan 3 : "."Rp. ".number_format($pagu[$pg]->tw3,2,',','.')}}<br />
                                    {{"Triwulan 4 : "."Rp. ".number_format($pagu[$pg]->tw4,2,',','.')}}<br />
                                  </h6>

                          <?php }
                              }
                            }
                          } ?>
                        </div>
                        <div class="resize-triggers">
                          <div class="expand-trigger">
                            <div style="width: 202px; height: 60px;"></div>
                          </div>
                          <div class="contract-trigger"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body iq-box-relative">
                      <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                        <i class="ri-database-2-line"></i>
                      </div>
                      <p class="text-secondary">Standar Biaya Masukan</p>
                      <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                        <div class="row ml-1">
                          @foreach($pedoman as $pedomansbm)
                          @if($pedomansbm->tahun == date('Y') && ($pedomansbm->jenis =='SBM' || $pedomansbm->jenis =='TorRab'))
                          <a href="{{asset('/pedoman/'.$pedomansbm->file)}}">{{$pedomansbm->tahun . " : " .$pedomansbm->nama}}</a>
                          @endif
                          @endforeach
                        </div>
                        <div class="resize-triggers">
                          <div class="expand-trigger">
                            <div style="width: 202px; height: 60px;"></div>
                          </div>
                          <div class="contract-trigger"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="iq-card-body">
                <div id="table" class="">
                  <span class="table-add float-left ml-3 mr-2">
                    @can('tor_create')
                    <a href="{{url('/steppengajuantor')}}" class="btn btn-sm btn-primary">
                      <i class="las la-plus"></i><span class="pl-1">Tambah TOR</span>
                    </a>
                    @endcan
                  </span>
                  <span class="table-add float-right mb-3 mr-2">
                    <div class="form-group row">
                      <form action="{{ url('/filtertahun') }}" method="GET">
                        <div class="row mr-3">
                          <div class="col mr-1">
                            <select class="form-control filter sm-8" name="tahun" id="input">
                              <option value="0">All</option>
                              <?php for ($thn = 0; $thn < count($tabeltahun); $thn++) {
                                if ($tabeltahun[$thn]->is_aktif == 1) {   ?>
                                  <option value="{{$tabeltahun[$thn]->tahun}}" {{$filtertahun==$tabeltahun[$thn]->tahun ? 'selected':''}}>{{$tabeltahun[$thn]->tahun}}</option>
                              <?php }
                              } ?>
                            </select>
                          </div>
                          <input type="submit" class="btn btn-sm btn-primary" value="Filter">
                        </div>
                      </form>
                    </div>
                  </span>
                </div>
                <div style="overflow-x:auto;" class="container mt-2 mr-5">
                  @if (session('success'))
                  <script>
                    Swal.fire({
                      icon: 'success',
                      title: "{{session('success')}}",
                      showConfirmButton: false,
                      timer: 3000
                    })
                  </script>
                  @endif
                  <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-icon">
                      <i class="ri-information-line"></i>
                    </div>
                    <div class="iq-alert-text">Lengkapi data TOR, Jadwal, RAB & Anggaran</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="ri-close-line"></i>
                    </button>
                  </div>

                  <table id="torab" class="table table-bordered table-responsive-md table-striped text-center" style="box-shadow:5px;">
                    <thead class="bg-primary" style="color: white;">
                      <tr>
                        <th colspan="3">
                          Tri Wulan 1
                        </th>
                        <th colspan="3">Tri Wulan 2
                        </th>
                        <th colspan="3">Tri Wulan 3 </i>
                        </th>
                        <th colspan="3">Tri Wulan 4 </i>
                        </th>
                      </tr>
                    </thead>
                    <?php
                    $semuaanggaran = 0;
                    ?>
                    <tbody class="bg-primary" style="color: white;">
                      <tr class="">
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                      </tr>
                        <!-- awal perulangan tor -->
                        @foreach ($tor as $tItem)
                          @php
                              $tw = 0;
                              foreach ($tw2 as $twItem) {
                                  if ($tItem->id_tw == $twItem->id) {
                                      $tw = substr($twItem->triwulan, 14, 1);
                                      break;
                                  }
                              }
                          @endphp
                          <tr>
                            @if ($tw == 2)
                              @for ($i = 0; $i < 3; $i++)
                                <th align="center" bgcolor=" white"></th>
                              @endfor
                            @elseif ($tw == 3)
                              @for ($i = 0; $i < 6; $i++)
                                <th align="center" bgcolor=" white"></th>
                              @endfor
                            @elseif ($tw == 4)
                              @for ($i = 0; $i < 9; $i++)
                                <th align="center" bgcolor=" white"></th>
                              @endfor
                            @endif
                              <th style="background-color: #cacfd1;" colspan="3">
                                  <h6 id="tornya" style="color: #000102b5;"><b>{{ $tItem->nama_kegiatan }}</b>
                                      <!-- AKSI TOR  -->
                                      @include('perencanaan/aksi/aksi_tor')
                                  </h6>
                              </th>
                          </tr>
                          <!-- TAMBAH RAB -->
                          @include('perencanaan/modal2/tambah_rab')
                          <!-- button untuk prodi mengajukan tor -->
                          @include('perencanaan/modal2/status')
                          @include('perencanaan/modal2/ajukan')

                          @foreach ($rab as $rabrev)
                              @if ($rabrev->id_tor == $tItem->id)
                                  <tr>
                                      @if ($tw == 2)
                                        @for ($i = 0; $i < 3; $i++)
                                          <td align="center" bgcolor=" white"></td>
                                        @endfor
                                      @elseif ($tw == 3)
                                        @for ($i = 0; $i < 6; $i++)
                                          <td align="center" bgcolor=" white"></td>
                                        @endfor
                                      @elseif ($tw == 4)
                                        @for ($i = 0; $i < 9; $i++)
                                          <td align="center" bgcolor=" white"></td>
                                        @endfor
                                      @endif
                                      <!-- NAMA KEGIATAN JADI 1 BARIS  -->
                                      <!-- AKSI -->
                                      <!-- for status -->
                                      <td style="background-color: #efefef;color:black" align="left" colspan="3"> RAB : {{ $rabrev->masukan }}
                                          <!-- AKSI KEGIATAN -->
                                          @include('perencanaan/aksi/aksi_rab')
                                      </td>
                                      <!-- ANGGARAN -->
                                    </tr>
                                    <tr>
                                      @if ($tw == 2)
                                        @for ($i = 0; $i < 3; $i++)
                                          <td align="center" bgcolor=" white"></td>
                                        @endfor
                                      @elseif ($tw == 3)
                                        @for ($i = 0; $i < 6; $i++)
                                          <td align="center" bgcolor=" white"></td>
                                        @endfor
                                      @elseif ($tw == 4)
                                        @for ($i = 0; $i < 9; $i++)
                                          <td align="center" bgcolor=" white"></td>
                                        @endfor
                                      @endif
                                      <td colspan="3" style="background-color: #efefef;">
                                          @php
                                              $totanggaran1 = 0;
                                          @endphp
                                          @foreach ($anggaran as $anggaranItem)
                                              @if ($anggaranItem->anggaran != 0 && $anggaranItem->id_rab == $rabrev->id)
                                                  @php
                                                      $totanggaran1 += $anggaranItem->anggaran;
                                                  @endphp
                                                  @foreach ($detail_mak as $detailMak)
                                                      @if ($anggaranItem->id_detail_mak == $detailMak->id)
                                                          <h6 align="left" style="font-size: smaller;">
                                                              {{ $detailMak->detail . " - " ." Rp. " .  number_format($anggaranItem->anggaran, 2, ',', '.') }}
                                                          </h6>
                                                      @endif
                                                  @endforeach
                                              @endif
                                          @endforeach
                                          <!-- TAMBAH ANGGARAN DI RAB  {{" [".$tw."] "}}-->
                                          <a href="#" class="badge iq-bg-primary">Total di RAB = <?= " Rp. " .  number_format($totanggaran1, 2, ',', '.'); ?></a>
                                      </td>
                                    </tr>
                              @endif
                          @endforeach

                          <!-- MODAL DETAIL TOR -->
                          @include('perencanaan/modal2/detail_tor')
                          <!-- MODAL UPDATE TOR -->
                          @include('perencanaan/modal2/update_tor')
                        @endforeach

                        @php 
                          $semuaanggaran = [0, 0, 0, 0];
                          foreach ($totalpertw as $totaltw) {
                            if (auth()->user()->id_unit != 1) {
                              for ($an = 0; $an < 4; $an++) {
                                if (substr($totaltw->triwulan, 14, 1) == $an + 1) {
                                  if ($totaltw->id_unit_tor == auth()->user()->id_unit) {
                                    if ($filtertahun != 0) {
                                      if (substr($totaltw->tgl_mulai_pelaksanaan, 0, 4) == $filtertahun) {
                                        $semuaanggaran[$an] += $totaltw->anggaran;
                                      }
                                    } else {
                                      $semuaanggaran[$an] += $totaltw->anggaran;
                                    }
                                  }
                                }
                              }
                            }
                          }
                        @endphp

                      <tr>
                        <td class="bg-primary" colspan="3" style="font-size: medium;">
                          <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[0], 2, ',', '.') ?></b>
                        </td>
                        <td class="bg-primary" colspan="3" style="font-size: medium;">
                          <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[1], 2, ',', '.') ?></b>
                        </td>
                        <td class="bg-primary" colspan="3" style="font-size: medium;">
                          <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[2], 2, ',', '.') ?></b>
                        </td>
                        <td class="bg-primary" colspan="3" style="font-size: medium;">
                          <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[3], 2, ',', '.') ?></b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  {{ $tor->links() }}
                </div>
              </div>
              <div id="editor"></div>
            </div>
          </div>

        </div>
        <div>
        </div></br>
        <hr />
        <div id="hasil">
          <!-- Hasil -->
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
  <script>
    $('.tor-confirm').on('click', function(event) {
      event.preventDefault();
      const url = $(this).attr('href');
      swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
      }).then(function(value) {
        if (value) {
          window.location.href = url;
        }
      });
    });
  </script>
  <script type="text/javascript">
    $('.rab-confirm').on('click', function(event) {
      event.preventDefault();
      const url = $(this).attr('href');
      swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
      }).then(function(value) {
        if (value) {
          window.location.href = url;
        }
      });
    });


    //print page
    function printDiv() {
      var printContents = document.getElementById("content-page").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
    };


    // javascript change html to pdf?

    // var doc = new jsPDF();
    // var specialElementHandlers = {
    //   '#editor': function(element, renderer) {
    //     return true;
    //   }
    // };
    // $('#generatePDF').click(function() {
    //   doc.fromHTML($('#torab').html(), 15, 15, {
    //     'width': 700,
    //     'elementHandlers': specialElementHandlers
    //   });
    //   doc.save('page.pdf');
    // });
  </script>

  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
        $(this).remove();
      });
    }, 3000);
  </script>

  @include('dashboards/users/layouts/footer')

</body>

</html>