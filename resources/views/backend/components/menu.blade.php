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

                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#news" href="javascript:void(0)" data-toggle="collapse">
                        <i class="bi bi-newspaper"></i>
                        <span class="nav-text">The news</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="news" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Articles</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Comments</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Categories</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Media center</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Authors</span></a></li>
                        </div>
                    </ul>
                </li>
                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#extra" href="javascript:void(0)" data-toggle="collapse">
                        <i class="bi bi-braces-asterisk"></i>
                        <span class="nav-text">The extra</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="extra" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Events</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Polls</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Classifieds</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Jobs</span></a></li>
                        </div>
                    </ul>
                </li>
                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#ads" href="javascript:void(0)" data-toggle="collapse">
                        <i class="bi bi-bullseye"></i>
                        <span class="nav-text">Ads</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="ads" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Campaigns</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Clients</span></a></li>
                        </div>
                    </ul>
                </li>
                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#store" href="javascript:void(0)" data-toggle="collapse">
                        <i class="bi bi-cart2"></i>
                        <span class="nav-text">Store</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="store" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Subscriptions</span></a></li>
                            <li class="has-sub" >
                                <a class="sidenav-item-link" data-target="#catalogue" href="javascript:void(0)" data-toggle="collapse">
                                    <span class="nav-text">Merch</span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="collapse" id="catalogue">
                                    <div class="sub-menu">
                                        <li><a href="#">Orders</a></li>
                                        <li><a href="#">Products</a></li>
                                        <li><a href="#">Categories</a></li>
                                    </div>
                                </ul>
                            </li>
                        </div>
                    </ul>
                </li>

                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#content" href="javascript:void(0)" data-toggle="collapse">
                        <i class="bi bi-menu-button-wide"></i>
                        <span class="nav-text">Layout</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="content" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Article types</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Static pages</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">F.A.Q.</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Text blocks</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Pop-ups</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Menus</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Custom landing pages</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Themes</span></a></li>
                        </div>
                    </ul>
                </li>
                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#seo" href="javascript:void(0)" data-toggle="collapse">
                        <i class="fas fa-rocket"></i>
                        <span class="nav-text">SEO</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="seo" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Meta tags</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Social-media</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Tags</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">301</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">404</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Feeds</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Searches</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Third-party</span></a></li>
                        </div>
                    </ul>
                </li>

                <li>
                    <a class="sidenav-item-link" href="#">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </li>
                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#users" href="javascript:void(0)" data-toggle="collapse">
                        <i class="bi bi-person-lines-fill"></i>
                        <span class="nav-text">Users</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="users" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Accounts</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Roles</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Groups</span></a></li>
                        </div>
                    </ul>
                </li>
                <li>
                    <a class="sidenav-item-link" href="#">
                        <i class="bi bi-envelope"></i>
                        <span class="nav-text">Contacts</span>
                    </a>
                </li>

                <li>
                    <a class="sidenav-item-link" href="#">
                        <i class="bi bi-trash3-fill"></i>
                        <span class="nav-text">Trash</span>
                    </a>
                </li>

                <li class="section-title">Super admin</li>

                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#settings" href="javascript:void(0)" data-toggle="collapse">
                        <i class="fas fa-cogs"></i>
                        <span class="nav-text">Settings</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="settings" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">General</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">I18N</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">System emails</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Integrations</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">API</span></a></li>
                        </div>
                    </ul>
                </li>

                <li class="has-sub" >
                    <a class="sidenav-item-link" data-target="#logs" href="javascript:void(0)" data-toggle="collapse">
                        <i class="fas fa-history"></i>
                        <span class="nav-text">Logs</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="logs" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Actions</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Notifications</span></a></li>
                            <li><a class="sidenav-item-link" href="#"><span class="nav-text">Errors</span></a></li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</aside>
