<?php

use Illuminate\Support\Facades\Auth;

?>
@include('dashboards/users/layouts/script')
<?php
function ngecekWulan($awal, $akhir)
{
    if (new datetime(date('Y-m-d')) >= new datetime($awal) && new datetime(date('Y-m-d')) <= new datetime($akhir) && !empty($_REQUEST['filterTw'])) {
        return true;
    }
    return false;
}
?>

<body>
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <div class="wrapper">
        @include('dashboards/users/layouts/navbar')
        @include('dashboards/users/layouts/sidebar')
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Monitoring Usulan</h4>
                                    </div>
                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                                <i class="ri-more-fill"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                                <a class="dropdown-item" href="" onclick="printDiv()"><i class="ri-printer-fill mr-2" onclick="printDiv()"></i>Print</a>
                                                <!-- <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <!-- A N G G A R A N -->
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                                <div class="iq-card-body iq-box-relative">
                                                    <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                                                        <i class="ri-focus-2-line"></i>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <?php
                                                            $ajuanTw1 = 0;
                                                            $ajuanTw2 = 0;
                                                            $ajuanTw3 = 0;
                                                            $ajuanTw4 = 0;
                                                            $setujuTw1 = 0;
                                                            $setujuTw2 = 0;
                                                            $setujuTw3 = 0;
                                                            $setujuTw4 = 0;

                                                            $jml_ang_ajuan = 0;
                                                            $jml_ang_disetujui = 0;
                                                            $statusTor2 = [];
                                                            $count1 = 0;
                                                            $count2 = 0;
                                                            $cekId = 0;
                                                            $i2 = 0;
                                                            $i3 = 0;
                                                            $udah = 1;
                                                            $disetujui = [
                                                                'tor' => [],
                                                                'anggaran' => [],
                                                            ]; //apakah ketiga wd sudah validasi?
                                                            $tordisetujui = [];
                                                            for ($m2 = 0; $m2 < count($tor); $m2++) {
                                                                $i2 = 0;
                                                                for ($tr2 = 0; $tr2 < count($trx_status_tor); $tr2++) {
                                                                    if ($trx_status_tor[$tr2]->id_tor == $tor[$m2]->id) {
                                                                        $cekId == $tor[$m2]->id;
                                                                        for ($s2 = 0; $s2 < count($status); $s2++) {
                                                                            if ($trx_status_tor[$tr2]->id_status == $status[$s2]->id) {
                                                                                $statusTor2[$tor[$m2]->id][$i2] = $status[$s2]->nama_status . ' , ';
                                                                                for ($u5 = 0; $u5 < count($users); $u5++) {
                                                                                    if ($trx_status_tor[$tr2]->create_by == $users[$u5]->id) {
                                                                                        if ($trx_status_tor[$tr2]->create_by == $users[$u5]->id) {
                                                                                            if ($status[$s2]->nama_status == 'Validasi' && $trx_status_tor[$tr2]->role_by == 'WD 3') {
                                                                                                $disetujui['anggaran'][$i3] = $tor[$m2]->jumlah_anggaran; //anggaran kegiatan yg telah divalidasi WD 3
                                                                                                $disetujui['tor'][$i3] = $tor[$m2]->id; // Kegiatan yg telah divalidasi wd 3
                                                                                                $disetujui['tw'][$i3] = $tor[$m2]->id_tw;
                                                                                                'TOR' . $tor[$m2]->id . ' -' . '[' . $tor[$m2]->id . '[[' . $i2 . '] ' . $statusTor2[$tor[$m2]->id][$i2] . " tw: " . $disetujui['tw'][$i3] . '<br />';

                                                                                                $i3 += 1;
                                                                                            }
                                                                                            $i2 += 1;
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        if ($tor[$m2]->id != $cekId) {
                                                                            $jml_ang_ajuan += $tor[$m2]->jumlah_anggaran; //penjumlahan anggaran yg diajukan
                                                                            $count1 += 1;

                                                                            // TOTAL ANGGARAN TIAP TW BERAPA -----------------------------------------------------
                                                                            foreach ($tw as $twS) {
                                                                                // && substr($twS->triwulan, 0, 4) == date('Y')
                                                                                if ($tor[$m2]->id_tw == $twS->id) {
                                                                                    if (substr($twS->triwulan, -1, 1) == 1) {
                                                                                        $ajuanTw1 += $tor[$m2]->jumlah_anggaran;
                                                                                    }
                                                                                    if (substr($twS->triwulan, -1, 1) == 2) {
                                                                                        $ajuanTw2 += $tor[$m2]->jumlah_anggaran;
                                                                                    }
                                                                                    if (substr($twS->triwulan, -1, 1) == 3) {
                                                                                        $ajuanTw3 += $tor[$m2]->jumlah_anggaran;
                                                                                    }
                                                                                    if (substr($twS->triwulan, -1, 1) == 4) {
                                                                                        $ajuanTw4 += $tor[$m2]->jumlah_anggaran;
                                                                                    }
                                                                                }
                                                                            }
                                                                            // END TOTAL ANGGARAN TIAP TW BERAPA -----------------------------------------------------

                                                                            $cekId = $tor[$m2]->id;
                                                                        }
                                                                    }
                                                                }
                                                                // echo "<br />";
                                                            }
                                                            ?>
                                                            <p class="text-secondary">Jumlah Anggaran Ajuan</p>
                                                            <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                                                                <?php
                                                                $x = 0; //agar array tidakduplicate

                                                                // TOTAL ANGGARAN DISETUJUI, TIDAK DUPLICATE
                                                                for ($d = 0; $d < count($disetujui['tor']); $d++) {
                                                                    if ($disetujui['tor'][$d] != $x) {
                                                                        $jml_ang_disetujui += $disetujui['anggaran'][$d]; //penjumlahan anggaran yg disetujui
                                                                        $count2 += 1;
                                                                    }

                                                                    $x = $disetujui['tor'][$d];
                                                                }

                                                                // TOTAL DISETUJUI TIAP TW
                                                                if (!empty($disetujui['tw'])) {
                                                                    for ($e = 0; $e < count($disetujui['tw']); $e++) { // echo $disetujui['tw'][$e];
                                                                        //----- TIAP TRIWULAN ADA BERAPA ANGGARAN -----
                                                                        foreach ($tw as $twS) {
                                                                            // && substr($twS->triwulan, 0, 4) == date('Y')
                                                                            if ($disetujui['tw'][$e] == $twS->id) {
                                                                                if (substr($twS->triwulan, -1, 1) == 1) {
                                                                                    $setujuTw1 += $disetujui['anggaran'][$e];
                                                                                }
                                                                                if (substr($twS->triwulan, -1, 1) == 2) {
                                                                                    $setujuTw2 += $disetujui['anggaran'][$e];
                                                                                }
                                                                                if (substr($twS->triwulan, -1, 1) == 3) {
                                                                                    $setujuTw3 += $disetujui['anggaran'][$e];
                                                                                }
                                                                                if (substr($twS->triwulan, -1, 1) == 4) {
                                                                                    $setujuTw4 += $disetujui['anggaran'][$e];
                                                                                }
                                                                            }
                                                                        }
                                                                        //---------------------------------------------
                                                                    }
                                                                }
                                                                ?>
                                                                <h4><b>{{ 'Rp. ' . number_format($jml_ang_ajuan) }}</b>
                                                                </h4>
                                                            </div>
                                                            <hr>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <span class="">{{ $count1 }} Kegiatan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                                <div class="iq-card-body iq-box-relative">
                                                    <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                                                        <i class="ri-pantone-line"></i>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="text-secondary">Jumlah Anggaran Disetujui</p>
                                                            <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                                                                <h4><b>{{ 'Rp. ' . number_format($jml_ang_disetujui) }}</b>
                                                                </h4>
                                                            </div>
                                                            <hr>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <span class="">{{ $count2 }} Kegiatan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-sm-5">
                                            <div class="iq-card-body">
                                                <div id="apex-column-wulan"></div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- STORE ANGGARAN ke tiap TW SESUAI FILTER  -->
                                    <?php
                                    if ($filtertw == 0) {
                                        $setujuTw1 = $setujuTw1;
                                        $setujuTw2 = $setujuTw2;
                                        $setujuTw3 = $setujuTw3;
                                        $setujuTw4 = $setujuTw4;
                                        $ajuanTw1 = $ajuanTw1;
                                        $ajuanTw2 = $ajuanTw2;
                                        $ajuanTw3 = $ajuanTw3;
                                        $ajuanTw4 = $ajuanTw4;
                                    }
                                    if ($filtertw != 0) {
                                        foreach ($tw as $cektw) {
                                            if ($cektw->id == $filtertw) {
                                                if (substr($cektw->triwulan, -1, 1) == 1) {
                                                    $ajuanTw1 = $jml_ang_ajuan;
                                                    $setujuTw1 = $jml_ang_disetujui;
                                                }
                                                if (substr($cektw->triwulan, -1, 1) == 2) {
                                                    $ajuanTw2 = $jml_ang_ajuan;
                                                    $setujuTw2 = $jml_ang_disetujui;
                                                }
                                                if (substr($cektw->triwulan, -1, 1) == 3) {
                                                    $ajuanTw3 = $jml_ang_ajuan;
                                                    $setujuTw3 = $jml_ang_disetujui;
                                                }
                                                if (substr($cektw->triwulan, -1, 1) == 4) {
                                                    $ajuanTw4 = $jml_ang_ajuan;
                                                    $setujuTw4 = $jml_ang_disetujui;
                                                }
                                            }
                                        }
                                    }
                                    ?>

                                    <div class="row justify-content-center">
                                        <div class="col-sm-7">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <script>
                                        const labels = [
                                            'Triwulan 1',
                                            'Triwulan 2',
                                            'Triwulan 3',
                                            'Triwulan 4',
                                        ];
                                        const data = {
                                            labels: labels,
                                            datasets: [{
                                                    label: 'Anggaran Ajuan',
                                                    backgroundColor: '#fe517e',
                                                    borderColor: 'rgb(255, 99, 132)',
                                                    data: [<?php echo  $ajuanTw1 ?>, <?php echo  $ajuanTw2 ?>,
                                                        <?php echo  $ajuanTw3 ?>, <?php echo  $ajuanTw4 ?>
                                                    ],
                                                },
                                                {
                                                    label: 'Anggaran Disetujui',
                                                    backgroundColor: '#99f6ca',
                                                    borderColor: '#99f6ca',
                                                    data: [<?php echo  $setujuTw1 ?>, <?php echo  $setujuTw2 ?>,
                                                        <?php echo  $setujuTw3 ?>, <?php echo  $setujuTw4 ?>
                                                    ],
                                                }
                                            ]
                                        };
                                        <?php
                                        // $show = "tr - 2";
                                        foreach ($tw as $x) {
                                            if ($x->id == $filtertw) {
                                                // $show = $x->triwulan;
                                            }
                                        }
                                        foreach ($tahun as $tampil) {
                                            if ($tampil->id == $filterTahun) {
                                                $tahunTampil = $tampil->tahun;
                                            }
                                        }
                                        ?>
                                        const config = {
                                            type: 'line',
                                            data: data,
                                            bezierCurve: true,
                                            options: {
                                                elements: {
                                                    line: {
                                                        tension: 0.4, //  bezier curves
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        max: 20000000 + <?= $ajuanTw1 + $ajuanTw2 + $ajuanTw3 + $ajuanTw4 ?>,
                                                    },
                                                    yAxes: [{
                                                        ticks: {
                                                            fontColor: "rgba(0,0,0,0.5)",
                                                            fontStyle: "bold",
                                                            beginAtZero: true,
                                                            maxTicksLimit: 5,
                                                            padding: 20
                                                        },
                                                        gridLines: {
                                                            drawTicks: false,
                                                            display: false
                                                        }
                                                    }],
                                                    xAxes: [{
                                                        gridLines: {
                                                            zeroLineColor: "transparent"
                                                        },
                                                        ticks: {
                                                            padding: 20,
                                                            fontColor: "rgba(0,0,0,0.5)",
                                                            fontStyle: "bold"
                                                        }
                                                    }]
                                                },

                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: 'Diagram Monitoring Usulan Anggaran ' + <?= $tahunTampil   ?>
                                                    },
                                                    datalabels: {
                                                        anchor: "end",
                                                        align: "top",
                                                        formatter(data, context) {
                                                            return getValueFormatted(data);
                                                        },
                                                    },
                                                }

                                            }
                                        };
                                        const myChart = new Chart(
                                            document.getElementById('myChart').getContext("2d"),
                                            config
                                        );
                                        // Get the chart's base64 image string
                                        var image = myChart.toBase64Image();
                                        console.log(image);
                                    </script>

                                    <br />
                                    <div class="table-responsive">
                                        <div class="form-group row float-right mb-3 mr-2">
                                            <span class="table-add float-right mb-3 mr-2">
                                                <div class="form-group row">
                                                    <form action="{{ url('/monitoringUsulan/filterTw') }}" method="GET">
                                                        <div class="row mr-3">
                                                            <div class="col mr-1">
                                                                <select class="form-control filter sm-8" name="filterTahun" id="selectnya" onchange="Ganti()">
                                                                    <!-- <option value="0">All</option> -->
                                                                    <?php foreach ($tahun as $thn) {
                                                                        if ($thn->is_aktif == 1) { ?>
                                                                            <option value="{{ base64_encode($thn->id) }}" {{$filterTahun==$thn->id ? 'selected':''}}>{{$thn->tahun}}</option>
                                                                    <?php
                                                                        }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col mr-1">
                                                                <select class="form-control filter sm-8" name="filterTw" id="filterTw" onchange="GantiTahun()">
                                                                    <option value="0">All</option>
                                                                    <?php
                                                                    for ($tw1 = 0; $tw1 < count($tw); $tw1++) {
                                                                        foreach ($tahun as $thn) {
                                                                            if ($thn->is_aktif == 1) {
                                                                                if ($thn->tahun == substr($tw[$tw1]->triwulan, 0, 4) && date('Y') == substr($tw[$tw1]->triwulan, 0, 4)) {  ?>
                                                                                    <option value="{{ base64_encode($tw[$tw1]->id) }}" id="options" {{$filtertw==$tw[$tw1]->id ? 'selected':''}}>{{$tw[$tw1]->triwulan}}</option>
                                                                    <?php   }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                                                        </div>
                                                    </form>
                                                    <script>
                                                        function Ganti() {
                                                            var id_thn = document.getElementById('selectnya').value;
                                                            $.ajax({
                                                                url: '/getTwByTahun/' + id_thn,
                                                                type: "GET",
                                                                data: {
                                                                    "_token": "{{ csrf_token() }}",
                                                                },
                                                                dataType: "json",
                                                                success: function(data) {
                                                                    $('select[id="filterTw"]').empty();
                                                                    $('select[id="filterTw"]').append('<option value=0>All</option>');
                                                                    $.each(data, function(key, tws) {
                                                                        $('select[id="filterTw"]').append('<option value="' + btoa(tws.id) + '">' + tws.triwulan + '</option>');
                                                                    });
                                                                }
                                                            });
                                                        }

                                                        function GantiTahun() {
                                                            var id_triwulan = document.getElementById('filterTw').value;
                                                            $.ajax({
                                                                url: '/getTahunByTw/' + id_triwulan,
                                                                type: "GET",
                                                                data: {
                                                                    "_token": "{{ csrf_token() }}",
                                                                },
                                                                dataType: "json",
                                                                success: function(data) {
                                                                    $('select[id="selectnya"]').empty();
                                                                    $.each(data, function(key, thn) {
                                                                        $('select[id="selectnya"]').append('<option value="' + btoa(thn.id) + '">' + thn.tahun + '</option>');
                                                                    });
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                </div>
                                            </span>
                                        </div>
                                        <table id="monitoring" class="table table-striped responsive table-bordered" style="display: block;
    overflow-y: auto;
    white-space: nowrap;
  max-height:500px;">
                                            <thead class="" style="background: linear-gradient(15deg, #3f768d 0%, #80d0c7 100%);color:white">
                                                <tr>
                                                    <th>No.</th>
                                                    <th scope="col">Triwulan</th>
                                                    <th scope="col">Prodi</th>
                                                    <th scope="col">Judul Kegiatan</th>
                                                    <th scope="col">Jenis Ajuan</th>
                                                    <th scope="col">Tanggal Mulai</th>
                                                    <th scope="col">Nama PIC</th>
                                                    <th scope="col">Anggaran Ajuan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                for ($m = 0; $m < count($tor); $m++) {
                                                    $ada = 0; //sudah diajukan apa belum
                                                    //  P R O D I 
                                                    $prodiTor = "";
                                                    for ($p = 0; $p < count($prodi); $p++) {
                                                        if ($tor[$m]->id_unit == $prodi[$p]->id) {
                                                            $prodiTor = $prodi[$p]->nama_unit;
                                                        }
                                                    }

                                                    // S T A T U S

                                                    $statusTor = [
                                                        [
                                                            'tor' => '',
                                                            'status' => '',
                                                            'statusMemo' => '',
                                                            'statusLPJ' => '',
                                                            'statusSPJ' => '',
                                                        ]
                                                    ];
                                                    for ($tr = 0; $tr < count($trx_status_tor); $tr++) {
                                                        if ($trx_status_tor[$tr]->id_tor == $tor[$m]->id) {
                                                            for ($s = 0; $s < count($status); $s++) {
                                                                if ($trx_status_tor[$tr]->id_status == $status[$s]->id) {
                                                                    $ada = 1;
                                                                    $statusTor[0]['tor'] = "TOR" . $tor[$m]->id;
                                                                    for ($u = 0; $u < count($users); $u++) {
                                                                        if ($trx_status_tor[$tr]->create_by == $users[$u]->id) {
                                                                            for ($r = 0; $r < count($roles); $r++) {
                                                                                if ($users[$u]->role == $roles[$r]->id) {
                                                                                    $statusTor[0]['status'] = $status[$s]->nama_status . " - " . $trx_status_tor[$tr]->role_by;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }


                                                ?>
                                                    <?php if ($ada == 1) { ?>
                                                        <tr>
                                                            <td>{{ $no + 1 }}</td><?php $no++ ?>
                                                            <?php foreach ($tw as $wulan) {
                                                                if ($wulan->id == $tor[$m]->id_tw) { ?>
                                                                    <td>{{ $wulan->triwulan }}</td>
                                                            <?php }
                                                            } ?>
                                                            <td>{{ $prodiTor }}</td>
                                                            <td>{{ $tor[$m]->nama_kegiatan }}</td>
                                                            <td>{{ $tor[$m]->jenis_ajuan }}</td>
                                                            <td><?php
                                                                $date = date_create($tor[$m]->tgl_mulai_pelaksanaan);
                                                                echo date_format($date, 'M d, Y'); ?></td>
                                                            <td>{{ $tor[$m]->nama_pic }}</td>
                                                            <td>{{ 'Rp. ' . number_format($tor[$m]->jumlah_anggaran, 2, ',', ',') }}
                                                            </td>
                                                            <td>
                                                                <?php if (empty($statusTor[0]['statusMemo'])) { ?>
                                                                    <div class="badge badge-pill {{ $statusTor[0]['status'] == 'Validasi - WD 3' ?  'badge-success' : 'badge-secondary' }}">{{ $statusTor[0]['status'] }}</div>
                                                                <?php } elseif (!empty($statusTor[0]['statusMemo']) && empty($statusTor[0]['persekotKerja'])) { ?>
                                                                    <div class="badge badge-pill badge-warning">{{ $statusTor[0]['statusMemo'] }}</div>

                                                                <?php } elseif (!empty($statusTor[0]['statusMemo']) && !empty($statusTor[0]['persekotKerja']) && empty($statusTor[0]['statusSPJ']) && empty($statusTor[0]['statusLPJ'])) { ?>
                                                                    <div class="badge badge-pill badge-warning">{{ $statusTor[0]['persekotKerja'] }}</div>

                                                                <?php } elseif (!empty($statusTor[0]['statusSPJ']) && empty($statusTor[0]['statusLPJ'])) { ?>
                                                                    <div class="badge badge-pill badge-primary">{{ $statusTor[0]['statusSPJ'] }}</div>

                                                                <?php } elseif (empty($statusTor[0]['statusSPJ']) && !empty($statusTor[0]['statusLPJ'])) { ?>
                                                                    <div class="badge badge-pill badge-primary">{{ $statusTor[0]['statusLPJ']}}</div>

                                                                <?php } elseif (!empty($statusTor[0]['statusSPJ']) && !empty($statusTor[0]['statusLPJ'])) { ?>
                                                                    <div class="badge badge-pill badge-primary">{{ $statusTor[0]['statusSPJ'] ." & ".$statusTor[0]['statusLPJ']}}</div>
                                                                <?php } ?>
                                                                <button class="badge badge-info" data-toggle="modal" data-placement="top" data-target="#detail_tor{{$tor[$m]->id}}">
                                                                    <i class="fa fa-tasks"></i>
                                                                </button>
                                                                <!-- -------------------------------------------------------------------------M O D A L S T A T U S------------------------------------------------------------------------------------
                                                                -----------------------------------------------------------------------------------MODAL STATUS------------------------------------------------------------------------------------
                                                                ---------------------------------------------------------------------------M O D A L S T A T U S------------------------------------------------------------------------------------  -->
                                                                <div class="modal fade" tabindex="-1" role="dialog" id="detail_tor{{$tor[$m]->id}}">
                                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header" style="background-color: #ffc107;color:white">
                                                                                <h5 class="modal-title" style="color:white"><b>Status Pengajuan TOR & RAB</b> </h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="iq-card-body">
                                                                                    <ul class="iq-timeline">
                                                                                        <?php
                                                                                        $indexwarna = 0;
                                                                                        $ada = 0;
                                                                                        if (!empty($trx_status_tor)) {
                                                                                            foreach ($trx_status_tor as $q3) {
                                                                                                if ($q3->id_tor == $tor[$m]->id) {
                                                                                        ?>
                                                                                                    <li>
                                                                                                        <?php for ($st = 0; $st < count($status); $st++) {
                                                                                                            if ($status[$st]->id == $q3->id_status) {
                                                                                                                $wstatus = $status[$st]->nama_status;
                                                                                                                if ($wstatus == 'Proses Pengajuan') {
                                                                                                                    $warnaLingkar = 'timeline-dots';
                                                                                                                } elseif ($wstatus == 'Verifikasi') {
                                                                                                                    $warnaLingkar = 'timeline-dots border-warning';
                                                                                                                } elseif ($wstatus == 'Review') {
                                                                                                                    $warnaLingkar = 'timeline-dots  border-info';
                                                                                                                } elseif ($wstatus == 'Revisi') {
                                                                                                                    $warnaLingkar = 'timeline-dots  border-danger';
                                                                                                                } elseif ($wstatus == 'Validasi') {
                                                                                                                    $warnaLingkar = 'timeline-dots  border-success';
                                                                                                                } elseif ($wstatus == 'Pengajuan Perbaikan') {
                                                                                                                    $warnaLingkar = 'timeline-dots';
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        ?>
                                                                                                        <div class="{{$warnaLingkar}}"><i class="ri-check-fill" style="color:black"></i></div>
                                                                                                        <?php
                                                                                                        $indexwarna += 1;
                                                                                                        if ($indexwarna > 3) {
                                                                                                            $indexwarna = 0;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col">
                                                                                                                <h6 style="text-align:left;">
                                                                                                                    <?php
                                                                                                                    foreach ($status as $st3) {
                                                                                                                        if ($st3->id == $q3->id_status) {
                                                                                                                            echo  $st3->nama_status;
                                                                                                                            foreach ($users as $u) {
                                                                                                                                if ($u->id == $q3->create_by) {
                                                                                                                                    foreach ($roles as $rl) {
                                                                                                                                        if ($rl->id == $u->role) {
                                                                                                                                            echo "<br/>" . " - create by : " . $u->name . " - " . $q3->role_by;
                                                                                                                                            // $pengvalidasi = $rl->id;
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </h6>
                                                                                                            </div>
                                                                                                            <div class="col">
                                                                                                                <small style="font-size: smaller;color:grey" class="float-right mt-1">{{$q3->created_at}}</small>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </li>


                                                                                                    <br />
                                                                                        <?php }
                                                                                            }
                                                                                        } ?>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                    </div>

                                    <!-- */ --------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                                    </td>
                                    <?php $idtor = base64_encode($tor[$m]->id) ?>
                                    <td><a href="{{ url('/detailtor/' . $idtor) }}">Detail</a>
                                    </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#monitoring').Table({
                "scrollY": 200,
                "scrollX": true
            });
        });
        //print page
        function printDiv() {
            var printContents = document.getElementById("content-page").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
        };
    </script>

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            <?php date_default_timezone_set('Asia/Jakarta'); ?>
            $('#monitoring').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'print',
                    {
                        extend: 'excelHtml5',
                        title: 'MonitoringUsulan_<?= date('Y-m-d H-i-s'); ?>'
                    },

                    {
                        extend: 'pdfHtml5',
                        title: 'MonitoringUsulan_<?= date('Y-m-d H-i-s'); ?>'
                    }
                ]
            });
        });
    </script>
    @include('dashboards/users/layouts/footer')
</body>

</html>