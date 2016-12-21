<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/dropzone.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-file-text wow animated jello" aria-hidden="true"></i>&nbsp;{{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                            @else
                            <li><a href="{{ url('/messages') }}">Messagerie <i class="fa fa-commenting" aria-hidden="true"></i></a></li>
                            <li><a href="{{ url('/share') }}">Fichiers partagées <i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                            <li><a href="{{ url('/files') }}">Mes fichiers <i class="fa fa-files-o" aria-hidden="true"></i></a></li>
                            <li>

                                <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>

                                <li><form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="loader-container">
                    <div class="loader"></div>
                </div>
                @if(Session::has('message'))
                <div class="container">
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                </div>
                @endif
                <div class="content">
                    @yield('content')
                </div>
            </div>

            <!-- Scripts -->
            <script src="/js/jquery.min.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/main.js"></script>
            <script src="/js/dropzone.js"></script>
        </body>
        </html>
