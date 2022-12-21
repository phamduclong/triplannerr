<div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        </div><!--col-->

        <div class="col-md-6">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                {{ html()->text('last_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.last_name'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
 <div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.user_name'))->for('user_name') }}

                {{ html()->text('user_name')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.user_name'))
                     ->attribute('maxlength', 191)
                     ->autofocus()
                      }}
         </div><!--form-group-->
      </div><!--col-->

    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.phone_no'))->for('phone_no') }}

                {{ html()->text('userdetail.phone_no')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.phone_no'))
                     ->autofocus()
                }}
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
@php
 if($user_data->userdetail){
 $birth_date=date("m/d/Y", strtotime($user_data->userdetail->birth_place));
 }
 @endphp
  <div class="row">
      <div class="col">
        <div class="form-group">
             {{ html()->label(__('validation.attributes.frontend.birth_place'))->for('birth_place') }}
            <input type="date" name="birth_place" value="@if($user_data){{isset($birth_date)?date('Y-m-d',strtotime($birth_date)):''}}@endif" placeholder="@lang('validation.attributes.frontend.birth_place')" class="form-control" date-format="mm/dd/yyyy">
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.sex'))->for('sex') }}

                <div class="input-sec">

                 <input type="radio" name="sex" value="male" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail) @if($user_data->userdetail->sex=='male') checked=""  @endif @endif>Male

                </div>
                 <div class="input-sec">
                 <input type="radio" name="sex" value="female" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail) @if($user_data->userdetail->sex=='female') checked=""  @endif @endif>Female

             </div>
             <div class="input-sec">
                 <input type="radio" name="sex" value="custom" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail)
                 @if($user_data->userdetail->sex=='custom') checked=""  @endif @endif>I don't want to say
                 </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
      <div class="col">
        <div class="form-group">



             {{ html()->label(__('validation.attributes.frontend.place_of_residence'))->for('place_of_residence') }}
             <select class="form-control"
                name="userdetail.place_of_residence"
                id="userdetail.place_of_residence">
                <option selected disabled>Select country</option>
                @foreach ($countries as $k => $country)
                <option value="{{ $k }}">{{ $country }}</option>
                @endforeach
            </select>
             {{-- {{ html()->textarea('userdetail.place_of_residence')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.place_of_residence'))
                     ->attribute('maxlength', 191)
                     ->autofocus() }} --}}
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 <div class="row">
  <div class="col-md-8">
      <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.favorite_nations'))->for('favorite_nations') }}
          <div class="input-group">
              <input type="text" id="search_data" name="fav_nation[]" placeholder="" autocomplete="off" class="form-control input-lg" value="@if($user_data->userdetail){{ $user_data->userdetail->fav_nation }} @endif"/>
             <!--  <div class="input-group-btn">
                  <button type="button" class="btn btn-primary btn-lg" id="search">Get Value</button>
              </div> -->
          </div>
          <br />
          <span id="country_name"></span>
      </div>
  </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.favorite_nations_want'))->for('favorite_nations') }}
            <div class="input-group">
                <input type="text" id="search_data1" name="fav_nation_want[]" placeholder="" autocomplete="off" class="form-control input-lg" value="@if($user_data->userdetail){{ $user_data->userdetail->fav_nation_want }} @endif" />
            </div>
            <br />
            <span id="country_name1"></span>
        </div>
    </div>
</div>

 <input type="hidden" name="role_type" value="traveler">
 <div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.upload_identity_document'))->for('classification_of_travel_report') }}
                </br>
                 {{ html()->file('userdetail.identity_document')
                        ->class('form-control')
                        ->autofocus()
                  }}
          <!--      <input type="file" name="identity_document" placeholder="validation.attributes.frontend.Upload_identity_document" value=""> -->

         </div><!--form-group-->
      </div><!--col-->
      <div class="col-md-6">
        <!-- <div class="form-group">
            @if(!empty($user_data->userdetail->identity_document) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->userdetail->identity_document)) )
            <a class="click_btn" href="{{url('uploads/frontend/doc/'.$user_data->userdetail->identity_document)}}" target="_blank">Click here</a>
            @endif
        </div> -->
      </div>

      <ul class="nav nav-tabs"  >
          <li class="nav-item">
              <a class="nav-link" href="#first_step" onClick="changeStep(first_step)"><i class="fa fa-arrow-left"></i> Back</a>
          </li>

          <li class="nav-item ml-auto">
              <a class="nav-link" href="#third_step" onClick="changeStep(third_step)"><i class="fa fa-arrow-right"></i> Go To Third Page</a>
          </li>
      </ul>
   </div><!--row-->
