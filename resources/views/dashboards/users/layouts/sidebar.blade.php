<div class="iq-sidebar">
    <div class="iq-navbar-logo d-flex justify-content-between">
        <a href="{{ route('home') }}" class="header-logo">
            <img src="{{ asset('findash/assets/images/logosv.png') }}" class="img-fluid rounded" alt="">
        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-menu-line"></i></div>
                <div class="hover-circle"><i class="ri-menu-line"></i></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class=" iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                {{-- DASHBOARD --}}
                {{-- @can('dashboard') --}}
                    <li class="{{ Request::is('home', 'admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="iq-waves-effect custom-tooltip">
                            <span class="ripple rippleEffect"></span>
                            <i class="las la-home iq-arrow-left" data-toggle="tooltip" data-placement="right"
                                title="Dashboard"></i><span>Dashboard
                                
                            </span>
                        </a>
                    </li>
                {{-- @endcan --}}

                {{-- MENU PERENCANAAN --}}
                <li
                    class="
                            {{ Request::is('monitoringUsulan', 'torab', 'validasi', 'detailtor', 'steppengajuantor') ? 'active' : '' }}">
                    <a href="#perencanaan" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="{{ Request::is('monitoringUsulan', 'torab', 'validasi', 'detailtor') ? 'true' : 'false' }}">
                        <span class="ripple rippleEffect"></span>
                        <i class="las la-clipboard iq-arrow-left" data-toggle="tooltip" data-placement="right"
                            title="Perencanaan"></i>
                        <span>Perencanaan</span>

                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                    </a>

                    <ul id="perencanaan"
                        class="iq-submenu {{ Request::is('monitoringUsulan', 'torab', 'validasi', 'detailtor', 'steppengajuantor') ? 'collapse show' : 'collapse' }}"
                        data-parent="#iq-sidebar-toggle">
                        {{-- @can('ajuan_monitoringUsulan')
                            <li class="sub-menu-perencanaan {{ Request::is('monitoringUsulan') ? 'active' : '' }}">
                                <a href="{{ url('/monitoringUsulan') }}">
                                    <i class="las la-chalkboard" data-toggle="tooltip" data-placement="right"
                                        title="Monitoring Usulan"></i>Monitoring Usulan</a>
                            </li>
                        @endcan
                        @can('ajuan_monitoringIKU')
                            <li class="sub-menu-perencanaan {{ Request::is('monitoringIKU') ? 'active' : '' }}">
                                <a href="{{ url('/monitoringIKU') }}">
                                    <i class="las la-chalkboard" data-toggle="tooltip" data-placement="right"
                                        title="Monitoring IKU"></i>Monitoring IKU</a>
                            </li>
                        @endcan --}}
                        @can('ajuan_torrab')
                            <li
                                class="sub-menu-perencanaan {{ Request::is('torab', 'steppengajuantor', 'lengkapitor') ? 'active' : '' }}">
                                <a href="{{ url('/torab') }}">
                                    <i class="las la-file-alt" data-toggle="tooltip" data-placement="right"
                                        title="TOR & RAB"></i>TOR & RAB</a>
                            </li>
                        @endcan
                        @can('ajuan_validasi')
                            <li class="sub-menu-perencanaan {{ Request::is('validasi') ? 'active' : '' }}">
                                <a href="{{ url('/validasi') }}">
                                    <i class="las la-stamp" data-toggle="tooltip" data-placement="right"
                                        title="Validasi"></i>Validasi TOR & RAB</a>
                            </li>
                        @endcan
                    </ul>
                </li>

                {{-- MENU KEUANGAN --}}
                {{-- <li
                    class="{{ Request::is('memo_cair', 'persekot_kerja', 'spj', 'lpj', 'monitoring_kak', 'upload_spj') ? 'active' : '' }}">
                    <a href="#keuangan" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="{{ Request::is('memo_cair', 'persekot_kerja', 'spj', 'lpj', 'monitoring_kak', 'upload_spj') ? 'true' : 'false' }}">
                        <span class="ripple rippleEffect"></span>
                        <i class="las la-money-bill iq-arrow-left" data-toggle="tooltip" data-placement="right"
                            title="Keuangan"></i><span>Keuangan
                            
                        </span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                    </a>
                    <ul id="keuangan"
                        class="iq-submenu {{ Request::is('memo_cair', 'persekot_kerja', 'spj', 'lpj', 'monitoring_kak', 'upload_spj') ? 'collapse show' : 'collapse' }}"
                        data-parent="#iq-sidebar-toggle">
                        @can('keu_memocair')
                            <li class="{{ Request::is('memo_cair') ? 'active' : '' }}">
                                <a href="{{ url('/memo_cair') }}">
                                    <i class="las la-money-check-alt" data-toggle="tooltip" data-placement="right"
                                        title="Memo Cair"></i>Memo Cair</a>
                            </li>
                        @endcan
                        @can('keu_persekot')
                            <li class="{{ Request::is('persekot_kerja') ? 'active' : '' }}">
                                <a href=" {{ url('/persekot_kerja') }}">
                                    <i class="las la-edit" data-toggle="tooltip" data-placement="right"
                                        title="Persekot Kerja"></i>Persekot Kerja</a>
                            </li>
                        @endcan
                        @can('keu_spj')
                            <li class="{{ Request::is('spj', 'upload_spj') ? 'active' : '' }}">
                                <a href=" {{ url('/spj') }}">
                                    <i class="las la-plus-circle" data-toggle="tooltip" data-placement="right"
                                        title="SPJ"></i>SPJ</a>
                            </li>
                        @endcan
                        @can('keu_lpj')
                            <li class="{{ Request::is('lpj') ? 'active' : '' }}">
                                <a href="{{ url('/lpj') }}">
                                    <i class="las la-file-upload" data-toggle="tooltip" data-placement="right"
                                        title="LPJ"></i>LPJ</a>
                            </li>
                        @endcan
                        @can('keu_monitoring')
                            <li class="{{ Request::is('monitoring_kak') ? 'active' : '' }}">
                                <a href="{{ url('/monitoring_kak') }}">
                                    <i class="las la-chalkboard" data-toggle="tooltip" data-placement="right"
                                        title="Monitoring Rekapitulasi"></i></i>Monitoring Rekapitulasi</a>
                            </li>
                        @endcan
                    </ul>
                </li> --}}

                {{-- <?php
                        foreach ($role as $roles) {
                            if ($roles->id == Auth::user()->role) {
                                $RoleLogin = $roles->name;
                            }
                        }

                        if ($RoleLogin === 'Admin' || $RoleLogin === 'BPU' || $RoleLogin === 'Staf Keuangan' || $RoleLogin === 'Staf Perencanaan') {
                        ?> --}}

                <li
                    class="{{ Request::is('pedomans', 'spj_kategori', 'spj_subkategori', 'tahun', 'triwulan', 'unit', 'pagu', 'mak', 'iku', 'roles', 'user') ? 'active' : '' }}">
                    <a href="#pengaturan" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="{{ Request::is('tahun', 'triwulan', 'unit', 'pagu', 'mak', 'iku', 'roles', 'user') ? 'true' : 'false' }}">
                        <span class="ripple rippleEffect"></span>
                        <i class="las la-cog iq-arrow-left" data-toggle="tooltip" data-placement="right"
                            title="Pengaturan"></i><span>Pengaturan</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                    </a>
                    <ul id="pengaturan"
                        class="iq-submenu {{ Request::is('pedomans', 'spj_kategori', 'spj_subkategori', 'tahun', 'triwulan', 'unit', 'pagu', 'mak', 'iku', 'roles', 'user') ? 'collapse show' : 'collapse' }}"
                        data-parent="#iq-sidebar-toggle">
                        @can('pic_show')
                            <li class="{{ Request::is('pic') ? 'active' : '' }}">
                                <a href="{{ url('/pic') }}"><i class="las la-stream" data-toggle="tooltip"
                                        data-placement="right" title="PIC"></i>PIC
                                    
                                </a>
                            </li>
                        @endcan
                        {{-- @can('kaprodi_show')
                            <li class="{{ Request::is('kaprodi') ? 'active' : '' }}">
                                <a href="{{ url('/kaprodi') }}"><i class="las la-stream" data-toggle="tooltip"
                                        data-placement="right" title="Kaprodi"></i>Kaprodi
                                    
                                </a>
                            </li>
                        @endcan --}}
                        @can('spjkategori_show')
                            <li class="{{ Request::is('spj_kategori') ? 'active' : '' }}">
                                <a href="{{ url('/spj_kategori') }}"><i class="las la-stream" data-toggle="tooltip"
                                        data-placement="right" title="SPJ Kategori"></i>SPJ Kategori
                                    
                                </a>
                            </li>
                        @endcan
                        @can('spjsubkategori_show')
                            <li class="{{ Request::is('spj_subkategori') ? 'active' : '' }}">
                                <a href="{{ url('/spj_subkategori') }}"><i class="las la-stream" data-toggle="tooltip"
                                        data-placement="right" title="SPJ Sub-Kategori"></i>SPJ Sub-Kategori
                                    
                                </a>
                            </li>
                        @endcan
                        @can('pedoman_show')
                            <li class="{{ Request::is('pedomans') ? 'active' : '' }}">
                                <a href="{{ url('/pedomans') }}"><i class="las la-folder" data-toggle="tooltip"
                                        data-placement="right" title="Pedoman"></i>Pedoman
                                    
                                </a>
                            </li>
                        @endcan
                        @can('tahun_show')
                            <li class="{{ Request::is('tahun') ? 'active' : '' }}">
                                <a href="{{ url('/tahun') }}"><i class="las la-calendar-check" data-toggle="tooltip"
                                        data-placement="right" title="Tahun"></i>Tahun
                                    
                                </a>
                            </li>
                        @endcan
                        @can('triwulan_show')
                            <li class="{{ Request::is('triwulan') ? 'active' : '' }}">
                                <a href="{{ url('/triwulan') }}"><i class="las la-hourglass-start" data-toggle="tooltip"
                                        data-placement="right" title="Triwulan"></i>Triwulan
                                    
                                </a>
                            </li>
                        @endcan
                        @can('unit_show')
                            <li class="{{ Request::is('unit') ? 'active' : '' }}">
                                <a href="{{ url('/unit') }}"><i class="las la-university" data-toggle="tooltip"
                                        data-placement="right" title="Unit"></i>Unit
                                    
                                </a>
                            </li>
                        @endcan
                        @can('pagu_show')
                            <li class="{{ Request::is('pagu') ? 'active' : '' }}">
                                <a href="{{ url('/pagu') }}"><i class="las la-laptop-code" data-toggle="tooltip"
                                        data-placement="right" title="Pagu"></i>Pagu
                                    
                                </a>
                            </li>
                        @endcan
                        @can('mak_show')
                            <li class="{{ Request::is('mak') ? 'active' : '' }}">
                                <a href="{{ url('/mak') }}"><i class="las la-th-list" data-toggle="tooltip"
                                        data-placement="right" title="MAK"></i>MAK
                                    
                                </a>
                            </li>
                        @endcan
                        @can('iku_show')
                            <li class="{{ Request::is('iku') ? 'active' : '' }}">
                                <a href="{{ url('/iku') }}"><i class="las la-list" data-toggle="tooltip"
                                        data-placement="right" title="IKU"></i>IKU
                                    
                                </a>
                            </li>
                        @endcan
                        @can('role_show')
                            <li class="{{ Request::is('roles') ? 'active' : '' }}"><a href="{{ url('/roles') }}"><i
                                        class="las la-users" data-toggle="tooltip" data-placement="right"
                                        title="Roles"></i>Roles
                                    
                                </a></li>
                        @endcan
                        @can('user_show')
                            <li class="{{ Request::is('user') ? 'active' : '' }}">
                                <a href="{{ url('/user') }}"><i class="las la-user-tie" data-toggle="tooltip"
                                        data-placement="right" title="Users"></i>User
                                    
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                {{-- <?php } ?> --}}
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
