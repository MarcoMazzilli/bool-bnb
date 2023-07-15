<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/img/Boolbnb.png" type="png">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>

    @guest
        <div class="container-fluid" id="register-login-wrapper">

            @include('auth.headerNativo')

            <div class="row">
                <div class="col-10 p-5 mx-auto">
                    @yield('content-log-reg')
                </div>
            </div>

        </div>
    @endguest

    @auth
        <div class="container-fluid" id="wrapper-auth-user">
            <div class="wrappper-dashboard border rounded-4 overflow-hidden" id="card-dashboard">

                <div class="row h-100">


                    <div class="col-2 p-0">
                        @include('admin.partials.asideLeft')
                    </div>

                    <div class="col-10 p-0 mx-auto">
                        <div>
                            @include('auth.headerNativo')
                        </div>
                        @yield('content')
                    </div>

                </div>
            </div>

        </div>
        @endauth

</body>

</html>
