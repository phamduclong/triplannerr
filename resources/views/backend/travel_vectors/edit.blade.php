@extends('backend.layouts.app')

<!-- @section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit')) -->
@section('title', app_name() . ' | ' . __('Edit travel vector'))

@section('breadcrumb-links')
    @include('backend.travel_vectors.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($travel_vector, 'PATCH', route('admin.travel_vectors.update', $travel_vector->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                    @lang('Costs Type management')
                        <small class="text-muted">{{__('Edit travel vector')}}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

           <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('Name'))->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder(__('Travel vector name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                        {{ html()->label(__('Parent'))->class('col-md-2 form-control-label')->for('parent') }}

                            <div class="col-md-10">
                               {{ html()->select('parent_id')
                                     ->class('form-control')
                                     ->id('parent_id')
                                     ->options(['' => 'Select parent']+$travel_vectors)
                                     ->attribute('onchange', 'load_graphic_content(this.value)')
                                     ->value($travel_vector->parent_id)
                                 }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                        {{ html()->label(__('Vecto type'))->class('col-md-2 form-control-label')->for('vector_type') }}
                            @php
                            $vector_types = [
                                ''               => 'Select vector type',
                                'overnight_stays'=> 'Overnight Stays',
                                'meals'          => 'Meals',
                                'fun_extras'     => 'Fun / Extras',
                                'guide'          => 'Touristic Guide',
                                'travel'         => 'Travel Vector'    
                            ];
                            @endphp
                            <div class="col-md-10">
                               {{ html()->select('vector_type')
                                     ->class('form-control')
                                     ->id('vector_type')
                                     ->options($vector_types)
                                     ->value($travel_vector->vector_type)
                                     ->required()
                                 }}
                            </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.travel_vectors'), __('buttons.general.cancel')) }}
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
