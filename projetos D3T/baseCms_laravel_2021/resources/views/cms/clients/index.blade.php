@extends('cms.layouts.page')

@section('content')
<div class="row">
    <div class="col-md-12">
        <tabs :tabs="[
					{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
				]" active-tab="0">
            <data-table slot="tabslot_0" title="Lista de Registros" busca="{{$busca}}" url="{{ $data['request']->url() }}" token="{{ csrf_token() }}" :items="{{ json_encode($items) }}" :titles="{{$titles}}" :actions="{{ $actions }}" :not-deletable="true" busca="{{$busca}}" :show-busca="true">
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

        </tabs>
    </div>
</div>

@endsection