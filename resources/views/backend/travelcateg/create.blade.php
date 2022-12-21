@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travelcateg.create-travel'))

@section('breadcrumb-links')
    @include('backend.travelcateg.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->form('POST', route('admin.travelcateg.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}

<div class="card">
<div class="card-body">

    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                @lang('labels.backend.access.travelcateg.travelcategs')
                <small class="text-muted">
                    @lang('labels.backend.access.travelcateg.create-travel')
                </small>
            </h4>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4 mb-4">
        <div class="col">

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.travel-categ.name'))->class('col-md-2 form-control-label')->for('name') }}
                    <div class="col-md-10">
                        {{ html()->text('name')
                         ->class('form-control')
                         ->placeholder(__('validation.attributes.backend.access.travel-categ.name'))
                         ->attribute('maxlength', 191)
                         ->required()
                         ->autofocus() }}
                    </div><!--col-->
            </div><!--form-group-->
             @php
                $graphic_type_arr = [''=>'Select Category Type', 'icon'=>'Icon', 'image'=>'Image'];
             @endphp
            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.travel-categ.graphic_type'))->class('col-md-2 form-control-label')->for('graphic_type') }}
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

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.travel-categ.description'))->class('col-md-2 form-control-label')->for('description') }}
                    <div class="col-md-10">
                        {{ html()->textarea('description')
                         ->class('form-control')
                         ->placeholder(__('validation.attributes.backend.access.travel-categ.description'))
                         ->attribute('maxlength', 191)
                         ->required() }}
                    </div><!--col-->
            </div><!--form-group-->



            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.travel-categ.meta-title'))->class('col-md-2 form-control-label')->for('meta-title') }}
                        <div class="col-md-10">
                            {{ html()->text('meta_title')
                             ->class('form-control')
                              ->placeholder(__('validation.attributes.backend.access.travel-categ.meta-title'))
                              ->attribute('maxlength', 191)
                             ->required()
                             ->autofocus() }}
                        </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.travel-categ.meta-description'))->class('col-md-2 form-control-label')->for('meta-description') }}
                    <div class="col-md-10">
                        {{ html()->text('meta_description')
                         ->class('form-control')
                         ->placeholder(__('validation.attributes.backend.access.travel-categ.meta-description'))
                         ->attribute('maxlength', 191)
                         ->required()
                         ->autofocus() }}
                    </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.travel-categ.meta-keyword'))->class('col-md-2 form-control-label')->for('meta-keyword') }}
                    <div class="col-md-10">
                        {{ html()->text('meta_keyword')
                         ->class('form-control')
                         ->placeholder(__('validation.attributes.backend.access.travel-categ.meta-keyword'))
                         ->attribute('maxlength', 191)
                         ->required()
                         ->autofocus() }}
                    </div><!--col-->
            </div><!--form-group-->
        </div>
    </div>
</div>

<div class="card-footer clearfix">
    <div class="row">
        <div class="col">
            {{ form_cancel(route('admin.travelcateg'), __('buttons.general.cancel')) }}
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
       $('#categ_content_id').html('<label class="col-md-2 form-control-label" for="content">Graphic Content</label><div class="col-md-10"><input class="form-control" type="text" name="graphic_content" placeholder="Travel Category Content" maxlength="191"></div>');
    }
    else if(content_value == 'image'){
      $('#categ_content_id').html('<label class="col-md-2 form-control-label" for="file_name">Image</label><div class="col-md-10"><input type="file" name="graphic_content"></div>');
    }
    else{
      $('#categ_content_id').html('');
    }
 }
</script>