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
                            <div class="iq-card-body p-0">
                                <div class="iq-edit-list">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $active = 2; ?>
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="row">
                                <div class="container mt-2 mb-2 mr-2 ml-2">
                                    <a href="{{url('/torab')}}"><button type="button" class="btn btn-primary btn-sm mr-2">Back</button></a>
                                    <div class="user-list-files d-flex float-right">
                                        {{-- <a class="iq-bg-primary" href="javascript:void();" onclick="printDiv()">
                                            Print
                                        </a>
                                        <a class="iq-bg-primary" href="{{url('exportExcel/' . base64_encode($id) )}}" target="_blank">
                                            Excel
                                        </a> --}}
                                        {{-- <a class="iq-bg-primary" href="{{url('exportPdf/' . base64_encode($id) )}}" target="_blank">
                                            Pdf
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="container center" id="iniprint">
                                @php
                                    $iku = "";
                                    $ik = "";
                                    $p = "";
                                    $disetujui = 0; //apakah wd 3 sudah validasi?=
                                    if (!empty($indikator_p)) {
                                        $p =  $indikator_p->P;
                                        $deskripsi_p =  $indikator_p->deskripsi;
                                        $iku = $indikator_p->IKU;
                                        $deskripsi_iku = $indikator_p->deskripsi_iku;
                                        $ik = $indikator_p->IK;
                                        $deskripsi_ik = $indikator_p->deskripsi_ik;
                                    }
                                    for ($u = 0; $u < count($unit); $u++) { 
                                        if ($tor->id_unit == $unit[$u]->id) {
                                            $prodi = $unit[$u]->nama_unit;
                                        }
                                    } 
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

                                        foreach ($status as $status_item) {
                                            if ($trx_item->id_status == $status_item->id) {
                                                if ($status_item->nama_status == "Sudah Disetujui") {
                                                    $disetujui = 1;
                                                }
                                                if ($status_item->nama_status == "Sudah Revisi") {
                                                    $note = "<b><i>komentar sebelum perbaikan tor</b></i>";
                                                    $warna_komentar = "alert-success";
                                                }
                                            }
                                        }
                                    }

                                    $pengajuan = 0;
                                    $detail = "Lengkapi Data";
                                    $name;
                                    $dalamRevisi = 0; // apakah sekarang dalam proses revisi? jika iya, maka dpt ditampilkan aksi jadwal dan rab
                                    $countRevisi = 0; //megnhitung brp kali revisi
                                    $countPerbaikan = 0; //megnhitung brp kali perbaikan

                                    foreach ($trx_status_tor as $trx_item) {
                                        foreach ($status as $status_item) {
                                            if ($trx_item->id_status == $status_item->id) {
                                                $name = $status_item->nama_status;
                                                if ($status_item->nama_status == "Belum Dinilai") {
                                                    $pengajuan = 1;
                                                    $detail = "Detail";
                                                }
                                                if ($status_item->nama_status == "Revisi") {
                                                    $countRevisi += 1;
                                                }
                                                if ($status_item->nama_status == "Sudah Revisi") {
                                                    $countPerbaikan += 1;
                                                }
                                            }
                                        }
                                    }

                                    //jika jumlah revisi tidak sama dengan perbaikan, maka aktifkan button aksi
                                    if ($countRevisi != $countPerbaikan) {
                                        $dalamRevisi = 1;
                                    }
                                    $alertRevisi = ""; //menampilkan peringatan untuk merevisi jadwal dan rab
                                @endphp

                                    @if ($dalamRevisi == 1)
                                        @foreach ($trx_status_tor as $revisian)
                                            @php
                                                $kjadwalSudahRevisi = "Belum";
                                                foreach ($komponen_jadwal as $kjadwal){
                                                    if ($kjadwal->id_tor == $tor->id && ($kjadwal->updated_at > $revisian->created_at || $kjadwal->created_at > $revisian->created_at)){
                                                        $kjadwalSudahRevisi = "Sudah";
                                                    }
                                                }
                                                $angSudahRevisi = "Belum";
                                                foreach ($anggaran as $ang) {
                                                    if ($ang->id_rab == $rab->id) {
                                                        if ($ang->updated_at > $revisian->created_at || $ang->created_at > $revisian->created_at) {
                                                            $angSudahRevisi = "Sudah";
                                                        }
                                                    }
                                                }
                                            @endphp

                                            @foreach ($status as $statusrevisian)
                                                @if ($revisian->id_status == $statusrevisian->id && $statusrevisian->nama_status == "Revisi")
                                                    @if (!empty($revisian->k_jadwal && $kjadwalSudahRevisi == "Belum"))
                                                        <div class="alert text-white bg-danger" role="alert">
                                                            <div class="iq-alert-icon">
                                                                <i class="ri-information-line"></i>
                                                            </div>
                                                            <div class="iq-alert-text">Anda belum merevisi <b>KOMPONEN JADWAL KEGIATAN</b> ! </div>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <i class="ri-close-line"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @if (!empty($revisian->k_rab && $angSudahRevisi == "Belum"))
                                                        <div class="alert text-white bg-danger" role="alert">
                                                            <div class="iq-alert-icon">
                                                                <i class="ri-information-line"></i>
                                                            </div>
                                                            <div class="iq-alert-text">Anda belum merevisi <b>ANGGARAN PADA RAB</b> ! </div>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <i class="ri-close-line"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif

                                    <div class="container center">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td colspan="8">
                                                            <h5 style="text-align: center;"><b>KERANGKA ACUAN KERJA (KAK) / TERM OF REFERENCE (ToR) <br />
                                                                    PROGRAM STUDI {{strtoupper($prodi)}}<br />SEKOLAH VOKASI UNIVERSITAS SEBELAS MARET</b></h5>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td width="2%"><b>1.</b></td>
                                                        <td width="28%"><b>Indikator Kinerja Utama</b></td>
                                                        <td width="3%">:</td>
                                                        <td width="7%"><b>{{$iku}}</b></td>
                                                        <td colspan="4" width="50%">{{$deskripsi_iku}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>2.</b></td>
                                                        <td><b>Indikator Kegiatan (IK)</b></td>
                                                        <td>:</td>
                                                        <td><b>{{$ik}}</b></td>
                                                        <td colspan="4">{{$deskripsi_ik}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>3.</b></td>
                                                        <td><b>Program</b></td>
                                                        <td>:</td>
                                                        <td><b>{{$p}}</b></td>
                                                        <td colspan="4">{{$deskripsi_p}}
                                                            @if (!empty($komentar['sub']))
                                                                <p>
                                                                    <a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komensub" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a>
                                                                </p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komensub">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['sub'] as $j)
                                                                    <h6 style="color: #dc3545;">{{$j}}</h6>
                                                                    <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Judul Kegiatan -->
                                                    <tr>
                                                        <td><b>4.</b></td>
                                                        <td><b>Judul Kegiatan</b></td>
                                                        <td>:</td>
                                                        <td colspan="4">
                                                            {{$tor->nama_kegiatan}}
                                                            @if (!empty($komentar['judul']))
                                                                <p>
                                                                    <a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenjudul" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a>
                                                                </p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenjudul">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['judul'] as $j)
                                                                    <h6 style="color: #dc3545;">{{$j}}</h6>
                                                                    <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Latar Belakang -->
                                                    <tr>
                                                        <td><b>5.</b></td>
                                                        <td colspan="7"><b>Latar Belakang</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7" style="text-align: justify;">
                                                            {!!$tor->latar_belakang!!}
                                                            @if (!empty($komentar['latar_belakang']))
                                                                <p>
                                                                    <a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenlatar" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a>
                                                                </p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenlatar">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['latar_belakang'] as $l)
                                                                        <h6 style="color: #dc3545;">{{$l}}</h6>
                                                                        <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Rasionalisasi -->
                                                    <tr>
                                                        <td><b>6.</b></td>
                                                        <td colspan="7"><b>Rasionalisasi</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7" style="text-align: justify;">{!!$tor->rasionalisasi!!}
                                                            @if (!empty($komentar['rasionalisasi']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenrasionalisasi" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenrasionalisasi">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['rasionalisasi'] as $r)
                                                                        <h6 style="color: #dc3545;">{{$r}}</h6>
                                                                        <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Tujuan -->
                                                    <tr>
                                                        <td><b>7.</b></td>
                                                        <td colspan="7"><b>Tujuan</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7" style="text-align: justify;"> {!!$tor->tujuan!!}
                                                            @if (!empty($komentar['tujuan']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komentujuan" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komentujuan">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['tujuan'] as $tujuan)
                                                                    <h6 style="color: #dc3545;">{{$tujuan}}</h6>
                                                                    <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Mekanisme dan Rancangan -->
                                                    <tr>
                                                        <td><b>8.</b></td>
                                                        <td colspan="7"><b>Mekanisme dan Rancangan</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7" style="text-align: justify;">{!!$tor->mekanisme!!}
                                                            @if (!empty($komentar['mekanisme']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenmekanisme" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenmekanisme">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['mekanisme'] as $mekanisme)
                                                                    <h6 style="color: #dc3545;">{{$mekanisme}}</h6>
                                                                    <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Jadwal Pelaksanaan -->
                                                    <tr>
                                                        <td><b>9.</b></td>
                                                        <td colspan="7"><b>Jadwal Pelaksanaan</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7">
                                                            <span>
                                                                Tentukan rincian jadwal yang realistik untuk pelaksanaan tiap kegiatan (mengacu pada mekanisme dan rancangan)
                                                            </span>
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
                                                            @php
                                                                foreach ($roles as $roles1) {
                                                                    if ($roles1->id == Auth::user()->role) {
                                                                        $RoleLogin = $roles1->name;
                                                                    }
                                                                }
                                                            @endphp
                                                            <!-- TAMBAH JADWAL -->
                                                            @if (!empty($komponen_jadwal))
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col" rowspan="2" class="align-middle">Komponen Input
                                                                                @if ($disetujui != 1 && $tor->nama_pic == Auth::user()->name || $RoleLogin == "Prodi" || $RoleLogin == "Admin")
                                                                                    @if ($pengajuan == 0 || $dalamRevisi == 1)
                                                                                        <a id="validasi" class="iq-bg-success rounded rounded mt-3 mb-1" style="padding: 0.5%;margin: top 12px;" data-toggle="modal" title="Tambah Jadwal" data-original-title="Tambah Jadwal" data-target="#tambah_jadwal{{ $tor->id }}" href="">
                                                                                            <i class="ri-user-add-line"></i> Tambah Jadwal<br />
                                                                                        </a>
                                                                                    @endif
                                                                                @endif
                                                                            </th>
                                                                            <th scope="col" colspan="12" style="text-align: center;">{{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                                                            <th id="validasi"></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>2</td>
                                                                            <td>3</td>
                                                                            <td>4</td>
                                                                            <td>5</td>
                                                                            <td>6</td>
                                                                            <td>7</td>
                                                                            <td>8</td>
                                                                            <td>9</td>
                                                                            <td>10</td>
                                                                            <td>11</td>
                                                                            <td>12</td>
                                                                            <td id="validasi">
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($komponen_jadwal as $komponen)
                                                                            <tr>
                                                                                <td>{{$komponen->komponen}}</td>
                                                                                @for ($b = 1; $b < $komponen->bulan_awal; $b++)
                                                                                    <td></td>
                                                                                @endfor
                                                                                @for ($kj = 0; $kj <= ($komponen->bulan_akhir - $komponen->bulan_awal); $kj++)
                                                                                    <td style=" background-color:black!important; -webkit-print-color-adjust: exact; "></td>
                                                                                @endfor
                                                                                @for ($c = 12; $c > $komponen->bulan_akhir; $c--)
                                                                                    <td></td>
                                                                                @endfor
                                                                                @if ($disetujui != 1 && $tor->nama_pic == Auth::user()->name || $RoleLogin == "Prodi" || $RoleLogin == "Admin")
                                                                                    <td id="validasi">
                                                                                        @if ($pengajuan == 0 || $dalamRevisi == 1)
                                                                                            <div class="flex align-items-center list-user-action">
                                                                                                <a class="iq-bg-primary rounded" style="padding: 1%;" data-toggle="modal" data-placement="top" title="Edit Jadwal" data-original-title="Edit Jadwal" data-target="#edit_jadwal{{$komponen->id}}" href=""><i class="ri-pencil-line"></i></a>
                                                                                                <a class="jadwal-confirm iq-bg-danger rounded" style="padding: 1%;margin:2%" href="{{url('/tor/delete_jadwal/'.base64_encode($komponen->id))}}" data-toggle="tooltip" title="Delete">
                                                                                                    <i class="ri-delete-bin-line"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        @endif
                                                                                        <!-- Modal Ubah Jadwal -->
                                                                                        <div class="modal fade" role="dialog" id="edit_jadwal{{$komponen->id}}" style="overflow:hidden;">
                                                                                            <div class="modal-dialog" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title">Edit Jadwal Pelaksanaan</h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <form class="form-horizontal" method="post" action="{{ url('/tor/update_jadwal/'.$komponen->id) }}">
                                                                                                            @csrf
                                                                                                            <label>Contoh</label><br />
                                                                                                            <img width="450" src="../assets/contoh/jadwaltor.png">
                                                                                                            <br />
                                                                                                            <div class="form-group">
                                                                                                                <label>TOR</label>
                                                                                                                <select name="id_tor" id="id_tor" class="form-control">
                                                                                                                    <option value="{{$tor->id}}">{{$tor->nama_kegiatan}}</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <label>Komponen</label>
                                                                                                                <textarea class="form-control" name="komponen" id="komponen" value="{{old('komponen',$komponen->komponen)}}" rows="2">{{$komponen->komponen}}
                                                                                                                </textarea>
                                                                                                            </div>
                                                                                                            <div class="row">
                                                                                                                <div class="col">
                                                                                                                    <label>Mulai Kegiatan</label>
                                                                                                                    <select name="bulan_awal" id="bulan_awal_ubah" onclick="min_ubah()" class="form-control">
                                                                                                                        <option hidden>Pilih</option>
                                                                                                                        <?php
                                                                                                                        $bulan = [
                                                                                                                            'Januari', 'Februari', 'Maret', 'April',
                                                                                                                            'Mei', 'Juni', 'Juli', 'Agustus',
                                                                                                                            'September',  'Oktober', 'November', 'Desember'
                                                                                                                        ];
                                                                                                                        for ($ba = 1; $ba <= 12; $ba++) { ?>
                                                                                                                            <option {{ $ba==$komponen->bulan_awal ? 'selected' : ''}} value="{{$ba}}">{{$bulan[$ba-1]}}</option>
                                                                                                                        <?php } ?>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <div class="col">
                                                                                                                    <label>Selesai Kegiatan</label>
                                                                                                                    <select name="bulan_akhir" id="bulan_akhir_ubah" onclick="max_ubah()" class="form-control">
                                                                                                                        <option hidden>Pilih</option>
                                                                                                                        <?php
                                                                                                                        $bulan = [
                                                                                                                            'Januari', 'Februari', 'Maret', 'April',
                                                                                                                            'Mei', 'Juni', 'Juli', 'Agustus',
                                                                                                                            'September',  'Oktober', 'November', 'Desember'
                                                                                                                        ];
                                                                                                                        for ($br = 1; $br <= 12; $br++) { ?>
                                                                                                                            <option {{ $br==$komponen->bulan_akhir ? 'selected' : ''}} value="{{$br}}">{{$bulan[$br-1]}}</option>
                                                                                                                        <?php } ?>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <input name="created_at" id="created_at" type="hidden" value="{{ $komponen->created_at }}">
                                                                                                                <input name="updated_at" id="updated_at" type="hidden" value="{{ date('Y-m-d H:i:s') }}">
                                                                                                            </div>
                                                                                                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                                                                        </form>
                                                                                                        <script>
                                                                                                            function min_ubah() {
                                                                                                                var selectBox = document.getElementById("bulan_awal_ubah");
                                                                                                                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                                                                                                                console.log(selectedValue);
                                                                                                                for (i = 1; i <= 12; i++) {
                                                                                                                    if (i < selectedValue) {
                                                                                                                        document.getElementById("bulan_akhir_ubah").options[i].disabled = true;
                                                                                                                    } else {
                                                                                                                        document.getElementById("bulan_akhir_ubah").options[i].disabled = false;
                                                                                                                    }
                                                                                                                }
                                                                                                            };

                                                                                                            function max_ubah() {
                                                                                                                var selectBox = document.getElementById("bulan_akhir_ubah");
                                                                                                                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                                                                                                                console.log(selectedValue);
                                                                                                                for (i = 1; i <= 12; i++) {
                                                                                                                    if (i > selectedValue) {
                                                                                                                        document.getElementById("bulan_awal_ubah").options[i].disabled = true;
                                                                                                                    } else {
                                                                                                                        document.getElementById("bulan_awal_ubah").options[i].disabled = false;
                                                                                                                    }
                                                                                                                }
                                                                                                            };
                                                                                                        </script>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @endif

                                                            <!-- Komentar jadwal -->
                                                            @if (!empty($komentar['jadwal']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenjadwal" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenjadwal">
                                                                <div class="container ml-3">
                                                                    @foreach($komentar['jadwal'] as $jadwal)
                                                                    <h6 style="color: #dc3545;">{{$jadwal}}</h6>
                                                                    <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Indikator Kinerja Utama (IKU) -->
                                                    <tr>
                                                        <td><b>10.</b></td>
                                                        <td colspan="7"><b>Indikator Kinerja Utama (IKU)</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" width="65%">Indikator</th>
                                                                        <th scope="col">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                                                        <th scope="col">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{$iku ." ".$deskripsi_iku}}</td>
                                                                        <td>{{$tor->realisasi_IKU ."%"}}</td>
                                                                        <td>{{$tor->target_IKU ."%"}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <!-- komentar IK -->
                                                            @if (!empty($komentar['iku']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenik" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenik">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['iku'] as $ik)
                                                                    <h6 style="color: #dc3545;">{{$ik}}</h6>
                                                                    <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Indikator Kinerja Kegiatan (IK) -->
                                                    <tr>
                                                        <td><b>11.</b></td>
                                                        <td colspan="7"><b>Indikator Kinerja Kegiatan (IK)</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" width="65%">Indikator</th>
                                                                        <th scope="col">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                                                        <th scope="col">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{$ik ." ".$deskripsi_ik}}</td>
                                                                        <td>{{$tor->realisasi_IK ."%"}}</td>
                                                                        <td>{{$tor->target_IK ."%"}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- Komentar IK -->
                                                            @if (!empty($komentar['ik']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenik" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenik">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['ik'] as $ik)
                                                                        <h6 style="color: #dc3545;">{{$ik}}</h6>
                                                                        <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Keberlanjutan -->
                                                    <tr>
                                                        <td><b>12.</b></td>
                                                        <td colspan="7"><b>Keberlanjutan</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7">
                                                            {!!$tor->keberlanjutan!!}
                                                            @if (!empty($komentar['keberlanjutan']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenkeberlanjutan" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenkeberlanjutan">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['keberlanjutan'] as $keberlanjutan)
                                                                        <h6 style="color: #dc3545;">{{$keberlanjutan}}</h6>
                                                                        <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Penanggungjawab -->
                                                    <tr>
                                                        <td><b>13.</b></td>
                                                        <td colspan="7"><b>Penanggungjawab</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="7">
                                                            Penanggung jawab dari kegiatan ini adalah {{$tor->pic->name }} NIK. {{$tor->pic->nip }}
                                                            @if (!empty($komentar['penanggung']))
                                                                <p><a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenpenanggung" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                        Lihat Komentar
                                                                    </a></p>
                                                            @else
                                                                <br />
                                                            @endif
                                                            <div class="container collapse col-6" id="komenpenanggung">
                                                                <div id="validasi" class="container ml-3">
                                                                    @foreach($komentar['penanggung'] as $penanggung)
                                                                        <h6 style="color: #dc3545;">{{$penanggung}}</h6>
                                                                        <hr class="mt-3">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td colspan="4" style="padding-left: 16.8rem; padding-bottom: 0;">Surakarta</td>
                                                    </tr>
                                                    <!-- TANDA TANGAN -->
                                                    <tr>
                                                        <td colspan="4" style="text-align: center; padding-top: 0;" width="50%">{{ $tor->unit->user->jabatan }}
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <b>{{ $tor->unit->user->name }}</b>
                                                            <br/>
                                                            NIP. {{ $tor->unit->user->nip }}
                                                        </td>
                                                        <td colspan="4" style="text-align: center; padding-top: 0;">Perencana/Penanggungjawab
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <b>{{$tor->pic->name}}</b><br />
                                                            {{"NIP. ". $tor->pic->nip }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" style="text-align: center; padding-bottom: 0;">Menyetujui</td>
                                                    </tr>
                                                    <tr >
                                                        <td colspan="8" style="text-align: center;">{{ $verifikator->jabatan }}
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <b>{{ $verifikator->name }}</b><br />
                                                            NIP. {{ $verifikator->nip }}
                                                        </td>
                                                    </tr>
                                                    <!-- TANDA TANGAN -->

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!-- R A B -->
                    @if ($rab)
                        <div class="col-sm-12">
                            <div class="iq-card">
                                @include('perencanaan/rab/lengkapirab')
                                @if (!empty($komentar['rab']))
                                    <p>
                                        <a id="validasi" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="#komenrab" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Lihat Komentar
                                        </a>
                                    </p>
                                @else
                                    <br />
                                @endif
                                <div class="container collapse col-6" id="komenrab">
                                    <div id="validasi" class="container ml-3">
                                        @foreach($komentar['rab'] as $rabs)
                                            <h6 style="color: #dc3545;">{{$rabs}}</h6>
                                            <hr class="mt-3">
                                        @endforeach
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    @endif
                    <!-- Modal Tambah Jadwal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="tambah_jadwal<?= $tor->id ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Jadwal Pelaksanaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" action="{{ url('/tor/create_jadwal/') }}">
                                        @csrf
                                        <label>Contoh</label><br />
                                        <img width="450" src="../assets/contoh/jadwaltor.png">
                                        <br />
                                        <div class="form-group">
                                            <label>TOR</label>
                                            <select name="id_tor" id="id_tor" class="form-control">
                                                <option value="{{$tor->id}}">{{$tor->nama_kegiatan}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label>Komponen Jadwal</label>
                                            <textarea class="form-control" id="komponen" name="komponen" rows="2" placeholder="komponen..."></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label>Mulai Kegiatan</label>
                                                <select name="bulan_awal" id="bulan_awal" onclick="min()" class="form-control">
                                                    <option hidden>Pilih</option>
                                                    <?php
                                                    $bulan = [
                                                        'Januari', 'Februari', 'Maret', 'April',
                                                        'Mei', 'Juni', 'Juli', 'Agustus',
                                                        'September',  'Oktober', 'November', 'Desember'
                                                    ];
                                                    for ($ba = 1; $ba <= 12; $ba++) { ?>
                                                        <option value="{{$ba}}">{{$bulan[$ba-1]}}</option>
                                                    <?php } ?>
                                                </select>
                                                <!-- <input type="month" id="start" name="start" min="2018-03" value="2018-05"> -->
                                            </div>
                                            <div class="col">
                                                <label>Selesai Kegiatan</label>
                                                <select name="bulan_akhir" id="bulan_akhir" onclick="max()" class="form-control">
                                                    <option hidden>Pilih</option>
                                                    <?php
                                                    $bulan = [
                                                        'Januari', 'Februari', 'Maret', 'April',
                                                        'Mei', 'Juni', 'Juli', 'Agustus',
                                                        'September',  'Oktober', 'November', 'Desember'
                                                    ];
                                                    for ($br = 1; $br <= 12; $br++) { ?>
                                                        <option value="{{$br}}">{{$bulan[$br-1]}}</option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                                        <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                                        <br />
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    </form>
                                    <script>
                                        function min() {
                                            var selectBox = document.getElementById("bulan_awal");
                                            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                                            console.log(selectedValue);
                                            for (i = 1; i < 12; i++) {
                                                if (i < selectedValue) {
                                                    document.getElementById("bulan_akhir").options[i].disabled = true;
                                                } else {
                                                    document.getElementById("bulan_akhir").options[i].disabled = false;
                                                }
                                            }
                                        };

                                        function max() {
                                            var selectBox = document.getElementById("bulan_akhir");
                                            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                                            console.log(selectedValue);
                                            for (i = 1; i < 12; i++) {
                                                if (i > selectedValue) {
                                                    document.getElementById("bulan_awal").options[i].disabled = true;
                                                } else {
                                                    document.getElementById("bulan_awal").options[i].disabled = false;
                                                }
                                            }
                                        };
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Tambah IKU -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="tambah_iku<?= $tor->id ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah IKU</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" action="{{ url('/tor/create_indikator/') }}">
                                        @csrf
                                        <label>Contoh</label><br />
                                        <img width="450" src="../assets/contoh/contohiku.png">
                                        <br />
                                        <div class="form-group">
                                            <label>TOR</label>
                                            <select name="id_tor" id="id_tor" class="form-control">
                                                <option value="{{$tor->id}}">{{$tor->nama_kegiatan}}</option>
                                            </select>
                                        </div>
                                        <div class="container mt-3">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <input name="jenis" id="jenis" value="IKU" type="hidden" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Realisasi</label>
                                                        <input name="realisasi" id="realisasi" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tahun Realisasi</label>
                                                        <input name="thn_realisasi" id="thn_realisasi" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Target</label>
                                                        <input name="target" id="target" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tahun Target</label>
                                                        <input name="thn_target" id="thn_target" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <hr>
                    <!-- Modal Tambah IK -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="tambah_ik<?= $tor->id ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah IK</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" action="{{ url('/tor/create_indikator/') }}">
                                        @csrf
                                        <label>Contoh</label><br />
                                        <img width="450" src="../assets/contoh/contohik.png">
                                        <br />
                                        <div class="form-group">
                                            <label>TOR</label>
                                            <select name="id_tor" id="id_tor" class="form-control">
                                                <option value="{{$tor->id}}">{{$tor->nama_kegiatan}}</option>
                                            </select>
                                        </div>
                                        <div class="container mt-3">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <input name="jenis" id="jenis" value="IK" type="hidden" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Realisasi</label>
                                                        <input name="realisasi" id="realisasi" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tahun Realisasi</label>
                                                        <input name="thn_realisasi" id="thn_realisasi" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Target</label>
                                                        <input name="target" id="target" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tahun Target</label>
                                                        <input name="thn_target" id="thn_target" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>

                                    </form>
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
    <script>
        function remove() {
            var n = document.getElementById("validasi");
            while (n) {
                document.getElementById("validasi").remove();
            }
        };

        function printDiv() {
            var printContents = document.getElementById("iniprint").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            // document.getElementById("buttonremove1").remove();
            // document.getElementById("buttonremove2").remove();
            window.print();
        };
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.jadwal-confirm').on('click', function(event) {
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
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.anggaran-confirm').on('click', function(event) {
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
    </script> -->

    @include('dashboards/users/layouts/footer')

</body>

</html>