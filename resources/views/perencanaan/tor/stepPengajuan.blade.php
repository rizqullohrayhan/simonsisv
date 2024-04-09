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
                                    <h4 class="card-title">TAHAP PENGAJUAN TOR</h4>
                                </div>
                            </div>
                            <?php $data = 1 ?>
                            <div class="iq-card-body">
                                <form id="form-wizard1" class="text-center mt-4" method="post" action="{{ url('/tor/create') }}">
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
                                    </ul> <!-- TAHAP 1  -->
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
                                                    <input type="hidden" name="create_by" id="create_by" value="{{ Auth()->user()->id }}" class="custom-control-input">
                                                    <input type="hidden" name="update_by" id="update_by" value="{{ Auth()->user()->id }}" class="custom-control-input">


                                                    <div class="form-group">
                                                        <label><b>Jenis Ajuan</b></label><br />
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="customRadio6" name="jenis_ajuan" id="jenis_ajuan" value="Baru" class="custom-control-input" checked>
                                                            <label class="custom-control-label" for="customRadio6"> Baru </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label><b>Prodi</b></label>
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
                                                        <select name="id_p" id="id_p" class="form-control @error('id_p') is-invalid @enderror">
                                                            @foreach ($indikator_p as $item)
                                                                <option value="{{ $item->id }}" @if (old('id_p') == $item->id) selected @endif><?= $item->P . " - " . substr($item->deskripsi, 0, 100) ?></option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_P')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div><br />
                                                    <div class="row" style="border: 1cm;">
                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <b>
                                                                    <h6 class="card-title"><b>Indikator Kinerja Utama (IKU)</b></h6>
                                                                </b>
                                                                <div class="form-group">
                                                                    <label>Realisasi IKU {{date('Y')-1}} (%)</label>
                                                                    <input name="realisasi_IKU" value="{{old('realisasi_IKU')}}" id="realisasi_IKU" type="text" class="form-control @error('realisasi_IKU') is-invalid @enderror">
                                                                </div>
                                                                @error('realisasi_IKU')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label>Target IKU {{date('Y')}} (%)</label>
                                                                    <input name="target_IKU" value="{{old('target_IKU')}}" id="target_IKU" type="text" class="form-control @error('target_IKU') is-invalid @enderror">
                                                                </div>
                                                                @error('target_IKU')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <b>
                                                                    <h6 class="card-title"><b>Indikator Kinerja Kegiatan (IK)</b></h6>
                                                                </b>
                                                                <div class="form-group">
                                                                    <label>Realisasi IK {{date('Y')-1}} (%)</label>
                                                                    <input name="realisasi_IK" value="{{old('realisasi_IK')}}" id="realisasi_IK" type="text" class="form-control @error('realisasi_IK') is-invalid @enderror">
                                                                </div>
                                                                @error('realisasi_IK')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label>Target IK {{date('Y')}} (%)</label>
                                                                    <input name="target_IK" value="{{old('target_IK')}}" id="target_IK" type="text" class="form-control @error('target_IK') is-invalid @enderror">
                                                                </div>
                                                                @error('target_IK')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div><br />
                                                    <div class="form-group">
                                                        <label><b>Nama Kegiatan</b></label>
                                                        <input name="nama_kegiatan" value="{{old('nama_kegiatan')}}" id="nama_kegiatan" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" style="border: 1px solid #aaaaaa7d;">
                                                    </div>
                                                    @error('nama_kegiatan')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
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
                                                    <label><b>Latar Belakang</b></label>
                                                    <textarea class="ckeditor form-control @error('latar_belakang') is-invalid @enderror" id="latar_belakang" name="latar_belakang">{{old('latar_belakang')}}</textarea>
                                                </div>
                                                @error('latar_belakang')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label><b>Rasionalisasi</b></label>
                                                    <textarea class="ckeditor form-control @error('rasionalisasi') is-invalid @enderror" id="rasionalisasi" name="rasionalisasi" rows="2">{{old('rasionalisasi')}}</textarea>
                                                </div>
                                                @error('rasionalisasi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label><b>Tujuan</b></label>
                                                    <textarea class="ckeditor form-control @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" rows="2">{{old('tujuan')}}</textarea>
                                                </div>
                                                @error('tujuan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label><b>Mekanisme</b></label>
                                                    <textarea class="ckeditor form-control @error('mekanisme') is-invalid @enderror" id="mekanisme" name="mekanisme" rows="2">{{old('mekanisme')}}</textarea>
                                                </div>
                                                @error('mekanisme')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label><b>Keberlanjutan</b></label>
                                                    <textarea class="ckeditor form-control @error('keberlanjutan') is-invalid @enderror" id="keberlanjutan" name="keberlanjutan" rows="2">{{old('keberlanjutan')}}</textarea>
                                                </div>
                                                @error('keberlanjutan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

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
                                                    <label><b>Nama Perancana / Penanggungjawab Kegiatan</b></label><br />
                                                    <select name="nama_pic" id="selectnya" onchange="Ganti()" class="form-control @error('nama_pic') is-invalid @enderror" style="width: 100%;height:50px;line-height:45px;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;border-radius:5px">
                                                        @foreach ($pics as $pic)
                                                            <option value="{{$pic->id}}" @if (old('nama_pic') == $pic->id) selected @endif>{{$pic->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('nama_pic')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Email PIC Kegiatan</b></label>
                                                    <input name="email_pic" id="email_pic" type="email" class="form-control @error('email_pic') is-invalid @enderror" value="{{old('email_pic')}}" placeholder="">
                                                </div>

                                                <!-- J A V A S C R I P T   O T O M A T I S   S H O W   E M A I L -->
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#selectnya').select2();
                                                    });

                                                    function Ganti() {
                                                        var namapic = document.getElementById('selectnya').value;
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

                                                @error('email_pic')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label><b>Kontak PIC Kegiatan</b></label>
                                                    <input name="kontak_pic" value="{{old('kontak_pic')}}" id="kontak_pic" type="text" class="form-control @error('kontak_pic') is-invalid @enderror" placeholder="">
                                                </div>
                                                @error('kontak_pic')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
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
                                                    <label><b>Tanggal Mulai Pelaksanaan</b></label>
                                                    <input name="tgl_mulai_pelaksanaan" id="tgl_mulai_pelaksanaan" value="{{old('tgl_mulai_pelaksanaan')}}" type="date" class="form-control @error('tgl_mulai_pelaksanaan') is-invalid @enderror">
                                                </div>
                                                @error('tgl_mulai_pelaksanaan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label><b>Tanggal Selesai Pelaksanaan</b></label>
                                                    <input name="tgl_akhir_pelaksanaan" id="tgl_akhir_pelaksanaan" value="{{old('tgl_akhir_pelaksanaan')}}" type="date" class="form-control @error('tgl_akhir_pelaksanaan') is-invalid @enderror">
                                                </div>
                                                @error('tgl_akhir_pelaksanaan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <!-- <div class="form-group">
                                                    <label>Jumlah Anggaran</label> -->
                                                <input name="jumlah_anggaran" id="jumlah_anggaran" value="0" type="hidden" class="form-control @error('jumlah_anggaran') is-invalid @enderror">
                                                <!-- </div> -->

                                                <div class="form-group">
                                                    <label><b>Rencana Penarikan Dana</b></label>
                                                    <!-- substr($tw[$t2]->triwulan, 0, 4) -->
                                                    <select name="id_tw" id="id_tw" class="form-control @error('id_tw') is-invalid @enderror">
                                                        <?php for ($t2 = 0; $t2 < count($tw); $t2++) {
                                                            foreach ($tabeltahun as $thn) {
                                                                if ($thn->is_aktif == 1) {
                                                                    if ($thn->tahun == substr($tw[$t2]->triwulan, 0, 4)) { ?>
                                                                        <option value="{{$tw[$t2]->id}}" @if (old('id_tw') == $tw[$t2]->id) selected @endif><?= $tw[$t2]->triwulan ?></option>
                                                        <?php }
                                                                }
                                                            }
                                                        } ?>
                                                    </select>
                                                </div>
                                                @error('id_tw')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

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
        <script>
            $(document).ready(function() {
                $('#id_unit').select2();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#nama_pic').select2();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#id_subK').select2();
            });
        </script>

        @include('dashboards/users/layouts/footer')

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
<script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // CKEDITOR.replace( 'latar_belakang' );
        // CKEDITOR.replace( 'rasionalisasi' );
        // CKEDITOR.replace( 'tujuan' );
        // CKEDITOR.replace( 'mekanisme' );
        // CKEDITOR.replace( 'keberlanjutan' );
    });
</script>

<script>
    $('#tgl_mulai_pelaksanaan').on('input', function() {
        $('#tgl_akhir_pelaksanaan').attr('min', this.value);
    });
    $('#tgl_akhir_pelaksanaan').on('input', function() {
        $('#tgl_mulai_pelaksanaan').attr('max', this.value);
    });
</script>

</html>
@endcan