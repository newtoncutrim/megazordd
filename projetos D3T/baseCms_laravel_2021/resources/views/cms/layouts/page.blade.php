@extends('cms.layouts.app')

@section('body')

<body class="hold-transition skin-red sidebar-mini fixed fundo_cms">
  <div class="wrapper" id="app">
    <header class="main-header">
      <!-- Logo -->
      <a href="{{ route('configurations.index') }}" class="logo d-md-flex d-none justify-content-center align-items-center">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{{ asset('img/logo_cms.svg') }}"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{{ asset('img/logo_cms.svg') }}"></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top d-flex d-md-block justify-content-between align-items-center">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <a href="{{ route('configurations.index') }}" class="logo d-flex d-md-none justify-content-center align-items-center">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{ asset('img/logo_cms.svg') }}"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="{{ asset('img/logo_cms.svg') }}"></span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle d-md-block d-none" data-toggle="dropdown">
                @if(strlen(Auth::user()->image) > 0)
                <img src="{{ asset(Auth::user()->image) }}" class="user-image" alt="User Image">
                @endif
                <span class="">Bem-vindo, {{ Auth::user()->name }} <span class="caret"></span></span>
              </a>
              <a href="#" class="dropdown-toggle d-block d-md-none" data-toggle="dropdown">
                @if(strlen(Auth::user()->image) > 0)
                <img src="{{ asset(Auth::user()->image) }}" class="user-image" alt="User Image">
                @endif
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sair
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- <div class="select-cms">
          <span style="color:#fff" class="mr-1">Ano do evento:</span>
          <select >
            <option>Selecionar</option>
            <option id="2019">2019</option>
            <option id="2020">2020</option>
            <option id="874">2021</option>
            <option id="1117">2022</option>
            <option id="2023">2023</option>
            <option id="2024">2024</option>
            <option id="2025">2025</option>
          </select>
          <div> -->
      </nav>
    </header>
    <!-- Menu lateral -->
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          @foreach($data['modules'] as $module)
          @if($module->has_son == 0)
          <li class="{{ $data['request']->is('cms/'.$module->path) ? 'active' : ''}}">
            <a href="{{ route($module->path . '.index') }}">
              <i class="{{ $module->icon }}"></i> <span>{{ $module->name }}</span>
            </a>
          </li>
          @else
          <li class="treeview {{ $data['request']->is('cms/'.$module->path . '/*') ? 'active menu-open' : '' }}">
            <a href="#">
              <i class="{{ $module->icon }}"></i> <span>{{ $module->name }}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{ $data['request']->is('cms/'.$module->path) ? 'display:block;' : '' }}">
              @foreach($module->submodules AS $submodule)
              <li class="{{ $data['request']->is('cms/'.$submodule->father_path . "/" . $submodule->path . "*") ? 'active' : '' }}">
                <a href="{{ route($submodule->path . '.index') }}">
                  <i class="far fa-circle fa-2xs v-middle"></i> {{ $submodule->name }}
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          @endif
          @endforeach
        </ul>
      </section>
    </aside>
    <!-- /.Menu lateral -->
    <div class="content-wrapper">
      <content-header :headers="{{$headers}}"></content-header>
      <section class="content">
        @yield('content')
      </section>
    </div>
  </div>
</body>
@endsection