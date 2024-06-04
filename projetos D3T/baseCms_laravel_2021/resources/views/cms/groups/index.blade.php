@extends('cms.layouts.page')
@section('content')
<div class="row">
  <div class="col-md-12">
    <tabs :tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
					{'icon' : 'fa fa-plus', 'title' : 'Adicionar Registro', 'active' : false}
					]" active-tab="{{$errors->any() ? 1 : 0}}">
      <data-table slot="tabslot_0" title="Lista de Registros" busca="{{$busca}}" url="{{ $data['request']->url() }}"
        token="{{ csrf_token() }}" :items="{{ json_encode($items) }}" :titles="{{$titles}}" :actions="{{$actions}}">
        @if(session()->has('message'))
        <div class="row">
          <div class="col-sm-12">
            <alert class="alert-success" icon="fa-check" text="{{ session()->get('message') }}">
            </alert>
          </div>
        </div>
        @endif
        <span slot="pagination" class="pull-right">
          {{ $items->appends(request()->input())->links() }}
          <div class="text-right">
            Exibindo <b>{{ ($items->perPage() * ($items->currentPage() - 1) + 1) }} -
              {{ $items->currentPage() != $items->lastPage() ? $items->count() * $items->currentPage() : $items->total() }}</b>
            de <b>{{ $items->total() }}</b> registros.
          </div>
        </span>
      </data-table>
      <div slot="tabslot_1">
        <ui-form form-class="form-horizontal col-12" title="Adicionar Registro" token="{{ csrf_token() }}"
          url="{{ route('groups.store') }}" method="POST">
          @if($errors->any())
          <div class="row">
            <div class="col-sm-12">
              <alert class="alert-danger" icon="fa-ban" title="Ops!"
                text="Não foi possível adicionar o registro, verifique os campos em destaque!">
              </alert>
            </div>
          </div>
          @endif
          <div class="form-group row {{ $errors->has('name') ? ' form-group has-warning' : '' }}">
            <label for="name" class="col-sm-2 control-label">Nome*</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" maxlength="255"
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
                    <input type="checkbox" name="module_id[]'" value="{{$module->id}}" id="cb_{{$module->id}}">
                    {{$module->name}}
                  </label>
                  @if($module->has_son == 1)
                  <ul>
                    @foreach($module->submodules()->get() as $index_s => $submodule)
                    <li class="checkbox">
                      <label for="cb_{{$submodule->id}}">
                        <input type="checkbox" name="module_id[]'" value="{{$submodule->id}}"
                          id="cb_{{$submodule->id}}">
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
    </tabs>
  </div>
</div>
@endsection