<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app" class="main-wrapper">

      <header>
        @include('auth.headerNativo')
      </header>

        <div class="container-fluid row h-100">

          <aside class="col-2 bg-dark text-white">
            @auth
                @include('profile.partials.asideLeft')
            @endauth
          </aside>

          <main class="col ">
              @yield('content')
          </main>
      </div>

    </div>
</body>

</html>
