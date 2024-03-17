@include('dashboards/users/layouts/script')

<body>
    <div class="wrapper">
        @include('dashboards/users/layouts/navbar')
        @include('dashboards/users/layouts/sidebar')

        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">DETAIL PERMISSION {{$role->name}}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form method="POST" action="">
                                    <div class="row">
                                        @foreach($authorities as $manageName => $permissions)
                                        <div class="col lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title"> {{$manageName}}</h5>
                                                    <p class="card-text">
                                                        @foreach($permissions as $p)
                                                    <div class="form-check">
                                                        <input id="{{$p}}" class="form-check-input" type="checkbox" value="{{$p}}" onclick="return false;" {{in_array($p,$rolePermissions) ? 'checked':null }} id="flexCheckChecked">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            {{trans("permissions.{$p}")}}
                                                            <!-- {{$p}} -->
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
@include('dashboards/users/layouts/footer')