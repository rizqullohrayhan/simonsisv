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
                                        <h4 class="card-title">Monitoring Indikator Kinerja Utama (IKU)</h4>
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

                                    <div class="table-responsive">
                                        <div class="form-group row float-right mb-3 mr-2">
                                            <span class="table-add float-right mb-3 mr-2">
                                                <div class="form-group row">
                                                    <!-- ... filter .... -->
                                                </div>
                                            </span>
                                        </div>
                                        <div class="iq-header-title">
                                            <?php
                                            $judulTw = '';
                                            $judulThn = '';
                                            foreach ($triwulan as $judultw) {
                                                if ($judultw->id == $filtertw) {
                                                    $judulTw = $judultw->triwulan;
                                                }
                                            }
                                            foreach ($tahun as $judulthn) {
                                                if ($judulthn->id == $filterTahun) {
                                                    $judulThn = $judulthn->tahun;
                                                }
                                            }
                                            ?>
                                            <h4 class="card-title text-center">Distribusi Anggaran DIPA Sekolah Vokasi UNS <br />
                                                <?php
                                                $judulTw1 = ucwords(str_replace("-", " ", $judulTw)); //2022 Triwulan 3
                                                $judulTw2 = substr($judulTw1, -10, 10); // Triwulan 3
                                                $judulThn2 = substr($judulTw1, 0, 4); // 2022
                                                if ($filtertw != 0 && $filterTahun != 0) {
                                                    echo $judulTw2 . " - " . $judulThn2;
                                                }
                                                if ($filtertw == 0 && $filterTahun != 0) {
                                                    echo $judulThn;
                                                }
                                                ?>
                                            </h4>
                                        </div>
                                        <div class="form-group row float-right mb-3 mr-2">
                                            <span class="table-add float-right mb-3">
                                                <div class="form-group row">
                                                    <form action="{{ url('/monitoringIKU/filterTw') }}" method="GET">
                                                        <div class="row mr-2">
                                                            <div class="col">
                                                                <select class="form-control filter" name="filterTahun" id="selectnya" onchange="Ganti()">
                                                                    <!-- <option value="0">All</option> -->
                                                                    <?php foreach ($tahun as $thn) {
                                                                        if ($thn->is_aktif == 1) { ?>
                                                                            <option value="{{ base64_encode($thn->id) }}" {{$filterTahun==$thn->id ? 'selected':''}}>{{$thn->tahun}}</option>
                                                                    <?php
                                                                        }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-control filter" name="filterTw" id="filterTw" onchange="GantiTahun()">
                                                                    <option value="0">All</option>
                                                                    <?php
                                                                    for ($tw1 = 0; $tw1 < count($triwulan); $tw1++) {
                                                                        foreach ($tahun as $thn) {
                                                                            if ($thn->is_aktif == 1) {
                                                                                if ($thn->tahun == substr($triwulan[$tw1]->triwulan, 0, 4) && date('Y') == substr($triwulan[$tw1]->triwulan, 0, 4)) {  ?>
                                                                                    <option value="{{ base64_encode($triwulan[$tw1]->id) }}" id="options" {{$filtertw==$triwulan[$tw1]->id ? 'selected':''}}><?= str_replace("-", " ", $triwulan[$tw1]->triwulan) ?></option>
                                                                    <?php   }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <input type="submit" class="btn btn-primary" value="Filter">
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
                                        <table id="monitoring" class="table table-striped table-bordered text-nowrap stripe row-border order-column">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th rowspan="2" bgcolor="#3f768d" style="vertical-align: middle;">No.</th>
                                                    <th rowspan="2" bgcolor="#3f768d" style="vertical-align: middle;">Prodi</th>
                                                    <th rowspan="2" style="vertical-align: middle;">Alokasi Anggaran</th>
                                                    <th colspan="12" style="text-align: center;">Indikator Kinerja Utama</th>
                                                </tr>
                                                <tr>
                                                    <th style="vertical-align: middle;">IKU001</th>
                                                    <th style="vertical-align: middle;">IKU002</th>
                                                    <th style="vertical-align: middle;">IKU003</th>
                                                    <th style="vertical-align: middle;">IKU004</th>
                                                    <th style="vertical-align: middle;">IKU005</th>
                                                    <th style="vertical-align: middle;">IKU006</th>
                                                    <th style="vertical-align: middle;">IKU007</th>
                                                    <th style="vertical-align: middle;">IKU008</th>
                                                    <th style="vertical-align: middle;">IKU009</th>
                                                    <th style="vertical-align: middle;">IKU010</th>
                                                    <th style="vertical-align: middle;">Total Sireva <br /></th>
                                                    <th style="vertical-align: middle;">Inventaris+BHP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                ?>

                                                <?php $i = 1;
                                                foreach ($prodi as $p) {
                                                    $alokasi = 0;
                                                    foreach ($pagus as $pagu) {
                                                        if ($pagu->id_unit == $p->id) {
                                                            $alokasi = $pagu->pagu;
                                                        }
                                                    }
                                                    if ($p->nama_unit != 'Sekolah Vokasi') { ?>
                                                        <tr>
                                                            <td bgcolor="#e7ecee">{{$i}}</td>
                                                            <td bgcolor="#f1f1f1">{{$p->nama_unit}}</td>
                                                            <td>{{ 'Rp. ' . number_format($alokasi)}}</td>
                                                            <?php
                                                            $tot_iku1 = 0;
                                                            $tot_iku2 = 0;
                                                            $tot_iku3 = 0;
                                                            $tot_iku4 = 0;
                                                            $tot_iku5 = 0;
                                                            $tot_iku6 = 0;
                                                            $tot_iku7 = 0;
                                                            $tot_iku8 = 0;
                                                            $tot_iku9 = 0;
                                                            $tot_iku10 = 0;
                                                            $total_sireva = 0;
                                                            foreach ($ang_iku as $anggaran_iku) {

                                                                foreach ($pengajuan as $pengajuans) {
                                                                    foreach ($status as $stat) {
                                                                        foreach ($triwulan as $tw) {
                                                                            if ($pengajuans->id_status == $stat->id && $stat->nama_status == 'Proses Pengajuan' && $pengajuans->id_tor == $anggaran_iku->id && $tw->id == $anggaran_iku->id_tw) {
                                                                                // $stat->nama_status;


                                                                                if ($anggaran_iku->id_unit == $p->id) {
                                                                                    $total_sireva += $anggaran_iku->jumlah_anggaran;
                                                                                    foreach ($subk as $sk) {
                                                                                        if ($sk->id == $anggaran_iku->id_subK) {
                                                                                            foreach ($ik as $iks) {
                                                                                                if ($sk->Kegiatan->id_ik == $iks->id) {
                                                                                                    // echo  $p->nama_unit . " - " . $anggaran_iku->nama_kegiatan . " - " . $iks->IndikatorIKU->IKU . ' Rp. ' . number_format($anggaran_iku->jumlah_anggaran) . " - " . $tw->tahun->tahun . " " . $tw->triwulan . " <br />";
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU001") {
                                                                                                        $tot_iku1 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU002") {
                                                                                                        $tot_iku2 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU003") {
                                                                                                        $tot_iku3 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU004") {
                                                                                                        $tot_iku4 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU005") {
                                                                                                        $tot_iku5 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU006") {
                                                                                                        $tot_iku6 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU007") {
                                                                                                        $tot_iku7 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU008") {
                                                                                                        $tot_iku8 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU009") {
                                                                                                        $tot_iku9 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                    if ($iks->IndikatorIKU->IKU == "IKU010") {
                                                                                                        $tot_iku10 += $anggaran_iku->jumlah_anggaran;
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <td>
                                                                @if($tot_iku1 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku1) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku2 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku2) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku3 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku3) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku4 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku4) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku5 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku5) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku6 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku6) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku7 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku7) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku8 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku8) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku9 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku9) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($tot_iku10 != 0)
                                                                {{ 'Rp. ' . number_format($tot_iku10) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($total_sireva != 0)
                                                                {{ 'Rp. ' . number_format($total_sireva) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($total_sireva != 0)
                                                                {{ 'Rp. ' . number_format($alokasi - $total_sireva) }}
                                                                @endif
                                                            </td>
                                                        </tr>

                                                <?php $i += 1;
                                                    }
                                                } ?>
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

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            <?php date_default_timezone_set('Asia/Jakarta'); ?>
            $('#monitoring').DataTable({
                // scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: true,
                // columnDefs: [{
                //     width: 200,
                //     targets: 0
                // }],
                fixedColumns: {
                    left: 2,
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'print',
                    {
                        extend: 'excelHtml5',
                        title: 'Monitoring Indikator Kinerja Utama_<?= date('Y-m-d H-i-s'); ?>'
                    },

                    {
                        extend: 'pdfHtml5',
                        title: 'Monitoring Indikator Kinerja Utama_<?= date('Y-m-d H-i-s'); ?>',
                        orientation: 'landscape'
                    }
                ]
            });
        });
    </script>
    @include('dashboards/users/layouts/footer')
</body>

</html>