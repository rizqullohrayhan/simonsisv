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
                    <h4 class="card-title">UPDATE USER</h4><!-- <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a> -->
                  </div>
                </div>
                <div class="card-body">
                  <div class="card" style="width: 28rem;">
                    <form class="form-horizontal" method="post" action="{{ route('user.processUpdate',['user'=>$user]) }}">
                      @csrf
                      <div class="form-group">
                        <label>Nama User</label>
                        <input name="name" id="name" value="{{old('name',$user->name)}}" type=" text" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input name="email" id="email" value="{{old('email',$user->email)}}" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input name="password" id="password" value="{{old('password')}}" type="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select class="js-example-basic-multiple2" name="role[]" id="role" multiple="multiple" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;
                        min-height: 52px;">
                          <!-- @if(old('role',$roleSelected))
                        <option value="{{old('role',$roleSelected->id)}}" selected>{{old('role',$roleSelected->name)}} </option>
                        @endif -->
                          <?php
                          $myString = $user->multirole;
                          $myArray = [];
                          $myArray = explode(',', $myString);
                          print_r($myArray);
                          ?>
                          @foreach($role as $role)
                          <option style="height: 42px;" value="{{$role->id}}" {{in_array($role->id , $myArray) ? 'selected' : ''}}>{{$role->name}} </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Unit</label>
                        <select class="js-example-basic-multiple3" name="id_unit" id="id_unit" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1;">
                          @foreach($unit as $unit)
                          <option value="{{$unit->id}}" {{$unit->id == $user->id_unit ? 'selected' : ''}}>{{$unit->nama_unit}}</option>
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

        <footer class="main-footer">
          <div class="footer-left">
            <!-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> -->
          </div>
          <div class="footer-right">
            <!-- 2.3.0 -->
          </div>
        </footer>
      </div>
    </div>

</body>
@include('dashboards/users/layouts/footer')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple2').select2();
  });
  $(document).ready(function() {
    $('.js-example-basic-multiple3').select2();
  });
</script>

</html>