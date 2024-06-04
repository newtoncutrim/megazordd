@extends('cms.layouts.page')

@section('content')
		<div class="row">
			<div class="col-md-12">

				<tabs
					:tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
					{'icon' : 'fa fa-plus', 'title' : 'Adicionar Registro', 'active' : false}
					]"
					active-tab="{{$errors->any() ? 1 : 0}}"
          >

					<data-table 
						slot="tabslot_0"
						title="Lista de Registros"
						url="{{ $data['request']->url() }}"
						token="{{ csrf_token() }}"
						:items="{{ json_encode($items) }}"
						:titles="{{$titles}}"
						:actions="{{ $actions }}"
						:not-deletable="false"
						>
						@if(session()->has('message'))
						<div class="row">
							<div class="col-sm-12">
								<alert
								class="alert-success"
								icon="fa-check"
								text="{{ session()->get('message') }}">
								</alert>
							</div>
						</div>
						@endif
						<span slot="pagination" class="pull-right">
							{{ $items->links() }}
						</span>

						</data-table>

					<div slot="tabslot_1">

			      <file-upload
							endpoint="{{ $_SERVER['REQUEST_URI'] }}"
							accept="image/*"
						></file-upload>
						@if($errors->any())
							<div class="row">
								<div class="col-sm-12">
									<alert
									class="alert-danger"
									icon="fa-ban"
									title="Ops!"
									text="Não foi possível adicionar o registro, verifique os campos em destaque!">
									</alert>
								</div>
							</div>
						@endif
		      </div>
				</tabs>
			</div>
		</div>

@endsection
