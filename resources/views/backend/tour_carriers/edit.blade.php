@extends('backend.layouts.app')

<!-- @section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit')) -->
@section('title', app_name() . ' | ' . __('labels.backend.access.tour_carriers.edit-travel'))
@section('breadcrumb-links')
    @include('backend.tour_carriers.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($data, 'PATCH', route('admin.tour_carriers.update', $data->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                    @lang('labels.backend.access.tour_carriers.management')
                        <small class="text-muted">@lang('labels.backend.access.tour_carriers.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

           <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.tour_carriers.title'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.tour_carriers.title'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.tour_carriers.graphic_type'))->class('col-md-2 form-control-label')->for('graphic_type') }}

                            <div class="col-md-10">
                            @php
                            $graphic_type_arr = [''=>'Select Category Type', 'icon'=>'Icon', 'image'=>'Image'];
                            @endphp

                               {{ html()->select('graphic_type')
                                     ->class('form-control')
                                     ->id('graphic_type_id')
                                     ->options($graphic_type_arr)
                                     ->attribute('onchange', 'load_graphic_content(this.value)')
                                     ->value($data->graphic_type)
                                     ->required()
                                 }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row" id="categ_content_id">
                            @if($data->graphic_type == 'image')
                                {{ html()->label(__('validation.attributes.backend.access.tour_carriers.graphic_image'))->class('col-md-2 form-control-label')->for('file_name') }}
                                    <div class="col-md-10">
                                        <input type="file" name="carrier_file_name">
                                    </div><!--col-->
                            @else
                                {{ html()->label(__('validation.attributes.backend.access.tour_carriers.graphic_icon'))->class('col-md-2 form-control-label')->for('content') }}

                                <div class="col-md-10">
                                    {{ html()->text('content')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.tour_carriers.graphic_icon'))
                                        ->attribute('maxlength', 191)
                                        ->value($data->graphic_content)
                                        }}
                                </div><!--col-->
                            @endif
                        </div><!--form-group-->

                    @if($data->graphic_type == 'image')
                        <div class="form-group row" id="categ_file_id">
                        {{ html()->label(__('validation.attributes.backend.access.tour_carriers.graphic_image'))->class('col-md-2 form-control-label')->for('file_name') }}
                            <div class="col-md-10">
                              <img src="{{ url('/img/backend/tour_carriers/image/').'/'.$data->graphic_content }}" width="50px" height="50px">
                            </div><!--col-->
                        </div><!--form-group-->

                        @else

                        <div class="form-group row" id="categ_file_id">
                            {{ html()->label(__('validation.attributes.backend.access.tour_carriers.graphic_icon'))->class('col-md-2 form-control-label')->for('content') }}

                            <div class="col-md-10">
                               <i class="{{$data->graphic_content}}" aria-hidden="true" style="font-size: 50px;"></i>
                            </div><!--col-->
                        </div><!--form-group-->

                       @endif

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.tour_carriers.description'))->class('col-md-2 form-control-label')->for('description') }}

                            <div class="col-md-10">
                                {{ html()->textarea('description')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.tour_carriers.description'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.tour_carriers'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}

<script>
function load_graphic_content(content_value){
    $('#categ_file_id').hide();
if(content_value == 'icon'){
   $('#categ_content_id').html('<label class="col-md-2 form-control-label" for="content">Graphic Content</label><div class="col-md-10"><input class="form-control" type="text" name="content" placeholder="Travel Category Content" maxlength="191"></div>');
}
else if(content_value == 'image'){
  $('#categ_content_id').html('<label class="col-md-2 form-control-label" for="file_name">Image</label><div class="col-md-10"><input type="file" name="carrier_file_name"></div>');
}
else{
  $('#categ_content_id').html('');
}
}
</script>
@endsection
