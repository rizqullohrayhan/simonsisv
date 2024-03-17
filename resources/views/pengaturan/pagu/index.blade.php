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
                                        <h4 class="card-title">PAGU

                                        </h4>
                                        <!-- Modal Tambah pagu -->
                                        <div class="modal fade" role="dialog" id="tambahpagu" style="overflow:hidden;">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah PAGU</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" method="post" action="{{ url('/pagu/create') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Nominal PAGU</label>
                                                                <input name="pagu" id="pagu" type="text" class="form-control">
                                                            </div>
                                                            <!-- <script>
                                                                /* Dengan Rupiah */
                                                                var dengan_rupiah = document.getElementById('pagu');
                                                                dengan_rupiah.addEventListener('keyup', function(e) {
                                                                    dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
                                                                });

                                                                /* Fungsi */
                                                                function formatRupiah(angka, prefix) {
                                                                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                                        split = number_string.split(','),
                                                                        sisa = split[0].length % 3,
                                                                        rupiah = split[0].substr(0, sisa),
                                                                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                                                    if (ribuan) {
                                                                        separator = sisa ? '.' : '';
                                                                        rupiah += separator + ribuan.join('.');
                                                                    }

                                                                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                                                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                                                                }
                                                            </script> -->
                                                            <div class="form-group">
                                                                <label>RPD Triwulan 1</label>
                                                                <input name="tw1" id="tw1" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>RPD Triwulan 2</label>
                                                                <input name="tw2" id="tw2" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>RPD Triwulan 3</label>
                                                                <input name="tw3" id="tw3" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>RPD Triwulan 4</label>
                                                                <input name="tw4" id="tw4" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Prodi</label>
                                                                <select name="id_unit" id="tambahunit" aria-hidden="true" data-select2-id="select2-data-58-6f47" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                                                                    @foreach ($unit as $unit)
                                                                    <option value="{{ $unit->id }}">
                                                                        {{ $unit->nama_unit }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tahun</label>
                                                                <select name="id_tahun" id="id_tahun" class="form-control">
                                                                    @foreach ($tabeltahun as $pt)
                                                                    <option value="{{ $pt->id }}">
                                                                        {{ $pt->tahun }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
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
                                    @can('pagu_create')
                                    <button class="btn btn-primary" data-toggle="modal" title="Tambah PAGU" data-original-title="Tambah PAGU" data-target="#tambahpagu">
                                        <i class="fa fa-plus me-1"></i> Tambah Data
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
                                    <span class="table-add float-right mb-3 mr-2">
                                        <div class="form-group row">
                                            <form action="{{ url('/pagu/filtertahun') }}" method="GET">
                                                <div class="row mr-3">
                                                    <div class="col mr-1">
                                                        <select class="form-control filter sm-8" name="tahun" id="input">
                                                            <option value="0">All</option>
                                                            <?php for ($thn2 = 0; $thn2 < count($tabeltahun); $thn2++) { ?>
                                                                <option value="{{ $tabeltahun[$thn2]->id }}" {{ $filtertahun == $tabeltahun[$thn2]->tahun ? 'selected' : '' }}>
                                                                    {{ $tabeltahun[$thn2]->tahun }}
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                                                </div>
                                            </form>
                                        </div>
                                    </span>
                                    <div class="table-responsive" style="overflow-x:scroll;">
                                        <div class="form-group row float-right mb-3 mr-2">
                                        </div>
                                        <table id="mypagu" class="table mb-0 table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th scope="col" weight="20%">Unit</th>
                                                    <th scope="col" weight="10%">Tahun</th>
                                                    <th scope="col" weight="10%">Pagu</th>
                                                    <th scope="col" weight="10%">RPD TW 1</th>
                                                    <th scope="col" weight="10%">RPD TW 2</th>
                                                    <th scope="col" weight="10%">RPD TW 3</th>
                                                    <th scope="col" weight="10%">RPD TW 4</th>
                                                    <th scope="col" weight="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1; ?>
                                                <?php for ($a = 0; $a < count($pagu); $a++) { ?>
                                                    <tr>
                                                        <td><a href="#">{{$num}}</a></td>
                                                        <td>
                                                            <?php for ($b = 0; $b < count($unit2); $b++) {
                                                                if ($unit2[$b]->id ==  $pagu[$a]->id_unit) {
                                                                    echo $unit2[$b]->nama_unit;
                                                                }
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php for ($c = 0; $c < count($tabeltahun); $c++) {
                                                                if ($tabeltahun[$c]->id ==  $pagu[$a]->id_tahun) {
                                                                    echo $tabeltahun[$c]->tahun;
                                                                }
                                                            } ?>
                                                        </td>
                                                        <td>{{"Rp. " .  number_format($pagu[$a]->pagu, 2, ',', '.') }}</td>
                                                        <td>{{"Rp. " .  number_format($pagu[$a]->tw1, 2, ',', '.') }}</td>
                                                        <td>{{"Rp. " .  number_format($pagu[$a]->tw2, 2, ',', '.') }}</td>
                                                        <td>{{"Rp. " .  number_format($pagu[$a]->tw3, 2, ',', '.') }}</td>
                                                        <td>{{"Rp. " .  number_format($pagu[$a]->tw4, 2, ',', '.') }}</td>
                                                        <td>
                                                            <div class="flex align-items-center list-user-action ml-3">
                                                                <div class="row">
                                                                    @can('pagu_update')
                                                                    <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update Pagu" data-original-title="Update Pagu" href="" data-target="#update_pagu<?= $pagu[$a]->id ?>"><i class="ri-pencil-line"></i></a>
                                                                    @endcan
                                                                    @can('pagu_delete')
                                                                    <a class="pagu-confirm iq-bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="{{url('/pagu/delete/'.base64_encode($pagu[$a]->id))}}"><i class="ri-delete-bin-line"></i></a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- Modal Ubah Pagu -->
                                    <div class="modal fade" role="dialog" id="update_pagu<?= $pagu[$a]->id ?>" style="overflow:hidden;">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update PAGU</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="post" action="{{ url('/pagu/update/' . $pagu[$a]->id) }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Nominal PAGU</label>
                                                            <input name="pagu" id="pagu" type="text" value="{{ old('pagu', $pagu[$a]->pagu) }}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Triwulan 1</label>
                                                            <input name="tw1" id="tw1" type="text" value="{{ old('tw1', $pagu[$a]->tw1) }}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Triwulan 2</label>
                                                            <input name="tw2" id="tw2" type="text" value="{{ old('tw2', $pagu[$a]->tw2) }}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Triwulan 3</label>
                                                            <input name="tw3" id="tw3" type="text" value="{{ old('tw3', $pagu[$a]->tw3) }}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Triwulan 4</label>
                                                            <input name="tw4" id="tw4" type="text" value="{{ old('tw4', $pagu[$a]->tw4) }}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Prodi</label>
                                                            <select name="id_unit" id="updateunit" aria-hidden="true" data-select2-id="select2-data-58-6f57" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                                                                @foreach ($unit2 as $unit)
                                                                <option value="{{ $unit->id }}" {{ $unit->id == $pagu[$a]->id_unit ? 'selected' : '' }}>
                                                                    {{ $unit->nama_unit }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun</label>
                                                            <select name="id_tahun" id="id_tahun" class="form-control">
                                                                @foreach ($tabeltahun as $pt)
                                                                <option value="{{ old('id_tahun', $pt->id) }}" {{ $pagu[$a]->id_tahun == $pt->id ? 'selected' : '' }}>
                                                                    {{ $pt->tahun }}
                                                                </option>
                                                                @endforeach
                                                            </select>
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


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.pagu-confirm').on('click', function(event) {
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
            $('#mypagu').DataTable();
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
            $('#tambahunit').select2();
        });
        $(document).ready(function() {
            $('#updateunit').select2();
        });
    </script>
</body>

</html>