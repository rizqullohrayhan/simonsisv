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
                        <div class="iq-card-header d-flex justify-content-between table-info">
                            <div class="iq-header-title">
                                <h4 class="card-title">REKAPITULASI PENCAIRAN DANA & AJUAN PERSEKOT KERJA</h4>
                            </div>

                            {{-- Filter Tahun dan Triwulan --}}
                            <div class="iq-header-toolbar col-sm-4 mt-3 d-flex justify-content-end">
                                <div class="form-group row mb-0">
                                    <span class="table-add mb-0">
                                        <div class="form-group row">
                                            <form action="{{ url('/persekot_kerja/filterTw') }}" method="GET">
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
                                                    <input type="submit" class="btn btn-info btn-sm" value="Filter">
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
                            <div class="table-editable">

                                <table id="datatable" class="table table-bordered table-responsive-md table-hover">
                                    <thead class="text-center align-center">
                                        <tr class="bg-info">
                                            <th style="width: 3%">No</th>
                                            <th style="width: 32%">Judul Kegiatan</th>
                                            <th style="width: 20%">Nama Unit/Prodi/Ormawa</th>
                                            <th style="width: 20%">Penanggungjawab Kegiatan</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 10%">Aksi</th>
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
                    "url": "{{ route('persekot_kerja.data') }}",
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
