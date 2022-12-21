
       {{-- @php
        if($user_data->userdetail){
           $explode_data=explode(',',$user_data->userdetail->sentimental_situation);
         }
        @endphp
        <div class="row">
           <div class="col">
              <div class="form-group senti-list">
                  {{ html()->label(__('validation.attributes.frontend.sentimental_situation'))->for('sentimental_situation') }}
                @foreach($travel_situation as $situation)
                  <div class="input-sec">
                    <input type="radio" name="sentimental_situation[]" value="{{$situation}}" @if($user_data->userdetail) @if(in_array($situation,$explode_data)) checked="" @endif @endif>{{$situation}}
                  </div>
                @endforeach
              </div><!--form-group-->
            </div><!--col-->
       </div><!--row--> --}}

       <div class="row">
          <div class="col">
              <div class="form-group senti-list">
                  {{ html()->label(__('validation.attributes.frontend.preferred_travel_category'))->for('preferred_travel_category') }}
                  @php
                   if($user_data->userdetail){
                     $explode_preferred_travel_category=explode(',',$user_data->userdetail->preferred_travel_category);
                    }
                  @endphp
                  @foreach($travel_category as $category)
                      <div class="input-sec">
                       <input type="checkbox" name="preferred_travel_category[]" placeholder="validation.attributes.frontend.preferred_travel_category" value="{{$category}}" @if($user_data->userdetail) @if(in_array($category,$explode_preferred_travel_category)) checked="" @endif @endif>{{$category}}
                       </div>
                  @endforeach
               </div><!--form-group-->
            </div><!--col-->
       </div><!--row-->

        @php
        if($user_data->userdetail){
           $explode_identification_option=explode(',',$user_data->userdetail->identification_option);
         }
        @endphp
        <div class="row">
            <div class="col">
                 <div class="form-group senti-list">
                    {{ html()->label(__('validation.attributes.frontend.identification_option'))->for('license_detail') }}
                    @foreach($agency_option as $option)
                    <div class="input-sec">
                      <input type="checkbox" name="identification_option[]" value="{{$option}}" @if($user_data->userdetail) @if(in_array($option,$explode_identification_option)) checked=""  @endif @endif>{{$option}}
                    </div>
                    @endforeach
                 </div><!--form-group-->
              </div><!--col-->
         </div><!--row-->
        @php
        if($user_data->userdetail){
           $explode_local_operator=explode(',',$user_data->userdetail->local_operator);
         }
        @endphp
       <div class="row">
          <div class="col">
               <div class="form-group senti-list">
                    {{ html()->label(__('validation.attributes.frontend.local_operator'))->for('local_operator') }}
                    @foreach($local_operator as $operator)
                  <div class="input-sec">
                  <input id="{{str_replace(' ', '', $operator)}}" type="checkbox" name="local_operator[]" value="{{$operator}}" @if($user_data->userdetail) @if(in_array($operator,$explode_local_operator)) checked=""  @endif @endif>{{$operator}}
                  </div>
                  @endforeach
               </div><!--form-group-->
            </div><!--col-->
       </div><!--row-->

       {{-- add overnight and vecto--}}
       <div class="row">
       @foreach($formFields['third_step'] as $name => $formField) 
            @if($formField['id'] == 'type_of_accommodation' || $formField['id'] == 'vector_type')
              <div class="{{$formField['wrapper_classes']}}" style="display: none" id="{{$formField['id']}}">
                  <label for="{{$name}}">
                      {{$formField['label']}}
                      @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                  </label>
                  @switch($formField['type'])
                      @case('multicheckbox')
                          @foreach($formField['options'] as $option)
                              <div class="input-sec">
                                  <input 
                                      type="checkbox" 
                                      name="{{$formField['name']}}" 
                                      value="{{$option['label']}}" 
                                      @if($user_data->userdetail && str_contains($user_data->userdetail->$name??'', $option['label'])) 
                                          checked 
                                      @endif
                                  >
                                      <span>{{$option['label']}}</span>
                                  </input>
                              </div>
                          @endforeach
                      @break
                  @endswitch
              </div>
            @endif
        @endforeach
       </div>
       {{-- end add overnight and vecto --}}

       <div class="row" id="subRestaurant" style="display: none">
          <div class="col">
              <div class="form-group senti-list">
                  {{ html()->label(__('validation.attributes.frontend.type_of_fav_meals'))->for('type_of_fav_meals') }}
                  @php
                  if(isset($user_data->userdetail)){
                    $explode_meals=explode(',',$user_data->userdetail->travel_favoritemealtype);
                  }
                  @endphp
                  @foreach($travel_favoritemealtype as $meals)
                    <div class="input-sec">
                      <input type="checkbox" name="type_of_fav_meals[]" value="{{$meals}}" @if($user_data->userdetail) @if(in_array($meals,$explode_meals)) checked="" @endif @endif>{{$meals}}
                    </div>
                  @endforeach
              </div><!--form-group-->
            </div><!--col-->
      </div><!--row-->
       @php
        if($user_data->userdetail){
           $explode_tourist_facility=explode(',',$user_data->userdetail->tourist_facility);
         }
        @endphp
  {{-- <div class="row">
    <div class="col">
         <div class="form-group senti-list">
              {{ html()->label(__('validation.attributes.frontend.tourist_facility'))->for('tourist_facility') }}
          @foreach($tourist_facility as $facility)
            <div class="input-sec">
            <input type="checkbox" name="tourist_facility[]" value="{{$facility}}"  @if($user_data->userdetail) @if(in_array($facility,$explode_tourist_facility)) checked=""  @endif @endif>{{$facility}}
            </div>
          @endforeach
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row--> --}}

   {{-- <div class="row">
    <div class="col">
         <div class="form-group">
              {{ html()->label(__('validation.attributes.frontend.doc_agency'))->for('doc_agency') }}
                {{ html()->file('userdetail.doc_agency_data')
                        ->autofocus()
                  }}
            @if(!empty($user_data->userdetail->doc_agency_data) && file_exists(public_path('uploads/frontend/pdf'.'/'.$user_data->userdetail->doc_agency_data)) )
               <!-- <a href="{{url('uploads/frontend/pdf/'.$user_data->userdetail->doc_agency_data)}}" target="_blank" class="click_btn">Click Here</a> -->
           @endif

           {{ html()->file('userdetail.doc_agency_data')
                       ->autofocus()
                  }}
           @if(!empty($user_data->userdetail->doc_agency_doc) && file_exists(public_path('uploads/frontend/pdf'.'/'.$user_data->userdetail->doc_agency_doc)) )
            <!--  <a href="{{url('uploads/frontend/pdf/'.$user_data->userdetail->doc_agency_doc)}}" target="_blank" class="click_btn" >Click Here</a> -->
           @endif

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row--> --}}

 {{-- <div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.doc_upload'))->for('doc_upload') }}
                </br>
                {{ html()->file('userdetail.doc_upload')
                        ->class('form-control')
                        ->autofocus()
                  }}
                <input type="hidden" name="doc_upload_hide" placeholder="validation.attributes.frontend.doc_upload" value="@if($user_data->userdetail){{isset($user_data->userdetail->doc_upload)?$user_data->userdetail->doc_upload:''}}@endif">

          </div><!--form-group-->
      </div><!--col-->
       <div class="col-md-6">
        <div class="form-group">
            @if(!empty($user_data->userdetail->doc_upload) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->userdetail->doc_upload)) )
           <!--  <a href="{{url('uploads/frontend/doc/'.$user_data->userdetail->doc_upload)}}" class="click_btn" target="_blank">Click Here</a> -->
            @endif
        </div>
      </div>
   </div> --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.agency_logo'))->for('agency_logo') }}
                </br>
                <input class="form-control to_crop" type="file" name="userdetail_agency_logo" id="userdetail_agency_logo" accept="image/*" autofocus="" data-id="userdetail_agency_logo_image" data-height="80" data-width="80" data-container="userdetail_agency_logo_container" data-dimension="userdetail_agency_logo">
                <p id="logoErr" class="text-danger"></p>
                <input type="hidden" name="userdetail_agency_logo_image" id="userdetail_agency_logo_image">
           </div><!--form-group-->
      </div><!--col-->
       <div class="col-md-6">
            <div class="form-group" id="AGENCY_LOGO">
              {{-- @if(!empty($user_data->userdetail->agency_logo) && file_exists(public_path('img/frontend/user/agency_logo'.'/'.$user_data->userdetail->agency_logo)) ) --}}
              @if(!empty($user_data->userdetail->agency_logo) && file_exists(public_path('img/frontend/user'.'/'.$user_data->userdetail->agency_logo)) )
              {{-- <img src="{{url('img/frontend/user/agency_logo/'.$user_data->userdetail->agency_logo)}}" class="img-responsive" width="100" height="100" id="userdetail_agency_logo_container"> --}}
              <img src="{{url('img/frontend/user/'.$user_data->userdetail->agency_logo)}}" class="img-responsive" width="100" height="100" id="userdetail_agency_logo_container">
             @else
             <img src="{!! URL::to('img/frontend/demo.png') !!}">
             @endif
           </div>
           <div class="form-group" id="AGENCY_LOGO_PREVIEW" style="display: none">
              <img src="" class="img-responsive" width="100" height="100" id="AGENCY_LOGO_PREVIEW_IMG">
          </div>
      </div>
 </div><!--row-->

 <div class="row">
    <div class="col-md-12">
        <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.other'))->for('other') }}
            {{ html()->textarea('other')
               ->class('form-control')
               ->placeholder(__('validation.attributes.frontend.other'))
               ->attribute('maxlength', 160)
               ->autofocus()->value($user_data->userdetail->other) }}
           </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 <div class="row">
  <ul class="nav nav-tabs border-0">
      <li class="nav-item">
          <a class="nav-link" href="#second_step" onClick="prevStep(second_step)"><i class="fa fa-arrow-left"></i> Back</a>
      </li>
      <li class="nav-item ml-auto">
          <div class="form-group mb-0 clearfix d-flex justify-content-end p-3">
              <div class="m-0" style="width: 34em; padding: 0em 1em">The memberschip is paid, activate the free trial for 7 days.
                <a class="nav-link" target="_blank" style="display: contents" href="{{ url('view-plans/420') }}">
                  Discover our tariff plans .
                </a>
              </div>
              {{ form_submit(__('labels.general.buttons.update'))->class('more_btn m-0') }}
          </div>
      </li>
  </ul>
      {{-- <div class="col">
          <div class="form-group mb-0 clearfix">
              {{ form_submit(__('labels.general.buttons.update'))->class('more_btn') }}
          </div><!--form-group-->
      </div><!--col--> --}}
  </div><!--row-->


