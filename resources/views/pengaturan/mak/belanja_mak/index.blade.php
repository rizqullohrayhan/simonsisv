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
                            <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/mak')}}" aria-selected="false">Kategori MAK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/kelompok_mak')}}" aria-selected="false">Kelompok MAK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{url('/belanja_mak')}}" aria-selected="true">Belanja MAK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/detail_mak')}}" aria-selected="true">Detail MAK</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content w-100" id="pills-tabContent-1">
                        <div class="tab-pane fade active show" id="pills-home-fill" role="tabpanel" aria-labelledby="pills-home-tab-fill">
                            <div class="col-sm-12">
                                <div class="iq-card">
                                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-text">Belanja MAK

                                                </h4>
                                                <!-- T A M B A H    -->
                                                <div class="modal fade" tabindex="-1" role="dialog" id="tambahBelMak">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Tambah Belanja MAK</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" method="post" action="{{ url('/belanja_mak/create') }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>Kelompok MAK</label>
                                                                        <select class="js-example-basic-single1" name="id_kelompok" id="id_kelompok" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                                                                            @foreach($kelompok_mak as $iniKel)
                                                                            <option value="{{$iniKel->id}}">{{$iniKel->kelompok}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Belanja Mak</label>
                                                                        <input name="belanja" id="belanja" type="text" class="form-control">
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
                                            @can('belanjamak_create')
                                            <button class="btn btn-primary" data-toggle="modal" title="Tambah Belanja MAK" data-original-title="Tambah Belanja MAK" data-target="#tambahBelMak">
                                                <i class="fa fa-plus me-1"></i> Tambah Data
                                            </button>
                                            @endcan
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
                                            <!-- <span class="table-add float-right mb-3 mr-2">
                                                <div class="form-group row">
                                                    <form action="{{ url('/searchBelanja') }}" method="GET">
                                                        <div class="row mr-3">
                                                            <div class="col mr-1">
                                                                <input type="text" id="searchKelompok" name="searchKelompok" class="form-control" placeholder="search Kelompok MAK">
                                                            </div>
                                                            <div class="col mr-1">
                                                                <input type="text" id="searchBelanja" name="searchBelanja" class="form-control" placeholder="search Belanja MAK">
                                                            </div>
                                                            <input type="submit" class="btn btn-primary btn-sm" value="Search">
                                                        </div>
                                                    </form>
                                                </div>
                                            </span> -->
                                            <div class="table-responsive">
                                                <div class="form-group row float-right mb-3 mr-2">
                                                </div>
                                                <table id="mybelmak" class="table mb-0 table table-striped table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th scope="col">MAK</th>
                                                            <th scope="col" width="30%">Kelompok MAK</th>
                                                            <th scope="col">Nama Belanja MAK</th>
                                                            <th scope="col" width="10%">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $num = 1; ?>
                                                        @foreach ($joinKelompok as $k2 => $join)
                                                        <?php //$num =  $joinKelompok->firstItem() + $k2 
                                                        ?>
                                                        <tr>
                                                            <td><a href="#">{{$num}}</a></td>
                                                            <td>{{$join->jenis_belanja}}</td>
                                                            <td>{{$join->kelompok}}</td>
                                                            <td>{{$join->belanja}}</td>
                                                            <td>
                                                                <div class="flex align-items-center list-user-action ml-3">
                                                                    <div class="row">
                                                                        @can('belanjamak_update')
                                                                        <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update Belanja" data-original-title="Update Belanja" href="" data-target="#update_bel<?= $join->idBelanja ?>"><i class="ri-pencil-line"></i></a>
                                                                        @endcan
                                                                        @can('belanjamak_delete')
                                                                        <a class="iq-bg-danger belanjamak-confirm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{url('/belanja_mak/delete/'.base64_encode($join->idBelanja))}}"><i class="ri-delete-bin-line"></i></a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal Ubah IK -->
                                                        <div class="modal fade" tabindex="-1" role="dialog" id="update_bel<?= $join->idBelanja ?>">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Update Belanja</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" method="post" action="{{ url('/belanja_mak/update/'.$join->idBelanja) }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label>Kelompok</label>
                                                                                <select aria-hidden="true" data-select2-id="select2-data-58-6f88" name="id_kelompok" id="id_kelompok_select" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                                                                                    <?php for ($b2 = 0; $b2 < count($kelompok_mak); $b2++) { ?>
                                                                                        <option value="{{$kelompok_mak[$b2]->id}}" {{$kelompok_mak[$b2]->id == $join->idKelompok ? 'selected' : ''}}>{{$kelompok_mak[$b2]->kelompok}}</option>
                                                                                    <?php
                                                                                    } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Belanja Mak</label>
                                                                                <input name="belanja" id="belanja" value="{{old('belanja',$join->belanja)}}" type="text" class="form-control">
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
                                            <?php $num += 1; ?>
                                            @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                        <!-- {{$joinKelompok->links() -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Wrapper END -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single1').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#id_kelompok_select').select2();
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.belanjamak-confirm').on('click', function(event) {
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
            $('#mybelmak').DataTable();
        });
    </script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
    @include('dashboards/users/layouts/footer')

</body>

</html>