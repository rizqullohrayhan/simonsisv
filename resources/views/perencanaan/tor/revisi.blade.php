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
                                    <h4 class="card-title">PENGAJUAN PERBAIKAN TOR</h4>
                                </div>
                            </div>
                            <?php $data = 1 ?>
                            <div class="iq-card-body">
                                <form id="form-wizard1" class="text-center mt-4" method="post" action="{{ url('/tor/revisi/'.base64_encode($id)) }}">
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

                                            @php
                                            $komentar = [
                                                'sub' => [],
                                                'judul' => [],
                                                'latar_belakang' => [],
                                                'rasionalisasi' => [],
                                                'tujuan' => [],
                                                'mekanisme' => [],
                                                'jadwal' => [],
                                                'iku' => [],
                                                'ik' => [],
                                                'keberlanjutan' => [],
                                                'penanggung' => [],
                                                'rab' => [],
                                            ];
                                            
                                            foreach ($trx_status_tor as $trx_item) {
                                                foreach ($users as $user) {
                                                    if ($trx_item->create_by == $user->id) {
                                                        foreach (['sub', 'judul', 'latar_belakang', 'rasionalisasi', 'tujuan', 'mekanisme', 'jadwal', 'iku', 'ik', 'keberlanjutan', 'penanggung', 'rab'] as $field) {
                                                            if (!empty($trx_item->{'k_' . $field})) {
                                                                if ($trx_item->{'k_' . $field} != '-') {
                                                                    $komentar[$field][] = " \"" . $trx_item->{'k_' . $field} . "\"\n (" . $user->name . " - " . $user->toRole->name . ")";
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            @endphp


                                            <div class="row">
                                                <div class="container ml-3">
                                                    <?php
                                                    $arrayStatus = [];
                                                    $i = 0;
                                                    foreach ($trx_status_tor as $trx2) {
                                                        foreach ($status as $status2) {
                                                            if ($trx2->id_tor == $id) {
                                                                if ($status2->id == $trx2->id_status) {
                                                                    $arrayStatus[$i] = $status2->nama_status;
                                                                    $status2->nama_status . "<br />";

                                                                    if ($status2->nama_status == "Revisi") {
                                                                        $arrayRev[$i] = $status2->nama_status;
                                                                    }

                                                                    $ch = "checked";
                                                                    $i += 1;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>


                                                    <br />
                                                    <input type="hidden" name="create_by" id="create_by" value="{{ Auth()->user()->id }}" class="custom-control-input">
                                                    <input type="hidden" name="update_by" id="update_by" value="{{ Auth()->user()->id }}" class="custom-control-input">
                                                    <div class="form-group mt-3">
                                                        <label>Jenis Ajuan</label><br />
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="jenis_ajuan" id="jenis_ajuan" value="Perbaikan" class="custom-control-input" {{$ch}}>
                                                            <label class="custom-control-label" for="danger-outlined">Perbaikan</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Prodi</label>
                                                        <?php
                                                        $UnitUser = "";
                                                        if (!empty($unit)) {
                                                            for ($u = 0; $u < count($unit); $u++) {
                                                                if ($unit[$u]->id == Auth::user()->id_unit) {
                                                                    $UnitUser = $unit[$u]->nama_unit;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <?php if ($UnitUser == "Sekolah Vokasi") { ?>
                                                            <select name="id_unit" id="id_unit" class="form-control @error('id_unit') is-invalid @enderror">
                                                                @foreach($unit as $unit)
                                                                <option value="{{$unit->id}}">{{$unit->nama_unit}}</option>
                                                                @endforeach
                                                            </select>
                                                        <?php } ?>
                                                        <?php if ($UnitUser != "Sekolah Vokasi") { ?>
                                                            <select name="id_unit" id="id_unit" class="form-control @error('id_unit') is-invalid @enderror">
                                                                <?php for ($u2 = 0; $u2 < count($unit); $u2++) {
                                                                    if ($unit[$u2]->id == Auth()->user()->id_unit) { ?>
                                                                        <option value="{{$unit[$u2]->id}}">{{$unit[$u2]->nama_unit}}</option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        <?php } ?>
                                                        @error('id_unit')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label><b>Kode Program</b></label>
                                                        @foreach($komentar['sub'] as $subs)
                                                        <h6 style="color: #dc3545;">{{$subs}}</h6>
                                                        <hr class="mt-3">
                                                        @endforeach
                                                        <select name="id_p" id="id_p" class="form-control @error('id_p') is-invalid @enderror">
                                                            @foreach ($indikator_p as $item)
                                                                <option value="{{ $item->id }}" @if (old('id_p', $tor['id_p']) == $item->id) selected @endif><?= $item->P . " - " . substr($item->deskripsi, 0, 100) ?></option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_P')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div><br />

                                                    <div class="col-sm-8">
                                                        <div class="card iq-mb-3 shadow">
                                                            <img width="700" src="{{ asset('assets/contoh/contohiku.png') }}" class="card-img-top">
                                                            <div class="card-body">
                                                                <b>
                                                                    <h6 class="card-title">Indikator Kinerja Utama (IKU)</h6>
                                                                </b>
                                                                @foreach($komentar['iku'] as $ikus)
                                                                <h6 style="color: #dc3545;">{{$ikus}}</h6>
                                                                <hr class="mt-3">
                                                                @endforeach
                                                                <div class="form-group">
                                                                    <label>Realisasi IKU (%)</label>
                                                                    <input name="realisasi_IKU" id="realisasi_IKU" value="{{old('realisasi_IKU',$tor['realisasi_IKU'])}}" type="text" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Target IKU (%)</label>
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
                                                                @foreach($komentar['ik'] as $iks)
                                                                <h6 style="color: #dc3545;">{{$iks}}</h6>
                                                                <hr class="mt-3">
                                                                @endforeach
                                                                <div class="form-group">
                                                                    <label>Realisasi IK (%)</label>
                                                                    <input name="realisasi_IK" id="realisasi_IK" value="{{old('realisasi_IK',$tor['realisasi_IK'])}}" type="text" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Target IK (%)</label>
                                                                    <input name="target_IK" id="target_IK" value="{{old('target_IK',$tor['target_IK'])}}" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Kegiatan</label>
                                                        @foreach($komentar['judul'] as $juduls)
                                                        <h6 style="color: #dc3545;">{{$juduls}}</h6>
                                                        <hr class="mt-3">
                                                        @endforeach
                                                        <input name="nama_kegiatan" id="nama_kegiatan" type="text" value="{{old('nama_kegiatan',$tor['nama_kegiatan'])}}" class="form-control">
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
                                                    @foreach($komentar['latar_belakang'] as $latarbelakangs)
                                                    <h6 style="color: #dc3545;">{{$latarbelakangs}}</h6>
                                                    <hr class="mt-3">
                                                    @endforeach
                                                    <textarea class="ckeditor form-control" id="latar_belakang" name="latar_belakang" value="{!!old('latar_belakang',$tor['latar_belakang'])!!}">{{$tor['latar_belakang']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rasionalisasi</label>
                                                    @foreach($komentar['rasionalisasi'] as $rasionalisasis)
                                                        <h6 style="color: #dc3545;">{{$rasionalisasis}}</h6>
                                                        <hr class="mt-3">
                                                    @endforeach
                                                    <textarea class="ckeditor form-control" id="rasionalisasi" name="rasionalisasi" rows="2">{{$tor['rasionalisasi']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tujuan</label>
                                                    @foreach($komentar['tujuan'] as $tujuans)
                                                    <h6 style="color: #dc3545;">{{$tujuans}}</h6>
                                                    <hr class="mt-3">
                                                    @endforeach
                                                    <textarea class="ckeditor form-control" id="tujuan" name="tujuan" rows="2">{{$tor['tujuan']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>mekanisme</label>
                                                    @foreach($komentar['mekanisme'] as $mekanismes)
                                                    <h6 style="color: #dc3545;">{{$mekanismes}}</h6>
                                                    <hr class="mt-3">
                                                    @endforeach
                                                    <textarea class="ckeditor form-control" id="mekanisme" name="mekanisme" rows="2">{{$tor['mekanisme']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>keberlanjutan</label>
                                                    @foreach($komentar['keberlanjutan'] as $keberlanjutans)
                                                    <h6 style="color: #dc3545;">{{$keberlanjutans}}</h6>
                                                    <hr class="mt-3">
                                                    @endforeach
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
                                                    @foreach($komentar['penanggung'] as $penanggungs)
                                                    <h6 style="color: #dc3545;">{{$penanggungs}}</h6>
                                                    <hr class="mt-3">
                                                    @endforeach
                                                    <select name="nama_pic" id="nama_pic" onchange="Ganti()" class="form-control @error('nama_pic') is-invalid @enderror" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                                                        @foreach ($pics as $pic)
                                                            <option value="{{$pic->id}}" @if (old('nama_pic',$tor['nama_pic']) == $pic->id) selected @endif>{{$pic->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email PIC Kegiatan</label>
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
                                                <!-- <div class="form-group">
                                                    <label>Jumlah Anggaran</label> -->
                                                <input name="jumlah_anggaran" id="jumlah_anggaran" value="{{old('jumlah_anggaran',$tor['jumlah_anggaran'])}}" type="hidden" class="form-control">
                                                <!-- </div> -->

                                                <div class="form-group">
                                                    <label>Rencana Penarikan Dana</label>
                                                    <select name="id_tw" id="id_tw" class="form-control">
                                                        <?php for ($t2 = 0; $t2 < count($tw); $t2++) { ?>
                                                            <option value="{{old('id_tw',$tw[$t2]->id)}}" {{$tw[$t2]->id == $tor['id_tw'] ? 'selected' : ''}}><?= $tw[$t2]->triwulan ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="create_by" value="{{$tor['create_by']}}">
                                                <input type="hidden" name="update_by" value="{{Auth()->user()->id}}">
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

<!-- J A V A S C R I P T   O T O M A T I S   S H O W   E M A I L -->
<script>
    $(document).ready(function() {
        $('#nama_pic').select2();
    });

    function Ganti() {
        var namapic = document.getElementById('nama_pic').value;
        $.ajax({
            url: '/getEmailPIC/' + namapic,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(key, pic) {
                    document.getElementById("email_pic").value = pic.email;
                    document.getElementById("kontak_pic").value = pic.telepon;
                });

            }
        });
    }
</script>
<!-- -------------------------------------------------------------------------- -->

</html>
@endcan