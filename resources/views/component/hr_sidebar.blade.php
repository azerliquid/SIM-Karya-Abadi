<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="">Karya Abadi</div>
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
                <!-- {{ Auth::user()}} -->

                    <li class="app-sidebar__heading">HR</li>
                    <li>
                        
                        <a href="#">
                            <i class="metismenu-icon pe-7s-server"></i>
                            Data Master
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="/hr/tenagakerja">
                                    <i class="metismenu-icon">
                                    </i>Tenaga Kerja
                                </a>
                            </li>
                            <li>
                                <a href="/hr/proyek">
                                    <i class="metismenu-icon">
                                    </i>Proyek
                                </a>
                            </li>
                        </ul>
                        
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