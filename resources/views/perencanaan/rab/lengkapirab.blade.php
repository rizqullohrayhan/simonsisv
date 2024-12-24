<br />
<?php
$totanggaran1 = 0;
?>
<div class="container center">
    <br />
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

                    <?php
                    foreach ($roles as $roleLoginLengkapi) {
                        if ($roleLoginLengkapi->id == Auth::user()->role) {
                            $unitLoginLengkapi = $roleLoginLengkapi->name;
                        }
                    }
                    ?>
                    <th rowspan="3" colspan="2" class="align-middle">Jenis Belanja
                        <?php if ($pengajuan == 0 || $dalamRevisi == 1) { ?>

                            @can('anggaran_create')
                            <!-- yang bisa akses Admin prodi, dan PIC yang bertanggung jawab di TOR tsb -->
                            <?php if ($tor->nama_pic == Auth::user()->name ||   $unitLoginLengkapi == "Admin"  ||   $unitLoginLengkapi == "Prodi") { ?>
                                <a id="validasi" class="iq-bg-success rounded" style="padding: 1%;" data-toggle="modal" data-placement="top" title="Tambah Anggaran" data-original-title="Tambah Anggaran" data-target="#tambah_anggaran<?= $rab->id ?>" href="">
                                    <i class="ri-user-add-line"></i> Tambah Anggaran</a>
                            <?php } ?>
                            @endcan
                        <?php } ?>
                    </th>
                    <th colspan="6" style="text-align: center;">Rincian Biaya</th>
                    <th rowspan="3" class="align-middle" style="text-align: center;">Jumlah Anggaran (Rp)</th>
                    <th rowspan="3"></th>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center;">Kebutuhan</th>
                    <th rowspan="2"  width="10%" class="align-middle" style="text-align: center;">Frek</th>
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
                        <tr>
                            <td colspan="2" style="text-align: justify;">
                                <b>{{$item->nomor_mak}} | {{$item->nama_belanja}}</b><br />
                                {{$item->detail}}
                                {{$item->catatan}}
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
                            <td>
                                @if ($tor->nama_pic == Auth::user()->name ||   $unitLoginLengkapi == "Admin"  ||   $unitLoginLengkapi == "Prodi")
                                    @include('perencanaan/aksi/aksi_anggaran')
                                @endif
                                @include('perencanaan/modal2/update_anggaran')
                            </td>
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
                    <th colspan="8">Total</th>
                    <th colspan="2">{{"Rp. ".number_format($totalAnggaranRab,2,',',',')}}</th>
                </tr>
                <!-- TANDA TANGAN -->
                <tr>
                    <td colspan="10"></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="6" style="text-align: center; padding-bottom: 0;">Surakarta</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;" width="50%">{{ $tor->unit->user->jabatan}}
                        <br />
                        <br />
                        <br />
                        <br />
                        <b>{{ $tor->unit->user->name}}</b>
                        <br/>
                        NIP. {{ $tor->unit->user->nip}}
                    </td>
                    {{-- <td></td> --}}
                    <td colspan="6" style="text-align: center;" width="50%">Perencana/Penanggungjawab
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
                    {{-- <td colspan="5"></td> --}}
                    <td colspan="10" style="text-align: center; padding-bottom: 0;">Menyetujui</td>
                </tr>
                {{-- <tr>
                    <td colspan="10"></td>
                </tr> --}}
                <tr >
                    {{-- <td colspan="5"></td> --}}
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
                <!-- TANDA TANGAN -->

                @include('perencanaan/modal2/tambah_anggaran')

            </tfoot>
        </table>
