<?php

use Illuminate\Support\Facades\Auth;
?>
@can('kegiatan_create')
@include('dashboards/users/layouts/script')

<body>
  <div id="loading">
    <div id="loading-center">
    </div>
  </div>
  <div class="wrapper">
    <?php $notifikasi = 0; ?>

    @include('dashboards/users/layouts/navbar')
    @include('dashboards/users/layouts/sidebar')

    <!-- Page Content  -->
    <div id="content-page" class="content-page"><?php $tor = $tor; ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="iq-card">
              <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                  <h4 class="card-title">PENGAJUAN TOR

                    @can('tor_create')
                    <button class="search-toggle iq-waves-effect bg-primary rounded" data-toggle="modal" title="Tambah TOR" data-original-title="Tambah TOR" data-target="#tambahtor<?= Auth()->user()->id_unit ?>"><i class="fa fa-plus-circle"></i>
                    </button>
                    @endcan
                    <!-- MODAL TAMBAH TOR  -->

                  </h4>
                  @include('dashboards/users/tor/modal/tambah_tor')
                </div>
              </div>
              <br />
              <?php if (Auth()->user()->role == 2) { ?>
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body iq-box-relative">
                      <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-primary">
                        <i class="ri-focus-2-line"></i>
                      </div>
                      <p class="text-secondary">Total Pagu</p>
                      <form action="http://127.0.0.1:8000/filterpagu" method="GET">
                        <div class="row mr-3">
                          <div class="col mr-1">
                            <select class="form-control filter sm-8" name="tahun" id="input">
                              <option value="0">All</option>
                              <?php for ($t2 = 0; $t2 < count($tabeltahun); $t2++) { ?>
                                <option value="{{$tabeltahun[$t2]->tahun}}" {{$filtertahun==$tabeltahun[$t2]->tahun ? 'selected':''}}>{{$tabeltahun[$t2]->tahun}}</option>
                              <?php } ?>
                            </select>
                          </div>
                          <input type="submit" class="btn btn-primary btn-sm" value="OK">
                        </div>
                      </form>
                      <br />
                      <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                        <div class="row ml-1">
                          <?php for ($pg = 0; $pg < count($pagu); $pg++) {
                            if ($pagu[$pg]->id_unit == Auth()->user()->id_unit) {
                              for ($t3 = 0; $t3 < count($tabeltahun); $t3++) {
                                if ($pagu[$pg]->id_tahun == $tabeltahun[$t3]->id) { ?>
                                  <h6>{{$tabeltahun[$t3]->tahun}} <b>{{"Rp".number_format($pagu[$pg]->pagu,2,',','.')}}</b></h6>

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
              <?php } ?>
              <div class="iq-card-body">
                <div id="table" class="table-editable">
                  <span class="table-add float-right mb-3 mr-2">
                    <div class="form-group row">
                      <form action="{{ url('/filtertahun') }}" method="GET">
                        <div class="row mr-3">
                          <div class="col mr-1">
                            <select class="form-control filter sm-8" name="tahun" id="input">
                              <option value="0">All</option>
                              <?php for ($thn = 0; $thn < count($tabeltahun); $thn++) { ?>
                                <option value="{{$tabeltahun[$thn]->tahun}}" {{$filtertahun==$tabeltahun[$thn]->tahun ? 'selected':''}}>{{$tabeltahun[$thn]->tahun}}</option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php if (Auth()->user()->role != 2) { ?>
                            <div class="col mr-1">
                              <select class="form-control filter sm-8" name="prodi" id="prodi">
                                <option value="0">All</option>
                                <?php
                                for ($pr = 0; $pr < count($unit); $pr++) { ?>
                                  <option value="{{$unit[$pr]->id}}" {{$filterprodi==$unit[$pr]->id ? 'selected':''}}>{{$unit[$pr]->nama_unit}}</option>
                                <?php } ?>
                              </select>
                            </div>
                          <?php } ?>
                          <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                        </div>
                      </form>
                    </div>
                  </span>
                </div>
                <?php for ($to = 0; $to < count($tor); $to++) { ?>
                  <!-- {{substr($tor[$to]->tgl_pelaksanaan,0,4)}} <br /> -->
                <?php } ?>
                <div style="overflow-x:auto;" class="container mt-2 mr-5">
                  <table class="table table-bordered table-responsive-md table-striped text-center" style="box-shadow:5px;">
                    <thead class="" bgcolor="#115552" style="color: white;">
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

                    <tbody bgcolor="#115552" style="color: white;">
                      <tr class="">
                        <?php
                        $semuaanggaran = 0;
                        $tw = [1, 2, 3, 4] ?>
                        <!-- <th>TOR</th> -->
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                        <!-- <th>Aksi</th> -->
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                        <!-- <th>Aksi</th> -->
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                        <!-- <th>Aksi</th> -->
                        <th>Kegiatan</th>
                        <th colspan="2">Anggaran</th>
                        <!-- <th>Aksi</th> -->
                      </tr>
                      <tr>
                        <?php
                        $baris = 1;
                        $warna = ["#C0C0C0", "white"];
                        $hitung = 0;
                        for ($a = 0; $a < count($tor); $a++) {
                          $hitung = 0;
                          for ($b = 0; $b < count($kegiatan); $b++) {
                            if ($kegiatan[$b]->id_tor == $tor[$a]->id) {
                              $hitung += 1;
                            }
                          }
                        ?>
                      <tr>
                        <th class="bg-secondary" colspan="13">
                          <h6 id="tornya" style="color: white;"><b>{{substr($tor[$a]->tgl_pelaksanaan,0,4)." "}}{{ strtoupper($tor[$a]->program)}}</b>
                            <!-- AKSI TOR  -->
                            <?php
                            $adaK = 0;
                            for ($k3 = 0; $k3 < count($kegiatan); $k3++) {
                              if ($tor[$a]->id == $kegiatan[$k3]->id_tor) {
                                $adaK += 1;
                              }
                            }
                            ?>

                            @include('dashboards/users/tor/aksi/aksi_tor')
                            <?php $total_per_tor = 0;
                            for ($l = 0; $l < count($totalpertw); $l++) {
                              if ($totalpertw[$l]->id_tor == $tor[$a]->id) {
                                $total_per_tor += $totalpertw[$l]->anggaran; ?>
                            <?php
                              }
                            }
                            ?>
                            <a class="badge iq-bg-primary">
                              <h5>
                                <?= "Rp. " .  number_format($total_per_tor, 2, ',', '.') ?>
                              </h5>
                            </a>
                          </h6>
                        </th>
                      </tr>
                      <!-- TAMBAH KEGIATAN -->
                      @include('dashboards/users/tor/modal/tambah_kegiatan')
                      <?php
                          $nomer = 1;
                          for ($b = 0; $b < count($kegiatan); $b++) {
                            if ($kegiatan[$b]->id_tor == $tor[$a]->id) {

                      ?>
                          <!-- NAMA KEGIATAN JADI 1 BARIS  -->
                          <tr>
                            <?php
                              if ($tor[$a]->id_tw == 2) {
                                for ($e = 1; $e < 4; $e++) { ?>
                                <td align="center" bgcolor=" white"></td>
                            <?php }
                              } ?>

                            <?php
                              if ($tor[$a]->id_tw == 3) {
                                for ($e = 1; $e < 7; $e++) { ?>
                                <td bgcolor="white"></td>
                            <?php }
                              } ?>
                            <?php
                              if ($tor[$a]->id_tw == 4) {
                                for ($e = 1; $e < 10; $e++) { ?>
                                <td bgcolor="white"></td>
                            <?php }
                              } ?>
                            <!-- NAMA KEGIATAN JADI 1 BARIS  -->
                            <!-- AKSI -->
                            <?php
                              $blok = 0;
                              $ada = 0;
                              $tdkada = 0;
                              $statuskeg;
                              $badge;
                              for ($stk = 0; $stk < count($trx_status_kegiatan); $stk++) {
                                if ($trx_status_kegiatan[$stk]->id_kegiatan == $kegiatan[$b]->id) {
                                  $ada += 1;
                                  if ($trx_status_kegiatan[$stk]->id_status == 1) {
                                    $statuskeg = "Pengajuan Prodi";
                                    $badge = "badge-warning";
                                  } elseif ($trx_status_kegiatan[$stk]->id_status == 2) {
                                    $statuskeg = "Diverifikasi";
                                    $badge = "badge-success";
                                  } elseif ($trx_status_kegiatan[$stk]->id_status == 3) {
                                    $statuskeg = "Revisi";
                                    $badge = "badge-danger";
                                  } elseif ($trx_status_kegiatan[$stk]->id_status == 4) {
                                    $statuskeg = "Divalidasi";
                                    $badge = "badge-info";
                                  } else {
                                    $statuskeg = "";
                                  }
                                } else {
                                }
                              }
                            ?>
                            <!-- <td bgcolor="#dee2e6" style="color: black;" align="left" colspan="3"><?= "ada :" . $ada . " - " . "id:" . $kegiatan[$b]->id . " - " . $nomer . ". " . $kegiatan[$b]->nama ?><br /><?php $nomer += 1 ?> -->
                            <td bgcolor="#dee2e6" style="color: black;" align="left" colspan="3"><?= $kegiatan[$b]->nama ?><br /><?php $nomer += 1 ?>
                              <?php if ($ada > 0) { ?>
                                <div class="badge badge-pill {{$badge}}">{{$statuskeg}}</div>
                              <?php } ?>
                              <!-- AKSI KEGIATAN -->
                              @include('dashboards/users/tor/aksi/aksi_kegiatan')
                            </td>

                            <?php
                              if ($tor[$a]->id_tw == 1) {
                                for ($e = 1; $e < 10; $e++) { ?>
                                <td align="center" bgcolor=" white"></td>
                            <?php }
                              } ?>
                            <?php
                              if ($tor[$a]->id_tw == 2) {
                                for ($e = 1; $e < 7; $e++) { ?>
                                <td align="center" bgcolor=" white"></td>
                            <?php }
                              } ?>
                            <?php
                              if ($tor[$a]->id_tw == 3) {
                                for ($e = 1; $e < 4; $e++) { ?>
                                <td bgcolor="white"></td>
                            <?php
                                }
                              }

                            ?>
                          </tr>

                          <!-- ----------------------------------------------------------- -->
                          <!-- ----------------------------------------------------------- -->
                          <tr bgcolor="white">
                            <?php
                              if ($tor[$a]->id_tw == 2) {
                                for ($e = 1; $e < 4; $e++) { ?>
                                <td align="center" bgcolor=" white"></td>
                            <?php }
                              } ?>

                            <?php
                              if ($tor[$a]->id_tw == 3) {
                                for ($e = 1; $e < 7; $e++) { ?>
                                <td bgcolor="white"></td>
                            <?php }
                              } ?>

                            <?php
                              if ($tor[$a]->id_tw == 4) {
                                for ($e = 1; $e < 10; $e++) { ?>
                                <td bgcolor="white"></td>
                            <?php }
                              } ?>

                            <!-- 
  -------------------------------------------------------------------------
                                 MODAL KEGIATAN
  -------------------------------------------------------------------------
 -->

                            <!-- ANGGARAN -->
                            <td colspan="3" bgcolor="white">
                              <?php
                              $totanggaran1 = 0;

                              $nomer_anggaran = 1;
                              $anggaranBerstatus = [];
                              $no = 0;
                              for ($i = 0; $i < count($anggaran); $i++) {
                                if ($anggaran[$i]->anggaran != 0) {
                                  if ($anggaran[$i]->id_keg == $kegiatan[$b]->id) {
                                    $totanggaran1 += $anggaran[$i]->anggaran;
                                    for ($j = 0; $j < count($mak); $j++) {
                                      if ($anggaran[$i]->id_mak == $mak[$j]->id) {
                              ?>
                                        <h6 align="left" style="font-size: smaller;">
                                          <span><?= $nomer_anggaran . ". " . " <b>" . $mak[$j]->jenis_belanja . " - " . "</b>" .
                                                  "Rp. " .  number_format($anggaran[$i]->anggaran, 2, ',', '.') ?>
                                            <?php $nomer_anggaran += 1; ?>

                                            <!-- AKSI ANGGARAN -->
                                            <?php
                                            for ($i2 = 0; $i2 < count($trx_status); $i2++) {
                                              if ($trx_status[$i2]->id_anggaran ==  $anggaran[$i]->id) {
                                                echo "{ " . $trx_status[$i2]->id_anggaran . " }";
                                                $no = 1;
                                                if ($trx_status[$i2]->id_anggaran == $trx_status[$i2]->id_anggaran) {
                                                  break;
                                                }
                                              } else {
                                                $no = 0;
                                              }
                                            }

                                            ?>
                                            @include('dashboards/users/tor/aksi/aksi_anggaran')
                                            <!-- MODAL UPDATE DI ANGGARAN -->
                                            @include('dashboards/users/tor/modal/update_anggaran')
                                          </span>
                                        </h6>
                              <?php
                                      }
                                    }
                                  }
                                }
                              } ?>
                              <!-- TAMBAH ANGGARAN  -->
                              <?php
                              // if ($statuskeg == "Divalidasi") { 
                              ?>
                              @can('anggaran_create')
                              <a class="iq-bg-primary rounded" style="padding: 1%;" data-toggle="modal" data-placement="top" title="Tambah Anggaran" data-original-title="Tambah Anggaran" data-target="#tambah_anggaran<?= $kegiatan[$b]->id ?>" href=""><i class="ri-user-add-line"></i></a>
                              @endcan
                              <?php
                              // } 
                              ?>
                              <a href="#" class="badge iq-bg-primary">Total = <?= "Rp. " .  number_format($totanggaran1, 2, ',', '.'); ?></a>

                            </td>
                            <!-- UPDATE KEGIATAN -->
                            @include('dashboards/users/tor/modal/update_kegiatan')
                            <!-- DETAIL KEGIATAN -->
                            @include('dashboards/users/tor/modal/detail_kegiatan')

                            <!-- TAMBAH ANGGARAN DI KEGIATAN -->
                            @include('dashboards/users/tor/modal/tambah_anggaran')

                            <?php
                              if ($tor[$a]->id_tw == 1) {
                                for ($e = 1; $e < 9; $e++) { ?>
                                <td align="center" bgcolor=" white"></td>
                            <?php }
                              } ?>
                            <?php
                              if ($tor[$a]->id_tw == 2) {
                                for ($e = 1; $e < 7; $e++) { ?>
                                <td align="center" bgcolor=" white"></td>
                            <?php }
                              } ?>
                            <?php
                              if ($tor[$a]->id_tw == 3) {
                                for ($e = 1; $e < 4; $e++) { ?>
                                <td bgcolor="white"></td>
                            <?php
                                }
                              }
                            ?>
                          </tr>

                      <?php
                            }
                          }
                          $baris += 1; ?>
                      <!-- DETAIL TOR -->
                      @include('dashboards/users/tor/modal/detail_tor')
                      <!-- MODAL UPDATE TOR -->
                      @include('dashboards/users/tor/modal/update_tor')
                    <?php
                        }
                    ?>
                    <?php
                    $semuaanggaran = [0, 0, 0, 0];
                    for ($u = 0; $u < count($totalpertw); $u++) {
                      if (auth()->user()->id_unit != 1) {
                        for ($an = 0; $an < 4; $an++) {
                          if ($totalpertw[$u]->id_tw == $an + 1) {
                            if ($totalpertw[$u]->id_unit_tor == auth()->user()->id_unit) {
                              if ($filtertahun != 0) {
                                if (substr($totalpertw[$u]->tgl_pelaksanaan, 0, 4) == $filtertahun) {
                                  $semuaanggaran[$an] += $totalpertw[$u]->anggaran;
                                }
                              } else {
                                $semuaanggaran[$an] += $totalpertw[$u]->anggaran;
                              }
                            }
                          }
                        }
                      }

                      // jika yang dashboard ADMIN

                      if (auth()->user()->id_unit == 1) {
                        for ($an = 0; $an < 4; $an++) {
                          if ($totalpertw[$u]->id_tw == $an + 1) {
                            if ($filtertahun != 0 && $filterprodi == 0) {
                              if (substr($totalpertw[$u]->tgl_pelaksanaan, 0, 4) == $filtertahun) {
                                $semuaanggaran[$an] += $totalpertw[$u]->anggaran;
                              }
                            } elseif ($filterprodi != 0 && $filtertahun == 0) {
                              if ($totalpertw[$u]->id_unit_tor == $filterprodi) {
                                $semuaanggaran[$an] += $totalpertw[$u]->anggaran;
                              }
                            } elseif ($filterprodi != 0 && $filtertahun != 0) {
                              if ($totalpertw[$u]->id_unit_tor == $filterprodi && substr($totalpertw[$u]->tgl_pelaksanaan, 0, 4) == $filtertahun) {
                                $semuaanggaran[$an] += $totalpertw[$u]->anggaran;
                              }
                            } else {
                              $semuaanggaran[$an] += $totalpertw[$u]->anggaran;
                            }
                          }
                        }
                      }
                    }
                    ?>
                    </tr>

                    <tr>
                      <td class="text-white" bgcolor="#115552" colspan="3" style="font-size: medium;">
                        <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[0], 2, ',', '.') ?></b>
                      </td>
                      <td class="text-white" bgcolor="#115552" colspan="3" style="font-size: medium;">
                        <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[1], 2, ',', '.') ?></b>
                      </td>
                      <td class="text-white" bgcolor="#115552" colspan="3" style="font-size: medium;">
                        <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[2], 2, ',', '.') ?></b>
                      </td>
                      <td class="text-white" bgcolor="#115552" colspan="3" style="font-size: medium;">
                        <i class="fa fa-calculator"></i><b> <?= "Rp. " .  number_format($semuaanggaran[3], 2, ',', '.') ?></b>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                  {{ $tor->links() }}
                </div>
              </div>
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
  @include('dashboards/users/layouts/footer')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript">
  </script>
  <script>
    $(document).ready(function() {
      $("#filter-tahun").change(function() {
        let a = $(this).val();
        tahun()
      })
    });

    function tahun() {
      var filtertahun = $("#filter-tahun").val();
      $.ajax({
        url: '/tor/filter_tahun/' + filtertahun,
        data: {
          tahun: filtertahun
        },
        success: function(data) {
          var data = JSON.parse(data);
          $("#tornya").html(data);
          // console.log(data);
          // console.log(data);
        }
      });
    }
  </script>
</body>

</html>
@endcan