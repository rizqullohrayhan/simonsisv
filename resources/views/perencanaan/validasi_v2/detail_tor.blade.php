<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

?>
@include('dashboards/users/layouts/script')

<body>
    {{-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> --}}
    <div class="wrapper">
        @include('dashboards/users/layouts/navbar')
        @include('dashboards/users/layouts/sidebar')

        <?php
        $disetujui = 0; //apakah 3 sudah validasi? 
        $current_status = 'Belum Dinilai';
        ?>
        
        <form method="post" action="/validasi/createValTor">
            @csrf
            <!-- Page Content  -->
            <div id="content-page" class="content-page">
                <div class="container-fluid">
                    <div class="row">
                        <?php $active = 2; ?>
                        <div class="col-sm-12">
                            <div class="iq-card">
                                <div class="row">
                                    <div class="container mt-2 mb-2 mr-2 ml-2">
                                        <?php if (Auth::user()->getroleNames()[0] != 'Admin') { ?>
                                            <a href="{{url('/validasi')}}"><button type="button" class="btn btn-primary btn-sm mr-2">Back</button></a>
                                        <?php }
                                        if (Auth::user()->getroleNames()[0] == 'Admin') { ?>
                                            <a href="{{url('/monitoringUsulan')}}"><button type="button" class="btn btn-primary btn-sm mr-2">Back</button></a>
                                        <?php } ?>
                                        <div class="user-list-files d-flex float-right">
                                            <a class="iq-bg-primary" href="javascript:void();" onclick="printDiv()">
                                                Print
                                            </a>
                                            <a class="iq-bg-primary" href="{{url('exportExcel/' . base64_encode($id) )}}" target="_blank">
                                                Excel
                                            </a>
                                            <a class="iq-bg-primary" href="{{url('exportPdf/' . base64_encode($id) )}}" target="_blank">
                                                Pdf
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <br />
                                <div class="container center" id="iniprint">
                                    @php
                                        $iku = "";
                                        $ik = "";
                                        $indikator_k = "n";
                                        $warna_komentar = "alert-danger"; //warna komentar
                                        $note = "";
                                    @endphp

                                    <!-- SUB K -->
                                    @php
                                        if (!empty($indikator_p)) {
                                            $p =  $indikator_p->P;
                                            $deskripsi_p =  $indikator_p->deskripsi;
                                            $iku = $indikator_p->IKU;
                                            $deskripsi_iku = $indikator_p->deskripsi_iku;
                                            $ik = $indikator_p->IK;
                                            $deskripsi_ik = $indikator_p->deskripsi_ik;
                                        }
                                    @endphp
                                    <!-- PRODI -->
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

                                            foreach ($status as $status_item) {
                                                if ($trx_item->id_status == $status_item->id) {
                                                    $current_status = $status_item->nama_status;
                                                    if ($status_item->nama_status == "Sudah Dinilai") {
                                                        $disetujui = 1;
                                                    }
                                                    if ($status_item->nama_status == "Sudah Revisi") {
                                                        $note = "<b><i>komentar sebelum perbaikan tor</b></i>";
                                                        $warna_komentar = "alert-success";
                                                    }
                                                }
                                            }
                                        }

                                        function buttonKomentar($Href)
                                        {
                                            echo '<a id="komen" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="' . $Href . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    Lihat Komentar
                                                </a>';
                                        }

                                        function buttonPlus($Href)
                                        {
                                            echo ' <a id="validasiplus" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="' . $Href . '" role="button" aria-expanded="false" aria-controls="' . $Href . '">
                                            <i class="las la-plus"></i> Tambah
                                        </a>';
                                        }

                                        function areaKomentar($idArea, $nameArea, $place)
                                        {
                                            echo ' <div class="container collapse col-6" id="' . $idArea . '">
                                            <div id="validasi" class="form-group">
                                                <textarea class="form-control" style="background:#c7c3c317" rows="1" id="' . $nameArea . '" name="' . $nameArea . '" placeholder="Komentar ' . $place . '..."></textarea>
                                            </div>
                                        </div>';
                                        }

                                        function collapseKomentar()
                                        {
                                            echo '<div class="collapse" id="collapseExample1">
                                            <div id="validasi" class="container col-sm-12">';
                                            echo '</div>
                                        </div>';
                                        }

                                    @endphp

                                    <div class="table-responsive">
                                        <table id="torx" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td colspan="8">
                                                        <h5 style="text-align: center;"><b>KERANGKA ACUAN KERJA (KAK) / TERM OF REFERENCE (ToR) <br />
                                                                PROGRAM STUDI {{strtoupper($prodi)}}<br />SEKOLAH VOKASI UNIVERSITAS SEBELAS</b></h5>
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
                                                            {!! buttonKomentar("#lihatkomen3") !!}
                                                        @endif
                                                        @if ($disetujui != 1)
                                                            @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                {!! buttonPlus("#komen3") !!}
                                                            @endif
                                                            {!! areaKomentar("komen3", "k_sub", "Program") !!}
                                                        @endif
                                                        <div class="collapse" id="lihatkomen3">
                                                            <div id="validasi" class="container col-sm-12">
                                                                <?php
                                                                if (!empty($komentar['sub'])) {
                                                                    echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                                }
                                                                ?>
                                                                @foreach($komentar['sub'] as $subs)
                                                                <h6 style="color: #dc3545;">{{$subs}}</h6>
                                                                <hr class="mt-3">
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>4.</b></td>
                                                    <td><b>Judul Kegiatan</b></td>
                                                    <td>:</td>
                                                    <td colspan="5">
                                                        {{ $tor->nama_kegiatan }} <br/>
                                                        @if (!empty($komentar['judul']))
                                                            {!! buttonKomentar("#lihatkomen5") !!}
                                                        @endif
                                                        @if ($disetujui != 1)
                                                            @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                {!! buttonPlus("#komen5") !!}
                                                            @endif
                                                            {!! areaKomentar("komen5", "k_judul", "Judul Kegiatan") !!}
                                                        @endif
                                                        <div class="collapse" id="lihatkomen5">
                                                            <div id="validasi" class="container col-sm-12">
                                                                <?php
                                                                if (!empty($komentar['judul'])) {
                                                                    echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                                }
                                                                ?>
                                                                @foreach($komentar['judul'] as $juduls)
                                                                <h6 style="color: #dc3545;">{{$juduls}}</h6>
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
                                                    <td colspan="7" style="text-align: justify;">{!!$tor->latar_belakang!!}
                                                        <p>
                                                            <?php if (!empty($komentar['latar_belakang'])) {
                                                                buttonKomentar("#lihatkomen6");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen6") ?>
                                                                @endif
                                                        </p>

                                                        <?php areaKomentar("komen6", "k_latar_belakang", "latarbelakang Kegiatan"); ?>
                                                    <?php } ?>
                                                    <div class="collapse" id="lihatkomen6">
                                                        <div id="validasi" class="container col-sm-12">
                                                            <?php
                                                            if (!empty($komentar['latar_belakang'])) {
                                                                echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                            }
                                                            ?>
                                                            @foreach($komentar['latar_belakang'] as $latarbelakangs)
                                                            <h6 style="color: #dc3545;">{{$latarbelakangs}}</h6>
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
                                                        <p>
                                                            <?php if (!empty($komentar['rasionalisasi'])) {
                                                                buttonKomentar("#lihatkomen7");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen7") ?>
                                                                @endif
                                                        </p>
                                                        <?php areaKomentar("komen7", "k_rasionalisasi", "rasionalisasi Kegiatan"); ?>
                                                    <?php } ?>
                                                    <div class="collapse" id="lihatkomen7">
                                                        <div id="validasi" class="container col-sm-12">
                                                            <?php
                                                            if (!empty($komentar['rasionalisasi'])) {
                                                                echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                            }
                                                            ?>
                                                            @foreach($komentar['rasionalisasi'] as $rasionalisasis)
                                                            <h6 style="color: #dc3545;">{{$rasionalisasis}}</h6>
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
                                                    <td colspan="7" style="text-align: justify;">{!!$tor->tujuan!!}
                                                        <p>
                                                            <?php if (!empty($komentar['tujuan'])) {
                                                                buttonKomentar("#lihatkomen8");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen8") ?>
                                                                @endif
                                                        </p>
                                                        <?php areaKomentar("komen8", "k_tujuan", "tujuan Kegiatan"); ?>
                                                    <?php } ?>
                                                    <div class="collapse" id="lihatkomen8">
                                                        <div id="validasi" class="container col-sm-12">
                                                            <?php
                                                            if (!empty($komentar['tujuan'])) {
                                                                echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                            }
                                                            ?>
                                                            @foreach($komentar['tujuan'] as $tujuans)
                                                            <h6 style="color: #dc3545;">{{$tujuans}}</h6>
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
                                                    <td colspan="7">{!!$tor->mekanisme!!}
                                                        <p>
                                                            <?php if (!empty($komentar['mekanisme'])) {
                                                                buttonKomentar("#lihatkomen9");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen9") ?>
                                                                @endif
                                                        </p>
                                                        <?php areaKomentar("komen9", "k_mekanisme", "mekanisme Kegiatan"); ?>
                                                    <?php } ?>
                                                    <div class="collapse" id="lihatkomen9">
                                                        <div id="validasi" class="container col-sm-12">
                                                            <?php
                                                            if (!empty($komentar['mekanisme'])) {
                                                                echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                            }
                                                            ?>
                                                            @foreach($komentar['mekanisme'] as $mekanismes)
                                                            <h6 style="color: #dc3545;">{{$mekanismes}}</h6>
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
                                                        <br />
                                                        @if (!empty($komponen_jadwal))
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" rowspan="2" class="align-middle">Komponen Input</th>
                                                                        <th scope="col" colspan="12" style="text-align: center;">{{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                        <p>
                                                            <?php if (!empty($komentar['jadwal'])) {
                                                                buttonKomentar("#lihatkomen10");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen10") ?>
                                                                @endif
                                                        </p>
                                                        <?php areaKomentar("komen10", "k_jadwal", "jadwal Kegiatan"); ?>
                                                        <?php } ?>
                                                        <div class="collapse" id="lihatkomen10">
                                                            <div id="validasi" class="container col-sm-12">
                                                                <?php
                                                                if (!empty($komentar['jadwal'])) {
                                                                    echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                                }
                                                                ?>
                                                                @foreach($komentar['jadwal'] as $jadwals)
                                                                <h6 style="color: #dc3545;">{{$jadwals}}</h6>
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
                                                                    <th scope="col">Indikator</th>
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
                                                        <p>
                                                            <?php if (!empty($komentar['iku'])) {
                                                                buttonKomentar("#lihatkomen11");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen11") ?>
                                                                @endif
                                                        </p>
                                                        <?php areaKomentar("komen11", "k_iku", "iku Kegiatan"); ?>
                                                    <?php } ?>
                                                    <div class="collapse" id="lihatkomen11">
                                                        <div id="validasi" class="container col-sm-12">
                                                            <?php
                                                            if (!empty($komentar['iku'])) {
                                                                echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                            }
                                                            ?>
                                                            @foreach($komentar['iku'] as $ikus)
                                                            <h6 style="color: #dc3545;">{{$ikus}}</h6>
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
                                                                    <th scope="col">Indikator</th>
                                                                    <th scope="col">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                                                    <th scope="col">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{$iku ." ".$deskripsi_ik}}</td>
                                                                    <td>{{$tor->realisasi_IK ."%"}}</td>
                                                                    <td>{{$tor->target_IK ."%"}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p>
                                                            <?php if (!empty($komentar['ik'])) {
                                                                buttonKomentar("#lihatkomen12");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen12") ?>
                                                                @endif
                                                        </p>
                                                        <?php areaKomentar("komen12", "k_ik", "ik Kegiatan"); ?>
                                                    <?php } ?>
                                                    <div class="collapse" id="lihatkomen12">
                                                        <div id="validasi" class="container col-sm-12">
                                                            <?php
                                                            if (!empty($komentar['ik'])) {
                                                                echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                            }
                                                            ?>
                                                            @foreach($komentar['ik'] as $iks)
                                                            <h6 style="color: #dc3545;">{{$iks}}</h6>
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
                                                        <p>
                                                            <?php if (!empty($komentar['keberlanjutan'])) {
                                                                buttonKomentar("#lihatkomen13");
                                                            } ?>
                                                            <?php if ($disetujui != 1) { ?>
                                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                <?php buttonPlus("#komen13") ?>
                                                                @endif
                                                        </p>
                                                        <?php areaKomentar("komen13", "k_keberlanjutan", "keberlanjutan Kegiatan"); ?>
                                                    <?php } ?>
                                                    <div class="collapse" id="lihatkomen13">
                                                        <div id="validasi" class="container col-sm-12">
                                                            <?php
                                                            if (!empty($komentar['keberlanjutan'])) {
                                                                echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                            }
                                                            ?>
                                                            @foreach($komentar['keberlanjutan'] as $keberlanjutans)
                                                            <h6 style="color: #dc3545;">{{$keberlanjutans}}</h6>
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
                                                        <p>
                                                            <?php if (!empty($komentar['penanggung'])) {
                                                                buttonKomentar("#lihatkomen14");
                                                            } ?>
                                                            @if($disetujui != 1 && (Gate::check('tor_verifikasi') || Gate::check('tor_validasi')))
                                                                <?php buttonPlus("#komen14") ?>
                                                            @endif
                                                        </p>
                                                        @if ($disetujui != 1)
                                                            <?php areaKomentar("komen14", "k_penanggung", "penanggung Kegiatan"); ?>
                                                        @endif
                                                        
                                                        <div class="collapse" id="lihatkomen14">
                                                            <div id="validasi" class="container col-sm-12">
                                                                <?php
                                                                if (!empty($komentar['penanggung'])) {
                                                                    echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                                }
                                                                ?>
                                                                @foreach($komentar['penanggung'] as $penanggungs)
                                                                <h6 style="color: #dc3545;">{{$penanggungs}}</h6>
                                                                <hr class="mt-3">
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- TANDA TANGAN -->
                                                <tr>
                                                    <td colspan="4" style="text-align: center;" width="50%">Kepala Program Studi
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <b>{{ $tor->unit->kaprodi->name }}</b>
                                                        <br/>
                                                        NIP. {{ $tor->unit->kaprodi->nip }}
                                                    </td>
                                                    <td colspan="4" style="text-align: center;">Perencana/Penanggungjawab
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
                                                    <td colspan="8" style="text-align: center;">Menyetujui</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" width="30%">Wakil Dekan Akademik, Riset, dan Kemahasiswaan
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <b>{{ $wd1->name }}</b><br />
                                                        NIP. {{ $wd1->nip }}
                                                    </td>
                                                    <td colspan="3" width="30%">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <b>{{ $wd2->name }}</b><br />
                                                        NIP. {{ $wd2->nip }}
                                                    </td>
                                                    <td colspan="3">Wakil Dekan SDM, Keuangan, dan Logistik
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <br />
                                                        <b>{{ $wd3->name }}</b><br />
                                                        NIP. {{ $wd3->nip }}
                                                    </td>
                                                </tr>
                                            <!-- TANDA TANGAN -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <?php collapseKomentar(); ?>
                                </div>
                                <br />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="iq-card">
                                <div class="row">
                                    <div class="container my-2">
                                    </div>
                                </div>
                                <div class="container center">
                                    <div class="table-responsive">
                                        @include('perencanaan/validasi_v2/detail_rab')
                                        <p>
                                            <?php if (!empty($komentar['rab'])) {
                                                        buttonKomentar("#lihatkomentar12");
                                                    } ?>

                                            <?php if ($disetujui != 1) { ?>
                                                @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                <?php buttonPlus("#komenrab") ?>
                                                <?php areaKomentar("komenrab", "k_rab", "RAB"); ?>
                                                @endif
                                            <?php } ?>
                                        </p>

                                        <div class="collapse" id="lihatkomentar12">
                                            <div id="validasi" class="container col-sm-12">
                                                @if (!empty($komentar['rab']))
                                                    {!! $note !!}
                                                @endif
                                                @foreach($komentar['rab'] as $rab)
                                                    <h6 style="color: #dc3545;">{{$rab}}</h6>
                                                    <hr class="mt-3">
                                                @endforeach
                                            </div>
                                        </div>
                                        <br />
                                        <!-- V A L I D A S I -->
                                        <br />
                                        @if(($current_status == 'Belum Dinilai' || $current_status == 'Sudah Revisi') && ( Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_revisi') || Gate::check('tor_validasi') ) )
                                            <div id="validasi" class="container center">
                                                @php
                                                    $ada2 = 0;
                                                    $buttonSubmit = 1;
                                                    $currentStatus = null;
                                                    foreach ($trx_status_tor as $status_tor) {
                                                        if ($status_tor->id_tor == $tor->id) {
                                                            $ada2++;
                                                            foreach ($status as $statusTor) {
                                                                if ($statusTor->id == $status_tor->id_status) {
                                                                    $currentStatus = $statusTor->nama_status;
                                                                    foreach ($users as $userrole) {
                                                                        $currentStatusRole = $status_tor->role_by;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $muncul1 = '';
                                                    $muncul2 = '';
                                                    $muncul3 = '';
                                                @endphp
                                                <h4 id="validasiplus"><b>Verifikasi & Validasi TOR</b></h4>
                                                @foreach($status as $status)
                                                    @if($status->nama_status != "Sudah Revisi" && $status->nama_status != "Belum Dinilai")
                                                        <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status->id}}" autocomplete="off">
                                                        <label class="" for="danger-outlined">{{$status->nama_status}}</label><br/>
                                                    @endif
                                                @endforeach
                                                <input type="hidden" name="create_by" value="{{ Auth()->user()->id }}">
                                                @foreach($roles as $roleby)
                                                    @if(Auth()->user()->role == $roleby->id)
                                                        <input type="hidden" name="role_by" value="{{ $roleby->name }}">
                                                    @endif
                                                @endforeach
                                                <input type="hidden" name="id_tor" value="{{ $id }}">
                                                <input name="created_at" id="created_at" type="hidden" value="{{ date('Y-m-d H:i:s') }}">
                                                <input name="updated_at" id="updated_at" type="hidden" value="{{ date('Y-m-d') }}">
                                                @if($buttonSubmit == 1)
                                                    <button class="btn btn-primary btn-sm mb-4" type="submit">Kirim</button>
                                                @endif
                                                <br />
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </form>
    </div>
<!-- Wrapper END -->

@if($current_status == 'Revisi' || $current_status == 'Sudah Dinilai')
    <script>
        var n = document.getElementById("validasiplus");
        while (n) {
            n.parentNode.removeChild(n);
            n = document.getElementById("validasiplus"); // Perbarui nilai n
        }
    </script>
@endif
<script>
    function printDiv() {

        var printContents = document.getElementById("iniprint").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();

    };
</script>
@include('dashboards/users/layouts/footer')

</body>

</html>