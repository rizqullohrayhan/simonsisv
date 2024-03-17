<?php

use Illuminate\Support\Facades\Auth;
?>

<!-- N A V B A R   V A L I D A S I   U N T U K   B P U  /  W A K I L  D E K A N -->
<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-menu-line"></i></div>
                    <div class="hover-circle"><i class="ri-close-fill"></i></div>
                </div>
                <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                    <a href="{{ route('home') }}" class="header-logo">
                        <img src="{{ asset('findash/assets/images/logo.png') }}" class="img-fluid rounded" alt="">
                    </a>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="navbar-collapse collapse show" id="navbarSupportedContent" style="">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item nav-icon">
                        <a href="#" class="">


                        </a>
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">Pengajuan TOR<small class="badge  badge-light float-right pt-1">..</small></h5>
                                    </div>
                                    <a href="/validasi/ajuan/$unit[$u1]->id" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <!-- <h6 class="mb-0 "> KAK1</h6> -->
                                                <small class="float-right font-size-12"></small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <?php
            $jumlahpengajuan = 0;
            if (!empty($notifikasi)) {  ?>
                <?php if ($notifikasi == 1) {  ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-list">
                            <li class="nav-item nav-icon">
                                <a href="#" class="search-toggle iq-waves-effect bg-info rounded">
                                    <i class="ri-notification-line"></i>
                                    <span class="bg-danger dots"></span>
                                </a>
                                <div class="iq-sub-dropdown scrollable">
                                    <div class="iq-card shadow-none m-0">
                                        <div class="iq-card-body p-0 scroll-card">
                                            <div class="bg-primary p-3">
                                                <h5 class="mb-0 text-white">Notifikasi Pengajuan Kegiatan<small class="badge  badge-light float-right pt-1"></small></h5>
                                            </div>
                                            <?php
                                            $idtor = 0;
                                            $simpanTor = [
                                                $idtor => []
                                            ];
                                            $i = 0;
                                            $simpanId = [];
                                            $length = 0;
                                            $count = 0; //hitung total tor yang blm
                                            foreach ($trx_status_tor as $tstor) {
                                                foreach ($status as $sts) {
                                                    if ($sts->nama_status == "Proses Pengajuan") {
                                                        $simpanId[$i] = $tstor->id_tor;
                                            ?>

                                            <?php
                                                        $i += 1;
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            $clear_array = array_unique($simpanId);
                                            ?>
                                            <?php
                                            $trxStatusTor = [];
                                            $i2 = 0;
                                            foreach ($clear_array as $s1) {
                                                // echo "Trx status tor ";
                                                foreach ($trx_status_tor as $tstor2) {
                                                    if ($s1 == $tstor2->id_tor) {
                                                        $trxStatusTor[$i2] = $tstor2->id;
                                                        // echo  $trxStatusTor[$i2] . " ";
                                                        $i2 += 1;
                                                    }
                                                }
                                                foreach ($tor as $tor2) {
                                                    if ($s1 == $tor2->id) {
                                            ?>

                                                        <?php
                                                        $namastat = "";
                                                        $hitungNotif = 1;
                                                        foreach ($trx_status_tor as $tstor3) {
                                                            if ($trxStatusTor[$i2 - 1] == $tstor3->id) {
                                                                foreach ($user as $u) {
                                                                    foreach ($role as $r) {
                                                                        if ($u->role == $r->id) {
                                                                            if ($u->id == $tstor3->create_by) {
                                                                                foreach ($status as $sts3) {
                                                                                    if ($tstor3->id_status == $sts3->id) {
                                                                                        $namastat = $sts3->nama_status . " " . $tstor3->role_by;
                                                                                        if ($namastat != "Validasi WD 3") {
                                                                                            $count += 1;
                                                                                            if ($hitungNotif < 4) {
                                                        ?>
                                                                                                <a href="{{url('/detailtor/'.base64_encode($tor2->id))}}" class="iq-sub-card">
                                                                                                    <div class="media align-items-center">
                                                                                                        <div class="media-body">
                                                                                                            <h6><?php foreach ($unit as $unitTor) {
                                                                                                                    if ($tor2->id_unit == $unitTor->id) { ?>
                                                                                                                        <small class="badge badge-success">{{$unitTor->nama_unit}}</small>
                                                                                                                <?php }
                                                                                                                } ?>
                                                                                                                {{$tor2->nama_kegiatan." "}}
                                                                                                            </h6>
                                                                                                            @if($sts3->nama_status != 'Verifikasi Kaprodi')
                                                                                                            <small class="badge badge-warning">{{$sts3->nama_status." ".$tstor3->role_by}}</small>
                                                                                                            @endif
                                                                                                            @if($sts3->nama_status == 'Verifikasi Kaprodi')
                                                                                                            <small class="badge badge-warning">{{$sts3->nama_status}}</small>
                                                                                                            @endif
                                                                                                            <small class="float-right font-size-12">{{$tstor3->created_at}}</small>
                                                                                                            <p class="mb-0">
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </a>
                                                        <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                                $hitungNotif += 1;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        } ?>

                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            // echo $hitungNotif;
                                            if ($hitungNotif > 3) { ?>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php  } ?>
            <?php  } ?>
            <ul class="navbar-nav ml-auto navbar-list">
                <li class="line-height">
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <?php if (empty(Auth::user()->image) || Auth::user()->image == 'NULL') { ?>
                            <img src="{{ asset('findash/assets/images/user/1.jpg') }}" class="img-fluid rounded mr-3" alt="user">
                        <?php } ?>
                        <?php if (!empty(Auth::user()->image)) { ?>
                            <img src="{{ asset('imageprofil/'.Auth::user()->image) }}" class="img-fluid rounded mr-3" alt="user">
                        <?php } ?>
                        <div class="caption">
                            <?php if (!empty(Auth::user()->name)) { ?>
                                <h6 class="mb-0 line-height" style="color:white"><?= Auth::user()->name ?></h6>
                            <?php } ?>
                            <p class="mb-0 text" style="color:white">
                                <?= !empty(Auth::user()->getroleNames()) ? Auth::user()->getroleNames() : '' ?> <br />
                                <?php
                                if (!empty($unit)) {
                                    for ($u = 0; $u < count($unit); $u++) {
                                        if ($unit[$u]->id == Auth::user()->id_unit) {
                                            echo $unit[$u]->nama_unit;
                                        }
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 scroll-card">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello <?= Auth::user()->name ?></h5>
                                    <span class="text-white font-size-12">Available</span>
                                </div>
                                <div class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Change Role</h6>
                                            <p class="mb-0 font-size-12">
                                                <?php
                                                $myArray = (explode(',', Auth()->user()->multirole));
                                                // print_r($myArray[0]);
                                                ?>
                                                <?php $var = 0;
                                                foreach ($myArray as $tag) {
                                                    foreach ($tabelRole as $r3) {
                                                        if ($r3->id == $tag) { ?>
                                            <form class="form-horizontal" method="post" action="{{ url('/pergantian') }}">
                                                {{csrf_field()}}
                                                <button class="btn mb-1 {{Auth()->user()->role == $r3->id ? 'bg-success disabled' : 'bg-secondary'}} " style="color: white;" type="submit">
                                                    {{ $r3->name}} <i class="ri-login-box-line ml-2">
                                                    </i>
                                                    <input type="text" name="pilihrole" id="pilihrole" value="{{$r3->id}}" style="display:none;">
                                                </button>
                                            </form>
                                <?php }
                                                    }
                                                } ?>
                                </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url('/profil') }}" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">My Profile</h6>
                                            <p class="mb-0 font-size-12">View personal profile details.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ url('/profil') }}" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-profile-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Edit Profile</h6>
                                            <p class="mb-0 font-size-12">Modify your personal details.</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" role="button">{{ __('Logout') }}
                                        <i class="ri-login-box-line ml-2">
                                        </i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>