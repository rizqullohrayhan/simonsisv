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
                                    <h4 class="card-title">UPDATE ROLE</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form method="POST" action="{{route('roles.update',['role'=>$role])}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row ml-3">
                                        <div class="form-group">
                                            <h5> <label for="name"><b>Nama Aktor</b></label></h5>
                                            <input type="text" id="name" name="name" value="{{old('name',$role->name)}}" class="form-control @error('name') is-invalid @enderror" />
                                            @error('name')
                                            <span>
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php $m = 1; ?>
                                        @foreach($authorities as $manageName => $permissions)
                                        <div class="col lg-4">
                                            <div class="card">
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
                                                        @if(old('permissions',$permissionChecked))
                                                        <input id="{{$p}}" name="permissions[]" class="form-check-input {{$m}}" type="checkbox" value="{{$p}}" {{in_array($p,old('permissions',$permissionChecked)) ? "checked" : null}}>
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
                                        <!-- <a href="" class="btn btn-icon icon-left btn-primary"><i class="fa fa-sync-alt"></i> Save</a> -->
                                    </div>
                                    <br />
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
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
@include('dashboards/users/layouts/footer')