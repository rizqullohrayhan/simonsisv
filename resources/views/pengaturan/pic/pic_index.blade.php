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
                                        <h4 class="card-title">DATA PIC
                                        </h4>
                                    </div>
                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                        <button class="btn btn-primary" data-toggle="modal" title="Tambah PIC" data-original-title="Tambah PIC" data-target="#tambahpic">Tambah PIC</i>
                                        </button>
                                    </div>
                                    <!-- Modal Tambah user -->
                                    <div class="modal fade" role="dialog" id="tambahpic" style="overflow:hidden;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah PIC</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="form-tambah" method="post" action="{{ route('pic.store') }}">
                                                        <div class="form-group">
                                                            <label>Nama PIC</label>
                                                            <input name="name" id="name" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email PIC</label>
                                                            <input name="email" id="email" type="email" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIP</label>
                                                            <input name="nip" id="nip" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nomor WhatsApp</label>
                                                            <input name="telepon" id="telepon" type="text" class="form-control">
                                                            <small>contoh: 08123456789</small>
                                                        </div>
                                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="table-responsive table-invoice">
                                        <table id="myusers" class="table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="5%">No.</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>NIP</th>
                                                    <th>No Whatsapp</th>
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
                    <h5 class="modal-title">Edit PIC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-edit" method="post" action="">
                        <div class="form-group">
                            <label>Nama PIC</label>
                            <input name="name" id="name-pic" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email PIC</label>
                            <input name="email" id="email-pic" type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input name="nip" id="nip-pic" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nomor WhatsApp</label>
                            <input name="telepon" id="telepon-pic" type="text" class="form-control">
                            <small>contoh: 08123456789</small>
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
            ajax: `{{route('pic.list')}}`,
            columns: [
                { data: "DT_RowIndex" },
                { data: "name" },
                { data: "email" },
                { data: "nip" },
                { data: "telepon" },
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
            let url = '{{route("pic.edit", "id")}}';
            url = url.replace('id', id);

            $.ajax({
                url: url,
                type: "GET",
                success: function (res){
                    let action = '{{route("pic.update", "id")}}';
                    action = action.replace('id', id);
                    $('#form-edit').attr('action', action);
                    $('#name-pic').val(res.name);
                    $('#nip-pic').val(res.nip);
                    $('#email-pic').val(res.email);
                    $('#telepon-pic').val(res.telepon);
                    $('#editpic').modal('show');
                },
            });
        });

        $("#show_data").on("click", ".btn-delete", function () {
            Swal.fire({
                title: "Anda yakin hapus PIC?",
                text: "PIC yang dihapus tidak dapat dipulihkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data("id");
                    let url = '{{route("pic.delete", "id")}}';
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