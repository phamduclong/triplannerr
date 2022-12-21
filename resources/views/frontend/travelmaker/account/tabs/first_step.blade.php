<div class="row">
    <div class="col">
        <div class="form-group travel-info">
            <h4>Travel Maker: Role, Functionality and Rules</h4>
            <p>The "Travel Maker" is a traveller who shares his/her travels and inspires other travellers. He/she shares a passion for travel and organizes holidays for his/her friends.</p>
            <p>He/She proposes travel itineraries, calculates the budget necessary to participate and the minimum and maximum number of participants. It is the Tour Leader of the trips he/she offers.</p>
            <p>He/She accesses all the features available for "Travelers" but in Travel Maker He/She is allowed to do much more:</p>
            <p>He/She can post the "Travel Reports" exactly as the "Travelers" do but he/she can also decide to post the "Travel Diaries".</p>
            <p>What are "Travel Diaries"?</p>
            <p>They are detailed analytical documents which contain all the information necessary to faithfully replicate a travel experience:</p>
            <p>- the geographical references, the places they visited and the tracks of the GPS routes (if available or necessary)</p>
            <p>- the geographical references, the places they visited and the tracks of the GPS routes (if available or necessary)</p>
            <p>- the names and contact details of hotels, restaurants and service providers</p>
            <p>- contacts of tour guides, museums or theme parks, services and entertainment that characterized the holiday</p>
            <p>- all expenses in detail, from travel tickets to entertainment expenses</p>
            <p>- tips and useful information to repeat the travel experience in the best way</p>
            <p>While writing the "Travel Diaries", the "Travel Maker" may decide whether to make the collected information available to everyone for free or to ask for a payment of ??? 3.00 in order to download the document.</p>
            <p>The "Travel Maker" therefore also has the possibility to monetize his/her travel experiences.</p>
            <p>- suggesting his/her trips and look for travel partners.</p>
            <p>The "Travel Maker" is an experienced traveller who knows the places where he has traveled very well.</p>
            <p>When creating the "Travel Report" he/she can choose the "Search travel partners" option The "Travel Report" posted by him in this case becomes a travel proposal for the whole Community:</p>
            <p>The "Travel Maker" offers to become the Tour Leader of the trip he has planned and accompany the participants to repeat an experience that he has now consolidated.</p>
            <p>The "Travel Report - Seeking Travel Partners" will contain all the information to decide whether to accept the invitation, form the group of travellers and leave all together.</p>
        </div>
    </div>
</div> 
@php
    $role=Auth::user()->role_type;
@endphp
{{--<div class="row">
    <div class="col">
        <div class="form-group">
            <input class="term_condition" type="checkbox" name="" value="validation.attributes.frontend.term_condition"><a href="{{url('/characteristics-conditions',$role)}}">{{ html()->label(__('validation.attributes.frontend.term_condition'))->class('condition_text')->for('term_condition') }}</a>
        </div>
    </div>
</div>
--}}
<div class="row">
    <div class="col">
        <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.describe_yourself'))->for('describe_yourself') }}
            {{ html()->textarea('userdetail.describe_yourself')
                   ->class('form-control')
                   ->placeholder(__('validation.attributes.frontend.travel_report.extended_descriptive_text'))
                   ->attribute('maxlength', 191)
                   ->autofocus() }}
            
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

<ul class="nav nav-tabs" style="margin-left: 47pc;">
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#second_step"><i class="fa fa-arrow-right"></i> Go To Second Page</a>
    </li>
</ul>
