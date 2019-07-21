<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            @guest
            {{ config('app.name', 'Laravel') }}
            @endguest
            @auth
                Dashboard
            @endauth
        </a>
        @guest
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> 
        @else
        <a href="#" class="date_range" @click="showPeriodSelect = true">Period</a>
        <a href="{{route('vendor.index')}}">Vendor</a>
        <a href="{{route('scheduled.index')}}">Scheduled</a>

        <!-- Authentication Links -->
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endguest
    </div>
</nav>