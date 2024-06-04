@extends('cms.layouts.page')

@section('content')
<div class="row">
    <div class="col-md-12">

        <tabs :tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
					{'icon' : 'fa fa-plus', 'title' : 'Cadastro de Registros', 'active' : false},
				]" active-tab="{{$errors->any() ? 1 : 0}}">
            <data-table slot="tabslot_0" title="Lista de Registros" busca="{{$busca}}"
                url="{{ $data['request']->url() }}" token="{{ csrf_token() }}" :items="{{ json_encode($items) }}"
                :titles="{{$titles}}" :actions="{{ $actions }}" :not-deletable="false" busca="{{$busca}}"
                :show-busca="true">
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
                    url="{{ route('banner.store') }}" method="POST">
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
                        <label for="active" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Status</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input type="checkbox" aria-label="Nome" name="active" id="active" value="1"
                            {{old('active') ? (old('active') ? 'checked' : '') : 'checked'}}> Ativo
                            @if ($errors->has('active'))
                            <span class="help-block">
                                <strong>{{ $errors->first('active') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Período de
                            exibição</label>
                        <div class="d-md-flex justify-content-between col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input placeholder="Data inicial" type="date" class="mb-md-0 mb-2 form-control" value="{{ old('start_date') }}" name="start_date">
							<input placeholder="Data final" type="date" class="ml-md-2 form-control" value="{{ old('end_date') }}" name="end_date">
                        </div>
                    </div>
                    <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Nome</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input class="form-control" aria-label="Nome" type="text" name="name" id="name"
                                value="{{ old('name') }}" maxlength="250">
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
{{--                             <span class="help-block">
                                Adicionando # ao redor da palavra, ela fica com destaque no site, exemplo Saiba sobre #tecnologia#<br>
                                Máximo de 250 caracteres 
                            </span> --}}
                        </div>
                    </div>
{{--                     <div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description"
                            class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Descrição</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <ui-textarea name="description" value="{{ old('description') }}" id="full_textarea_banner">
                            </ui-textarea>
                            @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div> --}}
                   {{--  <div class="form-group row {{ $errors->has('cor_texto') ? ' form-group has-warning' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left" for="cor_texto">Cor do
                        texto</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input class="form-control col-sm-10" id="cor_texto" name="cor_texto"
                            style="padding: 0;width: 55px;height: 50px;" type="color"
                            value="{{ old('cor_texto') ?: '#ffffff' }}">
                            @if ($errors->has('cor_texto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cor_texto') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}
                  {{--   <div class="row form-group{{ $errors->has('turn') ? ' has-error' : '' }}">
                        <label for="turn"
                            class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Ordem*</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input type="number" aria-label="Nome" name="turn" class="form-control" id="turn"
                                value="{{ old('turn') }}" required>
                            @if ($errors->has('turn'))
                            <span class="help-block">
                                <strong>{{ $errors->first('turn') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div> --}}
                   {{--  <div class="row form-group{{ $errors->has('button') ? ' has-error' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Texto do botão</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input class="form-control" aria-label="Nome" type="text" name="button" id="button"
                                value="{{ old('button') }}" maxlength="150">
                            @if ($errors->has('button'))
                            <span class="help-block">
                                <strong>{{ $errors->first('button') }}</strong>
                            </span>
                            @endif
                            <span class="help-block">
                                Máximo de 150 caracteres
                            </span>
                        </div>
                    </div> --}}
                   {{--  <div class="form-group row {{ $errors->has('cor_botao') ? ' form-group has-warning' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left" for="cor_botao">Cor do
                        botão</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input class="form-control col-sm-10" id="cor_botao" name="cor_botao"
                            style="padding: 0;width: 55px;height: 50px;" type="color"
                            value="{{ old('cor_botao') ?: '#20C31D' }}">
                            @if ($errors->has('cor_botao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cor_botao') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}
                    <div class="row form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Link do botão</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input class="form-control" aria-label="Nome" type="text" name="link" id="link"
                                value="{{ old('link') }}">
                            @if ($errors->has('link'))
                            <span class="help-block">
                                <strong>{{ $errors->first('link') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div
                        class="row form-group{{ $errors->has('image') || $errors->has('images') ? ' has-error' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem desktop*</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input type="file" aria-label="Nome" name="image">
                            @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                            <span class="help-block">
                                Tamanho e formato recomendado: 1920x520px JPG
                            </span>
                        </div>
                    </div>
                    <div
                        class="row form-group{{ $errors->has('image_mobile') || $errors->has('images') ? ' has-error' : '' }}">
                        <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem mobile*</label>
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                            <input type="file" aria-label="Nome" name="image_mobile">
                            @if ($errors->has('image_mobile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image_mobile') }}</strong>
                            </span>
                            @endif
                            <span class="help-block">
                                Tamanho e formato recomendado: 370x500px JPG
                            </span>
                        </div>
                    </div>
                    @if ($errors->has('images'))
                    <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                        <div class="form-group has-error">
                            <span class="help-block">
                                <strong>{{ $errors->first('images') }}</strong>
                            </span>
                        </div>
                    </div>
                    @endif
                </ui-form>
            </div>
        </tabs>
    </div>
</div>

@endsection