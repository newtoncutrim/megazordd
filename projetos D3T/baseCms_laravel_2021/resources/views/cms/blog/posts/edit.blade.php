@extends('cms.layouts.page')

@section('content')
<div class="row">
	<div class="col-md-12">
		<ui-form form-class="form-horizontal" title="Atualizar Registro" token="{{ csrf_token() }}" url="{{ route('blog_posts.update', $blog->id) }}" cancel-url="{{ route('blog_posts.index') }}" method="PUT">
			@if($errors->any())
			<div class="col-sm-12">
				<alert class="alert-danger" icon="fa-ban" title="Ops!" text="Não foi possível atualizar o registro, verifique os campos em destaque!">
				</alert>
			</div>
			@endif
			<div class="form-group">
				<div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
					<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Status</label>
					<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
						<input type="checkbox" aria-label="Nome" name="active" id="active" value="1" {{$blog->active == '1' ? 'checked' : ''}}> Ativo
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
						<input type="checkbox" aria-label="Nome" name="highlight" id="highlight" value="1" {{$blog->highlight == '1' ? 'checked' : ''}}> Ativo
						@if ($errors->has('highlight'))
						<span class="help-block">
							<strong>{{ $errors->first('highlight') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="row {{ $errors->has('blog_category_id') ? ' has-error' : '' }}">
					<label for="image" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Categoria*</label>
					<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
						<ui-select :options='{{json_encode($categoryList)}}' selected="{{$blog->blog_category_id}}" :required="true" id="blog_category_id" name="blog_category_id" class="category">
						</ui-select>
						@if ($errors->has('blog_category_id'))
						<span class="help-block">
							<strong>{{ $errors->first('blog_category_id') }}</strong>
						</span>
						@endif
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row form-group{{ $errors->has('date') ? ' has-error' : '' }}">
					<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Agendamento</label>
					<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
						<input placeholder="Data e Hora" class="mouse-alter datepicker mb-md-0 mb-2 form-control" value="{{ $blog->date . ' ' . $blog->time }}" name="date" id="inputDate">
						@if ($errors->has('date'))
						<span class="help-block">
							<strong>{{ $errors->first('date') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Título*</label>
					<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
						<input class="form-control" aria-label="Título" type="text" required name="name" value="{{$blog->name}}" id="name" maxlength="150">
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
						<span class="help-block">
							Máximo de 150 caracteres
						</span>
					</div>
				</div>
				<div class="row form-group{{ $errors->has('user') ? ' has-error' : '' }}">
					<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Autor*</label>
					<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
						<input class="form-control" aria-label="Nome" type="text" required name="user" id="user" value="{{ $blog->user }}">
						@if ($errors->has('user'))
						<span class="help-block">
							<strong>{{ $errors->first('user') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="row form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
					<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Subtítulo</label>
					<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
						<input class="form-control" aria-label="Subtítulo" type="text" name="lead" value="{{$blog->lead}}" id="lead" maxlength="200">
						@if ($errors->has('lead'))
						<span class="help-block">
							<strong>{{ $errors->first('lead') }}</strong>
						</span>
						@endif
						<span class="help-block">
							Máximo de 200 caracteres
						</span>
					</div>
				</div>
				<div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
					<label for="description" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Conteúdo*</label>
					<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
						<textarea name="description" id="full_textarea" value="{{ $blog->description }}">{{ $blog->description }}
						</textarea>
						@if ($errors->has('description'))
						<span class="help-block">
							<strong>{{ $errors->first('description') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="row form-group{{ $errors->has('image') ? ' has-error' : '' }}">
					<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem*</label>
					<div class="col-sm-10">
						<div class="row">
							@if(strlen($blog->image) > 0)
							<div class="col-md-2 col-xs-4">
								<img src="{{ asset($blog->image) }}" style="width:100%">
							</div>
							@endif
							<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
								<input type="file" name="image">
								<input type="hidden" aria-label="Nome" aria-label="Nome" name="old-image" value="{{ $blog->image }}">
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
							Tamanho e formato recomendado: 800x450px JPG
						</span>
					</div>
				</div>
				
		</ui-form>
	</div>
</div>
@endsection