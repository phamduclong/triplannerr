@extends('backend.layouts.app')

@section('title', __('Travel vector management') . ' | ' . __('Create travel vector'))

@section('breadcrumb-links')
    @include('backend.travel_vectors.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.travel_vectors.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{__('Costs Type management')}}
                            <small class="text-muted">{{__('Create travel vector')}}</small>
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
                                     ->required()
                                 }}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.travel_vectors'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#travel_vectors_file').html('');
         function laod_graphic_container(obj){

            var content_value = $(obj).val();
            if(content_value == 'Icon'){
                $('#travel_vectors_file').html('<label class="col-md-2 form-control-label" for="content">Graphic Icon</label>                            <div class="col-md-10">                                <input class="form-control" type="text" name="content" id="content" placeholder="Graphic Icon" maxlength="191">                            </div>');
            }
            else if(content_value == 'Image'){
                $('#travel_vectors_file').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Image</label>                            <div class="col-md-10">                  <input type="file" name="carrier_file_name">                            </div>');
            }
            else{
                $('#travel_vectors_file').html('');
            }
        }
    </script>
@endsection
