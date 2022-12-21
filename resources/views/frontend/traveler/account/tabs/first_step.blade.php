<div class="row">
  <div class="col">
    <div class="form-group travel-info mb-0">
      <h4>Traveler: Role, Functionality and Rules</h4>
      <p>The "Traveller" is the main user of "Travel Maker".</p>
      <p>He/She shares his/her Travels to inspire other travellers.</p>
      <p>He/She describes his/her travel experiences by uploading his/her photos.</p>
      <p>He/She searches for information about different types of travel to find inspiration, tips and advice on how to organize his/her holidays.</p>
      <p>Role:</p>
      <p>- Creates "Travel Reports" (offers tips and information to organize trips and holidays)<p>
      <p>- Shares "Travel Reports" with his Followers in Travel Maker and on Social Networks</p>
      <p>- Shares other users' "Travel Reports" on his profile (to maintain a record or communicate his/her travel preferences to other users)</p>
      <p>- Activates the "Alerts" on the most interesting trips (to receive notifications when trips with the same characteristics are posted)</p>
      <p>- Uses the "Same Trip" function to communicate to other users that they had similar travel experiences, express appreciation and compare the information</p>
      <p>- Uses Travel Maker filters to search for his/her ideal trip and to gather information to plan trips and holidays.</p>
    </div>
  </div>
</div>
@php
  $role=Auth::user()->role_type;
@endphp
  
{{isset($validator)?$validator->messages():''}}
<div class="row">
  <div class="col">
    <div class="form-group">
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="form-group">
      {{ html()->label(__('validation.attributes.frontend.describe_yourself'))->for('describe_yourself') }}
             
      {{ html()->textarea('userdetail.describe_yourself')->class('form-control')->placeholder(__('validation.attributes.frontend.travel_report.extended_descriptive_text'))->attribute('maxlength', 191)->autofocus() }}
    </div>
  </div>
</div>


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
        <img src="{{url('img/frontend/user/cover/'.$user_data->userdetail->cover_image)}}" class="img-responsive" height="100" id="cover_image_container">
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
    <a class="nav-link" href="#second_step" onClick="changeStep(second_step)"><i class="fa fa-arrow-right"></i>Go To Second Page</a>
  </li>
</ul> 


