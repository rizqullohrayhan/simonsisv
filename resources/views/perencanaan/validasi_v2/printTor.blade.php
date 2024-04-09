<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIMONSI</title>
    <!-- Favicon -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('findash/assets/css/bootstrap.min.css') }}"> --}}
    <!-- Typography CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('findash/assets/css/typography.css') }}"> --}}
    <!-- Style CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('findash/assets/css/style.css') }}"> --}}
    <!-- Responsive CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('findash/assets/css/responsive.css') }}"> --}}
    <!-- Full calendar -->
    {{-- <link href='{{ asset('findash/assets/fullcalendar/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('findash/assets/fullcalendar/daygrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('findash/assets/fullcalendar/timegrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('findash/assets/fullcalendar/list/main.css') }}' rel='stylesheet' /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <style>
        /* .container class */
        .container {
            width: 100%;
            margin-right: auto;
            margin-left: auto;
            padding-right: 15px;
            padding-left: 15px;
        }

        /* .center class */
        .center {
            text-align: center;
        }
        /* .table class */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse; /* Menggabungkan batas (borders) menjadi satu */
        }

        /* .table-borderless class */
        .table-borderless {
            border: 0;
        }

        /* .border class */
        .border {
            border: 1px solid #dee2e6;
        }

        /* .align-top class */
        .align-top {
            vertical-align: top;
        }

        /* .border-dark class */
        .border-dark {
            border-color: #343a40!important;
        }

        /* .border-top class */
        .border-top {
            border-top: 1px solid #dee2e6;
        }

        /* .border-right class */
        .border-right {
            border-right: 1px solid #dee2e6;
        }

        /* .border-left class */
        .border-left {
            border-left: 1px solid #dee2e6;
        }

        /* .border-bottom class */
        .border-bottom {
            border-bottom: 1px solid #dee2e6;
        }

    </style>

</head>

<!-- SUB K -->
<?php
if (!empty($indikator_p)) {
    $p =  $indikator_p->P;
    $deskripsi_p =  $indikator_p->deskripsi;
    $iku = $indikator_p->IKU;
    $deskripsi_iku = $indikator_p->deskripsi_iku;
    $ik = $indikator_p->IK;
    $deskripsi_ik = $indikator_p->deskripsi_ik;
}

?>
<!-- PRODI -->

