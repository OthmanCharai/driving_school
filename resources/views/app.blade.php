<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <script
  src="https://code.jquery.com/jquery-3.6.3.slim.js"
  integrity="sha256-DKU1CmJ8kBuEwumaLuh9Tl/6ZB6jzGOBV/5YpNE2BWc="
  crossorigin="anonymous"></script>
       


        @vite('resources/css/app.css')
    

    </head>
    <body>
       <div id="app">
        <landing></landing>
       </div>
       @vite('resources/js/app.js')
    </body>
</html>
