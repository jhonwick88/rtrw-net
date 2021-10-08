<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta content="Konten keyword" name="keywords">
      <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"> -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="{{ asset('/resto/vendor/fontawesome/css/fontawesome-all.css') }}" rel="stylesheet">
        <link href="{{ asset('/resto/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/resto/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        
        @routes
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        @inertia
  <script src="{{ asset('resto/vendor/jquery/jquery.min.js')}}"></script>
  @if (!Request::is('admin/*') && !Request::is('user/*'))
  <script src="{{ asset('/js/main.js') }}"></script>
  @endif
    </body>
</html>
