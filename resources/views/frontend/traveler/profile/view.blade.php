@php
$route_name = Route::currentRouteName();
   if(!empty(Auth::user())){
    if($route_name=='frontend.my_profile' && Auth::user()->id==$user_id){
         $change_css = 'block';
    }
    else{
      $change_css = 'none';
    }
  }
  else{
    $change_css = 'none';
  }
@endphp

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    console.log('tabs')
  $( "#tabs" ).tabs().addClass( "ui-tabs ui-helper-clearfix" );
  $( "#tabs" ).tabs().removeClass( "ui-corner-all ui-widget ui-widget-content" );
  $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
} );
</script>
<style>
.ui-tabs-vertical { width: 100%; }
.ui-tabs-vertical .ui-tabs-nav { padding: 10px 5px 10px 10px; float: left; width: 20%; margin-top: 20px; }
.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
.ui-tabs-vertical .ui-tabs-panel { padding: 20px; float: right; width: 80%; margin-top: 15px;}
.ui-widget-header { border: initial; background: initial; }
.ui-state-default, .ui-widget-header .ui-state-default { border: initial; }
.ui-state-active, .ui-widget-header .ui-state-active { background: #0198cd; }
</style>

<style>
.ads_section1 h6 {
    text-transform: capitalize;
    font-size: 15px;
    font-weight: 600;
    padding: 0 10px;
}
.report-black-img{
   height:33px;
   padding-right:10px;
}
.travel_action.status1{
  background: #005ca9;
  color: #fff;
}
.sametrip.status1 {
    background: #005ca9;
    color: #fff;
}
.right-menu {
    display:<?php echo $change_css; ?>;
}
.edit-report a {
color: #131313;
}
.disabled {
    pointer-events: none;
}

.travel-tt {

  text-align: center;
    color: #ddd;

}

.ads_section1.view-travel-box p {
    font-size: 13px;
    background: #F1F1F1;
    line-height: 22px;
    padding: 10px;
    box-shadow: 0px 2px 5px #aaa;
    margin-top: -2px;
    background: #fff;
    box-shadow: none;
    margin: 0;
}

.ads_section1 a img {
    margin-bottom: 30px;
    max-width: 100%;
    min-height: 190px;
    margin-bottom: 0px !important;
    /* display: none; */
  }

.ads_section1 iframe {
    max-width: 100%;
    min-height: 190px;
}

.ads_section1 video {
    max-width: 100%;
    height: 190px;
    background: #000;
}

.ads_section1 {
    display: inline-block;
    width: 100%;
    text-align: center;
    /*border: solid 1px #ddd;*/
    min-height: 320px;
}

.goog-te-gadget {
  margin-left: 500px;
  font-size: 8px;
  
}

.goog-te-combo {
    font-size: 7pt;
  }

</style>
<div id="dataForPusher" dataUserAuthId="{{$userdata->user->id}}" hidden></div>
<div class="profile-section mx-50">
  <div class="container-fluid">
    <div class="profile-inner">
      <div id="tabs" class="row">
        <div class="col-md-2" style="margin-top: 100px">
          <ul style="font-size: 14px;width:10%;margin-left:-30px;
            justify-content: center;
            padding: 2rem;">
            <li><a href="#tabs-1" class="notranslate"><i class="fas fa-user-circle" style="width: 20px;"></i>&nbsp;About Me</a></li>
            <li style="margin-top: 10px"><a href="#tabs-2" class="notranslate"><i class="fas fa-cogs" style="width: 20px;"></i>&nbsp;My Preferences</a></li>
            <li style="margin-top: 10px"><a href="#tabs-3" class="notranslate"><i class="fas fa-globe" style="width: 20px;"></i>&nbsp;My World</a></li>
          </ul>
        </div>
        <div id="tabs-1" class="col-md-10">
          <h3 style="text-align: center; margin-bottom: 50px;" class="notranslate">About Me</h3>
          <div class="row">
            <div class="col-md-4 text-center notranslate">
              <i class="fas fa-birthday-cake"></i>&nbsp;Birthday
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->birth_place) )
                    {{ substr($userdata->birth_place, 8, 2) . "/" . substr($userdata->birth_place, 5, 2) . "/" . substr($userdata->birth_place, 0, 4) }}
                @endif
              </p>
            </div>
            <div class="col-md-4 text-center notranslate">
              <i class="fas fa-genderless"></i>&nbsp;Sex
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->sex) )
                  {{ $userdata->sex }}
                @endif
              </p>
            </div>
            {{-- <div class="col-md-3 text-center">
              <i class="fas fa-heart"></i>&nbsp;Relationship
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->sentimental_situation) )
                    {{ $userdata->sentimental_situation }}
                @endif
              </p>
            </div> --}}
            <div class="col-md-4 text-center notranslate">
              <i class="fas fa-city"></i>&nbsp;Residence
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->place_of_residence) )
                    {{ $userdata->place_of_residence }}
                @endif
              </p>
            </div>

            @if($userdata->user->role_type == 'travel_agency')
              <div class="col-md-4 text-center" style="margin-top: 30px">
                <i class="fas fa-genderless"></i>&nbsp;Service you are interested in
                <p class="fk-normal-text">
                  @if(!empty($userdata) && isset($userdata->identification_option) )
                      @php $identification_options =  explode(',', $userdata->identification_option)   @endphp

                      @forelse($identification_options as $key =>$type)
                          {{ $type }} &nbsp;
                      @empty

                      @endforelse
                  @endif
                </p>
              </div>

              <div class="col-md-4 text-center" style="margin-top: 27px">
                <i class="fas fa-genderless"></i>&nbsp;Local Operator
                <p class="fk-normal-text">
                  @if(!empty($userdata) && isset($userdata->local_operator) )
                      @php $local_operators =  explode(',', $userdata->local_operator)   @endphp

                      @forelse($local_operators as $key =>$type)
                          {{ $type }} &nbsp;
                      @empty

                      @endforelse
                  @endif
                </p>
              </div>
            @endif

          </div>
          <hr style="margin: 50px 0" />
          <div class="row">
            @if($userdata->user->role_type == 'travel_blogger')
              <div class="col-md-8 text-center" style="margin-top: -40px">
                <i class="fas fa-user-alt"></i>&nbsp;<span class="notranslate">My Biography</span>
                <div id="google_translate_element"></div> 
                <p class="fk-normal-text" style="text-align: left">
                  @if(!empty($userdata) && isset($userdata->describe_yourself) )
                      {{ $userdata->describe_yourself }}
                  @endif
                </p>
                <div style="margin-top: 40px" class="notranslate">
                  <div><i class="fa fa-server" aria-hidden="true"></i>&nbsp;Main Services Offered For Collaborations</div>
                  <?php
                    $listServices = explode(",", $userdata->blogger_service)
                  ?>
                  <div style="text-align: left;font-size: 12px">
                    @foreach($listServices as $listService)
                      @switch($listService)
                        @case(0)
                          <div style="margin-top: 10px">- Writing SEO articles with back-links Editing for your blog of an article that advertises "Travel Pro", which refers to his site, written in such a way as to implement Google s positioning of the "Travel Pro".</div>
                        @break
                        @case(1)
                          <div style="margin-top: 10px">- Promotion on their social channels Speak genuinely about your experience with the "Travel Pro", adding tags and mentions to the social channels of the "Travel Pro".</div>
                        @break
                        @case(2)
                          <div style="margin-top: 10px">- The blogger accesses the "Travel Pro" Instagram channel for a few hours to make stories, inviting his followers to follow this channel.</div>
                        @break  
                        @case(3)
                          <div style="margin-top: 10px">- Creation of an ad hoc format Possibility to propose a specific web marketing project, agreeing it with the "Travel Pro".</div>
                        @break
                        @case(4)
                          <div style="margin-top: 10px">- Creation of a promotional video available for the "Travel Pro".</div>
                        @break
                        @case(5)
                          <div style="margin-top: 10px">- Creation of a package of at least 5 professional photos available for the "Travel Pro".</div>
                        @break
                      @endswitch
                    @endforeach
                  </div>
                </div>
              </div>
            @else
              <div class="col-md-8 text-center">
                @if(!empty($userdata->agency_logo) && file_exists(public_path('img/frontend/user'.'/'.$userdata->agency_logo)) )
                 <img style="margin-left: -400px !important" src="{{url('img/frontend/user/'.$userdata->agency_logo)}}" class="img-responsive" width="100" height="100">
                @endif
                <i style="margin-left: 50px;" class="fas fa-user-alt"></i>&nbsp;<span class="notranslate">My biography</span>
                <div id="google_translate_element"></div>
                <p class="fk-normal-text" style="text-align: left;margin-top:30px">
                  @if(!empty($userdata) && isset($userdata->describe_yourself) )
                      {{ $userdata->describe_yourself }}
                  @endif
                </p>
              </div>
            @endif
            <div class="col-md-4 text-center notranslate">
              <?php
                $total_alert = 0;
                foreach ($alert_super_data as  $alert) {
                  $total_alert += $alert->alerts_count;
                }

                $total_super = 0;
                foreach ($alert_super_data as  $super) {
                  $total_super += $super->supers_count;
                }
              ?>
              <i class="fas fa-users"></i>&nbsp;Social
              <p class="fk-normal-text">
                    <span id="totalAlerts">{{ $total_alert }}</span> Alerts received<br/>
                    <span id="totalLikes">{{ $total_super }}</span> Likes received<br/>
                    <div class="follow-div">
                      @php $follow_status = 1 @endphp
                      @if(!empty($followdata) && $followdata->status=='1')
                        @php $follow_status = 0 @endphp
                      @endif
                      @if(!empty(Auth::user()))
                        @if(Auth::user()->id == $user_id)
                          <div class="repo_btn1" id="showListFollow">
                            <button class="follow @if(Auth::user()->id == $user_id) disabled @endif" data-id="{{ $user_id }}" data-value="{{ $follow_status }}" onClick="follow_user(this)">
                              @if(Auth::user()->id == $user_id)
                                <span id="followcount" style="display: inline">{{$followcount}}</span><a href="javascript:void(0)" > Follow</a>
                              @else
                                @php
                                  if(!empty($followdata) && $followdata->status=='1')
                                    echo $followcount .'<a href="javascript:void(0)" > UnFollow</a>';
                                  else
                                    echo $followcount .'<a href="javascript:void(0)" > Follow</a>';
                                @endphp
                              @endif
                            </button>
                          </div>
                        @else
                          <div class="repo_btn1">
                            <button class="follow @if(Auth::user()->id == $user_id) disabled @endif" data-id="{{ $user_id }}" data-value="{{ $follow_status }}" onClick="follow_user(this)">
                              @if(Auth::user()->id == $user_id)
                              <span id="followcount" style="display: inline">{{$followcount}}</span><a href="javascript:void(0)" > Follow</a>
                              @else
                                @php
                                  if(!empty($followdata) && $followdata->status=='1')
                                    echo $followcount .'<a href="javascript:void(0)" > UnFollow</a>';
                                  else
                                    echo $followcount .'<a href="javascript:void(0)" > Follow</a>';
                                @endphp
                              @endif
                            </button>
                          </div>
                        @endif
                      @else
                        <div class="repo_btn1">
                          <button class="follow" data-id="{{ $user_id }}" data-value="{{ $follow_status }}" onClick="follow_user(this)" >{{ $followcount}}<a href="{{url('/main-login')}}"> Follow</a></button>
                        </div>
                      @endif
                    </div>
                    @if(Auth::check())
                      @if($userdata->user->role_type == 'travel_agency' && Auth::user()->role_type == 'travel_blogger')
                        <div style="margin-top: 20px">
                          <button class="btn btn-danger" id="buttonSendMessage" roleType={{$role_type}} checkRequestInMonth={{$checkRequestInMonth}} userIdAuth={{Auth::user()->id}} userIdNoAuth={{$user_id}} roleTypeAuth={{Auth::user()->role_type}}>Start a collaboration</button>
                        </div>
                      @endif
                      @if($userdata->user->role_type == 'travel_blogger' && Auth::user()->role_type == 'travel_agency')
                        <div style="margin-top: 20px">
                          <button class="btn btn-danger" id="buttonSendMessage" roleType={{$role_type}} checkRequestInMonth={{$checkRequestInMonth}} userIdAuth={{Auth::user()->id}} userIdNoAuth={{$user_id}} roleTypeAuth={{Auth::user()->role_type}}>Start a collaboration</button>
                        </div>
                      @endif
                      @if($userdata->user->role_type == 'travel_agency' && Auth::user()->role_type == 'traveler')
                        <div style="margin-top: 20px">
                          <button class="btn btn-danger" id="buttonSendMessage" roleType={{$role_type}} checkRequestInMonth={{$checkRequestInMonthTraveler}} userIdAuth={{Auth::user()->id}} userIdNoAuth={{$user_id}} roleTypeAuth={{Auth::user()->role_type}}>Send Message</button>
                        </div>
                      @endif
                      @if($userdata->user->role_type == 'traveler' && Auth::user()->role_type == 'travel_agency')
                        <div style="margin-top: 20px">
                          <button class="btn btn-danger" id="buttonSendMessage" roleType={{$role_type}} checkRequestInMonth={{$checkRequestInMonthTraveler}} userIdAuth={{Auth::user()->id}} userIdNoAuth={{$user_id}} roleTypeAuth={{Auth::user()->role_type}}>Send Message</button>
                        </div>
                      @endif
                      @if($userdata->user->role_type == 'travel_agency' && Auth::user()->role_type == 'travel_maker')
                        <div style="margin-top: 20px">
                          <button class="btn btn-danger" id="buttonSendMessage" roleType={{$role_type}} checkRequestInMonth={{$checkRequestInMonthTravelMaker}} userIdAuth={{Auth::user()->id}} userIdNoAuth={{$user_id}} roleTypeAuth={{Auth::user()->role_type}}>Send Message</button>
                        </div>
                      @endif
                      @if($userdata->user->role_type == 'travel_maker' && Auth::user()->role_type == 'travel_agency')
                        <div style="margin-top: 20px">
                          <button class="btn btn-danger" id="buttonSendMessage" roleType={{$role_type}} checkRequestInMonth={{$checkRequestInMonthTravelMaker}} userIdAuth={{Auth::user()->id}} userIdNoAuth={{$user_id}} roleTypeAuth={{Auth::user()->role_type}}>Send Message</button>
                        </div>
                      @endif
                    @endif
              </p>
            </div>
          </div>
          <hr style="margin: 50px 0" />
          @if($userdata->user->role_type == 'travel_blogger'  || $userdata->user->role_type == 'travel_agency')
            <div class="row notranslate">
              <div class="col-md-7"></div>
              <div class="col-md-5">
                @if(!empty($userdata->fb_link))
                  <a href="{{$userdata->fb_link}}" target="_blank">
                    <i class="fa fa-facebook-square" style="font-size: 3em"></i>
                  </a>
                @else
                  <a href="#" style="pointer-events: none;cursor: default;">
                    <i class="fa fa-facebook-square" style="font-size: 3em"></i>
                  </a>
                @endif
                @if(!empty($userdata->twitter_link))
                  <a href="{{$userdata->twitter_link}}" target="_blank">
                    <i class="fa fa-twitter-square" style="font-size: 3em;color:#00BFFF"></i>
                  </a>
                @else
                  <a href="#" style="pointer-events: none;cursor: default;">
                    <i class="fa fa-twitter-square" style="font-size: 3em;color:#00BFFF"></i>
                  </a>
                @endif
                
                @if(!empty($userdata->insta_link))
                  <a href="{{$userdata->insta_link}}" target="_blank">
                    {{-- <img src="{{asset('img/frontend/instagram_image.png')}}" style="width:65px;height:50px;margin-top:-24px"> --}}
                    <i class="fa fa-instagram" style="font-size: 3em;"></i>
                  </a>
                @else
                  <a href="#" style="pointer-events: none;cursor: default;">
                    {{-- <img src="{{asset('img/frontend/instagram_image.png')}}" style="width:65px;height:50px;margin-top:-24px"> --}}
                    <i class="fa fa-instagram" style="font-size: 3em;"></i>
                  </a>
                @endif
                
                @if(!empty($userdata->pinterest_link))
                  <a href="{{$userdata->pinterest_link}}" target="_blank">
                    <i class="fa fa-pinterest-square" style="font-size: 3em;color:red"></i>
                  </a>
                @else
                  <a href="#" style="pointer-events: none;cursor: default;">
                    <i class="fa fa-pinterest-square" style="font-size: 3em;color:red"></i>
                  </a>
                @endif
                
                @if(!empty($userdata->tiktok_link))
                  <a style="color: white;" href="{{$userdata->tiktok_link}}" target="_blank">
                    <svg style="margin-top: -24px;background-color:black;border-radius: 8px;padding:5px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                      <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                    </svg>
                  </a>
                @else
                  <a href="#" style="color: white;pointer-events: none;cursor: default;">
                    <svg style="margin-top: -24px;background-color:black;border-radius: 8px;padding:5px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                      <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                    </svg>
                  </a>
                @endif
                
                {{-- <i class="fa fa-youtube-square" style="font-size: 3em;"></i> --}}
                @if(!empty($userdata->youtube_link))
                  <a href="{{$userdata->youtube_link}}" target="_blank">
                    {{-- <img src="{{asset('img/frontend/youtube_image.png')}}" style="width:40px;height:40px;margin-top:-24px"> --}}
                    <i class="fa fa-youtube-square" style="font-size: 3em;"></i>
                  </a>
                @else
                  <a href="#" style="pointer-events: none;cursor: default;">
                    {{-- <img src="{{asset('img/frontend/youtube_image.png')}}" style="width:40px;height:40px;margin-top:-24px"> --}}
                    <i class="fa fa-youtube-square" style="font-size: 3em;"></i>
                  </a>
                @endif
                @if(!empty($userdata->linkedin_link) )
                  <a style="color: white;" href="{{$userdata->linkedin_link}}" target="_blank">
                    <i class="fa fa-linkedin-square" style="font-size: 3em;color:#1E90FF"></i>
                  </a>
                @else
                  <a href="#" style="color: white;pointer-events: none;cursor: default;">
                    <i class="fa fa-linkedin-square" style="font-size: 3em;color:#1E90FF"></i>
                  </a>
                @endif
                {{-- <i class="fa fa-id-card" aria-hidden="true" style="font-size: 3em;"></i> --}}
                @if(!empty($userdata->personal_website))
                  <a href="{{$userdata->personal_website}}" target="_blank">
                    {{-- <img src="{{asset('img/frontend/personal_website.png')}}" style="width:40px;height:40px;margin-top:-24px" class="image_personal_web"> --}}
                    {{-- <i class="fa fa-id-card" aria-hidden="true" style="font-size: 3em;"></i> --}}
                    @if(!empty($userdata->agency_logo) && file_exists(public_path('img/frontend/user'.'/'.$userdata->agency_logo)) )
                      <img style="margin-top:-22px" src="{{url('img/frontend/user/'.$userdata->agency_logo)}}" class="img-responsive" width="45" height="45">
                    @else
                      <i class="fa fa-id-card" aria-hidden="true" style="font-size: 3em;"></i>
                    @endif
                  </a>
                @else
                  <a href="#" style="pointer-events: none;cursor: default;">
                    {{-- <img src="{{asset('img/frontend/personal_website.png')}}" style="width:40px;height:40px;margin-top:-24px" class="image_personal_web"> --}}
                    {{-- <i class="fa fa-id-card" aria-hidden="true" style="font-size: 3em;"></i> --}}
                    @if(!empty($userdata->agency_logo) && file_exists(public_path('img/frontend/user'.'/'.$userdata->agency_logo)) )
                      <a href="{{$userdata->agency_website}}" target="_blank">
                        <img style="margin-top:-22px" src="{{url('img/frontend/user/'.$userdata->agency_logo)}}" class="img-responsive" width="45" height="45">
                      </a>
                    @else
                      <i class="fa fa-id-card" aria-hidden="true" style="font-size: 3em;"></i>
                    @endif
                  </a>
                @endif
              </div>
            </div>
          @endif
        </div>
        <div id="tabs-2" class="col-md-10 notranslate">
          <h3 style="text-align: center; margin-bottom: 50px;">My Preferences</h3>
          <div class="row">
            <div class="col-md-4 text-center">
              <i class="fas fa-passport"></i>&nbsp;Ideal Travel Category
              {{-- <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->type_of_travel) )
                    @php $type_of_travels =  explode(',', $userdata->type_of_travel)   @endphp

                    @forelse($type_of_travels as $key =>$type)
                       {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p> --}}
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->preferred_travel_category) )
                    @php $preferred_travel_categorys =  explode(',', $userdata->preferred_travel_category)   @endphp

                    @forelse($preferred_travel_categorys as $key =>$type)
                        {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p>
            </div>

            <div class="col-md-4 text-center">
              <i class="fas fa-location-arrow"></i>&nbsp;Favourite Visited Countries
              <p class="fk-normal-text">
                @if($userdata) {{isset($userdata->fav_nation)?$userdata->fav_nation:''}}@endif
              </p>
            </div>
            <div class="col-md-4 text-center">
              <i class="fas fa-star"></i>&nbsp;Countries Wishlist
              <p class="fk-normal-text">
                @if($userdata) {{isset($userdata->fav_nation_want)?$userdata->fav_nation_want:''}}@endif
              </p>
            </div>
            
            {{-- <div class="col-md-4 text-center">
              <i class="fas fa-suitcase-rolling"></i>&nbsp;Ideal Type of Travel
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->preferred_travel_category) )
                    @php $preferred_travel_categorys =  explode(',', $userdata->preferred_travel_category)   @endphp

                    @forelse($preferred_travel_categorys as $key =>$type)
                        {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p>
            </div> --}}
            @if($userdata->user->role_type != 'travel_agency')
            <hr style="margin: 50px 0" />
            <div class="col-md-4 text-center">
              <i class="fas fa-bus"></i>&nbsp;Ideal Transportation
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->vector_type) )
                    @php $vector_types =  explode(',', $userdata->vector_type)   @endphp

                    @forelse($vector_types as $key =>$type)
                        {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p>
            </div>

            <div class="col-md-4 text-center">
              <i class="fas fa-suitcase-rolling"></i>&nbsp;Ideal Type of Travel
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->type_of_travel) )
                    @php $type_of_travels =  explode(',', $userdata->type_of_travel)   @endphp

                    @forelse($type_of_travels as $key =>$type)
                       {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p>
            </div>

            <div class="col-md-4 text-center">
              <i class="fas fa-user-friends"></i></i>&nbsp;Favourite Travel Partners
              <p class="fk-normal-text">
                @if($userdata) {{ isset($userdata->type_of_participants) ? $userdata->type_of_participants : '' }} @endif
              </p>
            </div>
            @endif
          </div>

          @if($userdata->user->role_type == 'travel_agency')
            <div class="row" style="margin-top: 30px">
              <div class="col-md-12 text-center">
                <div>Other</div>
                <p class="fk-normal-text">
                  @if(!empty($userdata) && isset($userdata->other) )
                    {{ $userdata->other }}
                  @endif
                </p>
              </div>
            </div>
          @endif
          @if($userdata->user->role_type != 'travel_agency')
          <hr style="margin: 50px 0" />
          <div class="row">
            <div class="col-md-4 text-center">
              <i class="fas fa-hotel"></i>&nbsp;Ideal Accomodation
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->type_of_accommodation) )
                    @php $type_of_accommodations =  explode(',', $userdata->type_of_accommodation)   @endphp

                    @forelse($type_of_accommodations as $key =>$type)
                        {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p>
            </div>
            <div class="col-md-4 text-center">
              <i class="fas fa-utensils"></i>&nbsp;Favourite Meals
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->travel_favoritemealtype) )
                    @php $travel_favoritemealtypes =  explode(',', $userdata->travel_favoritemealtype)   @endphp

                    @forelse($travel_favoritemealtypes as $key =>$type)
                        {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p>
            </div>
            <div class="col-md-4 text-center">
              <i class="fas fa-euro-sign"></i>&nbsp;Ideal Travel Budget
              <p class="fk-normal-text">
                @if(!empty($userdata) && isset($userdata->preferred_travel_budget) )
                    @php $preferred_travel_budgets =  explode(',', $userdata->preferred_travel_budget)   @endphp

                    @forelse($preferred_travel_budgets as $key =>$type)
                        {{ $type }}
                    @empty

                    @endforelse
                @endif
              </p>
            </div>
          </div>
          @endif
          {{-- <hr style="margin: 50px 0" />
          <div class="row">
            <div class="col-md-4 text-center">
              <i class="fas fa-user-friends"></i></i>&nbsp;Favourite Travel Partners
              <p class="fk-normal-text">
                @if($userdata) {{ isset($userdata->type_of_participants) ? $userdata->type_of_participants : '' }} @endif
              </p>
            </div>
            <div class="col-md-4 text-center">
              <i class="fas fa-location-arrow"></i>&nbsp;Favourite Visited Countries
              <p class="fk-normal-text">
                @if($userdata) {{isset($userdata->fav_nation)?$userdata->fav_nation:''}}@endif
              </p>
            </div>
            <div class="col-md-4 text-center">
              <i class="fas fa-star"></i>&nbsp;Countries Wishlist
              <p class="fk-normal-text">
                @if($userdata) {{isset($userdata->fav_nation_want)?$userdata->fav_nation_want:''}}@endif
              </p>
            </div>
          </div> --}}
        </div>
        <div id="tabs-3" class="col-md-10 notranslate">
          <div class="profile-banner">
            <div class="regions_div" id="regions_div" style="width: 900px; height: 500px;" name="{{$userdata}}" countriesOptions="{{$countriesOptions}}"></div>
            {{-- @include('frontend.profile-banner') --}}
            {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}"> --}}
            <p>"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @if(Auth::check())
    @if(Auth::user()->id == $user_id)
      <div class="row notranslate" style="margin-top: 20px">
        <div class="col-md-5"></div>
        <div class="col-md-7">
          <a href="{{url('/travel_report')}}" class="btn btn-primary" style="color: white;font-size: 15px;">Create A New Travel Report</a>
        </div>
      </div>
    @endif
  @endif
  <div class="row notranslate" style="margin-top: 50px">
    <div class="col-md-5"></div>
    <div class="col-md-7">
      <a href="javascript:void(0)"><i id="shareFacebook" class="fa fa-facebook-square" style="font-size: 3em"></i></a>
      <a href="javascript:void(0)"><i id="shareTwitter" class="fa fa-twitter-square" style="font-size: 3em;color:#00BFFF"></i></a>
      <a href="javascript:void(0)"><i id="shareLinkedin" class="fa fa-linkedin-square" style="font-size: 3em;color:#1E90FF"></i></a>
      <a href="javascript:void(0)"><i id="shareTelegram" class="fa fa-telegram" aria-hidden="true" style="font-size: 3em;color:#1E90FF"></i></a>
      <a href="javascript:void(0)" data-action="share/whatsapp/share"><i id="shareWhatsapp" class="fa fa-whatsapp" aria-hidden="true" style="font-size: 3em;color:green"></i></a>
    </div>
  </div>
</div>

<div class="travel-report notranslate">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="left-report row" id="travel_report_list_item">
            @forelse($alert_super_data as $report_data)
              <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="travel_site">
                    <div class="travel_over">
                      <b style="color: #005ca9;"><center>{{ $report_data->title}}</center></b>
                      @if(!empty($report_data->cover_photo) && file_exists(public_path('img/frontend/travel_report/coverphoto'.'/'.$report_data->cover_photo)) )
                           <img src="{{url('img/frontend/travel_report/coverphoto/'.$report_data->cover_photo)}}">
                           @else
                           <img src="{{url('img/frontend/alert1.jpg')}}">
                             @endif
                            <div class="overlay">
                            @if(!empty(Auth::user()))
                                @if(Auth::user()->id==$user_id)
                                 <div class="delete-report" style="float:right;"><a href="{{url('delete/travel_report',convertoToSlug($report_data->title))}}" style="color: #ff00006e;"><i class="fas fa-trash"></i></a></div>
                                 <div class="edit-report" style="float:right"><a href="{{url('edit/travel_report',convertoToSlug($report_data->title))}}" style="color: #005ca9;"><i class="fas fa-edit"></i></a></div>
                                @endif
                            @endif
                            <div class="middle">
                               @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
                                <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}">
                                 @else
                                <img src="{{url('img/frontend/f-logo.png')}}">
                                   @endif

                                <a href="{{url('view/travel_report',$report_data->slug)}}" class="text"><img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">
                                  @if($report_data->report_option == 'report' && $report_data->role_type=='travel_maker')
                                  Travel Report
                                  @endif
                                  @if($report_data->report_option == 'offer' && $report_data->role_type=='travel_maker')
                                  Travel Buddy Search
                                  @endif
                                  @if($report_data->role_type=='traveler')
                                  Travel Report
                                  @endif
                                  @if($report_data->role_type=='travel_agency')
                                  Travel Offert
                                  @endif
                                  @if($report_data->role_type=='travel_blogger')
                                  Travel Post
                                  @endif
                                </a>
                            </div>
                            <!-- <div class="middle">
                            <img src="{{('img/frontend/f-logo.png')}}">
                            <a href="#" class="text">Travel Report</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="travel_btn">
                      @if(!empty(Auth::user()))
                          @php
                          $super=check_super_from_user($report_data->id, Auth::user()->id);
                          @endphp
                          @if($super=='1')
                              <a href="javascript:void(0)" class="travel_action status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$report_data->id}}" data-count="{{$report_data->supers_count}}" data-text="Like">Like {{$report_data->supers_count}}</a>
                          @else
                            <a href="javascript:void(0)" class="travel_action status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="super" data-id="{{$report_data->id}}" data-count="{{$report_data->supers_count}}" data-text="Like">Like {{$report_data->supers_count}}</a>
                          @endif
                      @else
                          <a href="{{url('/main-login')}}">Like! {{$report_data->supers_count}}</a>
                      @endif
                      @if(!empty(Auth::user()))
                          @php
                          $alert=check_alert_from_user($report_data->id, Auth::user()->id);
                          @endphp
                          @if($alert=='1')
                            <a href="javascript:void(0)" class="travel_action status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$report_data->id}}" data-text="Alert" data-count="{{$report_data->alerts_count}}">Alert {{$report_data->alerts_count}}</a>
                          @else
                            <a href="javascript:void(0)" class="travel_action status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="alert" data-id="{{$report_data->id}}" data-text="Alert" data-count="{{$report_data->alerts_count}}">Alert {{$report_data->alerts_count}}</a>
                          @endif
                      @else
                          <a href="{{url('/main-login')}}">Alert {{$report_data->alerts_count}}</a>
                      @endif
                      @if(!empty(Auth::user()))
                         @php
                            $same_trip_page=check_sametrip_page_from_user($report_data->id,Auth::user()->id);
                         @endphp
                        @if($same_trip_page=='1')
                          <a href="javascript:void(0)" class="travel_action status1 disabled @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip page" data-id="{{$report_data->id}}"  id = "sametrip-{{$report_data->id}}">Same Trip Page</a>
                        @else
                          <a href="javascript:void(0)" class="travel_action status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip page" data-id="{{$report_data->id}}" id = "sametrip-{{$report_data->id}}">Same Trip Page</a>
                        @endif
                      @else
                        <a href="{{url('/main-login')}}">Same Trip Page</a>
                      @endif
                      @if(!empty(Auth::user()))
                           @php
                             $same_trip=check_sametrip_from_user($report_data->id, Auth::user()->id);
                           @endphp
                           @if($same_trip=='1')
                               <a href="javascript:void(0);" class="sametrip status1
                               @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip" data-id="{{$report_data->id}}"onClick="same_trip_delete(this)">Same Trip</a>
                           @else
                            <a href="javascript:void(0);" id="element" class="sametrip status0 checktrip @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip" data-id="{{$report_data->id}}" onClick="same_report(this)">Same Trip</a>
                          @endif
                      @else
                        <a href="{{url('/main-login')}}">Same Trip</a>
                      @endif
                    </div>
                  </div>
              </div>
            @empty
                <h3>No report found</h3>
          @endforelse
          <div id="load-data"></div>
        </div>
        <div id="remove-row">
            <button class="btn more_btn filter_report_btn_more" id="more_btn" userIdNoAuth={{$user_id}}>
              <span id="textMoreReport">More Reports</span>
              <div class="spinner-border text-light" role="status" style="display:none" id="loadingReport">
                <span class="sr-only">Loading...</span>
              </div>
            </button>
        </div>
       </div>

       <div class="col-md-3">
        {{--<div class="ads_section1">
          <a href="#"><img src="{{ url('img/frontend/ads1.png') }}"></a>
          <a href="#"><img src="{{ url('img/frontend/ads2.png') }}"></a>
          <a href="#"><img src="{{ url('img/frontend/ads2.png') }}"></a>
        </div>--}}
        @php
          $ip= Request::ip();
        @endphp

        <div class="ads_section1 view-travel-box">
          @if(!empty($ads_data))
            @foreach($ads_data as $ads)
             @if($ads->ads_type=='free')
                @if($ads->type=="image")
                 <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
                 <h6>{{$ads->title}}</h6>
                 <img class="travel_site" src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
                 <p>{{$ads->description}}</p>
                @endif

                  @if($ads->type=='video')
                     @if(!empty($ads->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$ads->type_file)) )
                     <h6>{{$ads->title}}</h6>
                      <video width="280" controls class="travel_site">
                        <source src="{{url('img/backend/advertisement/'.$ads->type_file)}}" type="video/mp4">
                      </video>
                      <p>{{$ads->description}}</p>
                       @else
                       <h6>{{$ads->title}}</h6>
                      <iframe width="280" src="{{isset($ads->embedded_link)?$ads->embedded_link:''}}">
                      </iframe>
                      <p>{{$ads->description}}</p>
                      @endif
                  @endif
                @endif
            @endforeach
          @endif
      </div>
      </div>
        <div class="col-md-9">
            <div class="left-report row">
                @if(!empty($ads_data_bottom))
                    @foreach($ads_data_bottom as $ads)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      @if($ads->ads_type=='paid' || $ads->ads_type=='free')
                        @if($ads->type=="image")
                         <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
                         <h6>{{$ads->title}}</h6>
                         <img class="travel_site" style="max-width: 100%; min-height: 190px; height: 173px;" src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
                         <p>{{$ads->description}}</p>
                        @endif

                        @if($ads->type=='video')
                            @if(!empty($ads->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$ads->type_file)) )
                             <h6>{{$ads->title}}</h6>
                              <video controls class="travel_site">
                                <source src="{{url('img/backend/advertisement/'.$ads->type_file)}}" type="video/mp4">
                              </video>
                              <p>{{$ads->description}}</p>
                               @else
                               <h6>{{$ads->title}}</h6>
                              <iframe src="{{isset($ads->embedded_link)?$ads->embedded_link:''}}">
                              </iframe>
                              <p>{{$ads->description}}</p>
                            @endif
                        @endif
                      @endif
                     </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <!-- <button class="btn more_btn"><img class="report-black-img" src="{{ url('img/frontend/black_travel_report.png')}}">Call to Actions</button>-->
  </div>
