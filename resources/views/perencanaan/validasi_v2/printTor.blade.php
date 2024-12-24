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
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"> --}}
    
    <style>
        {!! file_get_contents(public_path('bootstrap-3.3.7-dist/css/bootstrap.min.css')) !!}
    </style>

    <style>
        /* .container class */
        .container {
            width: 100%;
        }

        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
        }

        .table-bordered > tbody > tr > td,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > td,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > thead > tr > th {
            border: 1px solid #343a40;
        }

        /* .border class */
        td > .border {
            border: 1px solid #dee2e6;
        }

        /* .border-dark class */
        td > .border-dark {
            border-color: #343a40!important;
        }

        /* .border-top class */
        td > .border-top {
            border-top: 1px solid #dee2e6;
        }

        /* .border-right class */
        td > .border-right {
            border-right: 1px solid #dee2e6;
        }

        /* .border-left class */
        td > .border-left {
            border-left: 1px solid #dee2e6;
        }

        /* .border-bottom class */
        td > .border-bottom {
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
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td width="2%"><small>v1.6</small></td>
                <td width="9%"></td>
                <td width="9%"></td>
                <td width="9%"></td>
                <td colspan="14"></td>
                <td class="align-top" style="padding: 0; border: 1px solid #343a40;" rowspan="2" colspan="3"><small>KAK</small></td>
            </tr>
            <tr>
                <td colspan="1" style="padding-bottom: 0"></td>
                <td colspan="18" style="text-align: center; padding-bottom: 0;">
                    <b>KERANGKA ACUAN KERJA (KAK) / TERM OF REFERENCE (ToR)</b>
                </td>
            </tr>
            <tr>
                {{-- <td colspan="3"></td> --}}
                <td colspan="21" style="text-align: center; padding: 0;">
                    <b>PROGRAM STUDI {{strtoupper($prodi)}}</b>
                </td>
                {{-- <td colspan="3"></td> --}}
            </tr>
            <tr>
                {{-- <td colspan="3"></td> --}}
                <td colspan="21" style="text-align: center; padding-top: 0;">
                    <b>SEKOLAH VOKASI UNIVERSITAS SEBELAS MARET</b>
                </td>
                {{-- <td colspan="3"></td> --}}
            </tr>
            <tr>
                {{-- <td style="width: 22px"></td>
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
                <td style="width: 24px"></td> --}}
            </tr>
            <tr>
                <td><b>1.</b></td>
                <td colspan="3"><b>Indikator Kinerja Utama (IKU)</b></td>
                <td style="padding-left: 0; padding-right: 0; width: 1%">:</td>
                <td colspan="2" style="text-align: center;"><b>{{$iku}}</b></td>
                <td colspan="14">{{$deskripsi_iku}}</td>
            </tr>
            <tr>
                <td><b>2.</b></td>
                <td colspan="3"><b>Indikator Kinerja Kegiatan (IK)</b></td>
                <td style="padding-left: 0; padding-right: 0; width: 1%">:</td>
                <td colspan="2" style="text-align: center;"><b>{{$ik}}</b></td>
                <td colspan="14">{{$deskripsi_ik}}</td>
            </tr>
            <tr>
                <td><b>3.</b></td>
                <td colspan="3"><b>Program</b></td>
                <td style="padding-left: 0; padding-right: 0; width: 1%">:</td>
                <td colspan="2" style="text-align: center;"><b>{{$p}}</b></td>
                <td colspan="14">{{$deskripsi_p}}
                </td>
            </tr>
            <tr>
                <td><b>4.</b></td>
                <td colspan="3"><b>Judul Kegiatan</b></td>
                <td style="padding-left: 0; padding-right: 0; width: 1%">:</td>
                <td colspan="16">
                    {{ $tor->nama_kegiatan }}
                </td>
            </tr>

            <!-- Latar Belakang -->
            <tr>
                <td style="padding-bottom: 0"><b>5.</b></td>
                <td colspan="20" style="padding-bottom: 0;"><b>Latar Belakang</b></td>
            </tr>
            <tr>
                <td style="padding-top: 0;"></td>
                <td colspan="20" style="text-align: justify; padding-top: 0; padding-bottom: 0;">{!!$tor->latar_belakang!!}
                </td>
            </tr>

            <!-- Rasionalisasi -->
            <tr>
                <td style="padding-bottom: 0"><b>6.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Rasionalisasi</b></td>
            </tr>
            <tr>
                <td style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="text-align: justify; padding-top: 0; padding-bottom: 0;">{!!$tor->rasionalisasi!!}
                </td>
            </tr>

            <!-- Tujuan -->
            <tr>
                <td style="padding-bottom: 0"><b>7.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Tujuan</b></td>
            </tr>
            <tr>
                <td style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="text-align: justify; padding-top: 0; padding-bottom: 0;">{!!$tor->tujuan!!}
                </td>
            </tr>

            <!-- Mekanisme dan Rancangan -->
            <tr>
                <td style="padding-bottom: 0"><b>8.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Mekanisme dan Rancangan</b></td>
            </tr>
            <tr>
                <td style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="padding-top: 0; padding-bottom: 0;">{!!$tor->mekanisme!!}
                </td>
            </tr>

            <!-- Jadwal Pelaksanaan -->
            <tr>
                <td style="padding-bottom: 0"><b>9.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Jadwal Pelaksanaan</b></td>
            </tr>
            <tr>
                <td style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="padding-top: 0; padding-bottom: 0;">
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
                <td style="padding-bottom: 0"><b>10.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Indikator Kinerja Utama (IKU)</b></td>
            </tr>
            <tr>
                <td style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="padding-top: 0; padding-bottom: 0;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="80%">Indikator</th>
                                <th width="10%">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                <th width="10%">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="80%">{{$iku ." ".$deskripsi_iku}}</td>
                                <td width="10%">{{$tor->realisasi_IKU ."%"}}</td>
                                <td width="10%">{{$tor->target_IKU ."%"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Indikator Kinerja Kegiatan (IK) -->
            <tr>
                <td style="padding-bottom: 0"><b>11.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Indikator Kinerja Kegiatan (IK)</b></td>
            </tr>
            <tr>
                <td style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="padding-top: 0; padding-bottom: 0;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="80%">Indikator</th>
                                <th width="10%">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                <th width="10%">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="80%">{{$iku ." ".$deskripsi_ik}}</td>
                                <td width="10%">{{$tor->realisasi_IK ."%"}}</td>
                                <td width="10%">{{$tor->target_IK ."%"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Keberlanjutan -->
            <tr>
                <td style="padding-bottom: 0"><b>12.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Keberlanjutan</b></td>
            </tr>
            <tr>
                <td colspan="1" style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="padding-top: 0; padding-bottom: 0;">
                    {!!$tor->keberlanjutan!!}
                </td>
            </tr>

            <!-- Penanggungjawab -->
            <tr>
                <td style="padding-bottom: 0"><b>13.</b></td>
                <td colspan="20" style="padding-bottom: 0"><b>Penanggungjawab</b></td>
            </tr>
            <tr>
                <td colspan="1" style="padding-top: 0; padding-bottom: 0;"></td>
                <td colspan="20" style="padding-top: 0; padding-bottom: 0;">
                    Penanggung jawab dari kegiatan ini adalah {{$tor->pic->name }} NIK. {{$tor->pic->nip }}
                </td>
            </tr>
        </tbody>
        <tfoot>
            <!-- TANDA TANGAN -->
            <tr><td style="padding: 0;"></td></tr>
            <tr>
                <td colspan="10"></td>
                <td colspan="11" style="padding-bottom: 0;">Surakarta, {{ $tanggal }}</td>
            </tr>
            <tr>
                <td colspan="1" style="padding-top: 0;"></td>
                <td colspan="8" style="padding-top: 0;">{{ $tor->unit->user->jabatan }} <br> {{ $tor->unit->nama_unit }}</td>
                <td style="padding-top: 0;"></td>
                <td colspan="11" style="padding-top: 0;">Perencana/Penanggungjawab</td>
            </tr>
            <tr>
                <td colspan="1" style="padding-bottom: 0;"></td>
                <td colspan="8" style="padding-bottom: 0; vertical-align: bottom;">
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>{{ $tor->unit->user->name }}</b>
                    {{-- NIP. {{ $tor->unit->user->nip }} --}}
                </td>
                <td style="padding-bottom: 0;"></td>
                <td colspan="11" style="padding-bottom: 0; vertical-align: bottom;">
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>{{$tor->pic->name}}</b>
                    {{-- {{"NIP. ". $tor->pic->nip }} --}}
                </td>
            </tr>
            <tr>
                <td colspan="1" style="padding-top: 0;"></td>
                <td colspan="8" style="padding-top: 0;">
                    NIP. {{ $tor->unit->user->nip }}
                </td>
                <td style="padding-top: 0;"></td>
                <td colspan="11" style="padding-top: 0;">
                    NIP. {{ $tor->pic->nip }}
                </td>
            </tr>
            <tr>
                <td colspan="21" style="padding: 0;"></td>
            </tr>
            <tr>
                <td colspan="21" style="text-align: center;">Menyetujui,</td>
            </tr>
            <tr>
                {{-- <td colspan="21" style="padding: 0;"></td> --}}
                <td colspan="21" style="text-align: center;">{{ $verifikator->jabatan }}
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>{{ $verifikator->name }}</b><br />
                    NIP. {{ $verifikator->nip }}
                </td>
            </tr>
            {{-- <tr>
                <td colspan="21">
                    <table class="table table-borderless">
                        <tr>
                            <td colspan="7" style="border: 1px solid #343a40; border-bottom: 0;">{{ $wd1->jabatan }}</td>
                            <td colspan="7" style="border: 1px solid #343a40; border-bottom: 0;">{{ $wd3->jabatan }}</td>
                            <td colspan="7" style="border: 1px solid #343a40; border-bottom: 0;">{{ $wd2->jabatan }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="border-right: 1px solid #343a40; border-left: 1px solid #343a40; vertical-align: bottom; padding-bottom: 0">
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>{{ $wd1->name }}</b>
                            </td>
                            <td colspan="7" style="border-right: 1px solid #343a40; border-left: 1px solid #343a40; vertical-align: bottom; padding-bottom: 0">
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>{{ $wd3->name }}</b>
                            </td>
                            <td colspan="7" style="border-right: 1px solid #343a40; border-left: 1px solid #343a40; vertical-align: bottom; padding-bottom: 0">
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>{{ $wd2->name }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" style="border: 1px solid #343a40; border-top: 0; padding-top: 0;">NIP. {{ $wd1->nip }}</td>
                            <td colspan="7" style="border: 1px solid #343a40; border-top: 0; padding-top: 0;">NIP. {{ $wd3->nip }}</td>
                            <td colspan="7" style="border: 1px solid #343a40; border-top: 0; padding-top: 0;">NIP. {{ $wd2->nip }}</td>
                        </tr>
                    </table>
                </td>
            </tr> --}}
        <!-- TANDA TANGAN -->
        </tfoot>
    </table>
    {{-- <div class="table-responsive">
    </div> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('dashboards/users/layouts/footer')
</body>

</html>