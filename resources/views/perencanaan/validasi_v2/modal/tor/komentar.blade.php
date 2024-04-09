<div class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true" id="modalKomentar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Komentar TOR & RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                    $active = 2;
                    $iku = "";
                    $ik = "";
                    $indikator_k = "n";
                    $warna_komentar = "alert-danger"; //warna komentar
                    $note = "";

                    if (!empty($indikator_p)) {
                        $p =  $indikator_p->P;
                        $deskripsi_p =  $indikator_p->deskripsi;
                        $iku = $indikator_p->IKU;
                        $deskripsi_iku = $indikator_p->deskripsi_iku;
                        $ik = $indikator_p->IK;
                        $deskripsi_ik = $indikator_p->deskripsi_ik;
                    }
                @endphp
                <div class="iq-card">
                    <div class="table-responsive">
                        <table id="torx" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><small>v1.6</small></th>
                                    <th colspan="17"></th>
                                    <th class="border align-top" rowspan="2" colspan="3"><small>KAK</small></th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="15">
                                        <h5 style="text-align: center;"><b>KERANGKA ACUAN KERJA (KAK) / TERM OF REFERENCE (ToR)</b></h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="15">
                                        <h5 style="text-align: center;"><b>PROGRAM STUDI {{strtoupper($prodi)}}</b></h5>
                                    </th>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="15">
                                        <h5 style="text-align: center;"><b>SEKOLAH VOKASI UNIVERSITAS SEBELAS</b></h5>
                                    </th>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width: 22px"></th>
                                    <th style="width: 22px"></th>
                                    <th style="width: 14px"></th>
                                    <th style="width: 127px"></th>
                                    <th style="width: 11px"></th>
                                    <th style="width: 29px"></th>
                                    <th style="width: 29px"></th>
                                    <th style="width: 35px"></th>
                                    <th style="width: 35px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                    <th style="width: 24px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>1.</b></td>
                                    <td colspan="3"><b>Indikator Kinerja Utama</b></td>
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
                                    <td colspan="3"><b>Judul Kegiatan</b></td>
                                    <td>:</td>
                                    <td colspan="16">
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
                                    <td colspan="20"><b>Latar Belakang</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="20" style="text-align: justify;">{!!$tor->latar_belakang!!}
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
                                    <td colspan="20"><b>Rasionalisasi</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="20" style="text-align: justify;">{!!$tor->rasionalisasi!!}
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
                                    <td colspan="20"><b>Tujuan</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="20" style="text-align: justify;">{!!$tor->tujuan!!}
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
                                    <td colspan="20"><b>Mekanisme dan Rancangan</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="20">{!!$tor->mekanisme!!}
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
                                                        <th scope="col" rowspan="2" colspan="8" class="border align-middle">Komponen Input</th>
                                                        <th scope="col" colspan="12" class="border" style="text-align: center;">{{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="border">1</td>
                                                        <td class="border">2</td>
                                                        <td class="border">3</td>
                                                        <td class="border">4</td>
                                                        <td class="border">5</td>
                                                        <td class="border">6</td>
                                                        <td class="border">7</td>
                                                        <td class="border">8</td>
                                                        <td class="border">9</td>
                                                        <td class="border">10</td>
                                                        <td class="border">11</td>
                                                        <td class="border">12</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($komponen_jadwal as $komponen)
                                                        <tr>
                                                            <td colspan="8"  class="border">{{$komponen->komponen}}</td>
                                                            @for ($b = 1; $b < $komponen->bulan_awal; $b++)
                                                                <td class="border"></td>
                                                            @endfor
                                                            @for ($kj = 0; $kj <= ($komponen->bulan_akhir - $komponen->bulan_awal); $kj++)
                                                                <td class="border" style=" background-color:black!important; -webkit-print-color-adjust: exact; "></td>
                                                            @endfor
                                                            @for ($c = 12; $c > $komponen->bulan_akhir; $c--)
                                                                <td class="border"></td>
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
                                    <td colspan="20"><b>Indikator Kinerja Utama (IKU)</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="20">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="14" scope="col" class="border">Indikator</th>
                                                    <th colspan="3" scope="col" class="border">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                                    <th colspan="3" scope="col" class="border">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="14" class="border">{{$iku ." ".$deskripsi_iku}}</td>
                                                    <td colspan="3" class="border">{{$tor->realisasi_IKU ."%"}}</td>
                                                    <td colspan="3" class="border">{{$tor->target_IKU ."%"}}</td>
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
                                    <td colspan="20"><b>Indikator Kinerja Kegiatan (IK)</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="20">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="14" scope="col" class="border">Indikator</th>
                                                    <th colspan="3" scope="col" class="border">Realisasi <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)-1}}</th>
                                                    <th colspan="3" scope="col" class="border">Target <br /> {{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="14" class="border">{{$iku ." ".$deskripsi_ik}}</td>
                                                    <td colspan="3" class="border">{{$tor->realisasi_IK ."%"}}</td>
                                                    <td colspan="3" class="border">{{$tor->target_IK ."%"}}</td>
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
                                    <td colspan="20"><b>Keberlanjutan</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="19">
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
                                    <td colspan="20"><b>Penanggungjawab</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="19">
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
                                    <td colspan="10"></td>
                                    <td colspan="11">Surakarta</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="7" style="text-align: center;">Kepala Program Studi
                                        <br />
                                        <br />
                                        <br />
                                        <br />
                                        <b>{{ $tor->unit->kaprodi->name }}</b>
                                        <br/>
                                        NIP. {{ $tor->unit->kaprodi->nip }}
                                    </td>
                                    <td></td>
                                    <td colspan="11" style="text-align: center;">Perencana/Penanggungjawab
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
                                    <td colspan="5" class="border-top border-right border-left">Wakil Dekan Akademik, Riset, dan Kemahasiswaan</td>
                                    <td colspan="8" class="border-top border-right border-left">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi</td>
                                    <td colspan="7" class="border-top border-right border-left">Wakil Dekan SDM, Keuangan, dan Logistik</td>
                                </tr>
                                @for ($i = 0; $i < 10; $i++)
                                    <tr>
                                        <td></td>
                                        <td colspan="5" class="border-left border-right"></td>
                                        <td colspan="8" class="border-left border-right"></td>
                                        <td colspan="7" class="border-left border-right"></td>
                                    </tr>
                                @endfor
                                <tr>
                                    <td></td>
                                    <td colspan="5" class="border-left border-right"><b>{{ $wd1->name }}</b></td>
                                    <td colspan="8" class="border-left border-right"><b>{{ $wd3->name }}</b></td>
                                    <td colspan="7" class="border-left border-right"><b>{{ $wd2->name }}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="5" class="border-left border-right border-bottom">NIP. {{ $wd1->nip }}</td>
                                    <td colspan="8" class="border-left border-right border-bottom">NIP. {{ $wd3->nip }}</td>
                                    <td colspan="7" class="border-left border-right border-bottom">NIP. {{ $wd2->nip }}</td>
                                </tr>
                            <!-- TANDA TANGAN -->
                            </tbody>
                        </table>
                    </div>

                    <?php collapseKomentar(); ?>
                    <br />
                </div>
                <div class="iq-card">
                    <div class="row">
                        <div class="container my-2">
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
</div>