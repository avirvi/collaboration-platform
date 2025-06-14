<div class="navbar navbar-expand-sm shadow-sm bg-light border sticky-top">
    @auth
        <ul class="navbar-nav">
            <li>
                <a href="{{ route('dashboard.index') }}" class="nav-link">Dashboard</a>
            </li>

            @can('create', App\Models\Project::class)
                <li>
                    <a href="{{ route('projects.create') }}" class="nav-link">New Project</a>
                </li>
            @endcan
        </ul>
    @endauth

    <ul class="navbar-nav ms-auto">
        @guest
            <li>
                <a href="{{ route('login') }}" class="nav-link flex-sm-right">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            </li>
        @endguest

        @auth
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn nav-link bg-transparent">
                        Logout (Logged in as {{ auth()->user()->username }})
                    </button>
                </form>
            </li>
        @endauth
    </ul>
</div>
