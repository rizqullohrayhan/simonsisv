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
                                        <h4 class="card-title">DATA USER
                                        </h4>
                                    </div>
                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                        <!-- <a href="{{url('/user/create')}}" class="btn btn-primary">Tambah User</a> -->
                                        <button class="btn btn-primary" data-toggle="modal" title="Tambah User" data-original-title="Tambah User" data-target="#tambahuser">Tambah User</i>
                                        </button>
                                    </div>
                                    <!-- Modal Tambah user -->
                                    <div class="modal fade" role="dialog" id="tambahuser" style="overflow:hidden;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="post" action="{{ url('/user/create') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Nama User</label>
                                                            <input name="name" id="name" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIP</label>
                                                            <input name="nip" id="nip" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input name="email" id="email" type="email" class="form-control">
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label>Password</label>
                                                            <input name="password" id="password" type="password" class="form-control">
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select class="js-role-tambah" name="role[]" id="role[]" multiple="multiple" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                                                @foreach($role as $roletambah)
                                                                <option value="{{$roletambah->id}}">{{$roletambah->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Unit</label>
                                                            <select class="js-unit-tambah" name="id_unit" id="id_unit" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;">
                                                                @foreach($unit as $unittambah)
                                                                <option value="{{$unittambah->id}}">{{$unittambah->nama_unit}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <?php $i = 0 ?>
                                                        <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                        <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                    </form>
                                                </div>

                                            </div>
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
                                    <div class="table-responsive table-invoice">
                                        <table id="myusers" class="table table-striped table table-striped table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="5%">No.</th>
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>NIP</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Multirole</th>
                                                    <th>Unit</th>
                                                    <th width="8%">Status</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1; ?>
                                                @foreach($user as $u)
                                                <tr>
                                                    <td><a href="#">{{$num}}</a></td>
                                                    <td><img src="{{asset('imageprofil/'.$u->image)}}" class="avatar-35 rounded img-fluid"></img></td>
                                                    <td class="font-weight-600">{{$u->name}}</td>
                                                    <td class="font-weight-600">{{$u->nip}}</td>
                                                    <td class="font-weight-600">{{$u->email}}</td>
                                                    <?php foreach ($role as $roleindex) { ?>
                                                        <?php if ($u->role == $roleindex->id) { ?>
                                                            <td class="font-weight-600">{{$roleindex->name}}</td>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <td class="font-weight-600">
                                                        <?php
                                                        $myArray2 = (explode(',', $u->multirole));
                                                        ?>
                                                        <?php $var2 = 0;
                                                        $string = '';
                                                        foreach ($myArray2 as $tag2) {
                                                            foreach ($tabelRole as $r4) {
                                                                if ($r4->id == $tag2) {
                                                                    $string = $string . $r4->name . ", " ?>
                                                        <?php

                                                                }
                                                            }
                                                        }
                                                        $string2 = rtrim($string, ", ");
                                                        ?>
                                                        {{$string2}}
                                                    </td>

                                                    <td>
                                                        <?php foreach ($unit as $un) {
                                                            if ($un->id == $u->id_unit) { ?>
                                                                {{$un->nama_unit}}
                                                        <?php }
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                                            <div class="custom-switch-inner">
                                                                <!-- {{ Auth::user()->is_aktif }} -->
                                                                <!-- <p class="mb-0"> Success </p> -->
                                                                {{-- @if ($u->role == 1)
                                                                    <input data-id="{{$u->id}}" type="checkbox" class="custom-control-input bg-primary" data-on-label="On" id="customSwitch-22" checked="" disabled>
                                                                    <label class="custom-control-label" for="customSwitch-22" data-on-label="On" data-off-label="Off">
                                                                    </label>
                                                                @else --}}
                                                                    <input data-id="{{$u->id}}" type="checkbox" class="custom-control-input" data-on-label="On" data-off-label="Off" id="customSwitch-22{{$u -> id}}" {{ $u->is_aktif=='1' ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="customSwitch-22{{$u -> id}}" data-on-label="On" data-off-label="Off">
                                                                    </label>
                                                                {{-- @endif --}}
                                                                <!-- <input data-id="{{$u->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $u->is_aktif ? 'checked' : '' }}> -->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row ml-3">
                                                            <div class="flex align-items-center list-user-action">
                                                                <div class="row">
                                                                    <a href="{{route('user.detail',['user'=> base64_encode($u->id)])}}" class="iq-bg-primary"><i class="fa fa-list"></i></a>
                                                                    <?php if ($u->role != 1) { ?>
                                                                        <a class="iq-bg-warning" data-toggle="modal" data-placement="top" title="Update User" data-original-title="Update User" href="" data-target="#update_user<?= $u->id ?>"><i class="ri-pencil-line"></i></a>
                                                                        <!-- <a href="{{route('user.update',['user'=> base64_encode($u->id)])}}" class="iq-bg-primary" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ri-pencil-line"></i></a> -->
                                                                        <a href="{{route('user.delete',['user'=> base64_encode($u->id)])}}" class="iq-bg-danger" data-toggle="tooltip" title="" onclick="return confirm('Apakah anda yakin ingin hapus ?')"><i class="ri-delete-bin-line"></i></a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Modal Ubah User -->
                                                <div class="modal fade" role="dialog" id="update_user<?= $u->id ?>" style="overflow:hidden;">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Ubah User</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" method="post" action="{{ route('user.processUpdate',['user'=> $u->id]) }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>Nama User</label>
                                                                        <input name="name" id="name" value="{{old('name',$u->name)}}" type=" text" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>NIP</label>
                                                                        <input name="nip" id="nip" value="{{old('nip',$u->nip)}}" type="text" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input name="email" id="email" value="{{old('email',$u->email)}}" type="text" class="form-control">
                                                                    </div>
                                                                    <!-- <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input name="password" id="password" value="{{old('password')}}" type="password" class="form-control">
                                                                    </div> -->
                                                                    <div class="form-group">
                                                                        <label>Role</label>
                                                                        <select class="js-role-update" name="role[]" multiple="multiple" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;
                        min-height: 52px;">
                                                                            <?php
                                                                            $myString = $u->multirole;
                                                                            $myArray = [];
                                                                            $myArray = explode(',', $myString);
                                                                            print_r($myArray);
                                                                            ?>
                                                                            @foreach($role as $roleupdate)
                                                                            <option style="height: 42px;" value="{{$roleupdate->id}}" {{in_array($roleupdate->id , $myArray) ? 'selected' : ''}}>{{$roleupdate->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Unit</label>
                                                                        <select class="js-unit-update" name="id_unit" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;">
                                                                            @foreach($unit as $unit2)
                                                                            <option value="{{$unit2->id}}" {{$unit2->id == $u->id_unit ? 'selected' : ''}}>{{$unit2->nama_unit}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <?php $i = 0 ?>
                                                                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                                                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $num += 1; ?>
                                                @endforeach
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-role-tambah').select2();
        });
        $(document).ready(function() {
            $('.js-unit-tambah').select2();
        });
        $(document).ready(function() {
            $('.js-role-update').select2();
        });
        $(document).ready(function() {
            $('.js-unit-update').select2();
        });
    </script>
    <script>
        $(function() {
            $('.custom-control-input').change(function() {
                var is_aktif = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                console.log(is_aktif);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/user/isaktif',
                    data: {
                        'is_aktif': is_aktif,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#myusers').DataTable();
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