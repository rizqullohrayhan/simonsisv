<div class="modal fade" id="jenis_ajuan<?= $tor[$m]->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Jenis Penggunaan Dana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <p>Pilih salah satu opsi menuju proses selanjutnya:</p>
                <div class="row text-center">
                    <a href="{{ url('/dana_sendiri/') . '?idtor=' . base64_encode($tor[$m]->id) }}">
                        <button class="btn btn-sm bg-info rounded-pill">
                            Dana Sendiri
                        </button>
                    </a>
                    <a href="#" class="btn btn-sm bg-info rounded-pill" title="Detail" data-toggle="modal"
                        data-target="#input_persekotkerja{{ $tor[$m]->id }}">
                        Ajuan Persekot Kerja
                    </a>
                    <!-- MODAL - Input Persekot Kerja -->
                    @include('keuangan/persekot_kerja/input_pk')
                </div>
            </div>
        </div>
    </div>
