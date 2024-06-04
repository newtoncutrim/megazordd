@extends('cms.layouts.page')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- <div class="text-left">
            <a href="https://youtu.be/r02iLbtkfxA" target="_blank">
                <button type="button" class="btn btn-info">
                    Tutorial da página
                </button>
            </a>
            <br><br>
        </div> -->
        <tabs :tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
					{'icon' : 'fa fa-plus', 'title' : 'Cadastro de Registros', 'active' : false},
				]" active-tab="{{$errors->any() ? 1 : 0}}">
            <data-table slot="tabslot_0" title="Lista de Registros" url="{{ $data['request']->url() }}"
                token="{{ csrf_token() }}" :items="{{ json_encode($items) }}" :titles="{{$titles}}"
                :actions="{{ $actions }}" :not-deletable="false" busca="{{$busca}}" :show-busca="true">
                @if(session()->has('message'))
                <div class="row">
                    <div class="col-sm-12">
                        <alert class="alert-success" icon="fa-check" text="{{ session()->get('message') }}">
                        </alert>
                    </div>
                </div>
                @endif
                <span slot="pagination" class="pull-right">
                    {{ $items->links() }}
                </span>
            </data-table>
            <div slot="tabslot_1">
                <ui-form form-class="form-horizontal" title="Adicionar Registro" token="{{ csrf_token() }}"
                    url="{{ route('blog_categories.store') }}" method="POST">
                    @if($errors->any())
                    <div class="row">
                        <div class="col-sm-12">
                            <alert class="alert-danger" icon="fa-ban" title="Ops!"
                                text="Não foi possível adicionar o registro, verifique os campos em destaque!">
                            </alert>
                        </div>
                    </div>
                    @endif
                    <div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                        <label class="col-xl-1 col-lg-1 col-sm-1 col-12 text-lg-right text-sm-left">Status</label>
                        <div class="col-xl-11 col-lg-11 col-sm-11 col-12">
                            <input type="checkbox" aria-label="Nome" name="active" id="active" value="1"
                                {{old('active') ? (old('active') ? 'checked' : '') : 'checked'}}> Ativo
                            @if ($errors->has('active'))
                            <span class="help-block">
                                <strong>{{ $errors->first('active') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-xl-1 col-lg-1 col-sm-1 col-12 text-lg-right text-sm-left">Nome*</label>
                        <div class="col-xl-11 col-lg-11 col-sm-11 col-12">
                            <input class="form-control" aria-label="Nome" type="text" name="name" id="name"
                                value="{{ old('name') }}" maxlength="100" required>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                            <span class="help-block">
                                Máximo de 100 caracteres
                            </span>
                        </div>
                    </div>
                </ui-form>
            </div>
        </tabs>
    </div>
</div>

@endsection