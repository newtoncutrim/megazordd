@extends('cms.layouts.app')

@section('body')

<body class="hold-transition login-page fundo">
  <div class="container">
    <div class="row h-100 align-items-center justify-content-center">
      <div class="login-box" id="app">
        <div class="login-logo col-12">
          <img src="{{ asset('img/logo_cms.svg') }}">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body col-12" style="border-radius:0.25rem">
          <div class="row">

            <h4 class="text-center col-12">Painel Administrativo</h4><br><br>

            <form class="form-horizontal col-12" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="form-group has-feedback{{ $errors->has('username') ? ' form-group has-warning' : '' }}">
                <input name="username" type="username" class="form-control" placeholder="Usuário"
                  value="{{ old('username') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('username'))
                <span class="help-block">
                  <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group has-feedback{{ $errors->has('password') ? ' form-group has-warning' : '' }}">
                <input name="password" type="password" class="form-control" placeholder="Senha" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
              <div class="row align-items-center">
                <div class="col-8">
                  <div class="row align-items-center">
                    <label class="col-12 d-flex align-items-center">
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp Lembrar-me
                    </label>
                  </div>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-success btn-block btn-flat" style="border-radius:0.25rem">
                    Acessar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>

</body>

@endsection