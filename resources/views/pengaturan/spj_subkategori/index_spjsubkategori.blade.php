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
                                        <h4 class="card-title">Sub-Kategori File SPJ

                                        </h4>
                                        @include('pengaturan/spj_subkategori/tambah_subkategori')
                                    </div>
                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                                <i class="ri-more-fill"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                                <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                                <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <button class="btn btn-primary" data-toggle="modal" title="Tambah Kategori" data-original-title="Tambah Kategori" data-target="#add_kategori"><i class="fa fa-plus me-1"></i> Tambah Data
                                    </button>

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
                                        <div class="form-group row float-right mb-3 mr-2">
                                        </div>
                                        <table id="myunit" class="table mb-0 table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center" width="10%">No.</th>
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">Nama Sub Kategori</th>
                                                    <th scope="col">Catatan</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1; ?>
                                                <?php for ($a = 0; $a < count($spj_subkategori); $a++) { ?>
                                                    <tr>
                                                        <td class="text-center"><a href="#">{{ $num }}</a></td>
                                                        <td><?php for ($c = 0; $c < count($spj_kategori); $c++) {
                                                                if ($spj_kategori[$c]->id == $spj_subkategori[$a]->id_kategori) { ?>
                                                                    {{ $spj_kategori[$c]->nama_kategori }}
                                                            <?php }
                                                            } ?>
                                                        </td>
                                                        <td>{{ $spj_subkategori[$a]->nama_subkategori }}</td>
                                                        <td>{!! $spj_subkategori[$a]->catatan !!}</td>
                                                        <td>
                                                            <div class="flex align-items-center list-user-action">
                                                                <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update Kategori" data-original-title="Update Kategori" data-target="#update_subkategori<?= $spj_subkategori[$a]->id ?>"><i class="ri-pencil-line"></i></a>
                                                                <a class="iq-bg-danger unit-confirm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{ url('/spj_subkategori/delete/' . $spj_subkategori[$a]->id) }}"><i class="ri-delete-bin-line"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('pengaturan/spj_subkategori/edit_subkategori')
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
        $('.unit-confirm').on('click', function(event) {
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
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#myunit').DataTable();
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