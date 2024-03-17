@include('dashboards/users/layouts/script')


@section('title')
{{ trans('roles.title.index') }}
@endsection

<body>
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <div class="wrapper">
        @include('dashboards/users/layouts/navbar')
        @include('dashboards/users/layouts/sidebar')

        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-header-title ">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <h4 class="card-title">DATA ROLE
                                        </h4>
                                        <div class="iq-card-header-toolbar d-flex align-items-center">
                                            <a href="{{url('/roles_create')}}" class="btn btn-primary">Tambah Role</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: "{{session('success')}}",
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    </script>
                                    @endif
                                    <div class="card-body">
                                        <div class="table-responsive table-invoice">
                                            <table id="myroles" class="table table-striped table table-striped table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th width="10%">No.</th>
                                                        <th>Role</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $num = 1; ?>
                                                    @foreach($roles as $role)
                                                    <tr>
                                                        <td><a href="#">{{$num}}</a></td>
                                                        <td><a href="#">{{$role->name}}</a></td>

                                                        <td>
                                                            <div class="row ml-1">
                                                                <a href="<?= route('roles.show', ['role' => base64_encode($role->id)]) ?>" class="btn btn-primary btn-sm mr-1"><i class="fa fa-list"></i></a>

                                                                <a href="<?= route('roles.edit', ['role' => base64_encode($role->id)]) ?>" class="btn btn-warning btn-action btn-sm mr-1" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                                                @if($role->name != 'Admin')
                                                                <form action="{{route('roles.destroy',['role' => base64_encode($role->id)])}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-action btn-sm mr-1 trigger--fire-modal-1" data-toggle="tooltip" title="" onclick="return confirm('Apakah anda yakin ingin hapus ?')"><i class="fa fa-trash"></i></button>
                                                                </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $num += 1; ?>
                                                    @endforeach
                                                <tbody>
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


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#myroles').DataTable();
        });
    </script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
    @include('dashboards/users/layouts/footer')

    </html>