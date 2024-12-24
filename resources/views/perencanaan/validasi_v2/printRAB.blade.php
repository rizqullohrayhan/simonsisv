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
        .table-borderless > tfoot > tr > th {
            border: none;
        }

        .table-bordered > tbody > tr > td,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > td,
        .table-bordered > tfoot > tr > th {
            border: 1px solid #343a40;
        }

        /* .border class */
        .table > tbody > tr > td > .border,
        .table > tbody > tr > td > .border,
        .table > tfoot > tr > td > .border,
        .table > tfoot > tr > th > .border {
            border: 1px solid #343a40;
        }

        /* .border-dark class */
        .table > tbody > tr > td > .border-dark,
        .table > tbody > tr > td > .border-dark,
        .table > tfoot > tr > td > .border-dark,
        .table > tfoot > tr > th > .border-dark {
            border-color: #343a40!important;
        }

        /* .border-top class */
        .table > tbody > tr > td > .border-top,
        .table > tbody > tr > td > .border-top,
        .table > tfoot > tr > td > .border-top,
        .table > tfoot > tr > th > .border-top {
            border-top: 1px solid #343a40;
        }

        /* .border-right class */
        .table > tbody > tr > td > .border-right,
        .table > tbody > tr > td > .border-right,
        .table > tfoot > tr > td > .border-right,
        .table > tfoot > tr > th > .border-right {
            border-right: 1px solid #343a40;
        }

        /* .border-left class */
        .table > tbody > tr > td > .border-left,
        .table > tbody > tr > td > .border-left,
        .table > tfoot > tr > td > .border-left,
        .table > tfoot > tr > th > .border-left {
            border-left: 1px solid #343a40;
        }

        /* .border-bottom class */
        .table > tbody > tr > td > .border-bottom,
        .table > tbody > tr > td > .border-bottom,
        .table > tfoot > tr > td > .border-bottom,
        .table > tfoot > tr > th > .border-bottom {
            border-bottom: 1px solid #343a40;
        }
    </style>
