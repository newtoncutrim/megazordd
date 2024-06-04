@extends('front.layouts.app')

@section('body')
  <div id="app">
    <header>
      Header
    </header>
    <section class="content">
      @yield('content')
    </section>
  </div>
@endsection
