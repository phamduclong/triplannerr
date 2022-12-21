@extends('backend.layouts.app')
 
@section('title', __('labels.backend.access.advertisements.management') . ' | ' . __('labels.backend.access.advertisements.edit'))

@section('breadcrumb-links')
    @include('backend.advertisements.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->modelForm($data, 'PATCH', route('admin.advertisements.update', $data->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.advertisements.management')
                        <small class="text-muted">@lang('labels.backend.access.advertisements.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
              <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.advertisements.title'))->class('col-md-2 form-control-label')->for('title') }} 
                    <div class="col-md-10">
                        {{ html()->text('title')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.access.advertisements.title'))
                            ->attribute('maxlength', 191)
                            ->autofocus()
                            ->value($data->title) }}
                    </div><!--col-->
                </div>

                <div class="form-group row">
                    {{ html()->label(__('Travel Pro'))->class('col-md-2 form-control-label')->for('travel_pro') }}

                   <div class="col-md-10">
                        {{ html()->select('travel_pro')
                            ->class('form-control')
                            ->options(['' => 'Select Travel Pro']+$travel_pro)
                            ->value($data->travel_pro_id)
                        }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.advertisements.description'))->class('col-md-2 form-control-label')->for('description') }} 
                    <div class="col-md-10">
                        {{ html()->textarea('description1')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.access.advertisements.description'))
                            ->attribute('maxlength', 191)
                            ->autofocus()
                            ->value($data->description) }}
                    </div><!--col-->
                </div>

                 <div class="form-group row">

                           {{ html()->label(__('validation.attributes.backend.access.advertisements.ads_type'))->class('col-md-2 form-control-label')->for('ads_type') }}

                            <div class="col-md-10">
                                @php
                                    $ads_type = ['free' => 'Free', 'paid' => 'Paid'];
                                @endphp

                                {{ html()->select('ads_type')
                                    ->class('form-control')
                                    ->options($ads_type)
                                    ->value($data->ads_type)
                                }}
                               
                            </div><!--col-->
                        </div><!--form-group-->
                       <div class="row mt-4 mb-4">
                         <div class="col">
                           <div class="form-group row">

                            {{ html()->label(__('validation.attributes.backend.access.advertisements.graphic_type'))->class('col-md-2 form-control-label')->for('graphic_type') }}

                            <div class="col-md-10">
                                @php
                                    $graphic_type = ['' =>'select', 'image' => 'Image', 'video' => 'Video'];
                                @endphp

                                {{ html()->select('type')
                                    ->class('form-control')
                                    ->options($graphic_type)
                                    ->attribute('onChange', 'laod_advertisement(this)')
                                    ->value($data->type)
                                }}
                               
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row" id="tour_carriers_file">
                        </div>
                           <div class="form-group row" id="carriers_value_show">
                        </div>

                        <?php 
                          $videoUpload='';
                          if($data->type == 'video'){
                            if(!empty($data->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$data->type_file)) ) {
                                $videoUpload=url('img/backend/advertisement/'.$data->type_file);
                            }
                          }
                         ?>

                         <?php $embVideoUpload='';
                           if(!empty($data->embedded_link))
                            $embVideoUpload = $data->embedded_link;
                         ?>

                        <div id="cover_image_container">
                          <div class="form-group row" id="paid">
                            @if($data->type == 'image')

                                 {{ html()->label(__('validation.attributes.backend.access.advertisements.graphic_image'))->class('col-md-2 form-control-label')->for('graphic_image') }}

                                   <div class="col-md-10">
                                        <img src="{{url('img/backend/advertisement/'.$data->type_file)}}" style="height: 100px; width: 100px;">
                                    </div><!--col-->
                                    <br><br>

                                    @if(!empty($data->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$data->type_file)) )
                                    <label class="col-md-2 form-control-label" for="file_name"></label><div class="col-md-10">
                                        <input class="form-control" type="file" name="type_file" accept="image/*" autofocus="" data-height="400" data-width="400" >
                                    </div>
                                    @else
                                    <p></p>
                                  @endif
                              </div>
                                <!--form-group-->

                            @elseif($data->type == 'video')
                             <label class="col-md-2 form-control-label" for="file_name">Type Video</label>
                              <div class="col-md-5"><input type="radio" onchange="laod_advertisement(this)" name="xyz" value="embedded" data-value="embedded" @if(!empty($data->embedded_link)) checked @endif> Embedded Video</div>
                                <div class="col-md-5"><input type="radio" name="xyz" onchange="laod_advertisement(this)" data-value="upload" value="upload" @if(!empty($data->type_file)) checked @endif> Upload Video</div>
                               <br>
                              @if(!empty($data->type_file))
                                @if(!empty($data->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$data->type_file)) )
                                   {{ html()->label(__('validation.attributes.backend.access.advertisements.graphic_video'))->class('col-md-2 form-control-label')->for('graphic_video') }}
                                     <div class="col-md-10">
                                          <video width="250" controls>
                                            <source src="{{url('img/backend/advertisement/'.$data->type_file)}}" type="video/mp4">
                                          </video>
                                     </div>
                                 @else
                                     {{ html()->label(__('validation.attributes.backend.access.advertisements.graphic_video'))->class('col-md-2 form-control-label')->for('graphic_video') }}
                                     <div class="col-md-10">
                                        <video width="150" controls>
                                          <source src="#" type="video/mp4">
                                        </video>
                                     </div>
                                 @endif 

                                  @if(!empty($data->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$data->type_file)) )
                                  <label class="col-md-2 form-control-label" for="file_name"></label><div class="col-md-10"><input type="file" name="type_file" value="">(only accept mp4)</div>
                                  @else
                                  <p></p>
                                  @endif
                                 @else
                                 @if(!empty($data->embedded_link))
                                     <label class="col-md-2 form-control-label" for="file_name">Embedded URL</label>
                                        <div class="col-md-10">
                                           <input type="text" name="embedded_link" class="form-control" value="{{isset($data->embedded_link)?$data->embedded_link:''}}">
                                         </div><!--col-->
                                  @endif
                                @endif
                            @endif
                        </div>
                       
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.url'))->class('col-md-2 form-control-label')->for('url') }}

                           <div class="col-md-10">
                                {{ html()->text('ad_url')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.advertisements.url'))
                                    ->attribute('maxlength', 191)
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.country'))->class('col-md-2 form-control-label')->for('country') }}

                           <div class="col-md-10">
                                {{ html()->select('country')
                                    ->class('form-control')
                                    ->options(['' => 'Select Country']+$country_arr)
                                    ->value($data->country_departure)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.category'))->class('col-md-2 form-control-label')->for('category') }}

                           <div class="col-md-10">
                                {{ html()->select('category_id')
                                    ->class('form-control')
                                    ->options(['' => 'Select Category']+$categories)
                                    ->value($data->category_id)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.age'))->class('col-md-2 form-control-label')->for('age') }}

                           <div class="col-md-10">
                                {{ html()->select('age')
                                    ->class('form-control')
                                    ->options(['' => 'Select Age']+$travel_ages)
                                    ->value($data->age)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_types'))->class('col-md-2 form-control-label')->for('travel_types') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_types')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Type']+$travel_types)
                                    ->value($data->travel_type)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.vector_type'))->class('col-md-2 form-control-label')->for('vector_type') }}

                           <div class="col-md-10">
                                {{ html()->select('vector_type')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Vector']+$travel_vectors)
                                    ->value($data->vector_type)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_accommodations'))->class('col-md-2 form-control-label')->for('travel_accommodations') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_accommodations')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Accommodation']+$travel_accommodations)
                                    ->value($data->type_of_accomodation)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_participates'))->class('col-md-2 form-control-label')->for('travel_participates') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_participates')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Participate']+$travel_participates)
                                    ->value($data->type_of_participant)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_formula'))->class('col-md-2 form-control-label')->for('travel_formula') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_formula')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Formula']+$travel_formula)
                                    ->value($data->preffered_stay_formula)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_mealtype'))->class('col-md-2 form-control-label')->for('travel_mealtype') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_mealtype')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Meal Type']+$travel_mealtype)
                                    ->value($data->type_of_fav_meal)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.travel_budget'))->class('col-md-2 form-control-label')->for('travel_budget') }}

                           <div class="col-md-10">
                                {{ html()->select('travel_budget')
                                    ->class('form-control')
                                    ->options(['' => 'Select Travel Budget']+$travel_budget)
                                    ->value($data->budget)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.page'))->class('col-md-2 form-control-label')->for('page') }}

                           <div class="col-md-10">
                             <select name="view" class="form-control" required>
                                <option value=" ">Select View</option>
                                <option value="home" @if($data->view=='home') selected @endif>Home Page</option>
                                <option value="profile" @if($data->view=='profile') selected @endif>Profile Page</option>
                                <option value="travel_report" @if($data->view=='travel_report') selected @endif>Travel Report Page</option>
                               <!--  <option value="login" @if($data->view=='login') selected @endif>Login</option>
                                <option value="register" @if($data->view =='register') selected @endif>Register</option> -->
                              </select>   
                            </div><!--col-->
                        </div><!--form-group-->

                    <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.location'))->class('col-md-2 form-control-label')->for('location') }}

                        <div class="col-md-10">
                            <select name="location" class="form-control" required>
                                <option value=" ">Select Location</option>
                                <option value="top" @if($data->location=='top') selected @endif>Page Top</option>
                                <option value="middle" @if($data->location=='middle')selected @endif>Page Middle</option>
                                <option value="bottom" @if($data->location=='bottom')selected @endif>Page Bottom</option>
                                <option value="footer" @if($data->location=='footer')selected @endif>Page footer</option>
                            </select> 
                         </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.advertisements.status'))->class('col-md-2 form-control-label')->for('status') }}

                           <div class="col-md-10">
                             <div class="col-md-4" style="float:left;">
                                <input type="radio" name="status" value="1" @if($data->status=='1')checked @endif> Publish  
                             </div>
                             <div class="col-md-4" style="float:left;">
                                <input type="radio" name="status" value="0" @if($data->status=='0')checked @endif> Unpublish 
                             </div>
                            </div><!--col-->
                        </div><!--form-group-->
                  </div><!--col-->
               </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.advertisements'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        /*$('#tour_carriers_file').html('');*/
         function laod_advertisement(obj){
            $("#paid").hide();
            var content_value = $(obj).val();
            var type_value = $(obj).data('value');
            var videoUpload ='<?php echo $videoUpload; ?>';
            var embVideoUpload ='<?php echo $embVideoUpload; ?>';
            if(content_value == 'image'){
                $('#tour_carriers_file').html('');
                $('#carriers_value_show').html('');
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Image</label><div id="cover_image_container"><div class="col-md-10"><input type="file" class = "form-control to_crop" name="type_file" id="cover" accept="image/*" autofocus="" data-id="cover" data-height="400" data-width="400" data-container="cover_image_container" data-dimension="cover"><p id="coverErr" class="text-danger"></p><p>Image resolution should be minimum 400x400</p></div></div>');
            }
            else if(content_value == 'video'){
                $('#tour_carriers_file').html('');
                $('#carriers_value_show').html('');
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Type Video</label><div class="col-md-4"><input type="radio" onchange="laod_advertisement(this)" name="xyz" value="embedded" data-value="embedded">Embedded Video</div><div class="col-md-4"><input type="radio" name="xyz" onchange="laod_advertisement(this)" data-value="upload" value="upload"> Upload Video</div>');
            }
            else if(type_value == 'embedded'){
               $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Type Video</label><div class="col-md-4"><input type="radio" onchange="laod_advertisement(this)" name="xyz" value="embedded" data-value="embedded" checked>Embedded Video</div><div class="col-md-4"><input type="radio" name="xyz" onchange="laod_advertisement(this)" data-value="upload" value="upload"> Upload Video</div>');

                
               $('#carriers_value_show').html('<label class="col-md-2 form-control-label" for="file_name">Embedded URL</label><div class="col-md-10"><input type="text" name="embedded_link" class="form-control" value="'+embVideoUpload+'"></div>');
             
            }

            else if(type_value == 'upload'){
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Type Video</label><div class="col-md-4"><input type="radio" onchange="laod_advertisement(this)" name="xyz" value="embedded" data-value="embedded">Embedded Video</div><div class="col-md-4"><input type="radio" name="xyz" onchange="laod_advertisement(this)" data-value="upload" value="upload" checked> Upload Video</div>');
                var htmlV='';
                if(videoUpload!='') {
                    htmlV='<video width="250" controls><source src="'+videoUpload+'" type="video/mp4"></video><br>';  
                }
                $('#carriers_value_show').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Video</label><div class="col-md-10">'+htmlV+'<input type="file" name="type_file" value="">(only accept mp4)</div>');
            }
            else{
                $('#tour_carriers_file').html('');
                $('#carriers_value_show').html('');
            }

        }
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
