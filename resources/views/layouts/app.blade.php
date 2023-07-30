<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>BoolBnb</title>
    <link rel="shortcut icon" href="/img/boolbnb-favicon.png" type="png">

    <!-- Fonts awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



    {{-- tomtom autocomplete searchbox --}}
    <link
    rel="stylesheet"
    type="text/css"
    href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css"/>

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}

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
            <div class="wrappper-dashboard border rounded-4 my_overflow" id="card-dashboard">

                <div class="row h-100 no_wrap ps-2">

                    <div class="col-1 col-md-2  p-0 ">
                        @include('admin.partials.asideLeft')
                    </div>

                    <div class="col-10 p-0 mx-auto my_overflow_auto">

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
