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
                    <div class="col-lg-12">
                        <div class="iq-card">
                            <div class="iq-card-body p-0">
                                <div class="iq-edit-list">
                                    <ul class="iq-edit-profile d-flex nav nav-pills">
                                        <li class="col-md-2 p-0">
                                            <a class="nav-link active" data-toggle="pill" href="#satu">
                                                1. Kegiatan TOR
                                            </a>
                                        </li>
                                        <li class="col-md-2 p-0">
                                            <a id="nav2" class="nav-link" data-toggle="pill" href="#dua">
                                                2. Pelaksanaan
                                            </a>
                                        </li>
                                        <li class="col-md-3 p-0">
                                            <a class="nav-link" data-toggle="pill" href="#tiga">
                                                3. Input Realisasi & Target IKU
                                            </a>
                                        </li>
                                        <li class="col-md-3 p-0">
                                            <a class="nav-link" data-toggle="pill" href="#empat">
                                                4. Input Realisasi & Target IK
                                            </a>
                                        </li>
                                        <li class="col-md-2 p-0">
                                            <a class="nav-link" data-toggle="pill" href="#lima">
                                                TOR
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $active = 2; ?>
                    <div class="col-lg-12">
                        <div class="iq-edit-list-data">

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="satu" role="tabpanel">
                                    <div class="iq-card">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title">Pengajuan TOR</h4>
                                            </div>
                                        </div>
                                        <div class="iq-card-body">
                                            <div class="form-group row align-items-center">
                                                <div class="col-md-12">
                                                </div>
                                            </div>
                                            <div class=" row align-items-center">
                                                <div class="container ml-3">
                                                    <form class="form-horizontal" method="post" action="{{ url('/tor/create') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Jenis Ajuan</label><br />
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadio6" name="jenis_ajuan" id="jenis_ajuan" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadio6"> Baru </label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadio6" name="jenis_ajuan" id="jenis_ajuan" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadio6"> Perbaikan </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Prodi</label>
                                                            <?php if (Auth()->user()->role != 2) { ?>
                                                                <select name="id_unit" id="id_unit" class="form-control">
                                                                    @foreach($unit as $unit)
                                                                    <option value="{{$unit->id}}">{{$unit->nama_unit}}</option>
                                                                    @endforeach
                                                                </select>
                                                            <?php } ?>
                                                            <?php if (Auth()->user()->role == 2) { ?>
                                                                <select name="id_unit" id="id_unit" class="form-control">
                                                                    <?php for ($u2 = 0; $u2 < count($unit); $u2++) {
                                                                        if ($unit[$u2]->id == Auth()->user()->id_unit) { ?>
                                                                            <option value="{{$unit[$u2]->id}}">{{$unit[$u2]->nama_unit}}</option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kode Sub Kegiatan</label>
                                                            <select name="id_subK" id="id_subK" class="form-control">
                                                                <?php for ($s = 0; $s < count($subkeg); $s++) { ?>
                                                                    <option value="1"><?= $subkeg[$s]->subK . " - " . substr($subkeg[$s]->deskripsi, 0, 100) ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Kegiatan</label>
                                                            <input name="nama_kegiatan" id="nama_kegiatan" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Latar Belakang</label>
                                                            <textarea class="form-control" id="latar_belakang" name="latar_belakang" rows="2"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Rasionalisasi</label>
                                                            <textarea class="form-control" id="rasionalisasi" name="rasionalisasi" rows="2"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tujuan</label>
                                                            <textarea class="form-control" id="tujuan" name="tujuan" rows="2"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>mekanisme</label>
                                                            <textarea class="form-control" id="mekanisme" name="mekanisme" rows="2"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>keberlanjutan</label>
                                                            <textarea class="form-control" id="keberlanjutan" name="keberlanjutan" rows="2"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama PIC Kegiatan</label>
                                                            <input name="nama_pic" id="nama_pic" type="text" class="form-control" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email SSO PIC Kegiatan</label>
                                                            <input name="email_pic" id="email_pic" type="text" class="form-control" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kontak PIC Kegiatan</label>
                                                            <input name="kontak_pic" id="kontak_pic" type="text" class="form-control" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Mulai Pelaksanaan</label>
                                                            <input name="tgl_mulai_pelaksanaan" id="tgl_mulai_pelaksanaan" value="{{ old('tgl_pelaksanaan')}}" type="date" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Selesai Pelaksanaan</label>
                                                            <input name="tgl_akhir_pelaksanaan" id="tgl_akhir_pelaksanaan" value="{{ old('tgl_pelaksanaan')}}" type="date" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah Anggaran</label>
                                                            <input name="jumlah_anggaran" id="jumlah_anggaran" value="" type="text" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Rencana Penarikan Dana</label>
                                                            <select name="id_tw" id="id_tw" class="form-control">
                                                                <?php for ($t2 = 0; $t2 < count($tw); $t2++) { ?>
                                                                    <option value="1"><?= $tw[$t2]->triwulan ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <button class="btn btn-primary mr-1" href="#dua" type="submit">Submit</button>
                                                    </form>

                                                </div>
                                            </div>
                                            <!-- <button class="btn btn-primary mr-1" data-toggle="pill" href="#dua" onclick="{{$active==2}}">next</button> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="dua" role="tabpanel">
                                    <div class="iq-card">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                        <div class="iq-card-body">
                                            <label>Contoh</label><br />
                                            <img src="assets/contoh/jadwaltor.png">
                                            <br />
                                            <div class="container mt-3">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Komponen Input</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Bulan</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="tiga" role="tabpanel">
                                    <div class="iq-card">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                        <div class="iq-card-body">
                                            <label>Contoh</label><br />
                                            <img src="assets/contoh/contohiku.png">
                                            <br />
                                            <div class="container mt-3">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Realisasi</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Tahun Realisasi</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Target</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Tahun Target</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="empat" role="tabpanel">
                                    <div class="iq-card">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                        <div class="iq-card-body">
                                            <label>Contoh</label><br />
                                            <img src="assets/contoh/contohik.png">
                                            <br />
                                            <div class="container mt-3">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Realisasi</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Tahun Realisasi</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Target</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Tahun Target</label>
                                                            <input name="" id="" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="lima" role="tabpanel">
                                    <div class="iq-card">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                        <div class="iq-card-body">
                                            <br />
                                            <div class="container center">
                                                <h5 style="text-align: center;">
                                                    KERANGKA ACUAN KERJA (KAK) / TERM OF REFERENCE (ToR)<br />
                                                    PROGRAM STUDI ...<br />SEKOLAH VOKASI UNIVERSITAS SEBELAS</b>
                                                </h5>
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
        <!-- Wrapper END -->
        <!-- Footer -->
        <footer class="iq-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        Copyright 2020 <a href="#">FinDash</a> All Rights Reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer END -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('findash/assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('findash/assets/js/popper.min.js')}}"></script>
        <script src="{{ asset('findash/assets/js/bootstrap.min.js')}}"></script>
        <!-- Appear JavaScript -->
        <script src="{{ asset('findash/assets/js/jquery.appear.js')}}"></script>
        <!-- Countdown JavaScript -->
        <script src="{{ asset('findash/assets/js/countdown.min.js')}}"></script>
        <!-- Counterup JavaScript -->
        <script src="{{ asset('findash/assets/js/waypoints.min.js')}}"></script>
        <script src="{{ asset('findash/assets/js/jquery.counterup.min.js')}}"></script>
        <!-- Wow JavaScript -->
        <script src="{{ asset('findash/assets/js/wow.min.js')}}"></script>
        <!-- Apexcharts JavaScript -->
        <script src="{{ asset('findash/assets/js/apexcharts.js')}}"></script>
        <!-- Slick JavaScript -->
        <script src="{{ asset('findash/assets/js/slick.min.js')}}"></script>
        <!-- Select2 JavaScript -->
        <script src="{{ asset('findash/assets/js/select2.min.js')}}"></script>
        <!-- Owl Carousel JavaScript -->
        <script src="{{ asset('findash/assets/js/owl.carousel.min.js')}}"></script>
        <!-- Magnific Popup JavaScript -->
        <script src="{{ asset('findash/assets/js/jquery.magnific-popup.min.js')}}"></script>
        <!-- Smooth Scrollbar JavaScript -->
        <script src="{{ asset('findash/assets/js/smooth-scrollbar.js')}}"></script>
        <!-- lottie JavaScript -->
        <script src="{{ asset('findash/assets/js/lottie.js')}}"></script>
        <!-- Style Customizer -->
        <script src="{{ asset('findash/assets/js/style-customizer.js')}}"></script>
        <!-- Chart Custom JavaScript -->
        <script src="{{ asset('findash/assets/js/chart-custom.js')}}"></script>
        <!-- Custom JavaScript -->
        <script src="{{ asset('findash/assets/js/custom.js')}}"></script>
</body>

</html>