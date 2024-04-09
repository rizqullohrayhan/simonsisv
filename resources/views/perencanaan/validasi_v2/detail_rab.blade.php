<table id="datatable" class="table table-striped table-borderless">
    <thead>
        <tr>
            <td colspan="10">
                <h5 style="text-align: center;"><b>RINCIAN ANGGARAN BELANJA</b></h5>
            </td>
        </tr>
        <tr>
            <td style="127px"></td>
            <td style="13px"></td>
            <td style="52px"></td>
            <td style="50px"></td>
            <td style="50px"></td>
            <td style="50px"></td>
            <td style="50px"></td>
            <td style="50px"></td>
            <td style="83px"></td>
            <td style="83px"></td>
        </tr>
        <tr>
            <td class="border-top border-bottom border-left"><b>Unit Kerja</b> </td>
            <td class="border-top border-bottom">:</td>
            <td colspan="7" class="border-top border-bottom">{{$namaunit->nama_unit}}</td>
            <td class="border"><b>Tahun</b></td>
        </tr>
        <tr>
            <td class="align-middle border-top border-bottom border-left"><b>Kegiatan</b> </td>
            <td class="align-middle border-top border-bottom">:</td>
            <td colspan="7" class="align-middle border-top border-bottom">{{ $indikator_p->IK." : ".$indikator_p->deskripsi_ik}}</td>
            <td rowspan="3" class="align-middle border" style="text-align: center;">{{substr($tor->tgl_mulai_pelaksanaan,0,4)}}</td>
        </tr>
        <tr>
            <td class="align-middle border-top border-bottom border-left"><b>Program</b></td>
            <td class="align-middle border-top border-bottom">:</td>
            <td colspan="7" class="align-middle border-top border-bottom">{{$indikator_p->P." : ".  $indikator_p->deskripsi}}</td>
        </tr>
        <tr>
            <td class="align-middle border-top border-bottom border-left"><b>Judul Kegiatan</b></td>
            <td class="align-middle border-top border-bottom">:</td>
            <td colspan="7" class="align-middle border-top border-bottom">{{$tor->nama_kegiatan}}</td>
        </tr>
        <tr>
            <td colspan="9" class="border" style="text-align: center;"><b>Indikator</b></td>
            <td class="border"><b>Target</b></td>
        </tr>
        <tr>
            <td class="align-middle border-top border-bottom border-left"><b>Input (Masukan)</b></td>
            <td class="align-middle border-top border-bottom">:</td>
            <td colspan="7" class="align-middle border-top border-bottom">{{$rab->masukan }}</td>
            <td rowspan="2" class="align-middle border" style="text-align: center;">{{$tor->target_IKU}}</td>
        </tr>
        <tr>
            <td class="align-middle border-top border-bottom border-left"><b>Output (Keluaran)</b></td>
            <td class="align-middle border-top border-bottom">:</td>
            <td colspan="7" class="align-middle border-top border-bottom">{{$rab->keluaran}}</td>
        </tr>
        <tr>
            <td colspan="10" class="border"></td>
        </tr>
        <tr>
            <th colspan="10" class="border" style="text-align: center;"><b>Anggaran Belanja</b></th>
        </tr>
        <tr>
            <th rowspan="3" colspan="3" class="align-middle border" style="text-align: center;">Jenis Belanja</th>
            <th colspan="6" class="border" style="text-align: center;">Rincian Biaya</th>
            <th rowspan="3" class="align-middle border" style="text-align: center;">Jumlah Anggaran (Rp)</th>
        </tr>
        <tr>
            <th colspan="2" class="border" style="text-align: center;">Kebutuhan</th>
            <th rowspan="2" class="align-middle border" style="text-align: center;">Frek</th>
            <th colspan="2" class="border" style="text-align: center;">Perhitungan</th>
            <th rowspan="2" class="align-middle border" style="text-align: center;">Harga Satuan</th>
        </tr>
        <tr>
            <th class="border">Vol.</th>
            <th class="border">Sat.</th>
            <th class="border">Vol.</th>
            <th class="border">Sat.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3" class="border" style="text-align: center;">1</td>
            <td class="border" style="text-align: center;">2</td>
            <td class="border" style="text-align: center;">3</td>
            <td class="border" style="text-align: center;">4</td>
            <td class="border" style="text-align: center;">5</td>
            <td class="border" style="text-align: center;">6</td>
            <td class="border" style="text-align: center;">7</td>
            <td class="border" style="text-align: center;">8</td>
        </tr>
        @php
        $totalAnggaranRab = 0;
        $urut = 1;
        @endphp
        
        @foreach($anggaran as $item)
            @if ($item->anggaran != 0)
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
                            <td colspan="3" class="align-middle border" style="text-align: justify;">
                                <b>{{$kodeKelompok}} </b><br />
                                {{$detail->detail}}
                                {{ $item->catatan }}
                            </td>
                            <td class="align-middle border" style="text-align: center;">{{$item->kebutuhan_vol}}</td>
                            <td class="align-middle border" style="text-align: center;">{{$item->kebutuhan_sat}}</td>
                            <td class="align-middle border" style="text-align: center;">{{$item->frek}}</td>
                            <td class="align-middle border" style="text-align: center;">{{$item->perhitungan_vol}}</td>
                            <td class="align-middle border" style="text-align: center;">{{$item->perhitungan_sat}}</td>
                            <td class="align-middle border" style="text-align: center;">{{"Rp. ".number_format($item->harga_satuan,2,',',',')}}</td>
                            <td class="align-middle border" style="text-align: center;">{{"Rp. ".number_format($item->anggaran,2,',',',')}}</td>
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
            <th colspan="8" class="border">Total</th>
            <th colspan="2" class="border" style="text-align: right;">{{"Rp. ".number_format($totalAnggaranRab,2,',',',')}}</th>
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
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="10" style="text-align: center;">Menyetujui</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="3" class="border-top border-right border-left">Wakil Dekan Akademik, Riset, dan Kemahasiswaan</td>
            <td colspan="4" class="border-top border-right border-left">Wakil Dekan Perencanaan, Kerjasama, Bisnis dan Informasi</td>
            <td colspan="3" class="border-top border-right border-left">Wakil Dekan SDM, Keuangan, dan Logistik</td>
        </tr>
        @for ($i = 0; $i < 10; $i++)
            <tr>
                <td colspan="3" class="border-left border-right"></td>
                <td colspan="4" class="border-left border-right"></td>
                <td colspan="3" class="border-left border-right"></td>
            </tr>
        @endfor
        <tr>
            <td colspan="3" class="border-left border-right"><b>{{ $wd1->name }}</b></td>
            <td colspan="4" class="border-left border-right"><b>{{ $wd3->name }}</b></td>
            <td colspan="3" class="border-left border-right"><b>{{ $wd2->name }}</b></td>
        </tr>
        <tr>
            <td colspan="3" class="border-left border-right border-bottom">NIP. {{ $wd1->nip }}</td>
            <td colspan="4" class="border-left border-right border-bottom">NIP. {{ $wd3->nip }}</td>
            <td colspan="3" class="border-left border-right border-bottom">NIP. {{ $wd2->nip }}</td>
        </tr>
        <!-- TANDA TANGAN -->
    </tfoot>
</table>