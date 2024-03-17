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
                                    <a class="nav-link active" href="{{url('/k')}}" aria-controls="pills-home" aria-selected="false">Indikator P</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{url('/subk')}}" aria-controls="pills-home" aria-selected="false">Indikator SUB K</a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent-1" style="width: 100%">
                        <div class="tab-pane fade active show" id="pills-home-fill" role="tabpanel" aria-labelledby="pills-home-tab-fill">
                            <div class="col-sm-12">
                                <div class="iq-card">
                                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-text">Indikator Kegiatan

                                                </h4>
                                                <!-- Modal Tambah k -->
                                                <div class="modal fade" tabindex="-1" role="dialog" id="tambahk">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Tambah P</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" method="post" action="{{ url('/k/create') }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>IK</label>
                                                                        <select name="id_ik" id="id_ik" class="form-control">
                                                                            @foreach($ik as $iniIk)
                                                                            <option value="{{$iniIk->id}}">{{$iniIk->IK}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>P</label>
                                                                        <input name="P" id="K" type="text" class="form-control">
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
                                                <div class="modal fade" tabindex="-1" role="dialog" id="importP">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Import P</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" method="post" action="{{ url('/k/import') }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="input-group mb-3">
                                                                        <div class="custom-file">
                                                                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" 
                                                                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                        </div>
                                                                        {{-- <div class="input-group-prepend">
                                                                            <span class="input-group-text">Upload</span>
                                                                        </div> --}}
                                                                    </div>
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
                                            @can('k_create')
                                            <button class="btn btn-primary" data-toggle="modal" title="Tambah P" data-original-title="Tambah P" data-target="#tambahk">
                                                <i class="fa fa-plus me-1"></i> Tambah Data
                                            </button>
                                            <button class="btn btn-success" data-toggle="modal" title="Import Data" data-original-title="Import P" data-target="#importP">
                                                <i class="fa fa-plus me-1"></i> Import Data
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
                                            <div class="table-responsive">
                                                {{-- <div class="form-group row float-right mb-3 mr-2">
                                                </div> --}}
                                                <table id="myk" class="table mb-0 table table-striped table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th width="5%">No.</th>
                                                            <th scope="col">IKU</th>
                                                            <th scope="col">IK</th>
                                                            <th scope="col">P</th>
                                                            <th scope="col">Deskripsi</th>
                                                            <th scope="col" width="8%">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $num = 1;?>
                                                        <?php foreach ($k as $indexK => $indikatorK) { ?>
                                                            <tr>
                                                                <td>{{$num}}</td>
                                                                <td>{{$indikatorK->IKU}}</td>
                                                                <td>{{$indikatorK->IK}}</td>
                                                                <td>{{$indikatorK->P}}</td>
                                                                <td>{{$indikatorK->deskripsi}}</td>
                                                                <td>
                                                                    <div class="flex align-items-center list-user-action">
                                                                        @can('k_update')
                                                                        <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update K" data-original-title="Update K" href="" data-target="#update_k<?= $indikatorK->id ?>"><i class="ri-pencil-line"></i></a>
                                                                        @endcan
                                                                        @can('k_delete')
                                                                        <a class="k-confirm iq-bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{url('/k/delete/'.base64_encode($indikatorK->id))}}"><i class="ri-delete-bin-line"></i></a>
                                                                        @endcan
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <!-- Modal Ubah K -->
                                                            <div class="modal fade" tabindex="-1" role="dialog" id="update_k<?= $indikatorK->id ?>">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Update P</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal" method="post" action="{{ url('/k/update/'.$indikatorK->id) }}">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label>IK</label>
                                                                                    <select name="id_ik" id="id_ik" class="form-control">
                                                                                        @foreach($ik as $iniIk)
                                                                                        <option value="{{old('id_ik',$iniIk->id)}}" {{$iniIk->id == $indikatorK->id_ik ? 'selected' : ''}}>{{$iniIk->IK}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>P</label>
                                                                                    <input name="P" id="K" value="{{old('P',$indikatorK->P)}}" type="text" class="form-control">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Deskripsi</label>
                                                                                    <input name="deskripsi" id="deskripsi" value="{{old('deskripsi',$indikatorK->deskripsi)}}" type="text" class="form-control">
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
                                                <!-- $k->links()}} -->
                                            </div>
                                        </div>
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
            $('.k-confirm').on('click', function(event) {
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
                $('#myk').DataTable();
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
            $('#inputGroupFile01').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>
        @include('dashboards/users/layouts/footer')
</body>

</html>