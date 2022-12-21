@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div class="inner-banner">
   @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )

   <div class="cover-img" style="background-image: url('{{ asset('img/frontend/user/cover/'.$userdata->cover_image)}}'); height: 430px;width: 100%;background-size: 100% 100%;background-repeat: no-repeat;background-position: center;"></div>   <!--   <img src="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" class="img-responsive" > -->
           @else
            <img src="{{url('img/frontend/inner-banner.jpg')}}">
            @endif
            @section('content')
    {{ html()->form('POST', route('frontend.user.advertisement.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.advertisements.management')
                            <small class="text-muted">@lang('labels.backend.access.advertisements.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.title'))->class('col-md-2 form-control-label')->for('title') }} 
                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.advertisements.title'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div>

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan.description'))->class('col-md-2 form-control-label')->for('description') }}

                            <div class="col-md-10">
                                {{ html()->textarea('description1')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan.description'))
                                    ->autofocus()
                                    ->attribute('maxlength', 160) }}
                            </div><!--col-->
                        </div><!--form-group-->
                    
                        <div class="form-group row">

                            {{ html()->label(__('validation.attributes.backend.access.advertisements.graphic_type'))->class('col-md-2 form-control-label')->for('graphic_type') }}

                            <div class="col-md-10">
                                @php
                                    $graphic_type = ['' => 'Select advertisements Type', 'Image' => 'Image', 'Video' => 'Video'];
                                @endphp

                                 {{ html()->select('type')
                                    ->class('form-control')
                                    ->options($graphic_type)
                                    ->attribute('onChange', 'laod_advertisement(this)')
                                    ->required()
                                }}
                               
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row" id="tour_carriers_file">
                        </div>
                         <div class="form-group row" id="carriers_value_show">
                        </div>

                        {{-- <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.ads_type'))->class('col-md-2 form-control-label')->for('ads_type') }}

                            <div class="col-md-10">
                                @php
                                    $ads_type = ['free' => 'Free', 'paid' => 'Paid'];
                                @endphp

                                 {{ html()->select('ads_type')
                                    ->class('form-control')
                                    ->options($ads_type)
                                    ->required()
                                }}
                               
                            </div>
                        </div> --}}

                        
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.url'))->class('col-md-2 form-control-label')->for('url') }}

                           <div class="col-md-10">
                                {{ html()->text('ad_url')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.advertisements.url'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                         <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.country'))->class('col-md-2 form-control-label')->for('country') }}

                           <div class="col-md-10">
                                {{ html()->select('country')
                                    ->class('form-control')
                                    ->options(['' => 'Select Country']+$country_arr)

                                }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.category'))->class('col-md-2 form-control-label')->for('category') }}

                           <div class="col-md-10">
                                {{ html()->select('category_id')
                                    ->class('form-control')
                                    ->options(['' => 'Select Category']+$categories)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.age'))->class('col-md-2 form-control-label')->for('age') }}

                           <div class="col-md-10">
                                {{ html()->select('age')
                                    ->class('form-control')
                                    ->options(['' => 'Select Age']+$travel_ages)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_types'))->class('col-md-2 form-control-label')->for('travel_types') }}

                            <div class="col-md-10">
                                {{ html()->select('travel_types')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Type']+$travel_types)
                                    
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.vector_type'))->class('col-md-2 form-control-label')->for('vector_type') }}

                           <div class="col-md-10">
                                {{ html()->select('vector_type')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Vector']+$travel_vectors)
                                    
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_accommodations'))->class('col-md-2 form-control-label')->for('travel_accommodations') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_accommodations')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Accommodation']+$travel_accommodations)
                                    
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_participates'))->class('col-md-2 form-control-label')->for('travel_participates') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_participates')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Participate']+$travel_participates)
                                    
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_formula'))->class('col-md-2 form-control-label')->for('travel_formula') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_formula')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Formula']+$travel_formula)
                                    
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_mealtype'))->class('col-md-2 form-control-label')->for('travel_mealtype') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_mealtype')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Meal Type']+$travel_mealtype)
                                    
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_budget'))->class('col-md-2 form-control-label')->for('travel_budget') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_budget')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Budget']+$travel_budget)
                                    
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.page'))->class('col-md-2 form-control-label')->for('page') }}

                           <div class="col-md-10">
                            <select name="view" class="form-control" required>
                                <option value=" ">Select View</option>
                                <option value="home">Home Page</option>
                                <option value="profile">Profile Page</option>
                                <option value="travel_report">Travel Report Page</option>
                                <!-- <option value="login">Login</option>
                                <option value="register">Register</option> -->
                            </select>                              <!--   {{ html()->text('page')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.advertisements.page'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }} -->
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.location'))->class('col-md-2 form-control-label')->for('location') }}

                           <div class="col-md-10">
                             <select name="location" class="form-control" required>
                                <option value=" ">Select Location</option>
                                <option value="top">Page Top</option>
                                <option value="middle">Page Middle</option>
                                <option value="bottom">Page Bottom</option>
                                <option value="footer">Page footer</option>
                            </select>  
                            </div><!--col-->
                        </div><!--form-group-->

                        {{-- <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.status'))->class('col-md-2 form-control-label')->for('status') }}

                           <div class="col-md-10">
                             <div class="col-md-4" style="float:left;">
                                <input type="radio" name="status" value="1" checked> 
                                Publish  
                             </div>
                             <div class="col-md-4" style="float:left;">
                                <input type="radio" name="status" value="0"> Unpublish 
                             </div>
                            </div>
                        </div> --}}
                    </div><!--col-->
               </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                       <!--  {{ form_cancel(route('admin.plan_privilege'), __('buttons.general.cancel')) }} -->
                    </div><!--col-->

                    <div class="col text-right">
                        {{-- {{ form_submit(__('buttons.general.crud.create')) }} --}}
                        {{ form_submit(('Request Publication')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}


</div>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#tour_carriers_file').html('');
         function laod_advertisement(obj){
            var content_value = $(obj).val();
            var type_value = $(obj).data('value');
         
            if(content_value == 'Text'){
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="content">Graphic Text</label><div class="col-md-10"><input class="form-control" type="text" name="graphic_content" id="content" placeholder="Graphic Text" maxlength="191"></div>');
            }
            else if(content_value == 'Image'){
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Image</label><div id="cover_image_container"><div class="col-md-10"><input type="file" class = "form-control to_crop" name="type_file" id="cover" accept="image/*" autofocus="" data-id="cover" data-height="400" data-width="400" data-container="cover_image_container" data-dimension="cover"><p id="coverErr" class="text-danger"></p><p>Image resolution should be minimum 400x400</p></div></div>');
            }
            else if(content_value == 'Video'){
                // $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Video</label><div class="col-md-10"><input type="file" name="graphic_content"><br>(only accept mp4)</div>');
                  $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Type Video</label><div class="col-md-4"><input type="radio" onchange="laod_advertisement(this)" name="xyz" data-value="embedded"> Embedded Video</div><div class="col-md-4"><input type="radio" onchange="laod_advertisement(this)" name="xyz"data-value="upload"> Upload Video</div>');
            }
            else if(type_value == 'embedded'){
               $('#carriers_value_show').html('<label class="col-md-2 form-control-label" for="file_name">Embedded URL</label><div class="col-md-10"><input type="text" name="embedded_link" class="form-control" value=""></div>');
            }
            else if(type_value == 'upload'){
                $('#carriers_value_show').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Video</label><div class="col-md-10"><input type="file" name="type_file" value=""></div>');
            }
            else{
                $('#tour_carriers_file').html('');
                $('#carriers_value_show').html('');
            }
        }


        $(blurbt).find('p').each(function(){
           $( this ).replaceWith( $( this ).text() + "<br/>" );
        });
        $(blurbt).wrapInner("<p></p>");
        var pOnly  = $(blurbt).html();
        $('#usp-content').text(pOnly);
    </script>

    <script type="text/javascript">
    var $image_crop = '';
    var cOldImg = $('#cover_image_container').attr('src');
    $(document).on('change','.to_crop', function(){
        inputId = $(this).attr('id');
        $that = this;
        var isErr = true;
        $("#image_demo").html('');
        var desired_height = $(this).data('height');
        var desired_width = $(this).data('width');
        var dimensions = $(this).data('dimension');
        var container_id = $(this).data('id');
        var image_container = $(this).data('container');
        var _URL = window.URL || window.webkitURL;
        var file, img;
        if ((file = this.files[0])) {
              img = new Image();
              img.onload = function() {
                 // alert(this.width+"--"+this.height);
                  if (desired_width <= this.width && desired_height <= this.height) {
                     isErr = false;
                     $('#coverErr').html('');
                     
                  } else {
                      msg="Image resolution should be minimum "+desired_width+'x'+desired_height;
                      if(inputId == 'cover' && cOldImg){
                          $('#cover_image_container').attr('src',cOldImg);
                      }
                      
                      if(inputId == 'cover'){
                           $('#coverErr').html(msg);
                          $('#cover').val('');
                      }
                    
                      return;
                  }
              };
              img.src = _URL.createObjectURL(file);
          }
          
      }); 
      

</script>

@endsection
