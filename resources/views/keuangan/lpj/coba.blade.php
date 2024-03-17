                {{ $tombol = ''; }}
                    <p>Pilih salah satu untuk memperbarui status:</p>
                    @foreach ($trx_status_keu as $a)
                        @if ($a->id_tor == $tor[$m]->id)
                            @for ($s = 0; $s < count($status_keu); $s++)
                                @if ($a->id_status == $status_keu[$s]->id)
                                    @if ($status_keu[$s]->kategori == 'LPJ')
                                        @if ($status_keu[$s]->nama_status === 'Proses Pengajuan')
                                        <?php $tombol = '
                                            <div onclick="revisi('. $tor[$m]->id .')" class="custom-control custom-radio custom-radio-color-checked ">
                                                <input type="radio" name="id_status" id="revisi'. $tor[$m]->id .'"
                                                    value="10">
                                                <label for="revisi'. $tor[$m]->id .'" class=""> Revisi</label>
                                            </div>
                                            <div onclick="verifikasi('. $tor[$m]->id .')"
                                                class="custom-control custom-radio custom-radio-color-checked">
                                                <input type="radio" name="id_status" id="verifikasi'. $tor[$m]->id .'"
                                                    value="9">
                                                <label for="verifikasi'. $tor[$m]->id .'" class=""> Verifikasi</label>
                                            </div>';?>
                                        @elseif ($status_keu[$s]->nama_status === 'Revisi')
                                        <?php $tombol = '
                                            <div onclick="pengajuan('. $tor[$m]->id .')"
                                                class="custom-control custom-radio custom-radio-color-checked">
                                                <input type="radio" name="id_status" id="pengajuan'. $tor[$m]->id .'"
                                                    value="8">
                                                <label for="pengajuan'. $tor[$m]->id .'" class=""> Proses Pengajuan</label>
                                            </div>'; ?>
                                        @elseif ($status_keu[$s]->nama_status === 'Verifikasi')
                                        <?php $tombol = '
                                            <div onclick="lpjselesai('. $tor[$m]->id .')"
                                                class="custom-control custom-radio custom-radio-color-checked">
                                                <input type="radio" name="id_status" id="selesai'. $tor[$m]->id .'" value="11">
                                                <label for="selesai'. $tor[$m]->id .'" class=""> LPJ Selesai</label>
                                            </div>'; ?>
                                        @elseif ($status_keu[$s]->nama_status === 'LPJ Selesai')
                                        <?php $tombol = ''; ?>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        @endif
                    @endforeach
                    <?= $tombol ?>