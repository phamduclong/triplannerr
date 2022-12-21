@extends('backend.layouts.app')

@section('title', __('labels.backend.access.travel_report.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.travel_report.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($data, 'PATCH', route('admin.travel_report.update', $data->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.travel_report.management')
                        <small class="text-muted">@lang('labels.backend.access.travel_report.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            <center><img src="{{url('/img/frontend/travel_report/coverphoto/'.$data->cover_photo)}}" style="height: 100px; width: 100px;"></center>
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
                                @php
                                    $selected_cats = explode(',', $data->category_id);
                                @endphp
                                 {{
                                  Form::select('category_id[]', $travelcateg_arr , $selected_cats, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'category_id', 'multiple'=>'multiple'])
                                }}

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
                                    ->value($data->country_departure)
                                }}
                            </div><!--col-->

                            <div class="col-md-5">
                                 <div class="form-group" id="country_destination_div">
                              <p>Country of Destination</p>
                              @php
                              $selected_country = explode(',', $data->country_destination)
                              @endphp
                              {{
                                Form::select('country_destination[]',  $countriesArr, $selected_country, ['class' => 'form-control', 'required' => 'required', 'id'=> 'country_destination', 'multiple'=> 'multiple'])
                              }}
                            </div><!--col-->
                        </div>
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
                            {{ html()->number('travel_cost')
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
                            {{ Form::select('currency_id', $currency_arr, $data->currency_id, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
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
                                       <input type="radio" name="report_option" value="report" {{($data->report_option=='report')?'checked':''}}>Travel Report
                                       </div>
                                       </div>
                                       {{-- <div class="col-md-3">
                                        <div class="input-sec">
                                       <input type="radio" name="report_option" value="diary"  {{($data->report_option=='diary')?'checked':''}}>Travel Report with Diary
                                       </div>
                                       </div> --}}
                                       <div class="col-md-3">
                                        <div class="input-sec">
                                       <input type="radio" name="report_option" value="offer"  {{($data->report_option=='offer')?'checked':''}}>Travel Report with Travel Offert
                                      </div> </div>
                              </div>
                        </div>


                                <div class="form-group row">
                                    <!-- <div class="form-group senti-list"> -->
                                        {{ html()->label(__('validation.attributes.frontend.travel_report.security_option'))->class('col-md-2 form-control-label') }}
                                        <div class="col-md-10">
                                           <div class="col-md-3">
                                                <div class="input-sec">
                                                        <input type="radio" name="security_option" value="private" {{($data->security_option=='private')?'checked':''}}>Private
                                                </div>
                                           </div>
                                           <div class="col-md-3">
                                                <div class="input-sec">
                                                    <input type="radio" name="security_option" value="limited" {{($data->security_option=='limited')?'checked':''}}>Public
                                                </div>
                                           </div>
                                           <div class="col-md-3">
                                                <div class="input-sec">
                                                    <input type="radio" name="security_option" value="reserved" {{($data->security_option=='reserved')?'checked':''}}>Reserved
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
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div id="data_grid_row">
                            <!-- <div class="form-group row"> -->
                            @if(isset($tour_carrier_checked) && !empty($tour_carrier_checked))
                        @foreach($tour_carrier_checked as $value)
                            <div class="form-group row">
                                    {{ html()->label(__('validation.attributes.backend.access.travel_report.data_grid'))->class('col-md-2 form-control-label')->for('data_grid') }}

                                <div class="col-md-3">
                                   <label>Cost Summary</label>
                                   {{ html()->text('component_name[]')
                                    ->class('form-control')
                                    ->required()
                                    ->value($value['component_name'])}}
                                </div><!--col-->


                                <div class="col-md-3">
                                    <label>Individual Costs</label>
                                    {{ html()->number('component_cost[]')
                                        ->class('form-control')
                                        ->required()
                                        ->value($value['individual_cost'])}}
                                </div><!--col-->

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Total Cost</label>
                                       {{ html()->number('total_cost[]')
                                            ->class('form-control')
                                            ->required()
                                            ->value($value['total_cost'])}}
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @endif
                        </div>

                        <div id="gallery_row">
                        @php $i=1;@endphp
                        @if(isset($travel_report_gallery) && !empty($travel_report_gallery))
                                @foreach($travel_report_gallery as $value)
                            <div class="form-group row" id="{{'gallery-id-'.$value->id}}">
                                    {{ html()->label(__('validation.attributes.backend.access.travel_report.gallery_image'))->class('col-md-2 form-control-label')->for('gallery_image') }}

                                <div class="col-md-2">
                                    {{-- html()->file('gallery_photo[]')
                                        ->attribute('accept','image/jpg')
                                        ->autofocus()

                                    --}}
                                    <img src="{{url('/img/frontend/travel_report/gallery').'/'.$value->gallery_image}}" hight="50" width="50">
                                </div><!--col-->

                                <div class="col-md-2">
                                   {{ html()->text('gallery_caption[]')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.travel_gallery_caption'))
                                    ->required()
                                    ->value($value->image_caption) }}
                                </div><!--col-->

                                 <div class="col-md-2">

                                     {{ html()->text('location_of_shot[]')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.travel_report.travel_gallery_location'))
                                        ->required()
                                        ->value($value->image_location) }}
                                </div><!--col-->


                                <div class="col-md-2">
                                     {{ html()->number('sorting_in_gallery[]')
                                            ->class('form-control')
                                            ->attribute('min','1')
                                            ->attribute('max','5')
                                            ->placeholder(__('validation.attributes.backend.access.travel_report.travel_gallery_sorting'))
                                            ->required()
                                            ->value($value->image_sorting) }}
                                </div><!--col-->
                               @if($i==1)
                                <div class="col-md-1">
                                    <a onclick="galleryimage()" class="btn btn-success btn-sm"><i class="fa fa-plus" title="Add New Image Row"></i></a>
                                </div><!--col-->
                                @else
                                <div class="col-md-1">
                                    <a onclick="removeimage({{$value->id}})" class="btn btn-danger btn-sm"><i class="fa fa-trash" title="Remove Image Row"></i></a>
                                </div>
                                @endif
                            </div>
                            @php $i++;@endphp
                            @endforeach
                                @endif
                        </div>

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.slideshow'))->class('col-md-2 form-control-label')->for('slide_show') }}

                            <div class="col-md-10">
                                {{ html()->file('slideshow_with_audio[]')
                                    ->attribute('multiple')
                                    ->autofocus()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.slide_audio'))->class('col-md-2 form-control-label')->for('slide_show') }}
                            @foreach($slide_data as $key=>$slide_audio)
                            <div class="col-md-5">


                            <input class="form-audio" type="radio" name="image_audio" value="{{$key}}" {{($data->image_audio==$key)?'checked':''}}> <audio style="padding-top:30px"controls src="{{url('/audio/backend/',$slide_audio)}}"></audio>
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
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.travel_report.longitude'))->class('col-md-2 form-control-label')->for('longitude') }}

                            <div class="col-md-10">
                                {{ html()->text('longitude')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.travel_report.longitude'))
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <input type="hidden" name="oldimage" value="{{ $data->cover_photo}}">
                    </div><!--col-->
                </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.travel_report'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}


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
function removeimage(id){
    $.ajax({
            url :"<?= url('admin/travel_report/deletegalleryimg/&ids='); ?>" +id,
            method : 'GET',
            data:{ids:id},
            success:function(data){
          $('#gallery-id-'+id).remove();
            }
          });
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


        $(".add_cost_button").on('click', function(){
            var container_length = $(this).attr('data-id');
            var new_length = parseInt(container_length) + 1;
            $.ajax({
                data:{container_length:container_length, '_token' : '{{ csrf_token()}}'},
                type:'get',
                url:'{{url("/travel_report/get_travel_cost_summary") }}',
                success: function(data){
                  $('#data_grid_row').append(data);
                  $(".add_cost_button").attr('data-id', new_length);
                },
            });
          });
    </script>
@endsection

<style>
    .box{
        color: #fff;
        padding: 20px;
        display: none;
        margin-top: 20px;
    }
    .red{ background: #ff0000; }
    .green{ background: #228B22; }
    .blue{ background: #0000ff; }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
</script>
<script>
var select=new MSFmultiSelect(
  document.querySelector('#travel_report_category'),
  {
      onChange:function(checked,value,instance){
        console.log(checked,value,instance);
      },
      selectAll:true,
      appendTo:'#travel_report_category_div',
  }
);

var select1 = new MSFmultiSelect(
  document.querySelector('#country_destination'),
  {
      onChange:function(checked,value,instance){
        console.log(checked,value,instance);
      },
      selectAll:true,
      appendTo:'#country_destination_div',
  }
);
</script>