</div>

<div id="listFollowUsers" class="modal notranslate" role="dialog" style="width: 700px; margin:auto">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">List of followed users</h4>
              <button id="xClose" type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12 text-center">
                      <div id="dataUsers">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Username</th>
                            </tr>
                          </thead>
                          <tbody id="listUserFollows">
                            <?php $i = 1 ?>
                            @foreach($listUserFollows as $listUserFollow)
                              <th scope="row">{{$i}}</th>
                              <td>{{$listUserFollow->user_name}}</td>
                              <?php $i++ ?>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button id="closeModal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>


<div id="popUpSendMessage" class="modal notranslate" role="dialog" style="width: 700px; margin:auto">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Send Message</h4>
              <button id="xCloseSendMessage" type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form action="{{ route('frontend.sendMessage') }}" method="POST">
                @csrf
                {{-- <label for="toEmail">To Email:</label> --}}
                <input type="text" name="userIdNoAuth" value="{{$user_id}}" hidden>
                <input type="text" name="firstNameNoAuth" value="{{$userdata->user->first_name}}" hidden>
                <input type="text" name="lastNameNoAuth" value="{{$userdata->user->last_name}}" hidden>
                <input type="text" name="roleTypeNoAuth" value="{{$userdata->user->role_type}}" hidden>
                <input class="form-control" type="text" name="toEmail" id="toEmail" value="{{$emailToSend}}" hidden>
                <label for="messageSended">Message:</label>
                <textarea class="form-control" type="text" name="messageSended" id="messageSended"></textarea>
                <input type="submit" class="btn btn-primary" value="Send" id="submitMessage" hidden>
              </form>
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary" id="messageSubmit">Send</button>
              <button id="closeSendMessage" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://js.pusher.com/7.1/pusher.min.js"></script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
