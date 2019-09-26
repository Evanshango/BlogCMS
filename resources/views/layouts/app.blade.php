<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BlogCMS') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'BlogCMS') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}"><b>Dashboard</b></a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{route('user.profile')}}" class="dropdown-item">My Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @if(!in_array(request()->path(), ['login', 'register', 'password/email', 'password/reset']))
        <main class="container py-4">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            @if(session()->has('info'))
                <div class="alert alert-info">
                    {{session()->get('info')}}
                </div>
            @endif
            <div class="row">
                @if(Auth::check())
                    <div class="col-md-4">
                        @if(Auth::user()->admin)
                            <ul class="list-group mb-2">
                                <li class="list-group-item">
                                    <a href="{{route('users.index')}}"><b>Users</b></a>
                                </li>
                            </ul>
                            <ul class="list-group mb-2">
                                <li class="list-group-item">
                                    <a href="{{route('settings')}}"><b>Site Settings</b></a>
                                </li>
                            </ul>
                        @endif
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{route('category.create')}}"><b>Create a Category</b></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('tag.create')}}"><b>Create a Tag</b></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('post.create')}}"><b>Create a Post</b></a>
                            </li>
                        </ul>
                        <ul class="list-group mt-2">
                            <li class="list-group-item">
                                <a href="{{route('categories.index')}}" style="color: #008000"><b>View Categories</b></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('tags.index')}}" style="color: #008000"><b>View Tags</b></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('posts.index')}}" style="color: #008000"><b>View Posts</b></a>
                            </li>
                        </ul>
                            <ul class="list-group mt-2">
                                <li class="list-group-item">
                                    <a href="{{route('trash.index')}}" style="color: #ff0000"><b>Trashed Posts</b></a>
                                </li>
                            </ul>
                    </div>
                @endif
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </main>
    @else
        <main class="py-4">
            @yield('content')
        </main>
    @endif
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
