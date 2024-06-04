@extends('cms.layouts.page')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ui-form form-class="form-horizontal" title="Atualizar Registro" token="{{ csrf_token() }}"
            url="{{ route('products.update', $product->id) }}" cancel-url="{{ route('products.index') }}" method="PUT">
            @if($errors->any())
            <div class="col-sm-12">
                <alert class="alert-danger" icon="fa-ban" title="Ops!"
                    text="Não foi possível atualizar o registro, verifique os campos em destaque!">
                </alert>
            </div>
            @endif

            
            <div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Status</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input type="checkbox" aria-label="Nome" name="active" id="active" value="1"
                        {{$product->active == '1' ? 'checked' : ''}}> Ativo
                    @if ($errors->has('active'))
                    <span class="help-block">
                        <strong>{{ $errors->first('active') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('highlight') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Destaque</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input type="checkbox" aria-label="Nome" name="highlight" id="highlight" value="1"
                        {{$product->highlight == '1' ? 'checked' : ''}}> Ativo
                    @if ($errors->has('highlight'))
                    <span class="help-block">
                        <strong>{{ $errors->first('highlight') }}</strong>
                    </span>
                    @endif
                </div>
            </div> 
           
            <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Nome*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="title" id="title" value="{{ $product->title }}">
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Lead</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="lead" id="lead" value="{{ $product->lead }}">
                    @if ($errors->has('lead'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lead') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
           
            <div class="row form-group{{ $errors->has('turn') ? ' has-error' : '' }}">
                <label for="turn" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Ordem*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input type="number" name="turn" aria-label="Nome" class="form-control" id="turn"
                        value="{{ $product->turn }}" maxlength="200" required>
                    @if ($errors->has('turn'))
                    <span class="help-block">
                        <strong>{{ $errors->first('turn') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Link</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="link" id="link" value="{{ $product->link }}">
                    @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Descrição*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <ui-textarea name="description" id="full_textarea" value="{{ $product->description }}">{{ $product->description }}
                    </ui-textarea>
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <div class="row">
                        @if (strlen($product->image) > 0)
                          <div class="col-md-2 col-xs-4">
                            <img src="{{ asset($product->image) }}" style="width:100%">
                          </div>
                        @endif
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                          <input name="image" type="file">
                          <input aria-label="Nome" aria-label="Nome" name="old-image" type="hidden"
                            value="{{ $product->image }}">
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
                        JPG ou PNG
                    </span>
                </div>
            </div>
        </div>
    </ui-form>
</div>
</div>
@endsection