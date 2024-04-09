@include('dashboards/users/layouts/script')

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('dashboards/users/layouts/navbar')
            @include('dashboards/users/layouts/sidebar')


            <div id="content-page" class="content-page">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">DATA Kaprodi
                                        </h4>
                                    </div>
                                    @if (is_null($hasKaprodi))
                                        <div class="iq-card-header-toolbar d-flex align-items-center">
                                            <button class="btn btn-primary" data-toggle="modal" title="Tambah Kaprodi" data-original-title="Tambah Kaprodi" data-target="#tambahpic">Tambah Kaprodi</i>
                                            </button>
                                        </div>
                                        <!-- Modal Tambah user -->
                                        <div class="modal fade" role="dialog" id="tambahpic" style="overflow:hidden;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Kaprodi</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="form-tambah" method="post" action="{{ route('kaprodi.store') }}">
                                                            <div class="form-group">
                                                                <label>Nama Kaprodi</label>
                                                                <input name="name" id="name" type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>NIP</label>
                                                                <input name="nip" id="nip" type="text" class="form-control">
                                                            </div>
                                                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="iq-card-body">
                                    <div class="table-responsive table-invoice">
                                        <table id="myusers" class="table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="5%">No.</th>
                                                    <th>Nama</th>
                                                    <th>NIP</th>
                                                    {{-- <th>Email</th> --}}
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="show_data">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </section>
    </div>

    <div class="modal fade" role="dialog" id="editpic" style="overflow:hidden;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kaprodi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-edit" method="post" action="">
                        <div class="form-group">
                            <label>Nama Kaprodi</label>
                            <input name="name" id="name-pic" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input name="nip" type="text" id="nip-pic" class="form-control">
                        </div>
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>

    <script>
        // $(document).ready(function() {
        //     // $.noConflict();
        // });
        var table = $('#myusers').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: `{{route('kaprodi.list')}}`,
            columns: [
                { data: "DT_RowIndex" },
                { data: "name" },
                { data: "nip" },
                { data: "action" },
            ],
            columnDefs: [
                {
                    className: "text-center",
                    width: "3%",
                    targets: [0],
                },
            ],
        });
        
        $('#show_data').on('click', '.btn-edit', function() {
            let id = $(this).data('id');
            let url = '{{route("kaprodi.edit", "id")}}';
            url = url.replace('id', id);

            $.ajax({
                url: url,
                type: "GET",
                success: function (res){
                    let action = '{{route("kaprodi.update", "id")}}';
                    action = action.replace('id', id);
                    $('#form-edit').attr('action', action);
                    $('#name-pic').val(res.name);
                    $('#nip-pic').val(res.nip);
                    $('#editpic').modal('show');
                },
            });
        });

        $("#show_data").on("click", ".btn-delete", function () {
            Swal.fire({
                title: "Anda yakin hapus Kaprodi?",
                text: "Kaprodi yang dihapus tidak dapat dipulihkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data("id");
                    let url = '{{route("kaprodi.delete", "id")}}';
                    url = url.replace('id', id);

                    $.ajax({
                        url: url,
                        type: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        beforeSend: function () {
                            Swal.fire({
                                title: "Mohon Tunggu",
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        },
                        success: function (res) {
                            if (res.status) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: res.message,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                table.ajax.reload();
                            } else {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: res.message,
                                    icon: "error",
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            var err = JSON.parse(xhr.responseText);
                            Swal.fire({
                                title: "Gagal!",
                                text: err.message,
                                icon: "error",
                            });
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                    });
                }
            });
        });

        $('#form-tambah').submit(function (e) {
            e.preventDefault();
            let data = new FormData(this);
            let form = this
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                data: data,
                contentType: false, // Tidak mengatur contentType secara otomatis
                processData: false, // Tidak memproses data secara otomatis
                beforeSend: function () {
                    Swal.fire({
                        title: "Mohon Tunggu",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function (res) {
                    if (res.status) {
                        form.reset();
                        $("#tambahpic").modal("hide");
                        Swal.fire({
                            title: "Berhasil!",
                            text: res.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        location.reload();
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: res.message,
                            icon: "error",
                        });
                    }
                },
                error: function (xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    Swal.fire({
                        title: "Gagal!",
                        text: err.message,
                        icon: "error",
                    });
                },
            });
        });

        $('#form-edit').submit(function (e) {
            e.preventDefault();
            let data = new FormData(this);
            let form = this;
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                data: data,
                contentType: false, // Tidak mengatur contentType secara otomatis
                processData: false, // Tidak memproses data secara otomatis
                beforeSend: function () {
                    Swal.fire({
                        title: "Mohon Tunggu",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function (res) {
                    if (res.status) {
                        form.reset();
                        $("#editpic").modal("hide");
                        Swal.fire({
                            title: "Berhasil!",
                            text: res.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: res.message,
                            icon: "error",
                        });
                    }
                },
                error: function (xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    Swal.fire({
                        title: "Gagal!",
                        text: err.message,
                        icon: "error",
                    });
                },
            });
        });
    </script>
    @include('dashboards/users/layouts/footer')

    </html>