<script type="text/javascript">

  $(document).ready(function() {
    $("#Restaurant").change(function() {
        if(this.checked) {
          $('#subRestaurant').show();
        }else{
          $('#subRestaurant').hide();
        }
    });

    $("#OvernightStays").change(function() {
        if(this.checked) {
          $('#type_of_accommodation').show();
        }else{
          $('#type_of_accommodation').hide();
        }
    });

    $("#TravelVector").change(function() {
        if(this.checked) {
          $('#vector_type').show();
        }else{
          $('#vector_type').hide();
        }
    });
  });

   $(document).ready(function () {
    $("input[name='preferred_travel_category[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='preferred_travel_category[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});


   $(document).ready(function () {
    $("input[name='type_of_accommodation[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='type_of_accommodation[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});

   $(document).ready(function () {
    $("input[name='vector_type[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='vector_type[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});

    $(document).ready(function () {
    $("input[name='type_of_participants[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='type_of_participants[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});

$(document).ready(function () {
  $("input[name='type_of_fav_meals[]']").change(function () {
      var maxAllowed = 3;
      var cnt = $("input[name='type_of_fav_meals[]']:checked").length;
      if (cnt > maxAllowed) {
          $(this).prop("checked", "");
          alert('You can select maximum ' + maxAllowed + ' Value!!');
      }
  });
});
</script>


