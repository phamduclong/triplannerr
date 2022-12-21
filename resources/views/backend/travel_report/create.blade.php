@extends('backend.layouts.app')

@section('title', __('labels.backend.access.travel_report.management') . ' | ' . __('labels.backend.access.travel_report.create'))

@section('breadcrumb-links')
    @include('backend.travel_report.includes.breadcrumb-links')
@endsection

@section('content')
<style>
  .col-md-3 {
    max-width: 30%;
    float: left;
}
</style>
    {{ html()->form('POST', route('admin.travel_report.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.travel_report.management')
                            <small class="text-muted">@lang('labels.backend.access.travel_report.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.title'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.title'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.category_id'))->class('col-md-2 form-control-label')->for('category_id') }}

                            <div class="col-md-10">
                                <select name="category_id" class="form-control">
                                   @foreach ($categories as $categories_name)
                                        <option value="{{ $categories_name->id}}">{{$categories_name->name}} </option>
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.report_date'))->class('col-md-2 form-control-label')->for('report_date') }}

                            <div class="col-md-5">
                                <p>Trip Start</p>
                                {{ html()->date('report_startdate')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.trip_start'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->

                            <div class="col-md-5">
                                <p>Trip End</p>
                                {{ html()->date('report_enddate')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.trip_end'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.travel_report.report_country'))->class('col-md-2 form-control-label')->for('report_country') }}
                            <div class="col-md-5">
                              <p>Country of Departure</p>
                                {{ html()->select('country_departure')
                                    ->class('form-control')
                                    ->options($countriesArr)
                                }}
                            </div><!--col-->

                            <div class="col-md-5">
                              <p>Country of Destination</p>
                                {{ html()->select('country_destination')
                                    ->class('form-control')
                                    ->options($countriesArr)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.travel_report.no_of_participants'))->class('col-md-2 form-control-label')->for('total_travel_time') }}
                           <div class="col-md-10">
                            {{ html()->number('no_of_participants')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.no_of_participants'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.travel_time'))->class('col-md-2 form-control-label')->for('travel_time') }}

                            <div class="col-md-10">
                                {{ html()->number('travel_time')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.travel_time'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.total_cost_of_trip'))->class('col-md-2 form-control-label')->for('travel_time') }}

                            <div class="col-md-10">
                            {{ html()->number('total_cost_of_trip')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.travel_report.total_cost_of_trip'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.currency'))->class('col-md-2 form-control-label')->for('travel_time') }}

                            <div class="col-md-10">
                            {{ Form::select('currency_id', $currency_arr, null, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.no_of_carriers'))->class('col-md-2 form-control-label')->for('no_of_carriers') }}

                             <div class="col-md-10">
                             {{ html()->number('no_of_carries')
                                        ->class('form-control')
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                            </div>
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.frontend.travel_report.option'))->class('col-md-2 form-control-label') }}
                              <div class="col-md-10">
                                       <div class="col-md-3">
                                        <div class="input-sec">
                                       <input type="radio" name="report_option" value="report" checked>Travel Report
                                       </div>
                                       </div>
                                       {{-- <div class="col-md-3">
                                        <div class="input-sec">
                                       <input type="radio" name="report_option" value="diary">Travel Report with Diary
                                       </div>
                                       </div> --}}
                                       <div class="col-md-3">
                                        <div class="input-sec">
                                       <input type="radio" name="report_option" value="offer">Travel Report with Travel Offert
                                      </div> </div>
                              </div>
                        </div>


                                <div class="form-group row">
                                    <!-- <div class="form-group senti-list"> -->
                                        {{ html()->label(__('validation.attributes.frontend.travel_report.security_option'))->class('col-md-2 form-control-label') }}
                                        <div class="col-md-10">
                                           <div class="col-md-3">
                                                <div class="input-sec">
                                                        <input type="radio" name="security_option" value="private">Private
                                                </div>
                                           </div>
                                           <div class="col-md-3">
                                                <div class="input-sec">
                                                    <input type="radio" name="security_option" value="limited">Public
                                                </div>
                                           </div>
                                           <div class="col-md-3">
                                                <div class="input-sec">
                                                    <input type="radio" name="security_option" value="reserved">Reserved
                                                </div>
                                          </div>
                                       </div>
                                    <!-- </div> -->
                                </div>

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.description'))->class('col-md-2 form-control-label')->for('description') }}

                            <div class="col-md-10">
                                {{ html()->textarea('description')
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.cover_photo'))->class('col-md-2 form-control-label')->for('cover_photo') }}

                            <div class="col-md-10">
                                {{ html()->file('cover_photo')
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div id="data_grid_row">
                            <div class="form-group row">
                                    {{ html()->label(__('validation.attributes.backend.access.travel_report.data_grid'))->class('col-md-2 form-control-label')->for('data_grid') }}

                                <div class="col-md-3">
                                   <label>Cost Summary</label>
                                   {{ html()->text('component_name[]')
                                    ->class('form-control')
                                    ->required() }}
                                </div><!--col-->


                                <div class="col-md-3">
                                    <label>Individual Costs</label>
                                    {{ html()->number('component_cost[]')
                                        ->class('form-control')
                                        ->required() }}
                                </div><!--col-->

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Total Cost</label>
                                       {{ html()->number('total_cost[]')
                                            ->class('form-control')
                                            ->required() }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="gallery_row">
                            <div class="form-group row">
                                    {{ html()->label(__('validation.attributes.backend.access.travel_report.gallery_image'))->class('col-md-2 form-control-label')->for('gallery_image') }}

                                <div class="col-md-2">
                                    {{ html()->file('gallery_photo[]')
                                        ->attribute('accept','image/jpg')
                                        ->required()
                                        ->autofocus()
                                    }}
                                </div><!--col-->

                                <div class="col-md-2">
                                   {{ html()->text('gallery_caption[]')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.travel_gallery_caption'))
                                    ->required() }}
                                </div><!--col-->

                                 <div class="col-md-2">
                                     {{ html()->text('location_of_shot[]')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.travel_report.travel_gallery_location'))
                                        ->required() }}
                                </div><!--col-->


                                <div class="col-md-2">
                                     {{ html()->number('sorting_in_gallery[]')
                                            ->class('form-control')
                                            ->attribute('min','1')
                                            ->attribute('max','5')
                                            ->placeholder(__('validation.attributes.backend.access.travel_report.travel_gallery_sorting'))
                                            ->required() }}
                                </div><!--col-->

                                <div class="col-md-1">
                                    <a onclick="galleryimage()" class="btn btn-success btn-sm"><i class="fa fa-plus" title="Add New Image Row"></i></a>
                                </div><!--col-->
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.slideshow'))->class('col-md-2 form-control-label')->for('slide_show') }}

                            <div class="col-md-10">
                                {{ html()->file('slideshow_with_audio[]')
                                    ->attribute('multiple')
                                    ->required()
                                    ->autofocus()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.slide_audio'))->class('col-md-2 form-control-label')->for('slide_show') }}
                            @foreach($slide_data as $key=>$slide_audio)
                            <div class="col-md-5">


                                <input class="form-audio" type="radio" name="image_audio" value="">
                                <audio style="padding-top:30px"controls></audio>
                            </div><!--col-->
                            @endforeach
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.lattitude'))->class('col-md-2 form-control-label')->for('lattitude') }}

                            <div class="col-md-10">
                                {{ html()->text('lattitude')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.lattitude'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.longitude'))->class('col-md-2 form-control-label')->for('longitude') }}

                            <div class="col-md-10">
                                {{ html()->text('longitude')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.longitude'))
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                         {{--<div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.travel_cost'))->class('col-md-2 form-control-label')->for('travel_cost') }}

                            <div class="col-md-10">
                                {{ html()->text('travel_cost')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.travel_cost'))
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->--}}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.travel_report'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}

    <script>
// Add data grid cost component
 function datagrid(){

    var count = $(".data_grid_row").length;

    $('#data_grid_row').append('<div class="row datagrid_row" id="datagrid_row'+count+'"><div class="col-md-2"></div><div class="col-md-4"><div class="form-group"><input class="form-control" type="text" name="component_name[]" id="component_name" required=""></div></div><div class="col-md-4"><div class="form-group"><input class="form-control" type="text" name="component_cost[]" id="component_cost" required=""></div></div><div class="col-md-2"><div class="form-group"><a onclick="removedatagridrow('+count+')" class="btn btn-danger btn-sm"><i class="fa fa-trash" title="remove Row"></i></a></div></div></div>')
 }

// Add multiple gallery row
function galleryimage(){
     var count = $(".gallery_row").length;
     $('#gallery_row').append('<div class="row gallery_row" id="gallery_row'+count+'"><div class="col-md-2"></div><div class="col-md-2"><div class="form-group"><input type="file" accept="image/jpg" name="gallery_photo[]" id="gallery_photo" required="" autofocus=""></div></div><div class="col-md-2"><div class="form-group"><input class="form-control" type="text" name="gallery_caption[]" id="gallery_caption" required=""></div></div><div class="col-md-2"><div class="form-group"><input class="form-control" type="text" name="location_of_shot[]" id="location_of_shot" required=""></div></div><div class="col-md-2"><div class="form-group"><input class="form-control" type="number" name="sorting_in_gallery[]" id="sorting_in_gallery" maxin="1" max="5" maxlength="1" required=""></div></div><div class="col-md-1"><div class="form-group"><a onclick="removegalleryrow('+count+')" class="btn btn-danger btn-sm"><i class="fa fa-trash" title="remove row"></i></a></div></div></div>');
 }

 //remove gallery row
function removedatagridrow(count){
    $("#datagrid_row"+count).remove();
}

 //remove gallery row
function removegalleryrow(count){
    $("#gallery_row"+count).remove();
}
</script>

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
