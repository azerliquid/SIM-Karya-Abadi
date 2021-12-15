<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">HR</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-server"></i>
                        Data Master
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('tenagakerja.index')}}">
                                <i class="metismenu-icon">
                                </i>Tenaga Kerja
                            </a>
                        </li>
                        <li>
                            <a href="{{route('proyek.index')}}">
                                <i class="metismenu-icon">
                                </i>Proyek
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Logistik</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-tools"></i>
                        Barang
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>                    
                        <li>
                            <a href="{{route('barang.index')}}">
                                <i class="metismenu-icon pe-7s-tools" ></i>
                                Barang
                            </a>
                        </li>
                        <li>
                            <a href="{{route('baranginout.index')}}">
                                <i class="metismenu-icon">
                                </i>Keluar Masuk Barang
                            </a>
                        </li>
                        <li>
                            <a href="{{route('baranginout.index')}}">
                                <i class="metismenu-icon">
                                </i>Request Permintaan Bahan
                            </a>
                        </li>
                    </ul>
                </li>
                <li  >
                    <a href="tables-regular.html">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Tables
                    </a>
                </li>
                <li class="app-sidebar__heading">Pengadaan Bahan Bangunan</li>
                <li>
                    <a href="{{ route('request.index')}}">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Request
                    </a>
                </li>
                <li>
                    <a href="dashboard-boxes.html">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Riwayat Permintaan
                    </a>
                </li>
                <li class="app-sidebar__heading">Forms</li>
                <li>
                    <a href="forms-controls.html">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Forms Controls
                    </a>
                </li>
                <li>
                    <a href="forms-layouts.html">
                        <i class="metismenu-icon pe-7s-eyedropper">
                        </i>Forms Layouts
                    </a>
                </li>
                <li>
                    <a href="forms-validation.html">
                        <i class="metismenu-icon pe-7s-pendrive">
                        </i>Forms Validation
                    </a>
                </li>
                <li class="app-sidebar__heading">Charts</li>
                <li>
                    <a href="charts-chartjs.html">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>ChartJS
                    </a>
                </li>
                <li class="app-sidebar__heading">PRO Version</li>
                <li>
                    <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>
                        Upgrade to PRO
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>   