<?php

use Illuminate\Support\Str;

?>
@include('dashboards/users/layouts/script')

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('dashboards/users/layouts/navbar')
      @include('dashboards/users/layouts/sidebar')



      <div id="content-page" class="content-page">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                    <h4 class="card-title">Tambah User</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="card" style="width: 28rem;">
                    <form class="form-horizontal" method="post" action="{{ url('/user/create') }}">
                      @csrf
                      <div class="form-group">
                        <label>Nama User</label>
                        <input name="name" id="name" type="text" class="form-control">

                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input name="email" id="email" type="email" class="form-control">

                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input name="password" id="password" type="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select class="js-example-basic-multiple" name="role[]" id="role[]" multiple="multiple" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                          @foreach($role as $role)
                          <option value="{{$role->id}}">{{$role->name}}</option>
                          @endforeach
                        </select>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Unit</label>
                        <select name="id_unit" id="id_unit" class="form-control">
                          @foreach($unit as $unit)
                          <option value="{{$unit->id}}">{{$unit->nama_unit}}</option>
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

        </div>
      </div>
      @include('dashboards/users/layouts/footer')
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script>
        $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
        });
      </script>
</body>

</html>