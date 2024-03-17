<?php

use Illuminate\Support\Facades\Auth;

?>
@include('dashboards/users/layouts/script')

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
                                        <h4 class="card-title">TRIWULAN

                                        </h4>
                                        <!-- Modal Tambah TOR -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="tambahpagu">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Triwulan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" method="post" action="{{ url('/triwulan/create') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Nama Triwulan</label>
                                                                <select name="triwulan" id="triwulan" class="form-control">
                                                                    <option value="triwulan-1">Triwulan 1</option>
                                                                    <option value="triwulan-2">Triwulan 2</option>
                                                                    <option value="triwulan-3">Triwulan 3</option>
                                                                    <option value="triwulan-4">Triwulan 4</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tahun</label>
                                                                <select name="id_tahun" id="id_tahun" class="form-control">
                                                                    @foreach($tabeltahun as $pt)
                                                                    <option value="{{$pt->id}}">{{$pt->tahun}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Periode Awal</label>
                                                                <input name="periode_awal" id="periode_awal" type="date" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Periode Akhir</label>
                                                                <input name="periode_akhir" id="periode_akhir" type="date" class="form-control">
                                                            </div>
                                                            <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                            <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                    @can('triwulan_create')
                                    <button class="btn btn-primary" data-toggle="modal" title="Tambah TRIWULAN" data-original-title="Tambah TRIWULAN" data-target="#tambahpagu">
                                        <i class="fa fa-plus me-1"></i> Tambah Data
                                    </button>
                                    @endcan

                                    @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: "{{session('success')}}",
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    </script>
                                    @endif
                                    <span class="table-add float-right mr-2">
                                        <div class="form-group row">
                                            <form action="{{ url('/triwulan/filtertahun') }}" method="GET">
                                                <div class="row mr-3">
                                                    <div class="col mr-1">
                                                        <select class="form-control filter sm-8" name="tahun" id="input">
                                                            <option value="0">All</option>
                                                            <?php for ($thn = 0; $thn < count($tabeltahun); $thn++) { ?>
                                                                <option value="{{$tabeltahun[$thn]->id}}" {{$filtertahun==$tabeltahun[$thn]->id ? 'selected':''}}>{{$tabeltahun[$thn]->tahun}}</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                                                </div>
                                            </form>
                                        </div>
                                    </span>
                                    <div class="table-responsive table table-striped table-bordered">
                                        <div class="form-group row float-right mb-3 mr-2">
                                        </div>
                                        <table id="mytw" class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th scope="col">Triwulan</th>
                                                    <th scope="col">Tahun</th>
                                                    <th scope="col">Periode Awal</th>
                                                    <th scope="col">Periode Akhir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1; ?>
                                                <?php for ($a = 0; $a < count($triwulan); $a++) { ?>
                                                    <tr>
                                                        <td><a href="#">{{$num}}</a></td>
                                                        <td>{{$triwulan[$a]->triwulan}}</td>
                                                        <td>
                                                            <?php for ($c = 0; $c < count($tabeltahun); $c++) {
                                                                if ($tabeltahun[$c]->id == $triwulan[$a]->id_tahun) { ?>
                                                                    {{$tabeltahun[$c]->tahun}}
                                                            <?php }
                                                            } ?>
                                                        </td>
                                                        <td>{{$triwulan[$a]->periode_awal}}</td>
                                                        <td>{{$triwulan[$a]->periode_akhir}}</td>
                                                        <td>
                                                            <div class="flex align-items-center list-user-action">
                                                                @can('triwulan_update')
                                                                <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update Triwulan" data-original-title="Update Triwulan" href="" data-target="#update_tw<?= $triwulan[$a]->id ?>"><i class="ri-pencil-line"></i></a>
                                                                @endcan
                                                                @can('triwulan_delete')
                                                                <a class="iq-bg-danger tw-confirm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{url('/triwulan/delete/'.base64_encode($triwulan[$a]->id))}}"><i class="ri-delete-bin-line"></i></a>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Ubah TW -->
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="update_tw<?= $triwulan[$a]->id ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Ubah Triwulan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal" method="post" action="{{ url('/triwulan/update/'.$triwulan[$a]->id) }}">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label>Nama Triwulan </label>
                                                                            <select name="triwulan" id="triwulan" class="form-control">
                                                                                <option value="triwulan-1" {{substr($triwulan[$a]->triwulan,5) == 'triwulan-1' ? 'selected' : ''}}>Triwulan 1</option>
                                                                                <option value="triwulan-2" {{substr($triwulan[$a]->triwulan,5) == 'triwulan-2' ? 'selected' : ''}}>Triwulan 2</option>
                                                                                <option value="triwulan-3" {{substr($triwulan[$a]->triwulan,5) == 'triwulan-3' ? 'selected' : ''}}>Triwulan 3</option>
                                                                                <option value="triwulan-4" {{substr($triwulan[$a]->triwulan,5) == 'triwulan-4' ? 'selected' : ''}}>Triwulan 4</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Tahun</label>
                                                                            <select name="id_tahun" id="id_tahun" class="form-control">
                                                                                @foreach($tabeltahun as $pt)
                                                                                <option value="{{old('id_tahun',$triwulan[$a]->id_tahun)}}" {{$triwulan[$a]->id_tahun == $pt->id ? 'selected' : ''}}>{{$pt->tahun}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Periode Awal</label>
                                                                            <input name="periode_awal" id="periode_awal2" type="date" value="{{old('periode_awal',$triwulan[$a]->periode_awal)}}" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Periode Akhir</label>
                                                                            <input name="periode_akhir" id="periode_akhir2" type="date" value="{{old('periode_akhir',$triwulan[$a]->periode_akhir)}}" class="form-control">
                                                                        </div>
                                                                        <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                                        <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <script>
                                                        $('#periode_awal2').on('input', function() {
                                                            $('#periode_akhir2').attr('min', this.value);
                                                        });
                                                        $('#periode_akhir2').on('input', function() {
                                                            $('#periode_awal2').attr('max', this.value);
                                                        });
                                                    </script> -->
                                                    <?php $num += 1; ?>
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
    <!-- Wrapper END -->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.tw-confirm').on('click', function(event) {
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
    </script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#mytw').DataTable();
        });
    </script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
    <script>
        $('#periode_awal').on('input', function() {
            $('#periode_akhir').attr('min', this.value);
        });
        $('#periode_akhir').on('input', function() {
            $('#periode_awal').attr('max', this.value);
        });
    </script>
    @include('dashboards/users/layouts/footer')

    </html>