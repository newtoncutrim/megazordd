<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <link href="{{ url('img/cms/favicon.png') }}" rel="icon">

  <meta content="{{ csrf_token() }}" name="csrf-token">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Styles -->
  @vite('resources/assets/sass/website/app.scss')

</head>

<body>
  @routes
  @vite('resources/assets/js/front/app.js')
  @yield('body')
</body>

</html>
