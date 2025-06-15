<div class="navbar navbar-expand-sm shadow-sm bg-light border sticky-top">
    @guest
        <a href="{{ route('home') }}" class="nav-link">{{__('messages.Main_page')}}</a>
    @endguest
    @auth
        <ul class="navbar-nav">
            <li>
                <a href="{{ route('dashboard.index') }}" class="nav-link">{{__('messages.Dashboard')}}</a>
            </li>

            @can('create', App\Models\Project::class)
                <li>
                    <a href="{{ route('projects.create') }}" class="nav-link">{{__('messages.New_project')}}</a>
                </li>
            @endcan
        </ul>
    @endauth

    <ul class="navbar-nav">
        <li>
            <a class="nav-link" href="{{ url('lang/lv') }}">LV</a>
        </li>
        <li>
            <a class="nav-link" href="{{ url('lang/en') }}">EN</a>
        </li>
    </ul>

    <ul class="navbar-nav ms-auto">
        @guest
            <li>
                <a href="{{ route('login') }}" class="nav-link flex-sm-right">{{__('auth.Login')}}</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="nav-link">{{__('auth.Register')}}</a>
            </li>
        @endguest

        @auth
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn nav-link bg-transparent">
                        {{__('auth.Logout')}}
                    </button>
                </form>
            </li>
        @endauth
    </ul>
</div>
