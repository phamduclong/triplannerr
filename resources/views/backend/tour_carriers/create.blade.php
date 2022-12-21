@extends('backend.layouts.app')

@section('title', __('labels.backend.access.tour_carriers.management') . ' | ' . __('labels.backend.access.tour_carriers.create'))

@section('breadcrumb-links')
    @include('backend.tour_carriers.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.tour_carriers.store1'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.tour_carriers.management')
                            <small class="text-muted">@lang('labels.backend.access.tour_carriers.create')</small>
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
                                    $icon_type = ['' => 'Select graphics type', 'Icon' => 'Icon', 'Image' => 'Image'];
                                @endphp

                                {{ html()->select('graphic_type')
                                    ->class('form-control')
                                    ->options($icon_type)
                                    ->attribute('onChange', 'laod_graphic_container(this)')
                                }}
                                <!-- <select required class="form-control" name="graphic_type" id="graphic_type_id" onchange="selectFile(this.value)">
                                    <option value="">-Select-</option>
                                    <option value="Icon">Icon</option>
                                    <option value="Image">Image</option>
                                </select> -->
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row" id="tour_carriers_file">
                        </div>

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

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.tour_carriers'), __('buttons.general.cancel')) }}
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
        $('#tour_carriers_file').html('');
         function laod_graphic_container(obj){

            var content_value = $(obj).val();
            if(content_value == 'Icon'){
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="content">Graphic Icon</label>                            <div class="col-md-10">                                <input class="form-control" type="text" name="content" id="content" placeholder="Graphic Icon" maxlength="191">                            </div>');
            }
            else if(content_value == 'Image'){
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Image</label>                            <div class="col-md-10">                  <input type="file" name="carrier_file_name">                            </div>');
            }
            else{
                $('#tour_carriers_file').html('');
            }
        }
    </script>
@endsection
