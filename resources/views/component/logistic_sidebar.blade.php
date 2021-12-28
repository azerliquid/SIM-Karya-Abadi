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
                <li class="app-sidebar__heading">Logistik</li>
                <li>
                    <a href="/barang">
                        <i class="metismenu-icon pe-7s-tools"></i>
                        Barang
                    </a>
                </li>
                <li>
                    <a href="/baranginout">
                        <i class="metismenu-icon pe-7s-refresh-2"></i>
                        Keluar Masuk Barang
                    </a>
                </li>
                <li>
                    <a href="/listrequest">
                        <i class="metismenu-icon pe-7s-download"></i>
                        Permintaan Barang
                    </a>
                </li>
                <form method="POST" action="{{ route('logout') }}">
                <li>
                                @csrf
                    <a href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <i class="metismenu-icon pe-7s-back"></i>
                        Logout
                    </a>
                </li>
                </form>
            </ul>
        </div>
    </div>
</div>   