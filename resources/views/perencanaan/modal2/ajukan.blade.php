<!-- MODAL AJUKAN TOR -->
<div class="modal fade" tabindex="-1" role="dialog" id="ajukan{{ $tItem->id }}">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffc107;color:white">
                <h5 class="modal-title" style="color:white"><b>Pengajuan TOR & RAB ke Sekolah Vokasi</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <h4 class="card-title">Pengajuan TOR & RAB ke Sekolah Vokasi</h4> -->
                <form method="post" action="{{url('/validasi/pengajuanProdi')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <i>Lengkapi Data TOR & RAB Sebelum Diajukan</i>
                        <label for="exampleFormControlSelect1"></label><br />

                        @php
                            $jenisDiajukan = "Belum Diajukan";
                            if (!empty($trx_status_tor)) {  
                                foreach ($trx_status_tor as $trxstatus) {

                                    if ($trxstatus->id_tor == $tItem->id) {
                                        foreach ($status as $sts) {
                                            if ($sts->id == $trxstatus->id_status) {
                                                if ($sts->nama_status == "Belum Dinilai") {
                                                    $jenisDiajukan = "Baru";
                                                }
                                                if ($sts->nama_status == "Sudah Revisi") {
                                                    $jenisDiajukan = "Perbaikan";
                                                }
                                            }
                                        }
                                    }
                                    if ($trxstatus->id_tor != $tItem->id) {
                                        $jenisDiajukan = "Belum Diajukan";
                                    }
                                }
                            } else {
                                $jenisDiajukan = "Belum Diajukan";
                            }
                        @endphp
                        @foreach ($status as $item)
                            @if ($item->kategori == 'TOR')
                                @if ($jenisDiajukan == "Belum Diajukan" && $item->nama_status == 'Belum Dinilai')
                                    <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{ $item->id }}" autocomplete="off" checked hidden>
                                    {{-- <label class="" for="danger-outlined">{{ $item->nama_status }}</label><br /> --}}
                                @elseif ($jenisDiajukan == "Baru" || $jenisDiajukan == "Perbaikan")
                                    @if ($item->nama_status == 'Sudah Revisi')
                                        <input type="radio" class="btn-check" name="id_status" id="id_status" value="{{ $item->id }}" autocomplete="off" checked>
                                        <label class="" for="danger-outlined"><b>{{ $item->nama_status }}</b></label><br />
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        {{-- {{$jenisDiajukan}} --}}
                        <input type="hidden" name="create_by" value="<?= Auth()->user()->id ?>">
                        @foreach($role as $roleby)
                            @if(Auth()->user()->role == $roleby->id)
                                <input type="hidden" name="role_by" value="<?= $roleby->name ?>">
                            @endif
                        @endforeach
                        @php
                            $validator = $indikator_p->firstWhere('id', $tItem->id_p)->verifikator;
                        @endphp
                        <div class="form-group">
                            <input type="hidden" name="validator" value="{{$validator}}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="file">Unggah File TOR & RAB yang telah di TTD oleh Kaprodi dan PIC dalam format .pdf</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="file" accept="application/pdf" required>
                                <label class="custom-file-label" for="file">Pilih File</label>
                            </div>
                        </div> --}}
                        <input type="hidden" name="judul" value="{{ $tItem->nama_kegiatan }}">
                        <input type="hidden" name="id_tor" value="{{ $tItem->id }}">
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                        <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                        <br />
                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>