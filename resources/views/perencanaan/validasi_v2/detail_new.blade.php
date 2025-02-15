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

        @php
            $disetujui = 0;
            $current_status = 'Belum Dinilai';
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

            function buttonKomentar($Href)
            {
                echo '<a id="komen" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="' . $Href . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Lihat Komentar
                    </a>';
            }

            function buttonPlus($Href)
            {
                echo ' <a id="validasiplus" class="badge badge-danger btn-sm shadow" data-toggle="collapse" href="' . $Href . '" role="button" aria-expanded="false" aria-controls="' . $Href . '">
                <i class="las la-plus"></i> Tambah Komentar
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
        
        <form method="post" action="/validasi/createValTor" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_tor" value="{{$tor->id}}">
            <input type="hidden" name="judul" value="{{$tor->nama_kegiatan}}">
            <input type="hidden" name="create_by" value="{{Auth::user()->id}}">
            <input type="hidden" name="role_by" value="{{Auth::user()->toRole->name}}">
            <!-- Page Content  -->
            <div id="content-page" class="content-page">
                <div class="container-fluid">
                    <div class="iq-card">
                        <div class="container mt-2 mb-2 mr-2 ml-2">
                            <?php if (Auth::user()->getroleNames()[0] != 'Admin') { ?>
                                <a href="{{url('/validasi')}}"><button type="button" class="btn btn-primary btn-sm mr-2 mt-2">Back</button></a>
                            <?php }
                            if (Auth::user()->getroleNames()[0] == 'Admin') { ?>
                                <a href="{{url('/monitoringUsulan')}}"><button type="button" class="btn btn-primary btn-sm mr-2 mt-1">Back</button></a>
                            <?php } ?>
                        </div>
                        <div class="container mx-auto" style="max-width: 1000px">
                            <table class="table table-borderless table-sm mb-4">
                                <tbody>

                                    <tr>
                                        <td>Program Studi</td>
                                        <td>: {{$prodi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Judul Kegiatan</td>
                                        <td>: {{$tor->nama_kegiatan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Ajuan</td>
                                        <td>: {{$tor->jenis_ajuan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Pelaksanaan Kegiatan</td>
                                        <td>: {{ \Carbon\Carbon::parse($tor->tgl_mulai_pelaksanaan)->translatedFormat('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama PIC Kegiatan</td>
                                        <td>: {{ $tor->pic->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor WhatsApp PIC Kegiatan</td>
                                        <td>: {{ $tor->pic->telepon }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email PIC Kegiatan</td>
                                        <td>: {{ $tor->pic->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Anggaran yang Diajukan</td>
                                        <td>: {{"Rp. ".number_format($tor->jumlah_anggaran,2,',',',')}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Lihat File Scan TOR dan RAB</td>
                                        <td>: <a href="{{asset('storage/fileScan/'. $tor->file)}}" target="_blank" class="btn btn-info btn-sm">Lihat File</a></td>
                                    </tr> --}}
                                    @if ($current_status == 'Belum Dinilai' || $current_status == 'Sudah Revisi')
                                    <tr>
                                        <td>Status Validasi</td>
                                        <td>
                                            <div class="form-group">:
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="statusRevisi" name="id_status" value="2" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="statusRevisi"> Revisi</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="statusSelesai" name="id_status" value="4" class="custom-control-input">
                                                    <label class="custom-control-label" for="statusSelesai"> Selesai</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="columnKomentar">
                                        <td>Komentar</td>
                                        <td>
                                            : <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalKomentar">Tambah / Lihat Komentar</button>
                                            @include('perencanaan.validasi_v2.modal.tor.komentar')
                                        </td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <tr class="text-center">
                                        <td colspan="2"><button class="btn btn-primary btn-sm" type="submit">Validasi TOR & RAB</button></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<!-- Wrapper END -->

@if($current_status == 'Revisi' || $current_status == 'Sudah Disetujui')
    <script>
        var n = document.getElementById("validasiplus");
        while (n) {
            n.parentNode.removeChild(n);
            n = document.getElementById("validasiplus"); // Perbarui nilai n
        }
    </script>
@endif
<script>
    document.querySelector('.custom-file-input').addEventListener('change',function(e){
        var fileName = document.getElementById("file").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
</script>

<script>
    $('input[name="id_status"]').change(function(){
        $('button[type="submit"]').removeAttr('hidden');
    })
    $('input[name="id_status"]').on("click", function(){
        let status = $('input[type="radio"]:checked').val();
        if (status == '4') {
            $('#columnSuratHasil').removeClass('invisible');
            $('#file').attr('required', true);
        } else {
            $('#file').removeAttr('required');
            $('#columnSuratHasil').addClass('invisible');
            $('#file').val('');
        }
    })
</script>

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