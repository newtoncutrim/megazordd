@extends('cms.layouts.page')
@section('content')
<div class="row">
    <div class="col-md-12">
        <ui-form form-class="form-horizontal" title="Atualizar Registro" token="{{ csrf_token() }}"
            url="{{ route('configurations.update', $configurations->id) }}" cancel-url="{{ route('configurations.index') }}"
            method="PUT">
            @if($errors->any())
            <div class="col-sm-12">
                <alert class="alert-danger" icon="fa-ban" title="Ops!"
                    text="Não foi possível atualizar o registro, verifique os campos em destaque!">
                </alert>
            </div>
            @endif
            @if(session()->has('message'))
                <div class="row">
                    <div class="col-sm-12">
                        <alert class="alert-success" icon="fa-check" text="{{ session()->get('message') }}">
                        </alert>
                    </div>
                </div>
                @endif
            <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Título do Site*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" type="text" aria-label="Nome" name="title" id="title" maxlength="100"
                        value="{{ $configurations->title }}" required>
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                    <span class="help-block">
                        Máximo de 100 caracteres
                    </span>
                </div>
            </div>

			<div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description"
                    class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Descrição do Site*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <textarea name="description" value="{{ $configurations->description }}" id="full_textarea">{{ $configurations->description }}</textarea>
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                    <span class="help-block">
                        Máximo de 250 caracteres
                    </span>
                </div>
            </div>

			<div class="row form-group{{ $errors->has('whatsapp') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Whatsapp*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                <ui-phone  
                    name="whatsapp" 
                    value="{{ $configurations->whatsapp }}" 
                    required="true" 
                    class="form-control">
                </ui-phone>
                    @if ($errors->has('whatsapp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('whatsapp') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Número para contato*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                <ui-phone  
                    name="phone" 
                    value="{{ $configurations->phone }}" 
                    required="true" 
                    class="form-control">
                </ui-phone>
                    @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Email de apresentação*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="email" name="email" id="email"
                        value="{{ $configurations->email }}" required>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('instagram') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Instagram*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                <input  
                    name="instagram" 
                    value="{{ $configurations->instagram }}" 
                    required
                    type="url" 
                    class="form-control">
                    @if ($errors->has('instagram'))
                    <span class="help-block">
                        <strong>{{ $errors->first('instagram') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Facebook*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                <input  
                    name="facebook" 
                    value="{{ $configurations->facebook }}" 
                    required
                    type="url" 
                    class="form-control">
                    @if ($errors->has('facebook'))
                    <span class="help-block">
                        <strong>{{ $errors->first('facebook') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('linkedin') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Linkedin*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                <input  
                    name="linkedin" 
                    value="{{ $configurations->linkedin }}" 
                    required
                    type="url" 
                    class="form-control">
                    @if ($errors->has('linkedin'))
                    <span class="help-block">
                        <strong>{{ $errors->first('linkedin') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

			<div class="row form-group{{ $errors->has('form_email') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Email do formulário de contato*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="email" name="form_email" id="form_email"
                        value="{{ $configurations->form_email }}" required>
                    @if ($errors->has('form_email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('form_email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>            

            <div class="row form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Palavras-chave*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="keywords" id="keywords"
                        value="{{ $configurations->keywords }}">
                    @if ($errors->has('keywords'))
                    <span class="help-block">
                        <strong>{{ $errors->first('keywords') }}</strong>
                    </span>
                    @endif
                    <span class="help-block">
                        Separe as palavras-chave utilizando a vírgula
                    </span>
                </div>
            </div>

        </ui-form>
    </div>
</div>
@endsection