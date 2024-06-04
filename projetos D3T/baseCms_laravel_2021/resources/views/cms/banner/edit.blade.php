@extends('cms.layouts.page')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ui-form form-class="form-horizontal" title="Atualizar Registro" token="{{ csrf_token() }}"
            url="{{ route('banner.update', $banner->id) }}" cancel-url="{{ route('banner.index') }}" method="PUT">
            @if($errors->any())
            <div class="col-sm-12">
                <alert class="alert-danger" icon="fa-ban" title="Ops!"
                    text="Não foi possível atualizar o registro, verifique os campos em destaque!">
                </alert>
            </div>
            @endif

            <div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                <label for="active" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Status</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input type="checkbox" aria-label="Nome" name="active" id="active" value="1"
                        {{$banner->active == '1' ? 'checked' : ''}}> Ativo
                    @if ($errors->has('active'))
                    <span class="help-block">
                        <strong>{{ $errors->first('active') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Período de exibição</label>
                <div class="d-md-flex justify-content-between col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input placeholder="Data inicial" type="date" class="mb-md-0 mb-2 form-control" value="{{ $banner->start_date }}" name="start_date">
                    <input placeholder="Data final" type="date" class="ml-md-2 form-control" value="{{ $banner->end_date }}" name="end_date">
                </div>
            </div>
            <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Name</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="name" id="name" maxlength="250"
                        value="{{ $banner->name }}">
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                   {{--  <span class="help-block">
                        Adicionando # ao redor da palavra, ela fica com destaque no site, exemplo Saiba sobre #tecnologia#<br>
                        Máximo de 250 caracteres 
                    </span> --}}
                </div>
            </div>
            {{-- <div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description"
                    class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Descrição</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <ui-textarea name="description" value="{{ $banner->description }}" id="full_textarea_banner" >{{ $banner->description }}</ui-textarea>
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('cor_texto') ? ' form-group has-warning' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left" for="cor_texto">Cor do texto</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                  <input class="form-control col-sm-10" id="cor_texto" name="cor_texto"
                    style="padding: 0;width: 55px;height: 50px;" type="color" value="{{ $banner->cor_texto }}">
                  @if ($errors->has('cor_texto'))
                    <span class="help-block">
                      <strong>{{ $errors->first('cor_texto') }}</strong>
                    </span>
                  @endif
                </div>
            </div>
            <div class="row form-group{{ $errors->has('turn') ? ' has-error' : '' }}">
                <label for="turn" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Ordem*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input type="number" name="turn" aria-label="Nome" class="form-control" id="turn"
                        value="{{ $banner->turn }}" maxlength="200" required>
                    @if ($errors->has('turn'))
                    <span class="help-block">
                        <strong>{{ $errors->first('turn') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row form-group{{ $errors->has('button') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Texto do botão</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="button" id="button" maxlength="150"
                        value="{{ $banner->button }}">
                    @if ($errors->has('button'))
                    <span class="help-block">
                        <strong>{{ $errors->first('button') }}</strong>
                    </span>
                    @endif
                    <span class="help-block">
                        Máximo de 150 caracteres
                    </span>
                </div>
            </div>
            <div class="form-group row {{ $errors->has('cor_botao') ? ' form-group has-warning' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left" for="cor_botao">Cor do botão</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                  <input class="form-control col-sm-10" id="cor_botao" name="cor_botao"
                    style="padding: 0;width: 55px;height: 50px;" type="color" value="{{ $banner->cor_botao }}">
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
                        value="{{ $banner->link }}">
                    @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem desktop*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <div class="row">
                        @if(strlen($banner->image) > 0)
                        <div class="col-md-2 col-xs-4">
                            <img src="{{ asset($banner->image) }}" style="width:100%">
                        </div>
                        @endif
                        <div class="col-xs-11">
                            <input type="file" aria-label="Nome" name="image" value="">
                            <input type="hidden" aria-label="Nome" value="{{ $banner->image }}">
                            <span class="help-block">
                                Para manter a imagem atual, não preencha esse campo
                            </span>
                            @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <span class="help-block">
                        Tamanho e formato recomendado: 1920x520px JPG
                    </span>
                </div>
            </div>
            <div class="row form-group{{ $errors->has('image_mobile') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem mobile*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <div class="row">
                        @if(strlen($banner->image_mobile) > 0)
                        <div class="col-md-2 col-xs-4">
                            <img src="{{ asset($banner->image_mobile) }}" style="width:100%">
                        </div>
                        @endif
                        <div class="col-xs-11">
                            <input type="file" aria-label="Nome" name="image_mobile" value="">
                            <input type="hidden" aria-label="Nome" value="{{ $banner->image_mobile }}">
                            <span class="help-block">
                                Para manter a imagem atual, não preencha esse campo
                            </span>
                            @if ($errors->has('image_mobile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image_mobile') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <span class="help-block">
                        Tamanho e formato recomendado: 370x500px JPG
                    </span>
                </div>
            </div>
    </div>
    </ui-form>
</div>
</div>
@endsection