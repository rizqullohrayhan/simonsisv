<?php
use App\Models\DokumenSPJ;
?>

@include('dashboards/users/layouts/script')

<body>
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>

    @include('dashboards/users/layouts/navbar')
    @include('dashboards/users/layouts/sidebar')
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-center table-info">
                            <div class="iq-header-title">
                                <h4 class="card-title">Surat Pertanggungjawaban (SPJ)</h4>
                            </div>
                        </div>
                        <div class="iq-card-body mx-5">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">
                                    Nama Kegiatan</label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">: {{ $nama_kegiatan }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">
                                    Nama Unit/Prodi/Ormawa</label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">: {{ $namaprodi }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">ID Ajuan Memo
                                    Cair</label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">: {{ $memocair }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">Nama
                                    Penanggungjawab Kegiatan</label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">: {{ $penanggung }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">Nominal Anggaran
                                </label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">:
                                        {{ 'Rp ' . number_format($anggaran) }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">Nominal
                                    Total SPJ
                                </label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">:
                                        {{ 'Rp ' . number_format($nilai_total) }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">Nilai Pengembalian

                                </label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">:
                                        {{ 'Rp ' . number_format($nilai_kembali) }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0">
                                    Bukti Transfer Sisa Anggaran
                                </label>
                                <div class="col-sm-9">
                                    <label style="font-weight: bold">: </label>
                                    <a class="text-primary" href="{{ asset('documents/' . $dokumen_bukti) }}"
                                        target="_blank">{{ $dokumen_bukti }}</a>
                                </div>
                            </div>

                            {{-- Unggah BUKTI SPJ --}}
                            <div class="iq-card" style="box-shadow: none">
                                <div class="iq-card-header d-flex justify-content-center table-secondary">
                                    <div class="iq-header-title">
                                        <h5 class="card-title">
                                            Dokumen Pendukung Surat Pertanggungjawaban (SPJ)
                                        </h5>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <p></p>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="nav flex-column nav-pills text-left" id="v-pills-tab"
                                                role="tablist" aria-orientation="vertical">
                                                <?php
                                        for ($a = 0; $a < count($spj_kategori); $a++) {
                                        ?>
                                                <a class="nav-link" id="tab-spj_kategori[$a]->id }}" data-toggle="pill"
                                                    href="#content-{{ $spj_kategori[$a]->id }}" role="tab"
                                                    aria-controls="{{ $spj_kategori[$a]->id }}"
                                                    aria-selected="true">{{ $spj_kategori[$a]->nama_kategori }}
                                                </a>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="tab-content mt-0" id="v-pills-tabContent">
                                                <?php
                                                    for ($a = 0; $a < count($spj_kategori); $a++) {
                                                ?>
                                                <div class="tab-pane fade show" role="tabpanel"
                                                    id="content-{{ $spj_kategori[$a]->id }}"
                                                    aria-labelledby="tab-{{ $spj_kategori[$a]->id }}">
                                                    <div class="col-12">
                                                        <h5 class="mb-2" style="color: #1E3D73">
                                                            <b>{{ $spj_kategori[$a]->nama_kategori }}</b>
                                                        </h5>
                                                        <?php $no = 1;
                                                            for ($b = 0; $b < count($spj_subkategori); $b++) {
                                                                if ($spj_subkategori[$b]->id_kategori == $spj_kategori[$a]->id) { ?>
                                                        <p>{!! $spj_subkategori[$b]->catatan !!}</p>
                                                        <table class="table">
                                                            <tr>
                                                                <td style="width: 5%">{{ $no }}</td>
                                                                <td style="width: 45%">
                                                                    <label for="exampleFormControlFile1">
                                                                        {{ $spj_subkategori[$b]->nama_subkategori }}
                                                                    </label>
                                                                </td>
                                                                <?php
                                                                $dokspj = '';
                                                                $bambang = DokumenSPJ::where([['id_tor', '=', $id_tor], ['id_subkategori', '=', $spj_subkategori[$b]->id]])->get();
                                                                foreach ($bambang as $isi) {
                                                                    $dokspj = $isi['name'];
                                                                }
                                                                ?>
                                                                <td style="width: 50%">
                                                                    <small style="color: darkorange">File Bukti:
                                                                        <a class="text-primary"
                                                                            href="{{ asset('document_spj/' . $dokspj) }}"
                                                                            target="_blank">{{ $dokspj }}</a>
                                                                    </small>
                                                                </td>
                                                            </tr>
                                                            <?php $no += 1;
                                                                }
                                                            } ?>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php
                                        } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>
<!-- Footer -->
@include('dashboards/users/layouts/footer')