<body class="container center">
    <table class="table table-borderless" style="max-width: 1000px">
        <tbody>
            <tr>
                <td><small>v1.6</small></td>
                <td colspan="17"></td>
                <td class="border border-dark align-top" rowspan="2" colspan="3"><small>KAK</small></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="15">
                    <h5 style="text-align: center;"><b>KERANGKA ACUAN KERJA (KAK) / TERM OF REFERENCE (ToR)</b></h5>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="15">
                    <h5 style="text-align: center;"><b>PROGRAM STUDI {{strtoupper($prodi)}}</b></h5>
                </td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="15">
                    <h5 style="text-align: center;"><b>SEKOLAH VOKASI UNIVERSITAS SEBELAS</b></h5>
                </td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td style="width: 22px"></td>
                <td style="width: 22px"></td>
                <td style="width: 14px"></td>
                <td style="width: 127px"></td>
                <td style="width: 11px"></td>
                <td style="width: 29px"></td>
                <td style="width: 29px"></td>
                <td style="width: 35px"></td>
                <td style="width: 35px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
                <td style="width: 24px"></td>
            </tr>
            <tr>
                <td><b>1.</b></td>
                <td colspan="3"><b>Indikator Kinerja Utama (IKU)</b></td>
                <td>:</td>
                <td colspan="2"><b>{{$iku}}</b></td>
                <td colspan="14">{{$deskripsi_iku}}</td>
            </tr>
            <tr>
                <td><b>2.</b></td>
                <td colspan="3"><b>Indikator Kegiatan (IK)</b></td>
                <td>:</td>
                <td colspan="2"><b>{{$ik}}</b></td>
                <td colspan="14">{{$deskripsi_ik}}</td>
            </tr>
            <tr>
                <td><b>3.</b></td>
                <td colspan="3"><b>Program</b></td>
                <td>:</td>
                <td colspan="2"><b>{{$p}}</b></td>
                <td colspan="14">{{$deskripsi_p}}
                </td>
            </tr>
            <tr>
                <td><b>4.</b></td>
                <td colspan="3"><b>Judul Kegiatan</b></td>
                <td>:</td>
                <td colspan="16">
                    {{ $tor->nama_kegiatan }}
                </td>
            </tr>

            <!-- Latar Belakang -->
            <tr>
                <td><b>5.</b></td>
                <td colspan="20"><b>Latar Belakang</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="20" style="text-align: justify;">{!!$tor->latar_belakang!!}
                </td>
            </tr>

            <!-- Rasionalisasi -->
            <tr>
                <td><b>6.</b></td>
                <td colspan="20"><b>Rasionalisasi</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="20" style="text-align: justify;">{!!$tor->rasionalisasi!!}
                </td>
            </tr>

            <!-- Tujuan -->
            <tr>
                <td><b>7.</b></td>
                <td colspan="20"><b>Tujuan</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="20" style="text-align: justify;">{!!$tor->tujuan!!}
                </td>
            </tr>

            <!-- Mekanisme dan Rancangan -->
            <tr>
                <td><b>8.</b></td>
                <td colspan="20"><b>Mekanisme dan Rancangan</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="20">{!!$tor->mekanisme!!}
                </td>
            </tr>

            <!-- Jadwal Pelaksanaan -->
            <tr>
                <td><b>9.</b></td>
                <td colspan="20"><b>Jadwal Pelaksanaan</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="20">
                    <br />
                    @if (!empty($komponen_jadwal))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" colspan="8" class="border border-dark align-middle">Komponen Input</th>
                                    <th scope="col" colspan="12" class="border border-dark" style="text-align: center;">{{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                </tr>
                                <tr>
                                    <td class="border border-dark">1</td>
                                    <td class="border border-dark">2</td>
                                    <td class="border border-dark">3</td>
                                    <td class="border border-dark">4</td>
                                    <td class="border border-dark">5</td>
                                    <td class="border border-dark">6</td>
                                    <td class="border border-dark">7</td>
                                    <td class="border border-dark">8</td>
                                    <td class="border border-dark">9</td>
                                    <td class="border border-dark">10</td>
                                    <td class="border border-dark">11</td>
                                    <td class="border border-dark">12</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($komponen_jadwal as $komponen)
                                    <tr>
                                        <td colspan="8"  class="border border-dark">{{$komponen->komponen}}</td>
                                        @for ($b = 1; $b < $komponen->bulan_awal; $b++)
                                            <td class="border border-dark"></td>
                                        @endfor
                                        @for ($kj = 0; $kj <= ($komponen->bulan_akhir - $komponen->bulan_awal); $kj++)
                                            <td class="border border-dark" style=" background-color:black!important; -webkit-print-color-adjust: exact; "></td>
                                        @endfor
                                        @for ($c = 12; $c > $komponen->bulan_akhir; $c--)
                                            <td class="border border-dark"></td>
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </td>
            </tr>

            <!-- Indikator Kinerja Utama (IKU) -->
            <tr>
                <td><b>10.</b></td>
                <td colspan="20"><b>Indikator Kinerja Utama (IKU)</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="20">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="14" scope="col" class="border border-dark">Indikator</th>
                                <th colspan="3" scope="col" class="border border-dark">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                <th colspan="3" scope="col" class="border border-dark">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="14" class="border border-dark">{{$iku ." ".$deskripsi_iku}}</td>
                                <td colspan="3" class="border border-dark">{{$tor->realisasi_IKU ."%"}}</td>
                                <td colspan="3" class="border border-dark">{{$tor->target_IKU ."%"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Indikator Kinerja Kegiatan (IK) -->
            <tr>
                <td><b>11.</b></td>
                <td colspan="20"><b>Indikator Kinerja Kegiatan (IK)</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="20">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="14" scope="col" class="border border-dark">Indikator</th>
                                <th colspan="3" scope="col" class="border border-dark">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                <th colspan="3" scope="col" class="border border-dark">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="14" class="border border-dark">{{$iku ." ".$deskripsi_ik}}</td>
                                <td colspan="3" class="border border-dark">{{$tor->realisasi_IK ."%"}}</td>
                                <td colspan="3" class="border border-dark">{{$tor->target_IK ."%"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Keberlanjutan -->
            <tr>
                <td><b>12.</b></td>
                <td colspan="20"><b>Keberlanjutan</b></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="19">
                    {!!$tor->keberlanjutan!!}
                </td>
            </tr>

            <!-- Penanggungjawab -->
            <tr>
                <td><b>13.</b></td>
                <td colspan="20"><b>Penanggungjawab</b></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="19">
                    Penanggung jawab dari kegiatan ini adalah {{$tor->pic->name }} NIK. {{$tor->pic->nip }}
                </td>
            </tr>
            <!-- TANDA TANGAN -->
            <tr>
                <td colspan="10"></td>
                <td colspan="11" style="margin-bottom: 0">Surakarta, {{ $tanggal }}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="7">Kepala Program Studi
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>{{ $tor->unit->kaprodi->name }}</b>
                    <br/>
                    NIP. {{ $tor->unit->kaprodi->nip }}
                </td>
                <td></td>
                <td colspan="11">Perencana/Penanggungjawab
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>{{$tor->pic->name}}</b><br />
                    {{"NIP. ". $tor->pic->nip }}
                </td>
            </tr>
            <tr>
                <td colspan="21"></td>
            </tr>
            <tr>
                <td colspan="21" style="text-align: center;">Menyetujui</td>
            </tr>
            <tr>
                <td colspan="21"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" class=" border-dark border-top border-right border-left">Wakil Dekan Akademik, Riset, dan Kemahasiswaan</td>
                <td colspan="8" class=" border-dark border-top border-right border-left">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi</td>
                <td colspan="7" class=" border-dark border-top border-right border-left">Wakil Dekan SDM, Keuangan, dan Logistik</td>
            </tr>
            @for ($i = 0; $i < 10; $i++)
                <tr>
                    <td></td>
                    <td colspan="5" class=" border-dark border-left border-right"></td>
                    <td colspan="8" class=" border-dark border-left border-right"></td>
                    <td colspan="7" class=" border-dark border-left border-right"></td>
                </tr>
            @endfor
            <tr>
                <td></td>
                <td colspan="5" class=" border-dark border-left border-right"><b>{{ $wd1->name }}</b></td>
                <td colspan="8" class=" border-dark border-left border-right"><b>{{ $wd3->name }}</b></td>
                <td colspan="7" class=" border-dark border-left border-right"><b>{{ $wd2->name }}</b></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" class=" border-dark border-left border-right border-bottom">NIP. {{ $wd1->nip }}</td>
                <td colspan="8" class=" border-dark border-left border-right border-bottom">NIP. {{ $wd3->nip }}</td>
                <td colspan="7" class=" border-dark border-left border-right border-bottom">NIP. {{ $wd2->nip }}</td>
            </tr>
        <!-- TANDA TANGAN -->
        </tbody>
    </table>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('dashboards/users/layouts/footer')
</body>

</html>