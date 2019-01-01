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
        <a href="#" class="date_range" @click="showPeriodSelect = true">Period</a>
        <a href="{{route('vendor.index')}}">Vendor</a>
        <!-- Authentication Links -->
        @guest
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> @else
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endguest
    </div>
    <div>
        @if(Session::has('success_message'))
            {{ Session::get('success_message') }}
        @endif
        @if(Session::has('error_message'))
            {{ Session::get('error_message') }}
        @endif
        @if(Session::has('message'))
            {{ Session::get('message') }}
        @endif
    </div>
</nav>