//handle event change user follows
Pusher.logToConsole = false;

var pusher = new Pusher('89922e6caa620cd4e897', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('channel-change-user-follows');
channel.bind('event-change-user-follows', function(data) {
  // alert(JSON.stringify(data));
  var userAuthId = $('#dataForPusher').attr('dataUserAuthId');
  if(userAuthId == data.userId){
    $('#followcount').html(data.numberOfFollows);
    $('#listUserFollows').html('');
    for(var i = 0 ; i < data.listUserFollows.length; ++i){
      $('#listUserFollows').append("<th scope='row'>"+(i+1)+"</th>");
      $('#listUserFollows').append("<td>"+data.listUserFollows[i]+"</td>");
    }
    
  }
});

var channel1 = pusher.subscribe('channel-change-like-and-alert');
channel1.bind('event-change-like-and-alert', function(data) {
  var userAuthId = $('#dataForPusher').attr('dataUserAuthId');
  if(userAuthId == data.userId){
    $('#totalAlerts').html(data.numberOfAlert);
    $('#totalLikes').html(data.numberOfLike);
  }
});
//end handle event change user follows
$(document).ready(function(){
  $('.delete-report').click(function(e){
    if(!confirm("Are You Sure to delete this?")){
      e.preventDefault();
    }
  });
  $('#showListFollow').click(function(){
    $('#listFollowUsers').modal('show');
  });
  $('#buttonSendMessage').click(function(){
    var roleType = $(this).attr('roleType');
    var checkRequestInMonth = $(this).attr('checkRequestInMonth');
    var userIdAuth = $(this).attr('userIdAuth');
    var userIdNoAuth = $(this).attr('userIdNoAuth');
    var roleTypeAuth = $(this).attr('roleTypeAuth');
    if(userIdAuth == userIdNoAuth){
      alert("You cannot send a message to yourself");
      return;
    }
    if(roleTypeAuth == 'travel_blogger' && checkRequestInMonth > 4){
      alert("Maximum number of messages reached for this month. Please try again next month");
      return;
    }
    if(roleTypeAuth == 'traveler' && checkRequestInMonth > 0){
      alert("Maximum number of messages reached for this month. Please try again next month");
      return;
    }
    if(roleTypeAuth == 'travel_maker' && checkRequestInMonth > 0){
      alert("Maximum number of messages reached for this month. Please try again next month");
      return;
    }
    $('#popUpSendMessage').modal('show');
  });
  $('#messageSubmit').click(function(){
    $('#submitMessage').click();
    $('#popUpSendMessage').css('opacity', '0.5');
  });

  //handle more report
  var page = 1;
  $('#more_btn').click(function(){
    page++;
    var user_id = $(this).attr('userIdNoAuth');
    $('#textMoreReport').hide();
    $('#loadingReport').show();
    $.ajax({
        data:{page:page,user_id:user_id, '_token' : '{{ csrf_token()}}'},
        type:'get',
        url:'{{url("/profile/get_more_travel_report") }}',
        success: function(data){
          $('#travel_report_list_item').html(data);
          $('#textMoreReport').show();
          $('#loadingReport').hide();
        },
    });
  });

  //end handle more report

  //handle share social
  setTimeout(function(){
    var title = 'Triplannerr';
    $('#shareFacebook').click(function(){
      var shareUrl = window.location.href;
      // link = 'https://www.facebook.com/sharer/sharer.php?u='+shareUrl+'&t=Share';
      link = 'https://www.facebook.com/sharer/sharer.php?u='+shareUrl;
      window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
    });
    $('#shareTwitter').click(function(){
      var shareUrl = window.location.href;
      // link = 'http://twitter.com/share?url='+shareUrl+'&text='+title;
      link = 'http://twitter.com/share?url='+shareUrl;
      window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
    });
    $('#shareLinkedin').click(function(){
      var shareUrl = window.location.href;
      link = 'https://www.linkedin.com/shareArticle?mini=true&url='+shareUrl;
      window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
    });
    $('#shareTelegram').click(function(){
      var shareUrl = window.location.href;
      // link = 'https://telegram.me/share/url?url='+shareUrl+'&text='+title;
      link = 'https://telegram.me/share/url?url='+shareUrl;
      window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
    });
    $('#shareWhatsapp').click(function(){
      var shareUrl = window.location.href;
      link = 'https://api.whatsapp.com/send?text='+shareUrl;
      // link = 'https://api.whatsapp.com/send?url='+shareUrl;
      window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
    });
  }, 500);
  //end handle share social
});
var userdata = JSON.parse($('#regions_div').attr('name'));
var place_of_residence = userdata.place_of_residence;
var fav_nation = userdata.fav_nation.split(', ');
var fav_nation_want = userdata.fav_nation_want.split(', ');
var allCountries = JSON.parse($('#regions_div').attr('countriesOptions'));
var list = [
  ['Country', 'Value', {role: 'tooltip', p:{html:true}}],
  // [place_of_residence, 200, '']
];
for(var i = 0 ; i < allCountries.length; ++i){
  list.push([
    allCountries[i],
    700,
    ''
  ]);
}
for(var i = 0; i < fav_nation.length; ++i){
  list.push([
    fav_nation[i],
    400,
    ''
  ]);
}
for(var i = 0; i < fav_nation_want.length; ++i){
  list.push([
    fav_nation_want[i],
    500,
    ''
  ]);
}
list.push([
  place_of_residence,
  200,
  ''
]);

  google.charts.load('current', {
    'packages':['geochart'],
    'mapsApiKey': 'AIzaSyCGrOHkMNJxFTIBIXK4TV5qS-yffxIaSxI'
  });
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable(
      
      // ['Germany', 200],
      // ['United States', 300],
      // ['Brazil', 400],
      // ['Canada', 500],
      // ['France', 600],
      // ['RU', 700]
      list
      
    );

    var options = {
      // region: '002', // Africa
      colorAxis: {colors: ['#32CD32', 'blue', 'red', 'gray']},
      backgroundColor: '#81d4fa',
      datalessRegionColor: 'gray',
      defaultColor: '#f5f5f5',
      legend: 'none',
      height: $('#regions_div').height(),
      width: $('#tabs-3').width(),
      keepAspectRatio: false,
      tooltip: {
        // trigger:  'none'
        isHtml: true
      }
    };

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);
  }
  $(window).resize(function(){
    drawRegionsMap();
  });

  //google translate
  function googleTranslateElementInit() { 
      new google.translate.TranslateElement(
          {pageLanguage: 'auto'}, 
          'google_translate_element'
      ); 
  } 
</script>
@push('after-styles')
<style>
.ads_section1 p {
    font-size: 13px;
    background: #F1F1F1;
    line-height: 22px;
    padding: 10px;
    box-shadow: 0px 2px 5px #aaa;
    margin-top: -2px;
}
.ads_section1 a img {
    margin-bottom: 0px !important;
}
  #loader {
    width: 100%;
    height: 100%;
    top: 200;
    left: 20;
    position: fixed;
    display: block;
    opacity: 0.7;
    background-color: #fff;
    z-index: 99;
    text-align: center;
  }
  .nav__menu a {
    color: #FFF;
  }

   .ads_section1 a img {
    margin-bottom: 30px;
    width: 100%;
    /* display: none; */
</style>
<script type="text/javascript">

  function ad_click(obj) {
    var id = $(obj).data('id');
    var ip = '<?php echo $ip; ?>';
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'post',
      url:'{{ url('/ads/save') }}',
      data:{userip:ip,ad_id:id},
      success:function(response){

      }
    });
  }

</script>

@endpush
