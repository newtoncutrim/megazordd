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
			<data-table slot="tabslot_0" title="Lista de Registros" url="{{ $data['request']->url() }}" token="{{ csrf_token() }}" :items="{{ json_encode($items) }}" :titles="{{$titles}}" :actions="{{ $actions }}" :not-deletable="false" busca="{{$busca}}" :show-busca="true">
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
				<ui-form form-class="form-horizontal" title="Adicionar Registro" token="{{ csrf_token() }}" url="{{ route('blog_posts.store') }}" method="POST">
					@if($errors->any())
					<div class="row">
						<div class="col-sm-12">
							<alert class="alert-danger" icon="fa-ban" title="Ops!" text="Não foi possível adicionar o registro, verifique os campos em destaque!">
							</alert>
						</div>
					</div>
					@endif
					<div class="form-group">
						<div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
							<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Status</label>
							<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
								<input type="checkbox" aria-label="Nome" name="active" id="active" value="1" {{old('active') ? (old('active') ? 'checked' : '') : 'checked'}}> Ativo
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
								<input type="checkbox" aria-label="Nome" name="highlight" id="highlight" value="1" {{old('highlight') ? (old('highlight') ? 'checked' : '') : 'checked'}}> Ativo
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
								<ui-select :options='{{json_encode($categoryList)}}' selected="{{ old('blog_category_id') }}" :required="true" id="blog_category_id" name="blog_category_id" class="category">
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
						<div>
							<div class="row form-group{{ $errors->has('date') ? ' has-error' : '' }}">
								<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Agendamento</label>
								<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
									<input placeholder="Data e Hora" class="mouse-alter datepicker mb-md-0 mb-2 form-control" value="{{ old('date') }}" name="date" id="inputDate">
									@if ($errors->has('date'))
									<span class="help-block">
										<strong>{{ $errors->first('date') }}</strong>
									</span>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Título*</label>
						<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
							<input class="form-control" aria-label="Título" type="text" required name="name" id="name" value="{{ old('name') }}" maxlength="250">
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
							<input class="form-control" aria-label="Nome" type="text" required name="user" id="user" value="{{ old('user') }}">
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
							<input class="form-control" aria-label="Subtítulo" type="text" name="lead" id="lead" value="{{ old('lead') }}" maxlength="200">
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
							<textarea url="{{ route('upload-images') }}" name="description" id="full_textarea" value="{{ old('description') }}">
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
						<div class="col-xl-10 col-lg-10 col-sm-10 col-12">
							<input type="file" aria-label="Nome" name="image" required>
							@if ($errors->has('image'))
							<span class="help-block">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
							@endif
							<span class="help-block">
								Tamanho e formato recomendado: 800x450px JPG
							</span>
						</div>
					</div>
				</ui-form>
			</div>
		</tabs>
	</div>
</div>

@endsection