<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CASDMS') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materialize.min.css') }}">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        <div class="navbar-fixed">
            <nav class="pink darken-4">
                <div class="nav-wrapper">
                    <a class="brand-logo left" href="{{ url('/home') }}">
                        <img src="{{ asset('images/uplogo_sm.png') }}">
                        <span>CAS</span>
                        <span>DMS</span>
                    </a>
                    <ul class="right">
                        @guest
                            <li><a class="nav-link" href="{{ url('/') }}">{{ __('Login') }}</a></li>
                        @else
                            <li><a href="#!/" class="pink-text text-darken-1"><i class="material-icons">home</i></a></li>
                            <li><a href="#!/received" class="pink-text text-darken-1"><i class="material-icons">inbox</i></a></li>
                            <li><a href="#!/sent" class="pink-text text-darken-1"><i class="material-icons">near_me</i></a></li>
                            <li><a href="#!/accounts" class="pink-text text-darken-1"><i class="material-icons">group</i></a></li>
                            <li>
                                <a class="dropdown-trigger btn-flat grey-text text-lighten-3" data-target="options" href="#" role="button">
                                    {{ Auth::user()->name }}
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="options" class='dropdown-content'>
                                    <li><a class="red-text" id="logout" href="{{ route('logout') }}"> Logout </a></li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
        <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST"> @csrf </form>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/materialize/dist/js/materialize.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script> -->
    <script type="text/javascript">
        $('.dropdown-trigger').dropdown();

        $("#logout").click(function(event){
            event.preventDefault()
            $("#logout-form").submit()
        })
    </script>
    @stack('scripts')
</body>
</html>
