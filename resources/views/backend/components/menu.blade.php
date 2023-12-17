<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">

        <div class="app-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('backend/images/logo.png') }}" alt="Mono">
                <span class="brand-name">The Newsroom</span>
            </a>
        </div>

        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-briefcase-account-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
