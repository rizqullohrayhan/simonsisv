@include('dashboards/users/layouts/script')

{{-- Fungsi untuk ngecek triwulan --}}
<?php
function ngecekWulan($awal, $akhir)
{
    if (new datetime(date('Y-m-d')) >= new datetime($awal) && new datetime(date('Y-m-d')) <= new datetime($akhir) && !empty($filtertw)) {
        return true;
    }
    return false;
}

function getIsi($data)
{
    if (!empty($data)) {
        return $data;
    } else {
        return 'Semua';
    }
}

$tahunTw = [];
$triwulanTw = [];

for ($tw1 = 0; $tw1 < count($tw); $tw1++) {
    foreach ($tahun as $thn) {
        if ($thn->is_aktif == 1) {
            $tahunTw[substr($tw[$tw1]->triwulan, 0, 4)] = substr($tw[$tw1]->triwulan, 0, 4);
            $triwulanTw[substr($tw[$tw1]->triwulan, -1, 1)] = substr($tw[$tw1]->triwulan, -1, 1);
        }
    }
}
?>

<body>
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>

    @include('dashboards/users/layouts/navbar')
    @include('dashboards/users/layouts/sidebar')
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <?php
                // Ambil data Total Pagu Fakultas SV dari tabel Pagu
                $total_pagu = 0;
                foreach ($pagu as $data) {
                    $total_pagu += $data['pagu'];
                }
                
                // Ambil data Jumlah Realisasi dari SPJ
                $total_realisasi = 0;
                foreach ($spj as $nilai) {
                    $total_realisasi += $nilai['nilai_total'];
                }
                
                // Ambil data Sisa
                $total_sisa = $total_pagu - $total_realisasi;
                ?>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                            <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-primary">
                                <i class="ri-focus-2-line"></i>
                            </div>
                            <p class="text-secondary">Total Pagu Fakultas Sekolah Vokasi</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4><b>{{ 'Rp ' . number_format($total_pagu) }}</b></h4>
                                <div id="iq-chart-box1"></div>
                                <span class="text-primary"><b>100.00 %</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                            <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-danger">
                                <i class="ri-database-2-line"></i>
                            </div>
                            <p class="text-secondary">Total Realisasi Pagu</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4><b>{{ 'Rp ' . number_format($total_realisasi) }}</b></h4>
                                <div id="iq-chart-box2"></div>
                                <span class="text-danger">
                                    <b>{{ !empty($total_pagu) ? number_format(($total_realisasi / $total_pagu) * 100, 2, '.', '') : number_format(0) }}%
                                    </b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                            <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                                <i class="ri-pie-chart-2-line"></i>
                            </div>
                            <p class="text-secondary">Total Sisa Pagu</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4><b>{{ 'Rp ' . number_format($total_sisa) }}</b></h4>
                                <div id="iq-chart-box3"></div>
                                <span
                                    class="text-warning"><b>{{ !empty($total_pagu) ? number_format(($total_sisa / $total_pagu) * 100, 2, '.', '') : number_format(0) }}%</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between table-primary">
                            <div class="iq-header-title col-sm-7 align-items-center">
                                <h4 class="card-title">REKAPITULASI AJUAN KAK-RAB</h4>
                            </div>

                            {{-- Filter Triwulan --}}
                            <div class="iq-header-toolbar col-sm-4 mt-3 d-flex justify-content-end">
                                <div class="form-group row mb-0">
                                    <span class="table-add mb-0">
                                        <div class="form-group row">
                                            <form action="{{ url('/monitoring_kak/filterTw') }}" method="GET">
                                                <div class="row mr-3">
                                                    <div class="mr-1">
                                                        <select class="form-control filter" name="tahunTw"
                                                            id="tahunTw">
                                                            <option value="">All</option>
                                                            <?php foreach ($tahunTw as $key=>$isi) { ?>
                                                            <option value="{{ base64_encode($key) }}"
                                                                {{ !empty($getTahun) && $getTahun == $isi ? 'selected' : '' }}>
                                                                {{ $isi }}
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col mr-1">
                                                        <select class="form-control filter" name="triwulanTw"
                                                            id="triwulanTw">
                                                            <option value="">All</option>
                                                            <?php foreach ($triwulanTw as $isi) { ?>
                                                            <option value="{{ base64_encode($isi) }}"
                                                                {{ !empty($getTriwulan) && $getTriwulan == $isi ? 'selected' : '' }}>
                                                                {{ 'Triwulan ' . $isi }}
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                                                </div>
                                            </form>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-editable">
                                <table id="datatable"
                                    class="table table-bordered table-responsive-md table-hover
                                    text-center">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle; width: 3%">No</th>
                                            <th rowspan="2" style="vertical-align: middle; width: 20%">Program Studi
                                            <th rowspan="2" style="vertical-align: middle; width: 12%">Pagu
                                                {{ getIsi($getTahun) }}</th>
                                            </th>
                                            <?php
                                            $nomorTw = 0;
                                            $tanggalTw = '';
                                            $tahunTw = '';
                                            $tw1 = 'Per 31 Maret ';
                                            $tw2 = 'Per 30 Juni ';
                                            $tw3 = 'Per 30 September ';
                                            $tw4 = 'Per 31 Desember ';
                                            foreach ($tw as $twname) {
                                                if ($twname->id == $filtertw) {
                                                    // ngambil nomor TW dari Filter yang dipilih
                                                    $nomorTw = substr($twname->triwulan, -1, 1);
                                            
                                                    // ngambil Tahun TW dari Filter yang dipilih
                                                    $tahunTw = substr($twname->triwulan, 0, 4);
                                            
                                                    // permisalan untuk menyesuaikan tanggal sesuai dengan nomor TW
                                                    if ($nomorTw == 1) {
                                                        $tanggalTw = $tw1;
                                                    } elseif ($nomorTw == 2) {
                                                        $tanggalTw = $tw2;
                                                    } elseif ($nomorTw == 3) {
                                                        $tanggalTw = $tw3;
                                                    } elseif ($nomorTw == 4) {
                                                        $tanggalTw = $tw4;
                                                    }
                                                }
                                            }
                                            
                                            // Jika Filter Triwulan adalah ALL (menampilkan semua data)
                                            if (!empty($filtertw) && is_array($filtertw)) {
                                            ?>
                                            <th colspan="6">
                                                {{ 'Laporan Tahun ' . getIsi($getTahun) . ' (Triwulan ' . getIsi($getTriwulan) . ')' }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 12%">RPD TW 1</th>
                                            <th style="width: 12%">RPD TW 2</th>
                                            <th style="width: 12%">RPD TW 3</th>
                                            <th style="width: 12%">RPD TW 4</th>
                                            <th style="width: 12%">KAK - Disetujui</th>
                                            <th style="width: 12%">Sisa Anggaran Pagu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            } 

                                            // Jika Filter Triwulan adalah Triwulan tertentu
                                            else {
                                            ?>
                                        <th colspan="5">
                                            {{ 'Triwulan ' . $nomorTw . ' (' . $tanggalTw . $tahunTw . ')' }}
                                        </th>
                                        </tr>
                                        <tr>
                                            <th>RPD</th>
                                            <th>KAK - Disetujui</th>
                                            <th>KAK - Revisi</th>
                                            <th>KAK - Review</th>
                                            <th>Sisa Anggaran Pagu</th>
                                        </tr>
                                        </thead>
                                    <tbody>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Script Datatable --}}
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>

    <?php if (!empty($filtertw) && is_array($filtertw)) { ?>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                search: false,
                pageLength: 5,
                ajax: {
                    "url": "{{ route('kak.dataAll') }}",
                    "data": {
                        "filtertw": "{{ $filtertw }}"
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'unit',
                        name: 'unit'
                    },
                    {
                        data: 'pagu',
                        name: 'pagu'
                    },
                    {
                        data: 'rpd1',
                        name: 'rpd1'
                    },
                    {
                        data: 'rpd2',
                        name: 'rpd2'
                    },
                    {
                        data: 'rpd3',
                        name: 'rpd3'
                    },
                    {
                        data: 'rpd4',
                        name: 'rpd4'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'sisa',
                        name: 'sisa'
                    },
                ],
            });
        });
    </script>
    <?php    
    } else {
    ?>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                search: false,
                pageLength: 5,
                ajax: {
                    "url": "{{ route('kak.dataTw') }}",
                    "data": {
                        "filtertw": "{{ $filtertw }}"
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'unit',
                        name: 'unit'
                    },
                    {
                        data: 'pagu',
                        name: 'pagu'
                    },
                    {
                        data: 'rpd',
                        name: 'rpd'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'review',
                        name: 'review'
                    },
                    {
                        data: 'revisi',
                        name: 'revisi'
                    },
                    {
                        data: 'sisa',
                        name: 'sisa'
                    },
                ],

            });
        });
    </script>
    <?php } ?>
    <!-- Footer -->
    @include('dashboards/users/layouts/footer')
</body>

</html>
