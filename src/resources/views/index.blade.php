<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Caterings</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="m-5">
            <div class="text-center fs-1">
                Caterings
            </div>
                
            </div>
        <main class="container container-custom">
            @auth
                @yield('content')
            @endauth

            @guest
                @yield('content')
            @endguest
        </main>
    </body>
</html>
