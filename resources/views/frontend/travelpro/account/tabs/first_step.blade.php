<div class="row">
    <div class="col">
      <div class="form-group travel-info">
        <h4>Travel Pro: Role, Functionality and Rules</h4>
        <p>He/She shares his/her travel reports.</p>
        <p>He/She is a professional who shares information and news on the offers, products and services he offers.</p>
        <p>- Agencies:</p>
        <p>"Tour Operator" "Travel Agency" "Travel Agent" "Local Agent"</p>
        <p>- Local Operators:</p>
        <p>"Excursions" "Tour Guides" "Day Trips"</p>
        <p>- Tourist Services:</p>
        <p>"Hotels and overnight Accommodation" "Restaurants and Services" "Monuments and Institutional Sites" "Attractions and Entertainment"</p>
         </div>
      </div>
  </div>
  @php
    $role=Auth::user()->role_type;
  @endphp
    <div class="row">
      <div class="col">
        <div class="form-group">
             <!-- {{ html()->label(__('validation.attributes.frontend.term_condition'))->for('term_condition') }}
              {{ html()->textarea('userdetail.term_condition')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.term_condition'))
                     ->attribute('maxlength', 191)
                     ->autofocus() }}
             -->
             {{--<input class="term_condition" type="checkbox" name="" value="validation.attributes.frontend.term_condition"><a href="{{url('/characteristics-conditions',$role)}}">{{ html()->label(__('validation.attributes.frontend.term_condition'))->class('condition_text')->for('term_condition') }}</a>--}}
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
  <div class="row">
      <div class="col">
        <div class="form-group">
          {{ html()->label(__('validation.attributes.frontend.describe_yourself'))->for('describe_yourself') }}
          {{ html()->textarea('userdetail.describe_yourself')
               ->class('form-control')
               ->placeholder(__('validation.attributes.frontend.describe_yourself'))
               ->attribute('maxlength', 191)
               ->autofocus() }}
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
<div class="row">
  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      {{ 
        html()->label(__('validation.attributes.frontend.cover_image'))->for('cover_image') 
      }}

      <input class="form-control to_crop" type="file" name="cover" id="cover" accept="image/*" autofocus="" data-id="userdetail_cover_image" data-height="400" data-width="1380" data-container="cover_image_container" data-dimension="cover">
      <p id="coverErr" class="text-danger"></p>
      <p style="color: red;">Image resolution should be minimum 1380x400</p>
      <input type="hidden" name="userdetail_cover_image" id="userdetail_cover_image" >
    </div>
  </div>
  <div class="col-lg-8 col-md-6">
    <div class="form-group">
      @if(!empty($user_data->userdetail->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$user_data->userdetail->cover_image)) )
        <img src="{{url('img/frontend/user/cover/'.$user_data->userdetail->cover_image)}}" class="img-responsive" height="100"  id="cover_image_container">
      @else
        <img src="{!! URL::to('img/frontend/demo.png') !!}" class="img-responsive" id="cover_image_container" height="100">
      @endif 
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-md-6">
    <div class="form-group">
      {{ html()->label(__('validation.attributes.frontend.profile_image'))->for('profile_image') }}

      <input class="form-control to_crop" type="file" name="profile" id="profile" accept="image/*" autofocus="" data-id="userdetail_profile_image" data-height="200" data-width="200" data-container="profile_image_container" data-dimension="profile">
      <p id="profileErr" class="text-danger"></p>
      <p style="color: red;">Image resolution should be minimum 200x200</p>
      <input type="hidden" name="userdetail_profile_image" id="userdetail_profile_image" >
    </div> 
  </div>

  <div class="col-lg-8 col-md-6">
    <div class="form-group">
      @if(!empty($user_data->userdetail->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$user_data->userdetail->profile_image)) )
        <img src="{{url('img/frontend/user/profile/'.$user_data->userdetail->profile_image)}}" class="img-responsive" id="profile_image_container" height="100">
      @else
        <img src="{!! URL::to('img/frontend/demo.png') !!}" class="img-responsive" id="profile_image_container" height="100">
      @endif 
    </div>
  </div>
</div>

<ul class="nav nav-tabs">
  <li class="nav-item ml-auto">
      <a class="nav-link" data-toggle="tab" href="#second_step"><i class="fa fa-arrow-right"></i> Go To Second Page</a>
  </li>
</ul>
