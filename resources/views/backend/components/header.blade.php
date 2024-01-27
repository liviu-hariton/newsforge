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
                        <span class="badge badge-xs rounded-circle">{{ auth()->user()->unreadNotifications()->count() }}</span>
                    </button>

                    <div class="dropdown-notify">
                        <header class="border-bottom py-2 px-4">
                            <h5>Notifications</h5>
                        </header>

                        <div data-simplebar style="height: 325px;">
                            @foreach($unread_notifications as $unread_notification)
                                @include('backend.components.header-notification', ['data' => $unread_notification])
                            @endforeach
                        </div>

                        <footer class="border-top dropdown-notify-footer">
                            <div class="d-flex justify-content-between align-items-center py-2 px-4">
                                <a href="#">view all notifications</a>
                            </div>
                        </footer>
                    </div>
                </li>

                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img
                            @if(auth()->user()->adminProfile->avatar)
                            src="{{ url('storage/'.auth()->user()->adminProfile->avatar) }}"
                            @else
                            src="https://placehold.co/100"
                            @endif
                            class="user-image rounded-circle"
                            alt="{{ auth()->user()->adminProfile->firstname }} {{ auth()->user()->adminProfile->lastname }}"
                        />
                        <span class="d-none d-lg-inline-block">{{ auth()->user()->adminProfile->firstname }} {{ auth()->user()->adminProfile->lastname }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        @foreach(adminUserProfileSections() as $profile_section_key=>$profile_section_properties)
                        <li>
                            <a
                                class="dropdown-link-item"
                                href="{{ route('admin.profile.'.$profile_section_key) }}"
                            >
                                {!! $profile_section_properties['icon'] !!}
                                <span class="nav-text">{{ $profile_section_properties['name'] }}</span>
                            </a>
                        </li>
                        @endforeach

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
