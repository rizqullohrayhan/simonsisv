<?php

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

?>
<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-menu-line"></i></div>
                    <div class="hover-circle"><i class="ri-close-fill"></i></div>
                </div>
                <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <img src="{{ asset('findash/assets/images/logo.png') }}" class="img-fluid rounded" alt="">
                    </a>
                </div>
            </div>
            <ul class="navbar-nav ml-auto navbar-list">
                <li class="line-height">
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        {{-- <?php if (empty(Auth::user()->image) || Auth::user()->image == 'NULL') { ?>
                            <img src="{{ asset('findash/assets/images/user/1.jpg') }}" class="img-fluid rounded me-3" alt="user">
                        <?php } elseif (!empty(Auth::user()->image || Auth::user()->image != 'NULL')) { ?>
                            <img src="{{ asset('imageprofil/'.Auth::user()->image) }}" class="img-fluid rounded me-3" alt="user">
                        <?php } ?> --}} 
                        <div class="caption">
                            <?php if (!empty(Auth::user()->name)) { ?>
                                <h6 class="mb-0 line-height" style="color:white"><?= Auth::user()->name ?></h6>
                            <?php } ?>
                            <p class="mb-0 text" style="color:white">
                                <?= !empty(Auth::user()->getroleNames()) ? Auth::user()->getroleNames() : '' ?> <br />
                                {{Auth::user()->unit->nama_unit}}
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
                                        <div class="rounded iq-card-icon bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ms-3 col">
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
                                                                    {{ $r3->name}} <i class="ri-login-box-line ms-2">
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
                                        <div class="rounded iq-card-icon bg-primary">
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
                                        <div class="rounded iq-card-icon bg-primary">
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
                                        <i class="ri-login-box-line ms-2">
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
