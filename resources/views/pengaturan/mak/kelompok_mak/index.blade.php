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
                                    <a class="nav-link active" href="{{url('/kelompok_mak')}}" aria-selected="true">Kelompok MAK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/belanja_mak')}}" aria-selected="false">Belanja MAK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/detail_mak')}}" aria-selected="true">Detail MAK</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-text">Kelompok MAK

                                        </h4>
                                        <!-- T A M B A H   -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="tambahKelMak">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Kelompok MAK</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" method="post" action="{{ url('/kelompok_mak/create') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>MAK</label>
                                                                <select name="id_mak" id="id_mak" class="form-control">
                                                                    @foreach($mak as $iniMak)
                                                                    <option value="{{$iniMak->id}}">{{$iniMak->jenis_belanja}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Kelompok Mak</label>
                                                                <input name="kelompok" id="kelompok" type="text" class="form-control">
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
                                    @can('kelompokmak_create')
                                    <button class="btn btn-primary" data-toggle="modal" title="Tambah MAK" data-original-title="Tambah MAK" data-target="#tambahKelMak">
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
                                    <!-- <span class="table-add float-right mb-3 mr-2">
                                        <div class="form-group row"> -->
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
                                    <!-- </div>
                                    </span> -->
                                    <div class="table-responsive">
                                        <div class="form-group row float-right mb-3 mr-2">
                                        </div>
                                        <table id="mykelmak" class="table mb-0 table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th scope="col">Kategori MAK</th>
                                                    <th scope="col">Nama Kelompok MAK</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1;
                                                for ($k2 = 0; $k2 < count($kelompok_mak); $k2++) { ?>
                                                    <?php //$num =  $kelompok_mak->firstItem() + $k2 
                                                    ?>
                                                    <tr>
                                                        <td><a href="#">{{$num}}</a></td>
                                                        <?php for ($sk2 = 0; $sk2 < count($mak); $sk2++) {
                                                            if ($mak[$sk2]->id == $kelompok_mak[$k2]->id_mak) { ?>
                                                                <td>{{$mak[$sk2]->jenis_belanja}}</td>
                                                        <?php }
                                                        } ?>
                                                        <td>{{$kelompok_mak[$k2]->kelompok}}</td>
                                                        <td>
                                                            <div class="flex align-items-center list-user-action">
                                                                @can('kelompokmak_update')
                                                                <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update MAK" data-original-title="Update MAK" href="" data-target="#update_kel<?= $kelompok_mak[$k2]->id ?>"><i class="ri-pencil-line"></i></a>
                                                                @endcan
                                                                @can('kelompokmak_delete')
                                                                <a class="iq-bg-danger kelompokmak-confirm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{url('/kelompok_mak/delete/'.base64_encode($kelompok_mak[$k2]->id))}}"><i class="ri-delete-bin-line"></i></a>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Ubah IK -->
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="update_kel<?= $kelompok_mak[$k2]->id ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update Kelompok MAK</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal" method="post" action="{{ url('/kelompok_mak/update/'.$kelompok_mak[$k2]->id) }}">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label>MAK</label>
                                                                            <select name="id_mak" id="id_mak" class="form-control">
                                                                                @foreach($mak as $iniMak)
                                                                                <option value="{{$iniMak->id}}" {{$iniMak->id == $kelompok_mak[$k2]->id_mak ? 'selected' : ''}}>{{$iniMak->jenis_belanja}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Nama Kelompok</label>
                                                                            <input name="kelompok" id="kelompok" value="{{old('kelompok',$kelompok_mak[$k2]->kelompok)}}" type="text" class="form-control">
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
                                <?php } ?>
                                </tbody>
                                </table>
                                </div><br />
                                <!-- {{$kelompok_mak->links() -->
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
        $('.kelompokmak-confirm').on('click', function(event) {
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
            $('#mykelmak').DataTable();
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