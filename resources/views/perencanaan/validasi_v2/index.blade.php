<?php

use Illuminate\Support\Facades\Auth;
?>
<!--
    HALAMAN VALIDASI UNTUK BPU, WD 2, WD 3, STAF KEU, STAF PERENCANAAN
 -->
@include('dashboards/users/layouts/script')

<!-- ------------------------------- G A N T I    T A M P I L A N -------------------------------- -->
<!-- ------------------------------- G A N T I    T A M P I L A N -------------------------------- -->
<!-- ------------------------------- G A N T I    T A M P I L A N -------------------------------- -->

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
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">VALIDASI DAN VERIFIKASI
                                        <br />
                                    </h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="d-flex justify-content-end">
                                    <div class="form-group row mr-3 mb-3">
                                        <div class="col mr-1">
                                            <select class="form-control filter sm-8" name="filterTahun" id="selectnya" onchange="Ganti()">
                                                <?php foreach ($tabeltahun as $thn) {
                                                    if ($thn->is_aktif == 1) { ?>
                                                        <option value="{{ base64_encode($thn->id) }}" {{$filterTahun==$thn->id ? 'selected':''}}>{{$thn->tahun}}</option>
                                                <?php
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 mr-3">
                                            <select class="form-control filter sm-8" name="filterTw" id="filterTw" onchange="GantiTahun()">
                                                <option value="0">All</option>
                                                <?php
                                                for ($tw1 = 0; $tw1 < count($tw); $tw1++) {
                                                    foreach ($tabeltahun as $thn) {
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
                                        <div class="row mr-3">
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-pills nav-fill" id="pills-tab-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link status active" style="cursor: pointer;" data-status="1" aria-controls="pills-home" aria-selected="false">Belum Dinilai</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link status" style="cursor: pointer;" data-status="2" aria-controls="pills-home" aria-selected="false">Revisi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link status" style="cursor: pointer;" data-status="3" aria-controls="pills-home" aria-selected="false">Sudah Revisi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link status" style="cursor: pointer;" data-status="4" aria-controls="pills-home" aria-selected="false">Sudah Disetujui</a>
                                    </li>
                                </ul>
                                <hr style="margin-top: 0">
                                <table id="monitoring" class="table table-striped responsive">
                                    <thead class="bg-primary" style="color: white;">
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

                                    <tbody id="show_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- Modal status --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="detail_tor">
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

    
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

    <script>
        let tahun = $('#selectnya').val();
        let triwulan = $('#filterTw').val();
        let status = 1;

        const initializeDataTable = (tahun, triwulan, status) => {
            return $("#monitoring").DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: `{{route('validasi.data')}}?tahun=${tahun}&triwulan=${triwulan}&status=${status}`,
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'triwulan.triwulan'},
                    {data: 'unit.nama_unit'},
                    {data: 'nama_kegiatan'},
                    {data: 'jenis_ajuan'},
                    {data: 'tgl_mulai_pelaksanaan'},
                    {data: 'pic.name'},
                    {data: 'jumlah_anggaran'},
                    {data: 'status'},
                    {data: 'id'},
                ],
            });
        };

        let table = initializeDataTable(tahun, triwulan, status);

        $('#selectnya').change(function() {
            Ganti();
            tahun = $(this).val();
            table = initializeDataTable(tahun, triwulan, status);
        })

        $('#filterTw').change(function() {
            GantiTahun();
            triwulan = $(this).val();
            table = initializeDataTable(tahun, triwulan, status);
        })

        $('.status').click(function() {
            $('.status').removeClass('active');
            $(this).addClass('active');
            status = $(this).data('status');
            table = initializeDataTable(tahun, triwulan, status);
        })

        $('#show_data').on('click', '.btn-detail', function() {
            let id = $(this).data('id');
            let url = "{{route('validasi.detail.status', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',
                success: function (res) {
                    $('.iq-timeline').empty();
                    res.forEach(trxStatus => {
                        // String tanggal dari server
                        let dateString = trxStatus.created_at;
                        let date = dateString.slice(0, 10);

                        let list = `
                            <li>
                                <div class="${trxStatus.status.warna_lingkar}"><i class="ri-check-fill" style="color:black"></i></div>
                                <div class="${trxStatus.status.warna_lingkar}"><i class="ri-check-fill" style="color:black"></i></div>
                                <div class="row">
                                    <div class="col">
                                        <h6 style="text-align:left;">
                                            ${trxStatus.status.nama_status}
                                            <br/> - create by : ${trxStatus.user.name}
                                        </h6>
                                    </div>
                                    <div class="col">
                                        <small style="font-size: smaller;color:grey" class="float-right mt-1">${date}</small>
                                    </div>
                                </div>
                            </li>
                            <br />
                        `;
                        $('.iq-timeline').append(list);
                        $('#detail_tor').modal('show');
                    });
                }
            })
        })
    </script>
    @include('dashboards/users/layouts/footer')

</body>

</html>