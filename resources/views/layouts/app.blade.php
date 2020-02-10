<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <script src="{{ mix('/js/app.js') }}"></script>
        <title>SVS</title>
        @stack('head')
    </head>
    <body>

        <nav class="navbar topnav navbar-dark bg-primary navbar-expand-lg justify-content-between">
            <div class="d-flex align-items-center">
                <h1><a class="navbar-brand" href="{{ route('home') }}">SVS</a></h1>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item @if(Route::currentRouteName() == 'home') active @endif">
                            <a class="nav-link" href="{{ route('home') }}">Start</a>
                        </li>
                        <li class="nav-item @if(Str::startsWith(Route::current()->uri, 'students')) active @endif">
                            <a class="nav-link" href="">Studenten</a>
                        </li>
                        <li class="nav-item @if(Str::startsWith(Route::current()->uri, 'educations')) active @endif">
                            <a class="nav-link" href="">Opleidingen</a>
                        </li>
                        
                        @if(\Auth::user()->level >= 2)
                        <li class="nav-item dropdown @if(Str::startsWith(Route::current()->uri, 'coord')) active @endif" data-controller="dropdown">
                            <a class="nav-link dropdown-toggle" data-target="dropdown.button" data-action="click->dropdown#toggle click@window->dropdown#hide" aria-expanded="false">Coördinator</a>
                            <div class="dropdown-menu" data-target="dropdown.menu">
                                <a href="{{ route('tracks.index') }}" class="dropdown-item">Programma's</a>
                                <a href="{{ route('terms.index') }}" class="dropdown-item">Blokken</a>
                                <a href="{{ route('rating_scales.index') }}" class="dropdown-item">Beoordelingsschalen</a>
                            </div>
                        </li>
                        @endif
                        
                        @if(\Auth::user()->level >= 3)
                        <li class="nav-item dropdown @if(Str::startsWith(Route::current()->uri, 'admin')) active @endif" data-controller="dropdown">
                            <a class="nav-link dropdown-toggle" data-target="dropdown.button" data-action="click->dropdown#toggle click@window->dropdown#hide" aria-expanded="false">Admin</a>
                            <div class="dropdown-menu" data-target="dropdown.menu">
                                <a href="{{ route('users.index') }}" class="dropdown-item">Gebruikers</a>
                                <a href="{{ route('units.index') }}" class="dropdown-item">Afdelingen</a>
                                <a href="{{ route('educations.index') }}" class="dropdown-item">Opleidingen</a>
                            </div>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="btn-group d-none d-md-flex">
                @yield('buttons')
                @if(session('unit', false))
                    <a class="btn btn-outline-gray" href="{{ route('users.edit', \Auth::user()) }}"><i class="fas fa-user-friends" aria-hidden="true"></i> <span>{{ session('unit')->title }}</span></a>
                @endif
            </div>
        </nav>
        @yield('subnav')
        <div class="@yield('container', 'container')">
            @include('layouts.status')
            @yield('content')
        </div>
    </body>
</html>
