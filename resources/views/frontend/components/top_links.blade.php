<ul class="list-unstyled mt-4 mt-lg-0">
    @guest()
        <li>
            <a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
        </li>
        <li>
            <a href="{{ route('register') }}"><i class="bi bi-person-fill-add"></i> Register</a>
        </li>
    @endguest

    @auth()
        <li>
            <div class="dropdown">
                <a class="btn btn-danger dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a
                        class="dropdown-item"
                        href="{{ route('logout') }}"
                        onclick="$('#logout-form').submit();return false;"
                        {{-- The #logout-form is rendered in /resources/views/layouts/frontend.blade.php --}}
                    >
                        <i class="bi bi-box-arrow-in-left"></i> Sign out
                    </a>
                </div>
            </div>
        </li>
    @endauth
</ul>
