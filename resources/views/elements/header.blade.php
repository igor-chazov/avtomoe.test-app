<header class="header">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            @if(Request::is('/'))
                <span class="navbar-brand d-flex align-items-center justify-content-center me-5">
                    <img src="{{ Vite::asset('resources/img/pic_2.png') }}" class="me-3" width="40" height="40" alt="pic_2.png">
                    {{ config('app.name', 'Laravel') }}
                </span>
            @else
                <a class="navbar-brand d-flex align-items-center justify-content-center me-5" href="{{ url('/') }}">
                    <img src="{{ Vite::asset('resources/img/pic_2.png') }}" class="me-3" width="40" height="40" alt="pic_2.png">
                    {{ config('app.name', 'Laravel') }}
                </a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @if(Request::is('/'))
                                <span class="nav-link active" aria-current="page">{{ __('page.home') }}</span>
                            @else
                                <a class="nav-link active" aria-current="page"
                                   href="{{ route('home') }}">{{ __('page.home') }}</a>
                            @endif
                        </li>
                        @auth
{{--                            <li class="nav-item">--}}
{{--                                @if(Request::is('events'))--}}
{{--                                    <span class="nav-link" aria-current="page">{{ __('page.events') }}</span>--}}
{{--                                @else--}}
{{--                                    <a class="nav-link" aria-current="page" href="{{ route('events') }}">{{ __('page.events') }}</a>--}}
{{--                                @endif--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                @if(Request::is('admin'))--}}
{{--                                    <span class="nav-link" aria-current="page">{{ __('page.dashboard') }}</span>--}}
{{--                                @else--}}
{{--                                    <a class="nav-link" aria-current="page" href="{{ route('admin.home') }}">{{ __('page.dashboard') }}</a>--}}
{{--                                @endif--}}
{{--                            </li>--}}
                        @endauth
                    </ul>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('auth.sign_in') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('auth.sign_up') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('auth.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
