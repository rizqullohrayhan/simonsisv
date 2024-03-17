<?php

use Illuminate\Support\Facades\Auth;
?>
@can('tor_create')
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
                    <div class="col-sm-12 col-lg-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">PERBAIKAN TOR</h4>
                                </div>
                            </div>
                            <?php $data = 1 ?>
                            <div class="iq-card-body">
                                <form id="form-wizard1" class="text-center mt-4" method="post" action="{{ url('/tor/update/'.$id) }}">
                                    @csrf
                                    <ul id="top-tab-list" class="p-0">
                                        <li class="active" id="account">
                                            <a href="javascript:void();">
                                                <i class="ri-lock-unlock-line"></i><span>1.</span>
                                            </a>
                                        </li>
                                        <li id="personal">
                                            <a href="javascript:void();">
                                                <i class="ri-user-fill"></i><span>2.</span>
                                            </a>
                                        </li>
                                        <li id="payment">
                                            <a href="javascript:void();">
                                                <i class="ri-camera-fill"></i><span> 3. </span>
                                            </a>
                                        </li>
                                        <li id="confirm">
                                            <a href="javascript:void();">
                                                <i class="ri-check-fill"></i><span> 4.</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- TAHAP 1  -->
                                    <fieldset>
                                        <div class="form-card text-left">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h4 class="mb-4">Pengajuan TOR</h4>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 1 - 4</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="container ml-3">

                                                    <div class="form-group">
                                                        <label>Jenis Ajuan</label><br />
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="customRadio6" name="jenis_ajuan" id="jenis_ajuan" value="Baru" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio6"> Baru </label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="customRadio7" name="jenis_ajuan" id="jenis_ajuan" value="Perbaikan" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio7"> Perbaikan </label>
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
                                                        <input name="nama_kegiatan" id="nama_kegiatan" type="text" value="{{old('nama_kegiatan',$tor['nama_kegiatan'])}}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="parent" id="parent" type="hidden" value="{{}}" class="form-control">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="card iq-mb-3 shadow">
                                                            <img width="700" src="../../assets/contoh/contohiku.png" class="card-img-top">
                                                            <div class="card-body">
                                                                <b>
                                                                    <h6 class="card-title">Indikator Kinerja Utama (IKU)</h6>
                                                                </b>
                                                                <div class="form-group">
                                                                    <label>Realisasi IKU</label>
                                                                    <input name="realisasi_IKU" id="realisasi_IKU" value="{{old('realisasi_IKU',$tor['realisasi_IKU'])}}" type="text" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Target IKU</label>
                                                                    <input name="target_IKU" id="target_IKU" value="{{old('target_IKU',$tor['target_IKU'])}}" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="card iq-mb-3 shadow">
                                                            <img width="700" src="../../assets/contoh/contohik.png" class="card-img-top">
                                                            <div class="card-body">
                                                                <b>
                                                                    <h6 class="card-title">Indikator Kinerja Kegiatan (IK)</h6>
                                                                </b>
                                                                <div class="form-group">
                                                                    <label>Realisasi IK</label>
                                                                    <input name="realisasi_IK" id="realisasi_IK" value="{{old('realisasi_IK',$tor['realisasi_IK'])}}" type="text" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Target IK</label>
                                                                    <input name="target_IK" id="target_IK" value="{{old('target_IK',$tor['target_IK'])}}" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary next action-button float-right">Next</button>
                                    </fieldset>
                                    <!-- TAHAP 2 -->
                                    <fieldset>
                                        <div class="form-card text-left">
                                            <div class="container mt-3">
                                                <div class="form-group">
                                                    <label>Latar Belakang</label>
                                                    <textarea class="ckeditor form-control" id="latar_belakang" name="latar_belakang" value="{!!old('latar_belakang',$tor['latar_belakang'])!!}">{{$tor['latar_belakang']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rasionalisasi</label>
                                                    <textarea class="ckeditor form-control" id="rasionalisasi" name="rasionalisasi" rows="2">{{$tor['rasionalisasi']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tujuan</label>
                                                    <textarea class="ckeditor form-control" id="tujuan" name="tujuan" rows="2">{{$tor['tujuan']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>mekanisme</label>
                                                    <textarea class="ckeditor form-control" id="mekanisme" name="mekanisme" rows="2">{{$tor['mekanisme']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>keberlanjutan</label>
                                                    <textarea class="ckeditor form-control" id="keberlanjutan" name="keberlanjutan" rows="2">{{$tor['keberlanjutan']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary next action-button float-right" value="Next">Next</button>
                                        <button type="button" class="btn btn-dark previous action-button-previous float-right mr-3" value="Previous">Previous</button>
                                    </fieldset>
                                    <!-- TAHAP 3 -->
                                    <fieldset>
                                        <div class="form-card text-left">
                                            <div class="container mt-3">
                                                <div class="form-group">
                                                    <label>Nama PIC Kegiatan</label>
                                                    <input name="nama_pic" id="nama_pic" type="text" class="form-control" value="{{old('nama_pic',$tor['nama_pic'])}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email SSO PIC Kegiatan</label>
                                                    <input name="email_pic" id="email_pic" type="text" class="form-control" value="{{old('email_pic',$tor['email_pic'])}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak PIC Kegiatan</label>
                                                    <input name="kontak_pic" id="kontak_pic" type="text" class="form-control" value="{{old('kontak_pic',$tor['kontak_pic'])}}">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary next action-button float-right" value="Next">Next</button>
                                        <button type="button" class="btn btn-dark previous action-button-previous float-right mr-3" value="Previous">Previous</button>
                                    </fieldset>

                                    <!-- TAHAP 4 -->
                                    <fieldset>
                                        <div class="form-card text-left">
                                            <div class="container mt-3">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai Pelaksanaan</label>
                                                    <input name="tgl_mulai_pelaksanaan" id="tgl_mulai_pelaksanaan" value="{{old('tgl_mulai_pelaksanaan',$tor['tgl_mulai_pelaksanaan'])}}" type="date" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Selesai Pelaksanaan</label>
                                                    <input name="tgl_akhir_pelaksanaan" id="tgl_akhir_pelaksanaan" value="{{old('tgl_akhir_pelaksanaan',$tor['tgl_akhir_pelaksanaan'])}}" type="date" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah Anggaran</label>
                                                    <input name="jumlah_anggaran" id="jumlah_anggaran" value="{{old('jumlah_anggaran',$tor['jumlah_anggaran'])}}" type="text" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Rencana Penarikan Dana</label>
                                                    <select name="id_tw" id="id_tw" class="form-control">
                                                        <?php for ($t2 = 0; $t2 < count($tw); $t2++) { ?>
                                                            <option value="1"><?= $tw[$t2]->triwulan ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary next action-button float-right">Submit</button>
                                        <button type="button" class="btn btn-dark previous action-button-previous float-right mr-3" value="Previous">Previous</button>
                                    </fieldset>
                                </form>

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
        <script type="text/javascript">
            var i = 0;
            $("#dynamic-ar").click(function() {
                ++i;
                $("#dynamicAddRemove").append('<div class="col-md-8"><div class="form-group"><label>Komponen Input</label><input name="komponen[]" id="" type="text" class="form-control"></div></div><div class="col-md-2"><div class="form-group"><label>Bulan</label><input name="bulan[]" id="" type="text" class="form-control"></div></div><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>');
            });
            $(document).on('click', '.remove-input-field', function() {
                $(this).parents('<div class="col-md-8">').remove();
            });
        </script>
</body>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>

</html>
@endcan