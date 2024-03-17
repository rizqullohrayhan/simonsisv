@include('dashboards/users/layouts/script')


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
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">TAMBAH ROLE</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="container ml-5">
                                    <!-- <div class="row align-items-start">
                                        <div class="col">
                                            One of three columns
                                        </div>
                                        <div class="col">
                                            One of three columns
                                        </div>
                                        <div class="col">
                                            One of three columns
                                        </div>
                                    </div> -->
                                </div>
                                <!-- <p>Use flexbox alignment utilities to vertically and horizontally align columns. <strong>Internet Explorer 10-11 do not support vertical alignment of flex items when the flex container has a <code>min-height</code> as shown below.</strong> <a href="https://github.com/philipwalton/flexbugs#flexbug-3">See Flexbugs #3 for more details.</a></p> -->
                                <!-- <h4 class="mb-3">Vertical alignment</h4> -->
                                <form method="POST" action="{{url('/roles_store')}}">
                                    @csrf
                                    <div class="row align-items-start">
                                        <div class="row ml-5">
                                            <div class="form-group">
                                                <h5><label for="name">Nama Aktor</label></h4>
                                                    <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" />
                                                    @error('name')
                                                    <span>
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                        function checkAll(ele, p) {
                                            // alert('form-check-input' + p);
                                            var checkboxes = document.getElementsByClassName('form-check-input ' + p);
                                            if (ele.checked) {
                                                for (var i = 0; i < checkboxes.length; i++) {
                                                    if (checkboxes[i].type == 'checkbox') {
                                                        checkboxes[i].checked = true;
                                                    }
                                                }
                                            } else {
                                                for (var i = 0; i < checkboxes.length; i++) {
                                                    if (checkboxes[i].type == 'checkbox') {
                                                        checkboxes[i].checked = false;
                                                    }
                                                }
                                            }
                                        }
                                    </script>

                                    <div class="row align-items-start">
                                        <?php $m = 1; ?>
                                        @foreach($authorities as $manageName => $permissions)
                                        <div class="col lg-4">
                                            <div class="card h-120">
                                                <div class="card-body">
                                                    <h5 class="card-title"> {{$manageName}}</h5>
                                                    <p class="card-text">

                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" onchange="checkAll(this,<?php echo $m ?>)" name="chk[]">
                                                        <label class="form-check-label">
                                                            Select All
                                                        </label>
                                                    </div>

                                                    @foreach($permissions as $p)
                                                    <div class="form-check">
                                                        @if(old('permissions'))
                                                        <input id="{{$p}}" name="permissions[]" class="form-check-input {{$m}}" type="checkbox" value="{{$p}}" {{in_array($p,old('permissions')) ? "checked" : null}}>
                                                        @else
                                                        <input id="{{$p}}" name="permissions[]" class="form-check-input {{$m}}" type="checkbox" value="{{$p}}">
                                                        @endif
                                                        <label class="form-check-label" for="{{$p}}">
                                                            {{trans("permissions.{$p}")}}
                                                            <!-- {{$p}} -->
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $m += 1; ?>
                                        @endforeach
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
@include('dashboards/users/layouts/footer')