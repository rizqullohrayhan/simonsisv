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
                                    <a class="nav-link" href="{{url('/iku')}}" aria-controls="pills-home" aria-selected="false">Indikator IKU</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/ik')}}" aria-controls="pills-home" aria-selected="false">Indikator IK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/k')}}" aria-controls="pills-home" aria-selected="false">Indikator K</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{url('/subk')}}" aria-controls="pills-home" aria-selected="false">Indikator SUB K</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-text">Sub Kegiatan

                                        </h4>
                                        <!-- Modal Tambah SUBK -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="tambahsubk">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah K</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" method="post" action="{{ url('/subk/create') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>K</label>
                                                                <select name="id_k" id="id_k" class="form-control">
                                                                    @foreach($k as $inik)
                                                                    <option value="{{$inik->id}}">{{$inik->K}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>SUB K</label>
                                                                <input name="subK" id="subK" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Deskripsi</label>
                                                                <input name="deskripsi" id="deskripsi" type="text" class="form-control">
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
                                    @can('subk_create')
                                    <button class="btn btn-primary" data-toggle="modal" title="Tambah SUB K" data-original-title="Tambah SUB K" data-target="#tambahsubk">
                                        <i class="fa fa-plus me-1"></i> Tambah Data
                                    </button>
                                    @endcan
                                    @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: "{{session('success')}}",
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                    </script>
                                    @endif

                                    <span class="table-add float-right mb-3 mr-2">
                                        <div class="form-group row">
                                            <!-- <form action="{{ url('/iku/filtertahun') }}" method="GET">
                                                    <div class="row mr-3">
                                                        <div class="col mr-1">
                                                            <select class="form-control filter sm-8" name="tahun" id="input">
                                                                <option value="0">All</option>
                                                                <?php
                                                                // for ($thn2 = 0; $thn2 < count($tabeltahun); $thn2++) { 
                                                                ?>
                                                                    <option value="$tabeltahun[$thn2]->id}}" $filtertahun==$tabeltahun[$thn2]->tahun ? 'selected':''}}>$tabeltahun[$thn2]->tahun}}</option>
                                                                <?php  ?>
                                                            </select>
                                                        </div>
                                                        <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                                                    </div>
                                                </form> -->
                                        </div>
                                    </span>
                                    <div class="table-responsive">
                                        <div class="form-group row float-right mb-3 mr-2">
                                        </div>
                                        <table id="mysubk" class="table mb-0 table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th scope="col">IKU</th>
                                                    <th scope="col">IK</th>
                                                    <th scope="col">K</th>
                                                    <th scope="col">SUB K</th>
                                                    <th width="50%" scope="col">Deskripsi</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1;
                                                $kodeIKU = 0;
                                                $kodeIK = 0;
                                                $kodeK = 0;
                                                ?>
                                                <?php foreach ($subk as $indexsubk => $k4) { ?>
                                                    <?php
                                                    // $num =  $subk->firstItem() + $indexsubk 
                                                    ?>
                                                    <tr>
                                                        <td><a href="#">{{$num}}</a></td>
                                                        <?php
                                                        for ($i = 0; $i < count($k); $i++) {
                                                            if ($k[$i]->id == $k4->id_k) {
                                                                $kodeK = $k[$i]->K;
                                                                for ($z = 0; $z < count($ik); $z++) {
                                                                    if ($ik[$z]->id == $k[$i]->id_ik) {
                                                                        $kodeIK = $ik[$z]->IK;
                                                                        for ($u = 0; $u < count($iku); $u++) {
                                                                            if ($iku[$u]->id == $ik[$z]->id_iku) {
                                                                                $kodeIKU = $iku[$u]->IKU;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        } ?>
                                                        <td>{{$kodeIKU}}</td>
                                                        <td>{{$kodeIK}}</td>
                                                        <td>{{$kodeK}}</td>
                                                        <td>{{$k4->subK}}</td>
                                                        <td>{{$k4->deskripsi}}</td>
                                                        <td>
                                                            <div class="flex align-items-center list-user-action">
                                                                @can('subk_update')
                                                                <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update K" data-original-title="Update SUB K" href="" data-target="#update_subk<?= $k4->id ?>"><i class="ri-pencil-line"></i></a>
                                                                @endcan
                                                                @can('subk_delete')
                                                                <a class="subk-confirm iq-bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{url('/subk/delete/'.base64_encode($k4->id))}}"><i class="ri-delete-bin-line"></i></a>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Ubah K -->
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="update_subk<?= $k4->id ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update K</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal" method="post" action="{{ url('/subk/update/'.$k4->id) }}">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label>K</label>
                                                                            <select name="id_k" id="id_k" class="form-control">
                                                                                @foreach($k as $inik)
                                                                                <option value="{{old('id_k',$inik->id)}}" {{$inik->id == $k4->id_k ? 'selected' : ''}}>{{$inik->K}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>SUB K</label>
                                                                            <input name="subK" id="subK" value="{{old('subK',$k4->subK)}}" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Deskripsi</label>
                                                                            <input name="deskripsi" id="deskripsi" value="{{old('deskripsi',$k4->deskripsi)}}" type="text" class="form-control">
                                                                        </div>
                                                                        <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                                        <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $('.subk-confirm').on('click', function(event) {
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
                $('#mysubk').DataTable();
            });
        </script>
        <script>
            // window.setTimeout(function() {
            //     $(".alert").fadeTo(500, 0).slideUp(500, function() {
            //         $(this).remove();
            //     });
            // }, 2000);
        </script>
        @include('dashboards/users/layouts/footer')
</body>

</html>