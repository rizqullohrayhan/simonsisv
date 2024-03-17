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
                                        <h4 class="card-title">TAHUN

                                        </h4>
                                        <!-- Modal Tambah TAHUN -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="tambahtahun">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Tahun</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal needs-validation" method="post" action="{{ url('/tahun/create') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Tahun</label>
                                                                <input name="tahun" id="tahun" type="text" class="form-control" required>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    @can('tahun_create')
                                    <button class="btn btn-primary" data-toggle="modal" title="Tambah TAHUN" data-original-title="Tambah TAHUN" data-target="#tambahtahun"><i class="fa fa-plus me-1"></i> Tambah Data
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
                                        <div class="form-group row float-right mb-3 mr-2">
                                        </div>

                                        <!-- <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Name</th>
                                                    <th colspan="2">HR Information</th>
                                                    <th colspan="2">Contact</th>
                                                    <th colspan="">Contact</th>
                                                </tr>
                                                <tr>
                                                    <th>Position</th>
                                                    <th>Salary</th>
                                                    <th>Office</th>
                                                    <th>Extn.</th>
                                                    <th>E-mail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Garrett Winters</td>
                                                    <td>Accountant</td>
                                                    <td>$170,750</td>
                                                    <td>Tokyo</td>
                                                    <td>8422</td>
                                                    <td>g.winters@datatables.net</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Ashton CoxAshton CoxAshton CoxAshton CoxAshton CoxAshton Cox</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Cedric Kelly</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>$433,060</td>
                                                    <td>Edinburgh</td>
                                                    <td>6224</td>
                                                    <td>c.kelly@datatables.net</td>
                                                </tr>
                                                <tr>
                                                    <td>Airi Satou</td>
                                                    <td>Accountant</td>
                                                    <td>$162,700</td>
                                                    <td>Tokyo</td>
                                                    <td>5407</td>
                                                    <td>a.satou@datatables.net</td>
                                                </tr>
                                                <tr>
                                                    <td>Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>$372,000</td>
                                                    <td>New York</td>
                                                    <td>4804</td>
                                                    <td>b.williamson@datatables.net</td>
                                                </tr>
                                                <tr>
                                                    <td>Herrod Chandler</td>
                                                    <td>Sales Assistant</td>
                                                    <td>$137,500</td>
                                                    <td>San Francisco</td>
                                                    <td>9608</td>
                                                    <td>h.chandler@datatables.net</td>
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>$327,900</td>
                                                    <td>Tokyo</td>
                                                    <td>6200</td>
                                                    <td>r.davidson@datatables.net</td>
                                                </tr>
                                                <?php for ($i = 0; $i < 12; $i++) { ?>
                                                    <tr>
                                                        <td>Colleen Hurst</td>
                                                        <td>Javascript Developer</td>
                                                        <td>$205,500</td>
                                                        <td>San Francisco</td>
                                                        <td>2360</td>
                                                        <td>c.hurst@datatables.net</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Salary</th>
                                                    <th>Office</th>
                                                    <th>Extn.</th>
                                                    <th>E-mail</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <br /> -->

                                        <table id="mytahun" class="table mb-0 table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th scope="col">Tahun</th>
                                                    @can('tahun_create')
                                                    <th scope="col">Status</th>
                                                    @endcan
                                                    @can('tahun_update')
                                                    <th scope="col">Action</th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1; ?>
                                                <?php foreach ($tahun as $thn) { ?>
                                                    <tr>
                                                        <td><a href="#">{{$num}}</a></td>
                                                        <td>{{$thn->tahun}}</td>
                                                        @can('tahun_create')
                                                        <td>
                                                            <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                                                <div class="custom-switch-inner">
                                                                    <input data-id="{{$thn->id}}" type="checkbox" class="custom-control-input" data-on-label="On" data-off-label="Off" id="customSwitch-22{{$thn->id}}" {{ $thn->is_aktif ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="customSwitch-22{{$thn->id}}" data-on-label="On" data-off-label="Off">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @endcan
                                                        @if(Gate::check('tahun_update') || Gate::check('tahun_delete'))
                                                        <td>
                                                            <div class="flex align-items-center list-user-action">
                                                                @can('tahun_update')
                                                                <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update Tahun" data-original-title="Update Tahun" href="" data-target="#update_thn<?= $thn->id ?>"><i class="ri-pencil-line"></i></a>
                                                                @endcan
                                                                @can('tahun_delete')
                                                                <a href="{{url('/tahun/delete/'.base64_encode($thn->id))}}" class="iq-bg-danger tahun-confirm" data-toggle="tooltip" title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                <!-- <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{url('/tahun/delete/'.$thn->id)}}" onclick="return confirm('Apakah anda yakin ingin hapus ?')"><i class="ri-delete-bin-line"></i></a> -->
                                                                @endcan
                                                            </div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    <!-- Modal Ubah TAHUN -->
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="update_thn<?= $thn->id ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Ubah Tahun</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal" method="post" action="{{ url('/tahun/update/'.$thn->id) }}">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label>Tahun</label>
                                                                            <input name="tahun" value="{{old('tahun',$thn->tahun)}}" id="tahun" type="text" class="form-control">
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
    </div>
    <!-- Wrapper END -->
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#mytahun').DataTable();
            // $('#example').DataTable();
        });
        //print page
        function printDiv() {
            var printContents = document.getElementById("content-page").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
        };
    </script>
    <script>
        $(function() {
            $('.custom-control-input').change(function() {
                var is_aktif = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/tahun/isaktif',
                    data: {
                        'is_aktif': is_aktif,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.tahun-confirm').on('click', function(event) {
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    </html>