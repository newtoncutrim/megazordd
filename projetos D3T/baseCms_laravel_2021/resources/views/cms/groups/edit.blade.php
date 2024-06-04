@extends('cms.layouts.page')
@section('content')
<div class="row">
  <div class="col-md-12">
    <ui-form form-class="form-horizontal col-12" title="Atualizar Registro" token="{{ csrf_token() }}"
      url="{{ route('groups.update', $item->id) }}" cancel-url="{{ route('groups.index') }}" method="PUT">
      @if($errors->any())
      <div class="col-sm-12">
        <alert class="alert-danger" icon="fa-ban" title="Ops!"
          text="Não foi possível atualizar o registro, verifique os campos em destaque!">
        </alert>
      </div>
      @endif
      <div class="form-group row {{ $errors->has('name') ? ' form-group has-warning' : '' }}">
        <label for="name" class="col-sm-2 control-label">Nome*</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" maxlength="255"
            required>
          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row ">
        <label class="col-sm-2 control-label">Módulo de Acesso</label>
        <div class="col-sm-10">
          <ul>
            @foreach($modules as $index => $module)
            <li class="checkbox">
              <label for="cb_{{$module->id}}">
                <input type="checkbox" name="module_id[]'" value="{{$module->id}}" id="cb_{{$module->id}}"
                  {{ in_array($module->id, $group_modules_ids) ? 'checked' : '' }}>
                {{$module->name}}
              </label>
              @if($module->has_son == 1)
              <ul>
                @foreach($module->submodules()->get() as $index_s => $submodule)
                <li class="checkbox">
                  <label for="cb_{{$submodule->id}}">
                    <input type="checkbox" name="module_id[]'" value="{{$submodule->id}}" id="cb_{{$submodule->id}}"
                      {{ in_array($submodule->id, $group_modules_ids) ? 'checked' : '' }}>
                    {{$submodule->name}}
                  </label>
                </li>
                @endforeach
              </ul>
              @endif
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </ui-form>
  </div>
</div>
@endsection