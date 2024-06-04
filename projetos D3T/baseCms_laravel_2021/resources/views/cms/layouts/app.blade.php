<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="noindex" name="robots" />
  <link href="{{ url('img/logo.png') }}" rel="icon">

  <meta content="{{ csrf_token() }}" name="csrf-token">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- TinyMCE -->
  <script src="https://cdn.tiny.cloud/1/usphdm27fhx8xeueohydiphnjv9h5xmjmna69nhzpdjeld9e/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

  <!-- Styles -->
  <script src="{{asset('tnyMce.js')}}">
   
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  @vite('resources/assets/sass/app.scss')
</head>

<body>
  @routes
  
  @yield('body')
</body>
@vite('resources/assets/js/cms/app.js')

<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</html>
