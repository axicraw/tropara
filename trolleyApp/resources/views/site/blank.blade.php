<!doctype html>
<html class="no-js" lang="en">
  <head>
    <base href="{{url()}}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trolleyin</title>

    <link rel="icon" href="favicon.png" type="image/ico"> 
    <link rel="stylesheet" href="css/foundation-icons/foundation-icons.css" />
    <link rel="stylesheet" href="css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="css/app.css" />
    @yield ('cssContent')

    <script src="js/modernizr.js"></script>
  </head>
  <body>
    @yield ('content')


    @yield('scriptsContent')
  </body>
</html>

