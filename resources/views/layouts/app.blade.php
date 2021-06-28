<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link href="{{ asset('public/assets/login/css/style.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('public/img/simbol-mini.png') }}" />   
  </head>
  <body>
    @yield('content')
    @yield('scripts')
  </body>
</html>
