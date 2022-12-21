@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.services.create-service'))

@section('breadcrumb-links')
    @include('backend.services.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->form('POST', route('admin.services.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          @lang('labels.backend.access.services.service')
            <small class="text-muted"> @lang('labels.backend.access.services.create-service')
            </small>
        </h4>
      </div><!--col-->
    </div><!--row-->

    <div class="row mt-4 mb-4">
      <div class="col">
        <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.service.title'))->class('col-md-2 form-control-label')->for('title') }}
            <div class="col-md-10">
             <!--  <input type="text" name="title" class="form-control"/> -->
             {{ html()->text('title')
                   ->class('form-control')
                   ->placeholder(__('validation.attributes.backend.access.service.title'))
                   ->attribute('maxlength', 191)
                   ->required()
                   ->autofocus() }}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.service.page_description'))->class('col-md-2 form-control-label')->for('page_description') }}
            <div class="col-md-10">
             <!--  <textarea name="page_description" class="form-control"> -->
              {{ html()->textarea('page_description')
                   ->class('form-control')
                   ->placeholder(__('validation.attributes.backend.access.service.page_description'))
                   ->attribute('maxlength', 191)
                   ->required() }}
              </textarea>
            </div><!--col-->
        </div><!--form-group-->

        @php
        $graphic_type_arr = [''=>'Select Type', 'icon'=>'Icon', 'image'=>'Image'];
        @endphp
        <div class="form-group row">
          {{ html()->label(__('validation.attributes.backend.access.service.graphic_type'))->class('col-md-2 form-control-label')->for('graphic_type') }}
              <div class="col-md-10">
                {{ html()->select('graphic_type')
                    ->class('form-control')
                    ->options($graphic_type_arr)
                    ->attribute('onchange', 'load_graphic_content(this.value)')
                    ->required()
                }}
              </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row" id="categ_content_id">
        </div><!--form-group-->

      </div>
    </div>
  </div>

  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        {{ form_cancel(route('admin.services'), __('buttons.general.cancel')) }}
      </div><!--col-->
      <div class="col text-right">
        {{ form_submit(__('buttons.general.crud.create')) }}
      </div><!--col-->
    </div><!--row-->
  </div><!--card-footer-->
</div>
{{ html()->form()->close() }}
@endsection

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script>
  function load_graphic_content(content_value){
    if(content_value == 'icon'){
       $('#categ_content_id').html('<label class="col-md-2 form-control-label" for="content">Graphic Content</label><div class="col-md-10"><input class="form-control" type="text" name="graphic_content" placeholder="Graphic Content" maxlength="191"></div>');
    }
    else if(content_value == 'image'){
      $('#categ_content_id').html('<label class="col-md-2 form-control-label" for="file_name">Image</label><div class="col-md-10"><input type="file" name="graphic_content"></div>');
    }
    else{
      $('#categ_content_id').html('');
    }
 }
</script>