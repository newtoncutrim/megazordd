@extends('cms.layouts.page')

@section('content')
		<div class="row">
			<div class="col-md-12">
				<ui-form
					form-class="form-horizontal"
					title="Atualizar Registro"
					token="{{ csrf_token() }}"
					url="{{ route($model.'.images.update', [$model_id, $item->id]) }}"
					cancel-url="{{ route($model.'.images.index', $model_id) }}"
					method="PUT"
					:has-error="{{ session()->has('errors') ? 'true' : 'false'}}">

						<images-form
						:errors="{{ session()->has('errors') ? session()->get('errors') : '{}' }}"
						:values="{{ json_encode($item) }}"
						></images-form>
				</ui-form>
			</div>
		</div>

@endsection