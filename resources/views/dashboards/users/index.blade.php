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
            <?php
            foreach ($role as $roles) {
                if ($roles->id == Auth::user()->role) {
                    $RoleLogin = $roles->name;
                }
            }
            ?>
            @if ($RoleLogin != 'Prodi')
            <h3 class="text-center">Welcome to SIMONSI (Sistem Monev Sekolah Vokasi) UNS, {{ Auth::user()->name }}
            </h3>
            <br>
            @endif

            {{-- Manajemen menu Dashboard --}}
            @can('dashboard')
            <div class="row">
                <?php
                // Ambil data Jumlah Anggaran dari TOR
                $total_anggaran = 0;
                foreach ($torAll as $data) {
                    $total_anggaran += $data['jumlah_anggaran'];
                }

                // Ambil data Jumlah Realisasi dari SPJ
                $total_realisasi = 0;
                foreach ($spj as $nilai) {
                    $total_realisasi += $nilai['nilai_total'];
                }

                // Ambil data Sisa
                $total_sisa = $total_anggaran - $total_realisasi;
                ?>
                {{-- <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body iq-box-relative">
                                <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-info">
                                    <i class="ri-pantone-line"></i>
                                </div>
                                <p class="text-secondary">Total Pagu</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5><b>{{ 'Rp ' . number_format($total_anggaran) }}</b></h5>
                <div id="iq-chart-box1"></div>
                <span class="text-info" style="font-size: 12px"><b>100%</b></span>
            </div>
        </div>
    </div>
    </div> --}}

    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-body iq-box-relative">
                <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                    <i class="ri-focus-2-line"></i>
                </div>
                <p class="text-secondary">Total Anggaran</p>
                <div class="d-flex align-items-center justify-content-between">
                    <h5><b>{{ 'Rp ' . number_format($total_anggaran) }}</b></h5>
                    <div id="iq-chart-box1"></div>
                    <span class="text-warning" style="font-size: 12px"><b>100%</b></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-body iq-box-relative">
                <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                    <i class="ri-database-2-line"></i>
                </div>
                <p class="text-secondary">Total Realisasi</p>
                <div class="d-flex align-items-center justify-content-between">
                    <h5><b>{{ 'Rp ' . number_format($total_realisasi) }}</b></h5>
                    <div id="iq-chart-box2"></div>
                    <span class="text-success" style="font-size: 12px">
                        <b>{{ number_format(($total_realisasi / $total_anggaran) * 100) }}%
                        </b>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-body iq-box-relative">
                <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-danger">
                    <i class="ri-pie-chart-2-line"></i>
                </div>
                <p class="text-secondary">Total Sisa</p>
                <div class="d-flex align-items-center justify-content-between">
                    <h5><b>{{ 'Rp ' . number_format($total_sisa) }}</b></h5>
                    <div id="iq-chart-box3"></div>
                    <span class="text-danger" style="font-size: 12px"><b>{{ number_format(($total_sisa / $total_anggaran) * 100) }}%</b></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-center table-primary">
                <div class="iq-header-title">
                    <h5 class="card-title">REKAPITULASI AJUAN PER TW</h5>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="table" class="table-editable">
                    <table id="datatable" class="table table-bordered table-responsive-md table-hover text-center">
                        <thead>
                            <tr class="bg-primary">
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Program Studi</th>
                                <th>Penanggungjawab</th>
                                <th width="12%">Anggaran</th>
                                <th width="12%">Realisasi</th>
                                <th width="12%">Sisa</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endcan
    </div>
    </div>
    {{-- Script Datatable --}}
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                search: false,
                pageLength: 5,
                ajax: "{{ route('home.data') }}",
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan'
                    },
                    {
                        data: 'namaprodi',
                        name: 'namaprodi'
                    },
                    {
                        data: 'nama_pic',
                        name: 'nama_pic'
                    },
                    {
                        data: 'anggaran',
                        name: 'anggaran'
                    },
                    {
                        data: 'realisasi',
                        name: 'realisasi'
                    },
                    {
                        data: 'sisa',
                        name: 'sisa',
                        orderable: true,
                        searchable: true
                    },
                ],
            });
        });
    </script>

    <!-- Footer -->
    @include('dashboards/users/layouts/footer')

    </html>