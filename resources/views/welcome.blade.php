<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .top-right {
            position: relative;
            /* right: 10px; */
            /* top: 18px; */
            float: right;
            width: 100%;
            height: 40px;
            margin-top: 15px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            float: right;
        }

    </style>
</head>
    <body>
        <div class="container " id="app">

            <div class="row">
                <div class="col-md-12">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/hyperlinks') }}">Home</a>
                            @else

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif

                                <a href="{{ route('login') }}">Login</a>

                            @endauth
                        </div>
                    @endif
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-warning" role="alert">
                        Hello! Here you can add custom hyperlinks for share with everyone. <br> If you want to add your own hyperlinks, you can signup and login.
                    </div>
                </div>
            </div>

            <hyperlink-index-component class="mb-5"></hyperlink-index-component>
        </div>
    </body>
</html>
