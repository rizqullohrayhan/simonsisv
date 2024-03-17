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
                        <div class="iq-card-header d-flex justify-content-center table-warning">
                            <div class="iq-header-title">
                                <h4 class="card-title">Edit Formulir Surat Pertanggungjawaban (SPJ)</h4>
                            </div>
                        </div>
                        <div class="iq-card-body mx-5">
                            <form class="needs-validation" enctype="multipart/form-data" method="post"
                                action="{{ url('/input_spj') }}">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="validationCustom01">
                                        Nama Kegiatan</label>
                                    <div class="col-sm-9">
                                        <label style="font-weight: bold">: {{ $nama_kegiatan }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="validationCustom01">
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
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="validationCustom01">Nama
                                        Penanggungjawab Kegiatan</label>
                                    <div class="col-sm-9">
                                        <label style="font-weight: bold">: {{ $penanggung }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="validationCustom01">Nominal Anggaran
                                    </label>
                                    <div class="col-sm-9">
                                        <label style="font-weight: bold">:
                                            {{ 'Rp ' . number_format($anggaran) }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="validationCustom01">Nominal
                                        Total SPJ
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nilai_total" class="form-control"
                                            id="validationCustom01" value="{{ $nilai_total }}">
                                    </div>
                                    <div class="invalid-feedback">
                                        Required!
                                    </div>
                                </div>
                                <input type="hidden" name="id_tor" class="form-control" value="<?= $_GET['idtor'] ?>">
                                <input type="hidden" name="jenis" value="SPJ Bukti Transfer Pengembalian" class="custom-file-input" required>
                                <input type="hidden" name="id_status" class="form-control" value="4">
                                <input type="hidden" name="create_by" class="form-control"
                                    value="<?= Auth()->user()->id ?>">
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <input name="created_at" id="created_at" type="hidden"
                                    value="<?= date('Y-m-d H:i:s') ?>">
                                <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="validationCustom01">Nilai Pengembalian

                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nilai_kembali" class="form-control"
                                            id="validationCustom01" value="{{ $nilai_kembali }}" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        Required!
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0">
                                        Unggah Bukti Transfer Sisa Anggaran
                                        <br>
                                        <small style="color: darkred">
                                            (Pdf. Doc. Images)
                                        </small>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file" name="file_bukti"
                                            id="file_bukti" accept="application/pdf, application/msword, image/*">
                                        <small style="color: darkred"><b>File yang sudah diupload :</b>
                                            <a class="text-primary" href="{{ asset('documents/' . $dokumen_bukti) }}"
                                                target="_blank">{{ $dokumen_bukti }}</a>
                                        </small>
                                    </div>
                                </div>

                                {{-- Unggah Bukti SPJ --}}
                                <div class="iq-card" style="box-shadow: none">
                                    <div class="iq-card-header d-flex justify-content-center table-warning my-1">
                                        <div class="iq-header-title">
                                            <h5 class="card-title">Edit Unggahan Dokumen Pendukung Surat
                                                Pertanggungjawaban (SPJ)
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="iq-card-body mx-0">
                                        <p></p>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="nav flex-column nav-pills text-left" id="v-pills-tab"
                                                    role="tablist" aria-orientation="vertical">
                                                    <?php
                                                    for ($a = 0; $a < count($spj_kategori); $a++) {
                                                    ?>
                                                    <a class="nav-link" id="tab-spj_kategori[$a]->id }}"
                                                        data-toggle="pill"
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
                                                                <tr class="form-group">
                                                                    <td rowspan="2">{{ $no }}</td>
                                                                    <td style="width: 65%">
                                                                        <label for="exampleFormControlFile1">
                                                                            {{ $spj_subkategori[$b]->nama_subkategori }}
                                                                        </label>
                                                                    </td>
                                                                    <td rowspan="2">
                                                                        <input type="file"
                                                                            class="form-control-file" name="file[]"
                                                                            id="file">
                                                                        <input type="hidden"
                                                                            class="form-control-file"
                                                                            name="id_subkategori[]"
                                                                            id="id_subkategori"
                                                                            value="{{ $spj_subkategori[$b]->id }}">
                                                                        <input type="hidden" name="id_tor"
                                                                            class="form-control"
                                                                            value="{{ $_GET['idtor'] }}">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    $dokspj = '';
                                                                    $bambang = DokumenSPJ::where([['id_tor', '=', $id_tor], ['id_subkategori', '=', $spj_subkategori[$b]->id]])->get();
                                                                    foreach ($bambang as $isi) {
                                                                        $dokspj = $isi['name'];
                                                                    }
                                                                    ?>
                                                                    <td
                                                                        style="border: none; padding-top: 0; padding-bottom: 0">
                                                                        <small style="color: darkorange">File
                                                                            yang
                                                                            sudah diupload:
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
                                        <div class="iq-card-footer float-right">
                                            <button type="submit" class="btn btn-primary m-3">Update</button>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('dashboards/users/layouts/footer')

</body>

</html>
