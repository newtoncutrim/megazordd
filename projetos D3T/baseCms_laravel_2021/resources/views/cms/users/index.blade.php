@extends('cms.layouts.page')
@section('content')
<div class="row">
  <div class="col-md-12">
    <tabs :tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
					{'icon' : 'fa fa-plus', 'title' : 'Adicionar Registro', 'active' : false}
					]" active-tab="{{$errors->any() ? 1 : 0}}">
      <data-table slot="tabslot_0" title="Lista de Registros" busca="{{$busca}}" url="{{ $data['request']->url() }}"
        token="{{ csrf_token() }}" :items="{{ json_encode($items) }}" :titles="{{$titles}}" :actions="{{ $actions }}">
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
          url="{{ route('users.store') }}" method="POST">
          @if($errors->any())
          <div class="row">
            <div class="col-sm-12">
              <alert class="alert-danger" icon="fa-ban" title="Ops!"
                text="Não foi possível adicionar o registro, verifique os campos em destaque!">
              </alert>
            </div>
          </div>
          @endif
          <div class="form-group row">
            <div class="col-sm-6 {{ $errors->has('group_id') ? ' form-group has-warning' : '' }}">
              <div class="row">
                <label class="col-sm-2 control-label">Imagem</label>
                <div class="col-sm-10">
                  <input type="file" name="image">
                  @if ($errors->has('image'))
                  <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-sm-6 {{ $errors->has('group_id') ? ' form-group has-warning' : '' }}">
              <div class="row">
                <label for="group_id" class="col-sm-2 control-label">Grupo*</label>
                <div class="col-sm-10">
                  <ui-select name="group_id" id="group_id" required="true" :options="{{ $groups }}" selected="0">
                  </ui-select>
                  @if ($errors->has('group_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('group_id') }}</strong>
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
                  <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
                    maxlength="200" required>
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
                  <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}"
                    maxlength="255" required>
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
                  <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}"
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
                <label for="password" class="col-sm-2 control-label">Senha*</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="password" maxlength="255" required>
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
    </tabs>
  </div>
</div>
@endsection