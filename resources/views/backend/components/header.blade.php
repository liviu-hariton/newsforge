<header class="main-header" id="header">
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>

        <span class="page-title">@yield('page-title')</span>

        <div class="navbar-right ">
            <div class="search-form">
                <form action="index.html" method="get">
                    <div class="input-group input-group-sm" id="input-group-search">
                        <input type="text" autocomplete="off" name="query" id="search-input" class="form-control"
                               placeholder="Search..."/>
                        <div class="input-group-append">
                            <button class="btn" type="button">/</button>
                        </div>
                    </div>
                </form>
                <ul class="dropdown-menu dropdown-menu-search">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Morbi leo risus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Dapibus ac facilisis in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Porta ac consectetur ac</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Vestibulum at eros</a>
                    </li>
                </ul>
            </div>

            <ul class="nav navbar-nav">
                <li class="custom-dropdown">
                    <button class="notify-toggler custom-dropdown-toggler">
                        <i class="mdi mdi-bell-outline icon"></i>
                        <span class="badge badge-xs rounded-circle">21</span>
                    </button>
                </li>

                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ asset('backend/images/user/user-xs-01.jpg') }}" class="user-image rounded-circle"
                             alt="User Image"/>
                        <span class="d-none d-lg-inline-block">John Doe</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a class="dropdown-link-item" href="user-profile.html">
                                <i class="mdi mdi-account-outline"></i>
                                <span class="nav-text">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-link-item" href="email-inbox.html">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="nav-text">Message</span>
                                <span class="badge badge-pill badge-primary">24</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-link-item" href="user-activities.html">
                                <i class="mdi mdi-diamond-stone"></i>
                                <span class="nav-text">Activitise</span></a>
                        </li>
                        <li>
                            <a class="dropdown-link-item" href="user-account-settings.html">
                                <i class="mdi mdi-settings"></i>
                                <span class="nav-text">Account Setting</span>
                            </a>
                        </li>

                        <li class="dropdown-footer">
                            <a
                                class="dropdown-link-item prevent-default"
                                href="{{ route('admin.logout') }}"
                                onclick="$('#logout-form').submit();"
                                {{-- The #logout-form is rendered in /resources/views/layouts/backend.blade.php --}}
                            >
                                <i class="mdi mdi-logout"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
