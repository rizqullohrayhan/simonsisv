<br />
<br />
<?php
$totanggaran1 = 0;
?>
<div class="container center">
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td colspan="10">
                        <h5 style="text-align: center;"><b>RINCIAN ANGGARAN BELANJA</b></h5>
                    </td>
                </tr>
                <tr>
                    <td width="28%"><b>Unit Kerja</b> </td>
                    <td width="2%">:</td>
                    <td colspan="7" width="50%">{{$namaunit->nama_unit}}</td>
                    <td width="5%"><b>Tahun</b></td>
                </tr>
                <tr>
                    <td><b>Kegiatan</b> </td>
                    <td width="1%">:</td>
                    <td colspan="7">{{ $indikator_p->IK." : ".$indikator_p->deskripsi_ik}}</td>
                    <td rowspan="3">{{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</td>
                </tr>
                <tr>
                    <td><b>Program</b></td>
                    <td width="1%">:</td>
                    <td colspan="7">{{$indikator_p->P." : ".  $indikator_p->deskripsi}}</td>
                </tr>
                <tr>
                    <td><b>Judul Kegiatan</b></td>
                    <td width="1%">:</td>
                    <td colspan="7">{{$tor->nama_kegiatan}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="8" style="text-align: center;"><b>Indikator</b></td>
                    <td><b>Target</b></td>
                </tr>
                <tr>
                    <td><b>Input (Masukan)</b></td>
                    <td width="1%">:</td>
                    <td colspan="7">{{$rab->masukan }}</td>
                    <td rowspan="2">{{$tor->target_IKU}}</td>
                </tr>
                <tr>
                    <td><b>Output (Keluaran)</b></td>
                    <td width="1%">:</td>
                    <td colspan="7">{{$rab->keluaran}}</td>
                </tr>
                <tr>
                    <td colspan="10"></td>
                </tr>
                <tr>
                    <th colspan="10" style="text-align: center;"><b>Anggaran Belanja</b></th>
                </tr>
                <tr>
                    <th rowspan="3" colspan="2" class="align-middle">Jenis Belanja</th>
                    <th colspan="6" style="text-align: center;">Rincian Biaya</th>
                    <th rowspan="3" class="align-middle" style="text-align: center;">Jumlah Anggaran (Rp)</th>
                    <th rowspan="3"></th>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center;">Kebutuhan</th>
                    <th rowspan="2" class="align-middle" style="text-align: center;">Frek</th>
                    <th colspan="2" style="text-align: center;">Perhitungan</th>
                    <th rowspan="2" class="align-middle" style="text-align: center;">Harga Satuan</th>
                </tr>
                <tr>
                    <th width="10%">Vol.</th>
                    <th width="10%">Sat.</th>
                    <th width="10%">Vol.</th>
                    <th width="10%">Sat.</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalAnggaranRab = 0;
                $urut = 1;
                @endphp
                
                @foreach($anggaran as $item)
                    @if ($item->anggaran != 0)
                        @php
                        $totanggaran1 += $item->anggaran;
                        @endphp
                        @foreach($detail_mak as $detail)
                            @if ($item->id_detail_mak == $detail->id)
                                @php
                                $kodeKelompok = '';
                                foreach ($belanja_mak as $belanja) {
                                    if ($belanja->id == $detail->id_belanja) {
                                        foreach ($kelompok_mak as $kelompoks) {
                                            if ($belanja->id_kelompok == $kelompoks->id) {
                                                $kodeKelompok = $kelompoks->kelompok;
                                            }
                                        }
                                    }
                                }
                                @endphp
                                <tr>
                                    <td colspan="2" style="text-align: justify;">
                                        <b>{{$kodeKelompok}} </b><br />
                                        {{$detail->detail}}
                                        <?= $item->catatan ?>
                                        <!-- MODAL UPDATE DI ANGGARAN -->
                                        @include('perencanaan/modal2/update_anggaran')
                                    </td>
                                    <td>{{$item->kebutuhan_vol}}</td>
                                    <td>{{$item->kebutuhan_sat}}</td>
                                    <td>{{$item->frek}}</td>
                                    <td>{{$item->perhitungan_vol}}</td>
                                    <td>{{$item->perhitungan_sat}}</td>
                                    <td>{{"Rp. ".number_format($item->harga_satuan,2,',',',')}}</td>
                                    <td>{{"Rp. ".number_format($item->anggaran,2,',',',')}}</td>
                                </tr>
                                @php
                                $totalAnggaranRab += $item->anggaran;
                                $urut += 1;
                                @endphp
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7">Total</th>
                    <th>{{"Rp. ".number_format($totalAnggaranRab,2,',',',')}}</th>
                </tr>
                <!-- TANDA TANGAN -->
                <tr>
                    <td colspan="10"></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td colspan="5" style="padding-left: 16.8rem; padding-bottom: 0;">Surakarta</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center;" width="50%">Kepala Program Studi
                        <br />
                        <br />
                        <br />
                        <br />
                        <b>{{ $tor->unit->kaprodi->name }}</b>
                        <br/>
                        NIP. {{ $tor->unit->kaprodi->nip }}
                    </td>
                    <td colspan="5" style="text-align: center;" width="50%">Perencana/Penanggungjawab
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
                        <b>Agus Dwi Priyanto, S.S., M.CALL</b><br />
                        NIP. 197408182000121001
                    </td>
                    <td colspan="4">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi
                        <br />
                        <br />
                        <br />
                        <b>Dr. Eng. Herman Saputro, S.Pd., M.Pd., M.T.</b><br />
                        NIP. 198208112006041001
                    </td>
                    <td colspan="2">Wakil Dekan SDM, Keuangan, dan Logistik
                        <br />
                        <br />
                        <br />
                        <br />
                        <b> Abdul Aziz, S.Kom., M.Cs.</b><br />
                        NIP. 198104132005011001
                    </td>
                </tr>
                <!-- TANDA TANGAN -->
            </tfoot>
        </table>