</head>

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
<body class="container center">
    <table id="datatable" class="table table-borderless">
        <tbody>
            <tr>
                <td colspan="10" style="padding: 0; text-align: center;">
                    <b>RINCIAN ANGGARAN BELANJA</b>
                </td>
            </tr>
            <tr>
                <td width="20%" style="border-bottom: solid;"></td>
                <td style="padding-left: 0; padding-right: 0; width: 1%; border-bottom: solid;"></td>
                <td width="8%" style="border-bottom: solid;"></td>
                <td style="border-bottom: solid;"></td>
                <td style="border-bottom: solid;"></td>
                <td style="border-bottom: solid;"></td>
                <td style="border-bottom: solid;"></td>
                <td style="border-bottom: solid;"></td>
                <td style="border-bottom: solid;"></td>
                <td style="border-bottom: solid;"></td>
            </tr>
            <tr>
                <td style="padding-left: 0; border-style: solid none solid solid;"><b>Unit Kerja</b> </td>
                <td style="padding-left: 0; border-style: solid none;">:</td>
                <td colspan="7" style="padding-left: 0; border-style: solid solid solid none;">{{$prodi}}</td>
                <td style="text-align: center; border: solid;"><b>Tahun</b></td>
            </tr>
            <tr>
                <td style="padding: 0; border-style: solid none solid solid;"><b>Kegiatan</b> </td>
                <td style="padding: 0; border-style: solid none;">:</td>
                <td colspan="7" style="padding: 0; border-style: solid solid solid none;">{{ $indikator_p->IK." - ".$indikator_p->deskripsi_ik}}</td>
                <td rowspan="3" style="padding: 0; text-align: center; vertical-align: middle; border: solid;">{{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</td>
            </tr>
            <tr>
                <td style="padding: 0; border-style: solid none solid solid;"><b>Program</b></td>
                <td style="padding: 0; border-style: solid none;">:</td>
                <td colspan="7" style="padding: 0; border-style: solid solid solid none;">{{$indikator_p->P." - ".  $indikator_p->deskripsi}}</td>
            </tr>
            <tr>
                <td style="padding: 0; border-style: solid none solid solid;"><b>Judul Kegiatan</b></td>
                <td style="padding: 0; border-style: solid none;">:</td>
                <td colspan="7" style="padding: 0; border-style: solid solid solid none;">{{$tor->nama_kegiatan}}</td>
            </tr>
            <tr>
                <td style="border-left: solid;"></td>
                <td colspan="8" class="border" style="padding: 0; text-align: center; border-style: solid solid solid none;"><b>Indikator</b></td>
                <td class="border" style="padding: 0; text-align: center; border: solid;"><b>Target</b></td>
            </tr>
            <tr>
                <td style="padding: 0; border-style: none none solid solid;"><b>Input (Masukan)</b></td>
                <td style="padding: 0; border-style: solid none;">:</td>
                <td colspan="7" style="padding: 0; border-style: solid solid solid none;">{{$rab->masukan }}</td>
                <td rowspan="2" class="align-middle border" style="padding: 0; text-align: center; vertical-align: middle; border: solid;">{{$tor->target_IKU}}</td>
            </tr>
            <tr>
                <td style="padding: 0; border-style: solid none solid solid;"><b>Output (Keluaran)</b></td>
                <td style="padding: 0; border-style: solid none;">:</td>
                <td colspan="7" style="padding: 0; border-style: solid solid solid none;">{{$rab->keluaran}}</td>
            </tr>
            <tr>
                <td colspan="10" style="border: solid;"></td>
            </tr>
            <tr>
                <th colspan="10" style="padding: 0; text-align: center; border: solid;"><b>Anggaran Belanja</b></th>
            </tr>
            <tr>
                <th rowspan="3" colspan="3" style="padding: 0; text-align: center; vertical-align: middle; border: solid;">Jenis Belanja</th>
                <th colspan="6" style="padding: 0; text-align: center; border: solid;">Rincian Biaya</th>
                <th rowspan="3" style="padding: 0; text-align: center; vertical-align: middle; border: solid;">Jumlah Anggaran (Rp)</th>
            </tr>
            <tr>
                <th colspan="2" style="padding: 0; text-align: center; border: solid;">Kebutuhan</th>
                <th rowspan="2" style="padding: 0; text-align: center; border: solid;">Frek</th>
                <th colspan="2" style="padding: 0; text-align: center; border: solid;">Perhitungan</th>
                <th rowspan="2" style="padding: 0; text-align: center; border: solid;">Harga Satuan</th>
            </tr>
            <tr>
                <th style="padding: 0; text-align: center; border: solid;">Vol.</th>
                <th style="padding: 0; text-align: center; border: solid;">Sat.</th>
                <th style="padding: 0; text-align: center; border: solid;">Vol.</th>
                <th style="padding: 0; text-align: center; border: solid;">Sat.</th>
            </tr>
            <tr>
                <td colspan="3" style="padding: 0; text-align: center; border: solid;">1</td>
                <td style="padding: 0; text-align: center; border: solid;">2</td>
                <td style="padding: 0; text-align: center; border: solid;">3</td>
                <td style="padding: 0; text-align: center; border: solid;">4</td>
                <td style="padding: 0; text-align: center; border: solid;">5</td>
                <td style="padding: 0; text-align: center; border: solid;">6</td>
                <td style="padding: 0; text-align: center; border: solid;">7</td>
                <td style="padding: 0; text-align: center; border: solid;">8</td>
            </tr>
            @php
            $totalAnggaranRab = 0;
            $urut = 1;
            @endphp
            
            @foreach($anggaran as $item)
                @if ($item->anggaran != 0)
                    <tr>
                        <td colspan="3" style="padding: 0; border: solid;">
                            <b>{{$item->nomor_mak}} | {{$item->nama_belanja}}</b><br />
                            {{$item->detail}}
                            {{$item->catatan}}
                        </td>
                        <td style="padding: 0; text-align: center; border: solid;">{{$item->kebutuhan_vol}}</td>
                        <td style="padding: 0; text-align: center; border: solid;">{{$item->kebutuhan_sat}}</td>
                        <td style="padding: 0; text-align: center; border: solid;">{{$item->frek}}</td>
                        <td style="padding: 0; text-align: center; border: solid;">{{$item->perhitungan_vol}}</td>
                        <td style="padding: 0; text-align: center; border: solid;">{{$item->perhitungan_sat}}</td>
                        <td style="padding: 0; text-align: center; border: solid;">{{number_format($item->harga_satuan,0,',','.')}}</td>
                        <td style="padding: 0; text-align: center; border: solid;">{{number_format($item->anggaran,0,',','.')}}</td>
                    </tr>
                    @php
                    $totalAnggaranRab += $item->anggaran;
                    $urut += 1;
                    @endphp
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="9" style="padding: 0; text-align: center; border: solid;">Total</th>
                <th style="padding: 0; text-align: right; border: solid;">{{number_format($totalAnggaranRab,0,',','.')}}</th>
            </tr>
            <!-- TANDA TANGAN -->
            <tr>
                <td colspan="10" style="padding: 0; "></td>
            </tr>
            <tr>
                <td colspan="6" style="padding-bottom: 0; "></td>
                <td colspan="4" style="padding-bottom: 0;">Surakarta, {{ $tanggal }}</td>
            </tr>
            <tr>
                <td colspan="6" style="padding-top: 0;">{{ $tor->unit->user->jabatan }} <br> {{ $tor->unit->nama_unit }}</td>
                <td colspan="4" style="padding-top: 0;">Perencana/Penanggungjawab</td>
            </tr>
            <tr>
                <td colspan="6" style="padding-bottom: 0; vertical-align: bottom;" width="50%">
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>{{ $tor->unit->user->name }}</b>
                </td>
                <td colspan="4" style="padding-bottom: 0; vertical-align: bottom;" width="50%">
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>{{$tor->pic->name}}</b>
                </td>
            </tr>
            <tr>
                <td colspan="6" style="padding-top: 0;">NIP. {{ $tor->unit->user->nip }}</td>
                <td colspan="4" style="padding-top: 0;">NIP. {{ $tor->pic->nip }}</td>
            </tr>
            <tr>
                <td colspan="10" style="padding: 0; "></td>
            </tr>
            <tr>
                <td colspan="10" style="padding: 0; text-align: center;">Menyetujui,</td>
            </tr>
            <tr>
                {{-- <td colspan="10" style="padding: 0; "></td> --}}
                <td colspan="10" style="text-align: center;">{{ $verifikator->jabatan }}
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
                <td colspan="10">
                    <table class="table table-borderless">
                        <tr>
                            <td colspan="3" style="padding: 0; border: 1px solid #343a40; border-bottom: 0;">{{ $wd1->jabatan }}</td>
                            <td colspan="4" style="padding: 0; border: 1px solid #343a40; border-bottom: 0;">{{ $wd3->jabatan }}</td>
                            <td colspan="3" style="padding: 0; border: 1px solid #343a40; border-bottom: 0;">{{ $wd2->jabatan }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="padding: 0; border-right: 1px solid #343a40; border-left: 1px solid #343a40; vertical-align: bottom; padding-bottom: 0">
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>{{ $wd1->name }}</b>
                            </td>
                            <td colspan="4" style="padding: 0; border-right: 1px solid #343a40; border-left: 1px solid #343a40; vertical-align: bottom; padding-bottom: 0">
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>{{ $wd3->name }}</b>
                            </td>
                            <td colspan="3" style="padding: 0; border-right: 1px solid #343a40; border-left: 1px solid #343a40; vertical-align: bottom; padding-bottom: 0">
                                <br />
                                <br />
                                <br />
                                <br />
                                <b>{{ $wd2->name }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="padding: 0; border: 1px solid #343a40; border-top: 0; padding-top: 0;">NIP. {{ $wd1->nip }}</td>
                            <td colspan="4" style="padding: 0; border: 1px solid #343a40; border-top: 0; padding-top: 0;">NIP. {{ $wd3->nip }}</td>
                            <td colspan="3" style="padding: 0; border: 1px solid #343a40; border-top: 0; padding-top: 0;">NIP. {{ $wd2->nip }}</td>
                        </tr>
                    </table>
                </td>
            </tr> --}}
        </tfoot>
    </table>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    @include('dashboards/users/layouts/footer')
</body>
</html>