<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">

        <a href={{url('/')}}>Home</a> |
        <a href={{URL::to('/about')}}>About</a> |
        <a href={{route('con')}}>Contact</a>
        {{-- //route is SEO friendly and it's better to use --}}

        <h2>Welcome to laravel</h2>

    </body>
</html>
