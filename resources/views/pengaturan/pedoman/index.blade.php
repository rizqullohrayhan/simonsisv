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
                                        <h4 class="card-title">Pedoman

                                        </h4>
                                        <!-- Modal Tambah pedoman -->
                                        @include('pengaturan.pedoman.tambah_pedoman')
                                        <div class="iq-card-header-toolbar d-flex align-items-center">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                                    <i class="ri-more-fill"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                                    <a class="dropdown-item" href="" onclick="printDiv()"><i class="ri-printer-fill mr-2" onclick="printDiv()"></i>Print</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        @can('pedoman_create')
                                        <button class="btn btn-primary" data-toggle="modal" title="Tambah pedoman" data-original-title="Tambah pedoman" data-target="#tambahpedoman"> <i class="fa fa-plus me-1"></i> Tambah Data
                                        </button>
                                        @endcan

                                        @if (session('success'))
                                        <script>
                                            Swal.fire({
                                                icon: 'success',
                                                title: "{{ session('success') }}",
                                                showConfirmButton: false,
                                                timer: 1500
                                            })
                                        </script>
                                        @endif
                                        <div class="table-responsive">
                                            <div class="form-group row float-right mb-3 mr-2">
                                            </div>
                                            <table id="mypedoman" class="table mb-0 table table-striped table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th width="5%">No.</th>
                                                        <th scope="col" width="30%">Jenis</th>
                                                        <th scope="col" width="40%">Nama</th>
                                                        <th scope="col" width="10%">File</th>
                                                        <th scope="col" width="5%">Tahun</th>
                                                        <th scope="col" width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($pedoman as $pedomansbm)
                                                    <tr>
                                                        <td class="text-center">{{ $i }}</td>
                                                        <td><?php $pedomansbm->jenis;
                                                            if ($pedomansbm->jenis == 'SBM') {
                                                                echo 'Standar Biaya Masukan' . ' (' . $pedomansbm->jenis . ')';
                                                            } else {
                                                                echo $pedomansbm->jenis;
                                                            }
                                                            ?></td>

                                                        <td>{{ $pedomansbm->nama }}</td>
                                                        <td><a href="{{ asset('/pedoman/' . $pedomansbm->file) }}">{{ $pedomansbm->file }}</a>
                                                        </td>
                                                        <td class="text-center">{{ $pedomansbm->tahun }}</td>
                                                        <td class="text-center">
                                                            <div class="flex align-items-center list-user-action ml-3">
                                                                <div class="row">
                                                                    @can('pedoman_update')
                                                                    <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update Pedoman" data-original-title="Update Pedoman" href="" data-target="#update_pedoman<?= $pedomansbm->id ?>"><i class="ri-pencil-line"></i></a>
                                                                    @endcan
                                                                    @can('pedoman_delete')
                                                                    <a href="{{ url('/pedomans/delete/' . base64_encode($pedomansbm->id)) }}" class="iq-bg-danger ped-confirm" data-toggle="tooltip" title="Delete">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Edit Pedoman -->
                                                    @include('pengaturan.pedoman.edit_pedoman')
                                                    <?php $i += 1; ?>
                                                    @endforeach
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
        <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $.noConflict();
                $('#mypedoman').DataTable();
            });

            //print page
            function printDiv() {
                var printContents = document.getElementById("content-page").innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
            };
        </script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $('.ped-confirm').on('click', function(event) {
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
        </script>
        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 2000);
        </script>

        @include('dashboards/users/layouts/footer')

        </html>