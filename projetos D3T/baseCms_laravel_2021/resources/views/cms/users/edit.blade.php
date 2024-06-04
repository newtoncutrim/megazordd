@extends('cms.layouts.page')
@section('content')
<div class="row">
  <div class="col-md-12">
    <ui-form form-class="form-horizontal col-12" title="Atualizar Registro" token="{{ csrf_token() }}"
      url="{{ route('users.update', $item->id) }}" cancel-url="{{ route('users.index') }}" method="PUT">
      @if($errors->any())
      <div class="col-sm-12">
        <alert class="alert-danger" icon="fa-ban" title="Ops!"
          text="Não foi possível atualizar o registro, verifique os campos em destaque!">
        </alert>
      </div>
      @endif
      <div class="form-group row">
        <div class="col-sm-6 {{ $errors->has('image') ? ' form-group has-warning' : '' }}">
          <div class="row">
            <label for="image" class="col-sm-2 control-label">Imagem</label>
            <div class="col-sm-10">
              <div class="row">
                @if(strlen($item->image) > 0)
                <div class="col-md-3">
                  <img src="{{ $item->image }}" style="width:100%">
                </div>
                @endif
                <div class="col-md-9">
                  <input type="file" name="image">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 {{ $errors->has('group_id') ? ' form-group has-warning' : '' }}">
          <div class="row">
            <label for="group_id" class="col-sm-2 control-label">Grupo*</label>
            <div class="col-sm-10">
              <ui-select name="group_id" id="group_id" required="true" :options="{{ $groups }}"
                selected="{{ $item->group_id }}">
              </ui-select>
              @if ($errors->has('group_id'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-6 {{ $errors->has('name') ? ' form-group has-warning' : '' }}">
          <div class="row">
            <label for="name" class="col-sm-2 control-label">Nome*</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" maxlength="200"
                required>
              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-sm-6 {{ $errors->has('email') ? ' form-group has-warning' : '' }}">
          <div class="row">
            <label for="email" class="col-sm-2 control-label">E-mail*</label>
            <div class="col-sm-10">
              <input type="text" name="email" class="form-control" id="email" value="{{ $item->email }}" maxlength="255"
                required>
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-6 {{ $errors->has('username') ? ' form-group has-warning' : '' }}">
          <div class="row">
            <label for="username" class="col-sm-2 control-label">Usuário*</label>
            <div class="col-sm-10">
              <input type="text" name="username" class="form-control" id="username" value="{{ $item->username }}"
                maxlength="255" required>
              @if ($errors->has('username'))
              <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-sm-6 {{ $errors->has('password') ? ' form-group has-warning' : '' }}">
          <div class="row">
            <label for="password" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="password" maxlength="255">
              <span class="help-block">
                Para manter a senha atual, não preencha este campo
              </span>
              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </ui-form>
  </div>
</div>
@endsection