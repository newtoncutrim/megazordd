@extends('cms.layouts.page')
@section('content')
<div class="row">
  <div class="col-md-12">
    <ui-form form-class="form-horizontal col-12" title="Atualizar Evento" token="{{ csrf_token() }}" url="{{ route('dashboard.update', $lead) }}" cancel-url="{{ route('dashboard.index') }}" method="PUT">
      @if($errors->any())
      <div class="col-sm-12">
        <alert class="alert-danger" icon="fa-ban" title="Ops!" text="Não foi possível atualizar o Evento, verifique os campos em destaque!">
        </alert>
      </div>
      @endif
      <div class="form-group row {{ $errors->has('contacted') ? ' form-group has-warning' : '' }}">
        <label class="col-sm-2 control-label">Contactado?</label>
        <div class="col-sm-10">
          <input type="checkbox" aria-label="Nome" name="contacted" id="contacted" value="1" {{ $lead->contacted == 1 ? 'checked' : ''}}> Sim
          @if ($errors->has('contacted'))
          <span class="help-block">
            <strong>{{ $errors->first('contacted') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('name') ? ' form-group has-warning' : '' }}">
        <label for="name" class="col-sm-2 control-label">Nome*</label>
        <div class="col-sm-6">
          <input disabled type="text" name="name" class="form-control" id="name" value="{{ $lead->name }}" required>
          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
      </div>
			<div class="form-group row {{ $errors->has('email') ? ' form-group has-warning' : '' }}">
        <label for="email" class="col-sm-2 control-label">E-mail*</label>
        <div class="col-sm-6">
          <input disabled type="text" name="email" class="form-control" id="email" value="{{ $lead->email }}" required>
          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
      </div>
			<div class="form-group row {{ $errors->has('phone') ? ' form-group has-warning' : '' }}">
        <label for="phone" class="col-sm-2 control-label">Telefone*</label>
        <div class="col-sm-6">
          <input disabled type="text" name="phone" class="form-control" id="phone" value="{{ $lead->phone }}" required>
          @if ($errors->has('phone'))
          <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
          </span>
          @endif
        </div>
      </div>
			<div class="form-group row {{ $errors->has('company') ? ' form-group has-warning' : '' }}">
        <label for="company" class="col-sm-2 control-label">Empresa*</label>
        <div class="col-sm-6">
          <input disabled type="text" name="company" class="form-control" id="company" value="{{ $lead->company }}" required>
          @if ($errors->has('company'))
          <span class="help-block">
            <strong>{{ $errors->first('company') }}</strong>
          </span>
          @endif
        </div>
      </div>
    </ui-form>
  </div>
</div>
@endsection