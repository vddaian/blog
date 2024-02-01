<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/nav-style.css')}}">
    @stack('css')
</head>

<body>
    <nav class="navBlock">
        <ul class="navElementsList">
            <li><a href="{{ route('posts.index') }}">{{ __('Home') }}</a></li>

        </ul>
        <ul class="navElementsList">
            @auth
                @if (in_array(session('role'), ['writer', 'editor', 'admin']))
                    <li><a href="{{ route('posts.form') }}">{{ __('New Post') }}</a></li>
                @endif
                @if (session('role') == 'admin')
                    <li><a href="{{ route('admin.index') }}">{{ __('Manager') }}</a></li>
                @endif
                <li><a href="{{ route('profile.index', session('username')) }}">{{ __('Profile') }}</a></li>
            @endauth
        </ul>
        <ul class="navElementsList">
            <ul class="languageList">
                <li class="languageListElem">{{__('Languages')}}
                    <ul class="auxlanguageList">
                        <li><a href="{{route('locale', 'es')}}">{{__('Spanish')}}</a></li>
                        <li><a href="{{route('locale', 'en')}}">{{__('English')}}</a></li>
                    </ul>
                </li>
                
            </ul>
            @auth
                <li><a href="{{ route('logout') }}">{{ __('Logout') }}</a></li>
            @else
                <li><a href="{{ route('login.index') }}">{{ __('Login') }}</a></li>
            @endauth

        </ul>
    </nav>
    @yield('content')
</body>

</html>
