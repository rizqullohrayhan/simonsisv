<?php

use Illuminate\Support\Facades\Auth;

?>
@include('dashboards/users/layouts/script')

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
            {{-- @if ($RoleLogin != 'Prodi') --}}
            {{-- <h3 class="text-center">Welcome to SIMONSI (Sistem Monev Sekolah Vokasi) UNS, {{ Auth::user()->name }}
            </h3>
            <br> --}}
            {{-- @endif --}}

            {{-- <div class="row">
                
            </div> --}}

            {{-- Manajemen menu Dashboard --}}
            {{-- @can('dashboard') --}}
            <div class="row">
                
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-center table-primary">
                            <div class="iq-header-title">
                                <h5 class="card-title">REKAPITULASI AJUAN PER TW</h5>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="d-flex justify-content-end">
                                <div class="form-group row mr-3 mb-3">
                                    <div class="col mr-1">
                                        <select class="form-control filter sm-8" name="filterTahun" id="selectTahun">
                                            @foreach ($tahun as $thn)
                                                <option value="{{ base64_encode($thn->id) }}" {{$thn->tahun == date('Y') ? 'selected':''}}>{{$thn->tahun}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-4 mr-3">
                                        <select class="form-control filter sm-8" name="filterTw" id="filterTw">
                                            
                                        </select>
                                    </div>
                                    <div class="row mr-3">
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role == 5)
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height text-white bg-info">
                                        <div class="iq-card-body iq-box-relative">
                                            {{-- <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                                                <i class="ri-shopping-cart-line"></i>
                                            </div> --}}
                                            <p class="text-white">Total Ajuan Belum Dinilai</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="text-white" id="belum_dinilai"><b>{{ $belum_dinilai }}</b></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-info">
                                        <div class="iq-card-body iq-box-relative">
                                            {{-- <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                                                <i class="ri-todo-line"></i>
                                            </div> --}}
                                            <p class="text-white">Total Ajuan Revisi</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="text-white" id="revisi"><b>{{ $revisi }}</b></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-info">
                                        <div class="iq-card-body iq-box-relative">
                                            {{-- <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                                                <i class="ri-money-dollar-circle-line"></i>
                                            </div> --}}
                                            <p class="text-white">Total Ajuan Sudah Revisi</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="text-white" id="sudah_revisi"><b>{{ $sudah_revisi }}</b></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-info">
                                        <div class="iq-card-body iq-box-relative">
                                            {{-- <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                                                <i class="ri-task-line"></i>
                                            </div> --}}
                                            <p class="text-white">Total Ajuan Sudah Disetujui</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="text-white" id="sudah_dinilai"><b>{{ $sudah_dinilai }}</b></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div id="table" class="table-editable">
                                <table id="statistikPerTW" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th hidden>status_id</th>
                                            <th hidden>created_at</th>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Program Studi</th>
                                            <th>Tanggal Ajuan</th>
                                            <th>Penanggungjawab</th>
                                            <th>Status</th>
                                            <th>Verifikator</th>
                                            <th>Anggaran</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            {{-- @endcan --}}
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

    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
    <script>
        $(window).on("load", function () {
            let idTahun = $('#selectTahun').val();
            $.ajax({
                url: '{{route("home.getTriwulan")}}',
                type: 'GET',
                data: {
                    id: idTahun
                },
                success: function(res) {
                    $('#filterTw').empty();
                    $('#filterTw').append('<option value="0" selected>All</option>');
                    res.forEach(tri => {
                        $('#filterTw').append(`<option value="${tri.id}">${tri.triwulan}</option>`);
                    });
                }
            });
            $.ajax({
                url: '{{route("home.getData")}}',
                type: 'GET',
                data: {
                    id_tahun: idTahun,
                    id_triwulan: 0,
                },
                success: function(res) {
                    $('#belum_dinilai').html(`<b>${res.belum_dinilai}</b>`);
                    $('#revisi').html(`<b>${res.revisi}</b>`);
                    $('#sudah_revisi').html(`<b>${res.sudah_revisi}</b>`);
                    $('#sudah_dinilai').html(`<b>${res.sudah_dinilai}</b>`);
                }
            });
            $('#statistikPerTW').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                search: false,
                pageLength: 5,
                ajax: "{{ route('home.data') }}?tahun=" + idTahun + "&triwulan=0",
                columns: [
                    {data: 'id_status', visible: false },
                    {data: 'created_at', visible: false },
                    {data: 'DT_RowIndex'},
                    {data: 'nama_kegiatan'},
                    {data: 'nama_unit'},
                    {data: 'tgl_ajuan'},
                    {data: 'nama_pic'},
                    {data: 'current_status'},
                    {data: 'validator.name'},
                    {data: 'jumlah_anggaran'},
                ],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"],
                ],
                order: [[0, 'asc'], [1, 'desc']]
            });
        });

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
    <script>
        $('#selectTahun').on('change', function() {
            let idTahun = $(this).val();
            $.ajax({
                url: '{{route("home.getTriwulan")}}',
                type: 'GET',
                data: {
                    id: idTahun
                },
                success: function(res) {
                    $('#filterTw').empty();
                    $('#filterTw').append('<option value="0" selected>All</option>');
                    res.forEach(tri => {
                        $('#filterTw').append(`<option value="${tri.id}">${tri.triwulan}</option>`);
                    });
                }
            });
            $.ajax({
                url: '{{route("home.getData")}}',
                type: 'GET',
                data: {
                    id_tahun: idTahun,
                    id_triwulan: 0,
                },
                success: function(res) {
                    $('#belum_dinilai').html(`<b>${res.belum_dinilai}</b>`);
                    $('#revisi').html(`<b>${res.revisi}</b>`);
                    $('#sudah_revisi').html(`<b>${res.sudah_revisi}</b>`);
                    $('#sudah_dinilai').html(`<b>${res.sudah_dinilai}</b>`);
                }
            });
            $('#statistikPerTW').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                search: false,
                pageLength: 5,
                ajax: "{{ route('home.data') }}?tahun=" + idTahun + "&triwulan=0",
                columns: [
                    {data: 'id_status', visible: false },
                    {data: 'created_at', visible: false },
                    {data: 'DT_RowIndex'},
                    {data: 'nama_kegiatan'},
                    {data: 'nama_unit'},
                    {data: 'tgl_ajuan'},
                    {data: 'nama_pic'},
                    {data: 'current_status'},
                    {data: 'validator.name'},
                    {data: 'jumlah_anggaran'},
                ],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"],
                ],
                order: [[0, 'asc'], [1, 'desc']]
            });
        });
        $('#filterTw').on('change', function() {
            let idTahun = $('#selectTahun').val();
            let idTriwulan = $(this).val();
            $.ajax({
                url: '{{route("home.getData")}}',
                type: 'GET',
                data: {
                    id_tahun: idTahun,
                    id_triwulan: idTriwulan,
                },
                success: function(res) {
                    $('#belum_dinilai').html(`<b>${res.belum_dinilai}</b>`);
                    $('#revisi').html(`<b>${res.revisi}</b>`);
                    $('#sudah_revisi').html(`<b>${res.sudah_revisi}</b>`);
                    $('#sudah_dinilai').html(`<b>${res.sudah_dinilai}</b>`);
                }
            });
            $('#statistikPerTW').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                search: false,
                pageLength: 5,
                ajax: "{{ route('home.data') }}?tahun=" + idTahun + "&triwulan=" + idTriwulan,
                columns: [
                    {data: 'id_status', visible: false },
                    {data: 'created_at', visible: false },
                    {data: 'DT_RowIndex'},
                    {data: 'nama_kegiatan'},
                    {data: 'nama_unit'},
                    {data: 'tgl_ajuan'},
                    {data: 'nama_pic'},
                    {data: 'current_status'},
                    {data: 'validator.name'},
                    {data: 'jumlah_anggaran'},
                ],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"],
                ],
                order: [[0, 'asc'], [1, 'desc']]
            });
        });
    </script>

    <!-- Footer -->
    @include('dashboards/users/layouts/footer')
    {{-- </html> --}}