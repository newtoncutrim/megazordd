@extends('cms.layouts.page')
@section('content')
<div class="row">
	<div class="col-md-12">
		<tabs :tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de seções', 'active' : false},
					]" active-tab="{{$errors->any() ? 1 : 0}}">
			<data-table slot="tabslot_0" title="Lista de seções" busca="{{$busca}}" url="{{ $data['request']->url() }}" token="{{ csrf_token() }}" :not-deletable="false" :items="{{ json_encode($leads) }}" :titles="{{$titles}}">
				@if(session()->has('message'))
				<div class="row">
					<div class="col-sm-12">
						<alert class="alert-success" icon="fa-check" text="{{ session()->get('message') }}">
						</alert>
					</div>
				</div>
				@endif
			</data-table>
		</tabs>
	</div>
</div>
@endsection