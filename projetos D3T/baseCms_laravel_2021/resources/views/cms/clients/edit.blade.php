@extends('cms.layouts.page')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ui-form form-class="form-horizontal" title="Atualizar Registro" token="{{ csrf_token() }}" url="{{ route('clients.update', $clients->id) }}" cancel-url="{{ route('clients.index') }}" method="PUT">
            @if($errors->any())
            <div class="col-sm-12">
                <alert class="alert-danger" icon="fa-ban" title="Ops!" text="Não foi possível atualizar o registro, verifique os campos em destaque!">
                </alert>
            </div>
            @endif

            <div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                <label class="col-xl-1 col-lg-1 col-sm-1 col-12 text-lg-right text-sm-left">Status</label>
                <div class="col-xl-11 col-lg-11 col-sm-11 col-12">
                    <input type="checkbox" aria-label="Nome" name="active" id="active" value="1" {{$clients->active == '1' ? 'checked' : ''}}> Ativo
                    @if ($errors->has('active'))
                    <span class="help-block">
                        <strong>{{ $errors->first('active') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group">
                @foreach ($inputs as $key => $item)
                <label class="col-xl-1 col-lg-1 col-sm-1 col-12 text-lg-right text-sm-left">{{$key}}</label>
                <div class="col-xl-5 col-lg-5 col-sm-5 col-12">
                    <input type="text" class="form-control" aria-label="{{$key}}" disabled value="{{$item}}">
                </div>
                @endforeach
            </div>
    </div>
    </ui-form>
</div>
</div>
@endsection