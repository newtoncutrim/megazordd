@extends('cms.layouts.page')
@section('content')
<div class="row">
	<div class="col-md-12">
		<ui-form form-class="form-horizontal" title="Atualizar Registro" token="{{ csrf_token() }}" url="{{ route('pages.update', $page->id) }}" cancel-url="{{ route('pages.index') }}" method="PUT">
			@if($errors->any())
			<div class="col-sm-12">
				<alert class="alert-danger" icon="fa-ban" title="Ops!" text="Não foi possível atualizar o registro, verifique os campos em destaque!">
				</alert>
			</div>
			@endif

			@if (in_array($page->id, [0]))
			<div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
				<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Status</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="checkbox" aria-label="Nome" name="active" id="active" value="1" {{$page->active == '1' ? 'checked' : ''}}> Ativo
					@if ($errors->has('active'))
					<span class="help-block">
						<strong>{{ $errors->first('active') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,1,2,3,4,5,6,7]))
			<div class="row form-group{{ $errors->has('location') ? ' has-error' : '' }}">
				<label for="location" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Localização</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="text" aria-label="Nome" name="location" class="PageDisable form-control" id="location" value="{{ $page->location }}" disabled>
					@if ($errors->has('location'))
					<span class="help-block">
						<strong>{{ $errors->first('location') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,1,3,4,5,6,7]))
			<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					@if (in_array($page->id, [3]))
					Razão Social
					@else
					Título
					@endif
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="text" aria-label="Nome" name="name" class="form-control" id="name" value="{{ $page->name }}" maxlength="250">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,3]))
			<div class="row form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
				<label for="cnpj" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					CNPJ
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<ui-mask-input type="text" mask="##.###.###/####-##" aria-label="CNPJ" name="cnpj" class="form-control" id="cnpj" value="{{ $page->cnpj }}"></ui-mask-input>
					@if ($errors->has('cnpj'))
					<span class="help-block">
						<strong>{{ $errors->first('cnpj') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,3]))
			<ui-states-and-cities pages="true" edit="{{$address}}"></ui-states-and-cities>

			@endif

			@if (in_array($page->id, [0,2]))
			<div class="row form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				<label for="phone" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					Telefone
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input aria-label="Telefone" name="phone" maxlength="30" minlength="9" type="text" class="form-control" id="phone" value="{{ $page->phone }}" />
					@if ($errors->has('phone'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,2]))
			<div class="row form-group{{ $errors->has('item') ? ' has-error' : '' }}">
				<label for="item" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					E-mail
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="text" aria-label="Nome" name="item" class="form-control" id="item" value="{{ $page->item }}" maxlength="300">
					@if ($errors->has('item'))
					<span class="help-block">
						<strong>{{ $errors->first('item') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,1,2,5,7]))
			<div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				<label for="description" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Descrição</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<textarea name="description" id="full_textarea" value="{{ $page->description }}">{{ $page->description }}</textarea>
					@if ($errors->has('description'))
					<span class="help-block">
						<strong>{{ $errors->first('description') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,1,4,5]))
			<div class="row form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem*</label>
				<div class="col-sm-10">
					<div class="row">
						@if(strlen($page->image) > 0)
						<div class="col-md-2 col-xs-4">
							<img src="{{ asset($page->image) }}" style="width:100%">
						</div>
						@endif
						<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
							<input type="file" name="image">
							<input type="hidden" aria-label="image" aria-label="Nome" name="old-image" value="{{ $page->image }}">
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
						Tamanho e formato recomendado: 800x600px JPG
					</span>
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,1]))
			<div class="row form-group{{ $errors->has('video') ? ' has-error' : '' }}">
				<label for="video" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					Link do YouTube
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="text" aria-label="video" name="video" class="form-control" id="video" value="{{ $page->video }}" maxlength="250">
					@if ($errors->has('video'))
					<span class="help-block">
						<strong>{{ $errors->first('video') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,3]))
			<div class="row form-group{{ $errors->has('instagram') ? ' has-error' : '' }}">
				<label for="instagram" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					Link do Instagram
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="url" aria-label="Instagram" name="instagram" class="form-control" id="instagram" value="{{ $page->instagram }}" maxlength="250">
					@if ($errors->has('instagram'))
					<span class="help-block">
						<strong>{{ $errors->first('instagram') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,3]))
			<div class="row form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
				<label for="facebook" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					Link do Facebook
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="url" aria-label="Facebook" name="facebook" class="form-control" id="facebook" value="{{ $page->facebook }}" maxlength="250">
					@if ($errors->has('facebook'))
					<span class="help-block">
						<strong>{{ $errors->first('facebook') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif

			@if (in_array($page->id, [0,3]))
			<div class="row form-group{{ $errors->has('whatsapp') ? ' has-error' : '' }}">
				<label for="whatsapp" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">
					Link do Whatsapp
				</label>
				<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
					<input type="url" aria-label="Whatsapp" name="whatsapp" class="form-control" id="whatsapp" value="{{ $page->whatsapp }}" maxlength="250">
					@if ($errors->has('whatsapp'))
					<span class="help-block">
						<strong>{{ $errors->first('whatsapp') }}</strong>
					</span>
					@endif
				</div>
			</div>
			@endif
		</ui-form>
	</div>
</div>
@endsection