@extends('cms.layouts.page')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ui-form form-class="form-horizontal" title="Atualizar Registro" token="{{ csrf_token() }}"
            url="{{ route('products.update', $product->id) }}" cancel-url="{{ route('products.index') }}" method="PUT">
            @if($errors->any())
            <div class="col-sm-12">
                <alert class="alert-danger" icon="fa-ban" title="Ops!"
                    text="Não foi possível atualizar o registro, verifique os campos em destaque! {{$errors}}">
                </alert>
            </div>
            @endif

            
{{--             <div class="row form-group{{ $errors->has('active') ? ' has-error' : '' }}">
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
            </div>  --}}
            <div class="row form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
              <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Sub Categoria</label>
              <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                  <select name="sub_category_id" id="sub_category_id" class="form-control">
                      <option value="">Selecione uma categoria</option>
                      @foreach ($subcategories as $category)
                          <option value="{{ $category->id }}" {{ $product->subCategory->id == $category->id ? 'selected' : '' }}>
                              {{ $category->name }}
                          </option>
                      @endforeach
                  </select>
                  @if ($errors->has('sub_category_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('sub_category_id') }}</strong>
                  </span>
                  @endif
              </div>
          </div>
          
           
            <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Titulo</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="title" id="title" value="{{ $product->title }}">
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

{{--             <div class="row form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Lead</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="lead" id="lead" value="{{ $product->lead }}">
                    @if ($errors->has('lead'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lead') }}</strong>
                    </span>
                    @endif
                </div>
            </div> --}}
           
            <div class="row form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                <label for="order" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Ordem*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input type="number" name="order" aria-label="Nome" class="form-control" id="order"
                        value="{{ $product->order }}" maxlength="200" required>
                    @if ($errors->has('order'))
                    <span class="help-block">
                        <strong>{{ $errors->first('order') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

{{--             <div class="row form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Link</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <input class="form-control" aria-label="Nome" type="text" name="link" id="link" value="{{ $product->link }}">
                    @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                    @endif
                </div>
            </div> --}}
            
            <div class="row form-group{{ $errors->has('descriptive') ? ' has-error' : '' }}">
                <label for="descriptive" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Descritivo</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <ui-textarea name="descriptive" id="full_textarea" value="{{ $product->descriptive }}">{{ $product->descriptive }}
                    </ui-textarea>
                    @if ($errors->has('descriptive'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descriptive') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Descrição</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <textarea name="description" id="tiny" value="{{ $product->description }}">{{ $product->description }}
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
                    <div class="row">
                        @if (strlen($product->image) > 0)
                         {{--  {{asset($product->image)}} --}}
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

                <div class="row form-group{{ $errors->has('gallery') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Imagem*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <div class="row">
                      @if (!empty($photoGallery))
                      {{-- http://localhost:82/storage/products/gallery/2bfbC72uYQ51jWK41mlXOFOvE63ZTWeZ6JEJVkRB.webp --}}
                        @foreach ($photoGallery as $file)
                       {{--  {{asset($file)}} --}}
                            <div class="col-md-2 col-xs-4 mb-3">
                              <img src="{{ asset($file) }}" style="width:100%">
                            </div>
                        @endforeach
                      @endif
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                          <input name="gallery[]" type="file">
                          <input aria-label="Nome" aria-label="Nome" name="old-gallery" type="hidden"
                            value="{{ $product->gallery }}">
                          <span class="help-block">
                            Para manter a imagem atual, não preencha esse campo
                          </span>
                          @if ($errors->has('gallery'))
                            <span class="help-block">
                              <strong>{{ $errors->first('gallery') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    <span class="help-block">
                        JPG ou PNG
                    </span>
                </div>

                <div class="row form-group{{ $errors->has('attachments_pdfs') ? ' has-error' : '' }}">
                <label class="col-xl-2 col-lg-2 col-sm-2 col-12 text-lg-right text-sm-left">Anexo Pdf*</label>
                <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                    <div class="row">
                          @if (!empty($pdfs))
                            @foreach ($pdfs as $file)
                              <div class="col-md-2 col-xs-4 mb-3">
                                <embed src="{{ asset($file) }}" type="application/pdf" style="width:100%; height:200px;">
                              </div>
                            @endforeach
                          @endif
                        <div class="col-xl-10 col-lg-10 col-sm-10 col-12">
                          <input name="attachments_pdfs[]" type="file">
                          <input aria-label="Nome" aria-label="Nome" name="old-attachments_pdfs" type="hidden"
                            value="{{ $product->attachments_pdfs }}">
                          <span class="help-block">
                            Para manter os pdfs atuais, não preencha esse campo
                          </span>
                          @if ($errors->has('attachments_pdfs'))
                            <span class="help-block">
                              <strong>{{ $errors->first('attachments_pdfs') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    <span class="help-block">
                        PDF ou DOC
                    </span>
                </div>
            </div>
        </div>
    </ui-form>
</div>
</div>
@endsection