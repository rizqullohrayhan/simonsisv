<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

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

        <?php
        $disetujui = 0; //apakah 3 sudah validasi? 
        ?>
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
                                <?php
                                $iku = "";
                                $ik = "";
                                $indikator_k = "n";
                                $sub_k = "";
                                $warna_komentar = "alert-danger"; //warna komentar
                                $note = "";
                                ?>

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
                                        <form method="post" action="/validasi/createValTor">
                                            @csrf
                                            <?php
                                                $komentar = [
                                                    'sub' => [],
                                                    'judul' => [],
                                                    'latarbelakang' => [],
                                                    'rasionalisasi' => [],
                                                    'tujuan' => [],
                                                    'mekanisme' => [],
                                                    'jadwal' => [],
                                                    'iku' => [],
                                                    'ik' => [],
                                                    'keberlanjutan' => [],
                                                    'penanggung' => [],
                                                    'komentar_rab' => [],
                                                ];

                                                foreach ($trx_status_tor as $trx_item) {
                                                    foreach ($users as $user) {
                                                        if ($trx_item->create_by == $user->id) {
                                                            foreach (['sub', 'judul', 'latarbelakang', 'rasionalisasi', 'tujuan', 'mekanisme', 'jadwal', 'iku', 'ik', 'keberlanjutan', 'penanggung', 'komentar_rab'] as $field) {
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
                                                            if ($status_item->nama_status == "Validasi" && $roles[$ro2]->name == "WD 3") {
                                                                $disetujui = 1;
                                                            }
                                                            if ($status_item->nama_status == "Pengajuan Perbaikan") {
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
                                                    echo ' <a id="validasiplus" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="' . $Href . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="las la-plus"></i>
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

                                            ?>

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
                                                            <td colspan="4">{{$deskripsi_p}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>4.</b></td>
                                                            <td><b>Judul Kegiatan</b></td>
                                                            <td>:</td>
                                                            <td colspan="5">{{$tor->nama_kegiatan}}
                                                                <p>
                                                                    <?php if (!empty($komentar['judul'])) {
                                                                        buttonKomentar("#lihatkomen5");
                                                                    }
                                                                    if ($disetujui != 1) { ?>
                                                                        @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                            <?php buttonPlus("#komen5") ?>
                                                                        @endif
                                                                    <?php areaKomentar("komen5", "k_judul", "Judul Kegiatan");
                                                                    } ?>
                                                                </p>
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
                                                                    <?php if (!empty($komentar['latarbelakang'])) {
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
                                                                    if (!empty($komentar['latarbelakang'])) {
                                                                        echo $note; //isinya : "komentar sebelum perbaikan tor"
                                                                    }
                                                                    ?>
                                                                    @foreach($komentar['latarbelakang'] as $latarbelakangs)
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
                                                                    <?php if ($disetujui != 1) { ?>
                                                                        @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_validasi'))
                                                                        <?php buttonPlus("#komen14") ?>
                                                                        @endif
                                                                </p>
                                                                </div><?php areaKomentar("komen14", "k_penanggung", "penanggung Kegiatan"); ?>
                                                                <?php } ?>
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
                                                                <b>{{ auth()->user()->name }}</b>
                                                                <br/>
                                                                NIP. {{Auth::user()->nip}}
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

                            <!-- R A B -->
                            @include('perencanaan/validasi/detail_rab')
                            <p>
                                <?php if (!empty($komentar['komentar_rab'])) {
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
                                    <?php
                                        if (!empty($komentar['komentar_rab'])) {
                                            echo $note;
                                        }
                                    ?>
                                    @foreach($komentar['komentar_rab'] as $rab)
                                    <h6 style="color: #dc3545;">{{$rab}}</h6>
                                    <hr class="mt-3">
                                    @endforeach
                                </div>
                            </div>
                            <br />
                            <!-- V A L I D A S I -->
                            <br />
                            @if(Gate::check('tor_verifikasi') || Gate::check('tor_verifikasi_kaprodi') || Gate::check('tor_revisi') || Gate::check('tor_validasi') )
                            <?php if ($disetujui != 1) { ?>
                                <div id="validasi" class="container center">
                                    <?php
                                            $blok = 0;
                                            $ada2 = 0;
                                            $tdkada2 = 0;
                                            $statuskeg = "n";
                                            $badge;
                                            $currentStatus;
                                            $buttonSubmit = 0;
                                            for ($stk2 = 0; $stk2 < count($trx_status_tor); $stk2++) {
                                                if ($trx_status_tor[$stk2]->id_tor == $tor->id) {
                                                    $ada2 += 1;
                                                    $trx_status_tor[$stk2]->id_status;

                                                    foreach ($status as $statusTor) {
                                                        if ($statusTor->id == $trx_status_tor[$stk2]->id_status) {
                                                            $currentStatus = $statusTor->nama_status;
                                                            foreach ($users as $userrole) {
                                                                $currentStatusRole =  $trx_status_tor[$stk2]->role_by;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                }
                                            }
                                    ?>
                                    <h4 id="validasiplus"><b>
                                            Verifikasi & Validasi TOR
                                        </b></h4>
                                    <?php
                                            $muncul = ''; //memunculkan dan menyembunyika icon plus untuk kolom komentar
                                            $muncul1 = '';
                                            $muncul2 = '';
                                            $muncul3 = '';
                                            for ($s = 1; $s < count($status); $s++) {
                                                if ($status[$s]->kategori == "TOR" && $status[$s]->nama_status != "Pengajuan Perbaikan") {
                                                    for ($r3 = 0; $r3 < count($roles); $r3++) {
                                                        if (Auth()->user()->role == $roles[$r3]->id) {
                                    ?>

                                                    <!-- K A P R O D I -->
                                                    <?php if ($roles[$r3]->name == "Kaprodi") {
                                                                if (($currentStatus == "Proses Pengajuan" || $currentStatus == "Pengajuan Perbaikan") && $status[$s]->nama_status == "Verifikasi Kaprodi") {
                                                                    $muncul = 'ada';
                                                                    $buttonSubmit = 1; ?>
                                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status[$s]->id}}" autocomplete=" off">
                                                            <label class="" for="danger-outlined">{{$status[$s]->nama_status}}</label><br />
                                                        <?php } elseif ($currentStatus != "Proses Pengajuan" || $currentStatus != "Pengajuan Perbaikan") {
                                                                    $muncul = 'tidak ada';
                                                                }
                                                            }

                                                            // B P U
                                                            elseif ($roles[$r3]->name == "BPU") {
                                                                if (($currentStatus == "Verifikasi Kaprodi") && $status[$s]->nama_status == "Verifikasi") {
                                                                    $muncul = 'ada';
                                                                    $buttonSubmit = 1; ?>
                                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status[$s]->id}}" autocomplete=" off">
                                                            <label class="" for="danger-outlined">{{$status[$s]->nama_status}}</label><br />
                                                        <?php } elseif ($currentStatus != "Verifikasi Kaprodi") {
                                                                    $muncul = 'tidak ada';
                                                                }

                                                                // W D 1
                                                            } elseif ($roles[$r3]->name == "WD 1") { ?>
                                                        <?php
                                                                if ($currentStatus == "Verifikasi" && ($status[$s]->nama_status == "Validasi" || $status[$s]->nama_status == "Revisi")) {
                                                                    $buttonSubmit = 1;
                                                                    $muncul1 = 'ada';
                                                                    if ($status[$s]->nama_status == "Revisi") {
                                                        ?>
                                                            <?php } ?>
                                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status[$s]->id}}" autocomplete=" off">
                                                            <label class="" for="danger-outlined">{{$status[$s]->nama_status}}</label><br />
                                                        <?php } elseif ($currentStatus != "Verifikasi") {
                                                                    $muncul1 = 'tidak ada';
                                                                }
                                                                // echo $muncul1;
                                                                if ($muncul1 == 'tidak ada') { ?>
                                                            <!-- <script>
                                                            var n = document.getElementById("validasiplus");
                                                            while (n) {
                                                                document.getElementById("validasiplus").remove();
                                                            }
                                                        </script> -->
                                                        <?php }

                                                                // W D 2
                                                            } elseif ($roles[$r3]->name == "WD 2") {
                                                                // echo $currentStatus . $currentStatusRole . "<br/ >"; //menampilkan status sebelumnya itu apa?
                                                                if ($currentStatus == "Validasi" && $currentStatusRole == "WD 1" &&  ($status[$s]->nama_status == "Validasi" || $status[$s]->nama_status == "Revisi")) {
                                                                    $buttonSubmit = 1;
                                                                    $muncul2 = 'ada';
                                                                    // echo "xx - " . $currentStatus . "-" . $currentStatusRole; 
                                                        ?>
                                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status[$s]->id}}" autocomplete=" off">
                                                            <label class="" for="danger-outlined">{{$status[$s]->nama_status}}</label><br />
                                                        <?php } elseif ($currentStatus != "Validasi" && $currentStatusRole != "WD 1") {
                                                                    $muncul2 = 'tidak ada';
                                                                }
                                                                // echo $muncul2;
                                                                if ($muncul2 == 'tidak ada') { ?>
                                                            <!-- <script>
                                                            var n = document.getElementById("validasiplus");
                                                            while (n) {
                                                                document.getElementById("validasiplus").remove();
                                                            }
                                                        </script> -->
                                                        <?php }

                                                                // W D 3
                                                            } elseif ($roles[$r3]->name == "WD 3") {
                                                                if ($currentStatus == "Validasi" && $currentStatusRole == "WD 2"   && ($status[$s]->nama_status == "Validasi" || $status[$s]->nama_status == "Revisi")) {
                                                                    $buttonSubmit = 1;
                                                                    $muncul3 = 'ada'; ?>
                                                            <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status[$s]->id}}" autocomplete=" off">
                                                            <label class="" for="danger-outlined">{{$status[$s]->nama_status}}</label><br />
                                                        <?php } elseif ($currentStatus != "Validasi" && $currentStatusRole != "WD 2") {
                                                                    $muncul3 = 'tidak ada';
                                                                }
                                                                // echo $muncul3;
                                                                if ($muncul3 == 'tidak ada') {
                                                        ?>
                                                            <!-- <script>
                                                            var n = document.getElementById("validasiplus");
                                                            while (n) {
                                                                document.getElementById("validasiplus").remove();
                                                            }
                                                        </script> -->
                                                        <?php }

                                                                //
                                                            } else { ?>
                                                        <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{$status[$s]->id}}" autocomplete=" off">
                                                        <label class="" for="danger-outlined">{{$status[$s]->nama_status}}</label><br />
                                    <?php }
                                                        }
                                                    }
                                                }
                                            } ?>
                                    <input type="hidden" name="create_by" value="<?= Auth()->user()->id ?>">
                                    @foreach($roles as $roleby)
                                    @if(Auth()->user()->role == $roleby->id)
                                    <input type="hidden" name="role_by" value="<?= $roleby->name ?>">
                                    @endif
                                    @endforeach
                                    <input type="hidden" name="id_tor" value="<?= $id ?>">
                                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                    <?php if ($buttonSubmit == 1) { ?>
                                        <button class="btn btn-primary btn-sm" type="submit">Kirim</button>
                                    <?php } ?>
                                    <?php if ($buttonSubmit != 1) { ?>
                                        <script>
                                            var n = document.getElementById("validasiplus");
                                            while (n) {
                                                document.getElementById("validasiplus").remove();
                                            }
                                        </script>
                                    <?php } ?>

                                    <br />
                                </div>
                            <?php } ?>
                            @endif
                            </form>
                        </div>
                        <br />

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
                                            <div class="form-group">
                                                <label>Komponen Input</label>
                                                <input name="komponen" id="komponen" type="text" class="form-control">
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Mulai Kegiatan</label>
                                                    <select name="bulan_awal" id="bulan_awal" class="form-control">
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
                                                </div>
                                                <div class="col">
                                                    <label>Selesai Kegiatan</label>
                                                    <select name="bulan_akhir" id="bulan_akhir" class="form-control">
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
                                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        </form>
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
                    <hr>
                    <div class="container ml-1">


                        <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove Komentar Sebelum Diprint">REMOVE</button>
                        <button type="button" class="btn btn-primary mb-3" onclick="printDiv()">PRINT</button> -->
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
</div>
</div>
<!-- Wrapper END -->
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