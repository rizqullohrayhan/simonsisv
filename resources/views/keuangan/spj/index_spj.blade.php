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

    @include('dashboards/users/layouts/navbar')
    @include('dashboards/users/layouts/sidebar')
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between table-danger">
                            <div class="iq-header-title">
                                <h4 class="card-title">REKAPITULASI SURAT PERTANGGUNGJAWABAN (SPJ)</h4>
                            </div>

                            {{-- Filter Tahun dan Triwulan --}}
                            <div class="iq-header-toolbar col-sm-4 mt-3 d-flex justify-content-end">
                                <div class="form-group row mb-0">
                                    <span class="table-add mb-0">
                                        <div class="form-group row">
                                            <form action="{{ url('/spj/filterTw') }}" method="GET">
                                                <div class="row mr-3">
                                                    <div class="col mr-1">
                                                        <select class="form-control filter sm-8" name="filterTahun"
                                                            id="selectnya" onchange="Ganti()">
                                                            <!-- <option value="0">All</option> -->
                                                            <?php foreach ($tahun as $thn) {
                                                                        if ($thn->is_aktif == 1) { ?>
                                                            <option value="{{ base64_encode($thn->id) }}"
                                                                {{ $filterTahun == $thn->id ? 'selected' : '' }}>
                                                                {{ $thn->tahun }}</option>
                                                            <?php
                                                                        }
                                                                    } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col mr-1">
                                                        <select class="form-control filter sm-8" name="filterTw"
                                                            id="filterTw" onchange="GantiTahun()">
                                                            <option value="0">All</option>
                                                            <?php
                                                                    for ($tw1 = 0; $tw1 < count($tw); $tw1++) {
                                                                        foreach ($tahun as $thn) {
                                                                            if ($thn->is_aktif == 1) {
                                                                                if ($thn->tahun == substr($tw[$tw1]->triwulan, 0, 4)) {  ?>
                                                            <option value="{{ base64_encode($tw[$tw1]->id) }}"
                                                                id="options"
                                                                {{ $filtertw == $tw[$tw1]->id ? 'selected' : '' }}>
                                                                {{ 'Triwulan ' . substr($tw[$tw1]->triwulan, -1, 1) }}
                                                            </option>
                                                            <?php   }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                    <input type="submit" class="btn btn-danger btn-sm" value="Filter">
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
                                                                $('select[id="filterTw"]').append('<option value="' + btoa(tws.id) + '">' + tws
                                                                    .triwulan + '</option>');
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
                                                                $('select[id="selectnya"]').append('<option value="' + btoa(thn.id) + '">' + thn
                                                                    .tahun + '</option>');
                                                            });
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div id="table" class="table-editable">
                                <span class="table-add float-right mb-3 mr-2">
                                    <button class="btn btn-info mb-3" title="Input SPJ Baru" data-toggle="modal"
                                        data-target="#spj_file">
                                        <i class="las la-file-alt"></i><span class="pl-1">SPJ File
                                        </span></i>
                                    </button>
                                </span>
                                <table id="datatable"
                                    class="table table-bordered table-responsive-md table-hover text-center">
                                    <thead class="bg-danger">
                                        <tr>
                                            <th style="vertical-align : middle;text-align:center;">No
                                            </th>
                                            <th style="vertical-align : middle;text-align:center;">
                                                Nama Unit/Prodi/Ormawa</th>
                                            <th style="vertical-align : middle;text-align:center;">
                                                Nomor Memo Cair</th>
                                            <th style="vertical-align : middle;text-align:center;">
                                                Judul Kegiatan</th>
                                            <th style="vertical-align : middle;text-align:center;">
                                                Penanggungjawab</th>
                                            <th style="vertical-align : middle;text-align:center;">Status</th>
                                            <th style="vertical-align : middle;text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL - SPJ FILE -->
    @include('keuangan/spj/spj_file')

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                search: false,
                pageLength: 5,
                ajax: {
                    "url": "{{ route('spj.data') }}",
                    "data": {
                        "filtertw": "{{ $filtertw }}",
                        "filterTahun": "{{ $filterTahun }}"
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan'
                    },
                    {
                        data: 'no_memo',
                        name: 'no_memo'
                    },
                    {
                        data: 'prodi',
                        name: 'prodi'
                    },
                    {
                        data: 'pic',
                        name: 'pic'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'button',
                        name: 'button'
                    },
                ],
            });
        });
    </script>


    <!-- Footer -->
    @include('dashboards/users/layouts/footer')

</body>

</html>

<script type="text/javascript">
    // Memunculkan Button Update Status sesuai Status yang dimiliki
    function pengajuan(id) {
        document.getElementById('revisispj' + id).style.display = 'none';
    }

    function revisi(id) {
        document.getElementById('revisispj' + id).style.display = 'block';
    }

    function verifikasi(id) {
        document.getElementById('revisispj' + id).style.display = 'none';
    }

    function spjselesai(id) {
        document.getElementById('revisispj' + id).style.display = 'none';
    }

    // Memunculkan input tambah file tf untuk pelunasan spj
    function belumselesai(id) {
        document.getElementById('input_tf' + id).style.display = 'block';
    }

    function selesai(id) {
        document.getElementById('input_tf' + id).style.display = 'none';
    }
</script>
