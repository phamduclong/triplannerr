@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
<style>
.badge-icon.chagecss {
    position: absolute;
    top: 1%;
    left: 7%;
    width: 150px;
    height: 100px;
}
.travel-article{
  margin-top: 28px;
}
.travel-report{
  margin-top: 28px;
}
.edit-report a {
    color: #131313;
}
.sametrip.status1 {
    background: #005ca9;
    color: #fff;
}

.travel-tt {
  text-align: center;
  color: #ddd;
}

.ads_section1 a img {
    margin-bottom: 30px;
    max-width: 100%;
    min-height: 190px;
    margin-bottom: 0px !important;
    /* display: none; */
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

.travel_action1.status1{
    background: #005ca9;
    color: #fff;
  }

  .sametrip1.status1 {
    background: #005ca9;
    color: #fff;
}

.disabled {
    pointer-events: none;
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

.view-travel-box h6 {
    display: inline-block;
    width: 100%;
    padding: 6px 0;
    margin: 0;
}

.ads_section1 {
    display: inline-block;
    width: 100%;
    text-align: center;
    border: solid 1px #ddd;
    min-height: 320px;
}


</style>

@if($userdata->role_type =='travel_agency')
<!-- <h2 style="color: blue">Traveler Pro</h2> -->

<div class="inner-banner">
	 @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )
    <div class="cover-img" style="background-image: url('{{ asset('img/frontend/user/cover/'.$userdata->cover_image)}}'); height: 430px;width: 100%;background-size: 100% 100%;background-repeat: no-repeat;background-position: center;"></div>
      @else
        <img src="{{url('img/frontend/inner-banner.jpg')}}">
      @endif

 <!-- <img src="{{url('img/frontend/inner-banner.jpg')}}"> -->
	<div class="container-fluid">
	 <p class="banner-txt">"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
	</div>
   <div class="badge-icon">
   	@if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
     <!-- <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive"> -->
     @else
    <!--  <img src="{{url('img/frontend/user.png')}}"> -->
      @endif

    </div>
</div>
<div class="profile-section mx-50">
  <div class="container-fluid">
    <div class="profile-inner">
      <div class="row">
        <div class="col-md-3">
          <div class="profile-img">
            @if(!empty($userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$userdata->profile_image)) )
              <img src="{{url('img/frontend/user/profile/'.$userdata-> profile_image)}}" class="img-responsive" >
             @else
              <img src="{{url('img/frontend/profile_user.jpg')}}">
             @endif

            <div class="profile-detail">
            <h4>@if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif</h4>
               <!-- @php
                $current=date('Y-m-d H:i:s');
                $date1=isset($userdata->birth_place)?$userdata->birth_place:'';
                        $date2 = $current;
                        $diff = abs(strtotime($date2) - strtotime($date1));
                        $years = floor($diff / (365*60*60*24));
                        @endphp -->
                        <div class="user_dt">
                      <p>
                          <b> Age: </b> @if($years){{isset($years)?$years:''}}  @endif year
                      </p>
                     @if(!empty($userdata->sex))
                      <p>
                          <b>Sex:</b>
                          @php
                            $sex = 'Not specified';
                            if($userdata->sex =='female')
                            {
                                $sex = 'Female';
                            }
                            else if($userdata->sex =='male')
                            {
                                $sex = 'Male';
                            }
                            else
                            {
                                $sex = 'Not specified';
                            }
                          @endphp
                          {{ $sex }}
                      </p>
                    @endif
                  @if(!empty($userdata->place_of_residence))
                        <p>
                          <b>Country:</b>
                          @if($userdata){{isset($userdata->place_of_residence)?$userdata->place_of_residence:''}}@endif
                        </p>
                   @endif
                   {{-- @if(!empty($userdata->relation_status))
                      <p><b>Relationship Status:</b> {{$userdata->relation_status}} </p>
                   @endif --}}
                   @if(!empty($userdata->fav_nation))
                      <p> <b>Favorite Nation: </b> {{$userdata->fav_nation}}</p>
                   @endif
                   @if(!empty($userdata->fav_nation_want))
                       <p> <b>Favorite Nations you want to visited: </b>@if($userdata) {{isset($userdata->fav_nation_want)?$userdata->fav_nation_want:''}}@endif</p>
                    @endif
                  </div>

            <div class="follow-div">
                @php $follow_status = 0 @endphp
                @if(!empty($followdata) && $followdata->status=='1')

                  @php $follow_status = 0 @endphp
                @else

                  @php $follow_status = 1 @endphp
                @endif
               <!--  <img class="followimg" height="35px" src="{{url('/img/frontend/follower.png')}}"> -->

                @if(!empty(Auth::user()))

               <div class="repo_btn1">
               <button class="follow @if(Auth::user()->id == $userdata->user_id) disabled @endif" data-id="{{$userdata->user_id}}" data-value="{{ $follow_status }}" onClick="follow_user(this)" >
                @if(Auth::user()->id == '1')
                {{$followcount}}<a href="javascript:void(0)" > Follow</a>
                @else
                  @php
                    if(!empty($followdata) && $followdata->status=='1')

                    {

                        echo $followcount .'<a href="javascript:void(0)" > UnFollow</a>';
                    }
                    else{

                        echo $followcount .'<a href="javascript:void(0)" > Follow</a>';
                    }
                     @endphp
                   </button>
                    @endif
                    </div>
                 @else
                <div class="repo_btn1">
                  <button class="follow" data-id="{{ $user_id }}" data-value="{{ $follow_status }}" onClick="follow_user(this)" >{{ $followcount}}<a href="{{url('/main-login')}}"> Follow</a></button>
               </div>
             @endif
          </div>
         @php
         $auth=Auth::user()->id;
         @endphp
         @if($auth==$userdata->user_id)
          <!-- <div class="repo_btn">
            <a href="{{url('account')}}"><i class="fa fa-arrow-left"></i>Go to Settings Page</a>
          </div> -->
          @endif
              <!-- <div class="repo_btn">
                <a href="#">New Offer</a>
              </div> -->
               </div>
            </div>
        </div>
        <div class="col-md-9 right-detail">
          <div class="profile-banner">
            @include('frontend.profile-banner')
            {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}">
            <p>"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p> --}}
          </div>
          <ul class="travel-user">
          <li>
            <div class="travel-type">
              <p>IDEAL TRAVEL</p>
             <div class="travel-tt" style="text-align: center; color:gary;">
                  @if(!empty($userdata) && isset($userdata->preferred_travel_category) )
                      @php $preferred_travel_categorys =  explode(',', $userdata->preferred_travel_category)   @endphp

                      @forelse($preferred_travel_categorys as $key =>$type)
                          {{ $type }}
                      @empty

                      @endforelse
                  @endif
              </div>
            </div>
          </li>

          <li>
            <div class="travel-type">
              <p>IDEAL STAY FORMULA</p>
               <div class="travel-tt">
                    @if(!empty($userdata) && isset($userdata->preferred_type) )
                        @php $preferred_types =  explode(',', $userdata->preferred_type)   @endphp
                        @forelse($preferred_types as $key =>$type)
                            {{ $type }}
                        @empty

                        @endforelse
                    @endif
                </div>
            </div>
          </li>

          <li>
            <div class="travel-type">
              <p>SERVICES</p>
               <div class="travel-tt">
                    @if(!empty($userdata) && isset($userdata->identification_option) )
                        @php $identification_options =  explode(',', $userdata->identification_option)   @endphp
                        @forelse($identification_options as $key =>$type)
                            {{ $type }}
                        @empty

                        @endforelse
                    @endif
                </div>
            </div>
          </li>

           <li>
            <div class="travel-type">
              <p>LOCAL OPERATOR</p>
               <div class="travel-tt">
                    @if(!empty($userdata) && isset($userdata->local_operator) )
                        @php $local_operators =  explode(',', $userdata->local_operator)   @endphp
                        @forelse($local_operators as $key =>$type)
                            {{ $type }}
                        @empty

                        @endforelse
                    @endif
                </div>
            </div>
          </li>

          <li>
            <div class="travel-type">
              <p>TOURIST RECEPTION FACILITY</p>
               <div class="travel-tt">
                    @if(!empty($userdata) && isset($userdata->tourist_facility) )
                        @php $tourist_facilities =  explode(',', $userdata->tourist_facility)   @endphp
                        @forelse($tourist_facilities as $key =>$type)
                            {{ $type }}
                        @empty

                        @endforelse
                    @endif
                </div>
            </div>
          </li>

         <!--  <li>
            <div class="travel-type">
              <p>IDEAL TRANSPORTATION</p>
              <div class="travel-tt">
                    @if(!empty($userdata) && isset($userdata->vector_type) )
                        @php $vector_types =  explode(',', $userdata->vector_type)   @endphp

                        @forelse($vector_types as $key =>$type)
                            {{ $type }}
                        @empty

                        @endforelse
                    @endif
                </div>
            </div>
          </li> -->
         <!--  <li>
            <div class="travel-type">
              <p>IDEAL ACCOMODATION</p>
              <div class="travel-tt">
                    @if(!empty($userdata) && isset($userdata->type_of_accommodation) )
                        @php $type_of_accommodations =  explode(',', $userdata->type_of_accommodation)   @endphp

                        @forelse($type_of_accommodations as $key =>$type)
                            {{ $type }}
                        @empty

                        @endforelse
                    @endif
                </div>
            </div>
          </li> -->
          <li>
            <div class="travel-type">
              <p>FAVORITE MEALS</p>
              <div class="travel-tt">
                    @if(!empty($userdata) && isset($userdata->travel_favoritemealtype) )
                        @php $travel_favoritemealtypes =  explode(',', $userdata->travel_favoritemealtype)   @endphp

                        @forelse($travel_favoritemealtypes as $key =>$type)
                            {{ $type }}
                        @empty

                        @endforelse
                    @endif
                </div>
            </div>
          </li>
         <!--  <li>
            <div class="travel-type">
              <p>IDEAL TRAVEL BUDGET</p>
              <div class="travel-tt">
                  @if(!empty($userdata) && isset($userdata->preferred_travel_budget) )
                      @php $preferred_travel_budgets =  explode(',', $userdata->preferred_travel_budget)   @endphp

                      @forelse($preferred_travel_budgets as $key =>$type)
                          {{ $type }}
                      @empty

                      @endforelse
                  @endif
              </div>
            </div>
          </li> -->
        </ul>
        </div>

          <div class="user-detail">
          <h6>Bio: @if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif</h6>
          <!-- <p>@if($userdata){{isset($userdata->describe_yourself)?$userdata->describe_yourself:''}}@endif </p> -->
          @if($userdata)
            @if(!empty($userdata->identification_option || $userdata->local_operator || $userdata->tourist_facility))
                <p>Our Services :</p>

                <p>- @if($userdata){{isset($userdata->identification_option)?$userdata->identification_option:''}}@endif</p>
                <p>- @if($userdata){{isset($userdata->local_operator)?$userdata->local_operator:''}}@endif</p>
                <p>- @if($userdata){{isset($userdata->tourist_facility)?$userdata->tourist_facility:''}}@endif</p>
            @endif
          @endif
        </div>
      </div>
      <!-- share social media -->
      @if(!empty($userdata->cover_image))
        <meta property="og:image" content="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}"/>
        <meta property="og:image:secure_url" content="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" />
        @else
        <meta property="og:image" content="{{url('img/frontend/inner-banner.jpg')}}"/>
        <meta property="og:image:secure_url" content="{{url('img/frontend/inner-banner.jpg')}}" />
        @endif
        <meta property="og:title" content="title" />
        <meta property="og:description" content="description" />
        <meta property="og:url" content="http://localhost/travelmaker/public/profile/6" />
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="Page Title">
        <meta name="twitter:description" content="Page description less than 200 characters">
        <meta name="twitter:creator" content="@author_handle">
        <meta name="twitter:image" content="http://www.example.com/image.jpg">

        <!-- <h4 style="color: #005ca9;text-align: center;">Share</h4> -->
        <br>

        <div class="share_links">

          <!-- <a href="{{ url('/')}}"><img src="{{url('img/frontend/log.png')}}"></a>
          @if(!empty($userdata->cover_image))
          <a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php //echo urlencode('new profile');?>&amp;p[summary]=<?php //echo urlencode('DESCRIPTION') ?>&amp;p[url]=<?php //echo urlencode(url('/')); ?>&amp;p[images][0]=<?php //echo urlencode(url('img/frontend/user/cover/'.$userdata->cover_image)); ?>"><img src="{{url('img/frontend/fb.png')}}"></a>
          @else
          <a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php //echo urlencode('new profile');?>&amp;p[summary]=<?php //echo urlencode('DESCRIPTION') ?>&amp;p[url]=<?php //echo urlencode(url('/')); ?>&amp;p[images][0]=<?php //echo urlencode(url('img/frontend/inner-banner.jpg')); ?>"><img src="{{url('img/frontend/fb.png')}}"></a>
          @endif
          <a href=""><img src="{{url('img/frontend/ins.png')}}"></a>
          @if(!empty($userdata->cover_image))
          <a href="http://twitter.com/share?url={{url('/')}}&text=TravelMaker&hashtags=travelmaker&image={{url('img/frontend/user/cover/'.$userdata->cover_image)}}" target="_blank"><img src="{{url('img/frontend/twi.png')}}"></a>
          @else
          <a href="http://twitter.com/share?url={{url('/')}}&text=TravelMaker&hashtags=travelmaker&image={{url('img/frontend/inner-banner.jpg')}}" target="_blank"><img src="{{url('img/frontend/twi.png')}}"></a>
          @endif
          <a href=""><img src="{{url('img/frontend/you.png')}}"></a>
          <a href=""><img src="{{url('img/frontend/tik.png')}}"></a> -->

          @if(!empty($userdata->cover_image))
          <a class="facebook-share" href="javascript:void(0)"><img src="{{url('img/frontend/fb.png')}}"></a>
          @else

          @endif
         <!--  <a href=""><img src="{{url('img/frontend/ins.png')}}"></a> -->
          @if(!empty($userdata->cover_image))
          <a href="javascript:void(0)" class="twitter-share"><img src="{{url('img/frontend/twi.png')}}"></a>
          @else

          @endif
        </div>

<!-- share social media -->
    <form method="post" action="{{ Route('frontend.user.collaboration_request')}}">
        @csrf
      <div class="send-msg">
        <div class="form-group">
          <label>Message</label>
          <textarea class="form-control" rows="5" name="blog_service" value="">Lorem Ipsum dummy text...
          </textarea>
        </div>
      </div>

      <!-- <div class="req-btn">
        <button class="btn">COLLABORATION REQUEST</button>
      </div>
       -->
        @php
          $login_id =Auth::user()->id;
        @endphp

       <input type="hidden" name="role_type" value="{{$userdata->role_type}}">
       <input type="hidden" name="user_id" value="{{$userdata->user_id}}">
       <input type="hidden" name="request_id" value="{{$login_id}}">
      <div class="blog-report login-form">
        <div class="form-group">
          <label>Send Request of Collaboration:</label>
          <textarea class="form-control" rows="4" name="message" value="">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</textarea>
        </div>
        <div class="req-btn">
          <button class="btn more_btn" type="submit">Send</button>
        </div>
      </div>
      </form>

      <!-- <div class="share_links">
        <a href="{{ url('/')}}"><img src="{{url('img/frontend/log.png')}}"></a>
        <a href="@if($userdata){{isset($userdata->fb_link)?$userdata->fb_link:''}}  @endif"><img src="{{url('img/frontend/fb.png')}}"></a>
        <a href="@if($userdata){{isset($userdata->insta_link)?$userdata->insta_link:''}}  @endif"><img src="{{url('img/frontend/ins.png')}}"></a>
        <a href="@if($userdata){{isset($userdata->twitter_link)?$userdata->twitter_link:''}}  @endif"><img src="{{url('img/frontend/twi.png')}}"></a>
        <a href="@if($userdata){{isset($userdata->youtube_link)?$userdata->youtube_link:''}}  @endif"><img src="{{url('img/frontend/you.png')}}"></a>
        <a href="@if($userdata){{isset($userdata->tiktok_link)?$userdata->tiktok_link:''}}  @endif"><img src="{{url('img/frontend/tik.png')}}"></a>
      </div> -->

    </div>
  </div>
</div>
<div class="travel-report">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="left-report row">
          @foreach($alert_super_data as $report_data)
          <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="travel_site">
                  <div class="travel_over">
                    @if(!empty($report_data->cover_photo) && file_exists(public_path('img/frontend/travel_report/coverphoto'.'/'.$report_data->cover_photo)) )
                         <img src="{{url('img/frontend/travel_report/coverphoto/'.$report_data->cover_photo)}}">
                         @else
                         <img src="{{url('img/frontend/alert1.jpg')}}">
                           @endif
                          <div class="overlay">
                          @if(!empty(Auth::user()))
                            @if(Auth::user()->id==$userdata->user_id)
                               <div class="delete-report" style="float:right;"><a href="{{url('delete/travel_report',convertoToSlug($report_data->title))}}" style="color: #ff00006e;"><i class="fas fa-trash"></i></a></div>

                               <div class="edit-report" style="float:right"><a href="{{url('edit/travel_report',convertoToSlug($report_data->title))}}"><i class="fas fa-edit"></i></a></div>
                            @endif
                          @endif
                          <div class="middle">
                             @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
                               <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}">
                               @else
                               <img src="{{url('img/frontend/f-logo.png')}}">
                                 @endif
                               <a href="{{url('view/travel_report', convertoToSlug($report_data->title))}}" class="text"><img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Proposal</a>
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
                             <a href="javascript:void(0)" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="Super" data-id="{{$report_data->id}}" data-count="{{$report_data->supers_count}}" data-text="Like">Like {{$report_data->supers_count}}</a>
                        @else
                           <a href="javascript:void(0)" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="super" data-id="{{$report_data->id}}" data-count="{{$report_data->supers_count}}" data-text="Like">Like {{$report_data->supers_count}}</a>
                        @endif
                    @else
                        <a href="{{url('/main-login')}}">Like! {{$report_data->supers_count}}</a>
                    @endif
                    @if(!empty(Auth::user()))
                        @php
                        $alert=check_alert_from_user($report_data->id, Auth::user()->id);
                        @endphp
                        @if($alert=='1')
                          <a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$report_data->id}}"  data-text="Alert" data-count="{{$report_data->alerts_count}}">Alert {{$report_data->alerts_count}}</a>
                        @else
                          <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$report_data->id}}" data-text="Alert" data-count="{{$report_data->alerts_count}}">Alert {{$report_data->alerts_count}}</a>
                        @endif
                    @else
                        <a href="{{url('/main-login')}}">Alert {{$report_data->alerts_count}}</a>
                    @endif
                    @if(!empty(Auth::user()))
                       @php
                           $same_trip_page=check_sametrip_page_from_user($report_data->id, Auth::user()->id);
                       @endphp
                      @if($same_trip_page=='1')
                        <a href="javascript:void(0)" class="travel_action1 status1 disabled @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip page" id = "sametrip-{{$report_data->id}}" data-id="{{$report_data->id}}">Same Trip Page</a>
                      @else
                        <a href="javascript:void(0)" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip page"  id = "sametrip-{{$report_data->id}}" data-id="{{$report_data->id}}">Same Trip Page</a>
                      @endif
                    @else
                      <a href="{{url('/main-login')}}">Same Trip Page</a>
                    @endif
                   @if(!empty(Auth::user()))
                         @php
                           $same_trip=check_sametrip_from_user($report_data->id, Auth::user()->id);
                         @endphp
                         @if($same_trip=='1')
                             <a href="javascript:void(0);" class="sametrip1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip" data-id="{{$report_data->id}}" onClick="same_trip_delete(this)" data-text="same trip">Same Trip</a>

                          @else

                            <a href="javascript:void(0);" id="element" class="sametrip1 status0 checktrip @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip" data-id="{{$report_data->id}}" onClick="same_report(this)" data-text="same trip">Same Trip</a>
                        @endif
                    @else
                      <a href="{{url('/main-login')}}">Same Trip</a>
                    @endif
                    </div>
            </div>
          </div>
         @endforeach
      </div>
     </div>
       <div class="col-md-3">
        @php
          $ip= Request::ip();
        @endphp
        <div class="ads_section1 view-travel-box">
          @if(!empty($ads_data))
            @foreach($ads_data as $ads)
              @if($ads->type=="image")
               <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
               <h6>{{$ads->title}}</h6>
               <img src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
               <p>{{$ads->description}}</p>
              @endif

              @if($ads->type=='video')
                  @if(!empty($ads->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$ads->type_file)) )
                   <h6>{{$ads->title}}</h6>
                    <video controls>
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
            @endforeach
          @endif
        </div>
       </div>
    </div>
    <!-- <button class="btn more_btn"><img class="report-black-img" src="{{ url('img/frontend/black_travel_report.png')}}">Call to Actions</button> -->
  </div>
</div>

@else($userdata->role_type =='travel_blogger')


<div class="inner-banner">
	 @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )
       <img src="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" class="img-responsive">
       @else
        <img src="{{url('img/frontend/inner-banner.jpg')}}">
    @endif

 <!-- <img src="{{url('img/frontend/inner-banner.jpg')}}"> -->
	<div class="container-fluid">
	 <p class="banner-txt">"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
	</div>
   <div class="badge-icon chagecss">
   	@if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
       <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive">
       @else
       <img src="{{url('img/frontend/user.png')}}">
    @endif
    </div>
</div>
<div class="profile-section mx-50">
  <div class="container-fluid">
    <div class="profile-inner">
      <div class="row">
        <div class="col-md-3">

          <div class="profile-img">
                 @if(!empty($userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$userdata->profile_image)) )
                    <img src="{{url('img/frontend/user/profile/'.$userdata->profile_image)}}" class="img-responsive" >
                 @else
                    <img src="{{url('img/frontend/profile_user.jpg')}}">
                 @endif

            <div class="profile-detail">
              <h4>@if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif</h4>
                @php
                $current=date('Y-m-d H:i:s');
                $date1=isset($userdata->birth_place)?$userdata->birth_place:'';
                        $date2 = $current;
                        $diff = abs(strtotime($date2) - strtotime($date1));
                        $years = floor($diff / (365*60*60*24));
                        @endphp
                        <div class="user_dt">
                      <p>
                          <b> Age: </b> @if($years){{isset($years)?$years:''}}  @endif year
                      </p>
                      <p>
                          <b>Sex:</b>
                          @php
                            $sex = 'Not specified';
                            if($userdata->sex =='female')
                            {
                                $sex = 'Female';
                            }
                            else if($userdata->sex =='male')
                            {
                                $sex = 'Male';
                            }
                            else
                            {
                                $sex = 'Not specified';
                            }
                          @endphp
                          {{ $sex }}
                      </p>
                      <p>
                          <b>Country:</b>
                          @if($userdata){{isset($userdata->place_of_residence)?$userdata->place_of_residence:''}}@endif
                      </p>
                      {{-- <p><b>Relationship Status:</b> {{$userdata->relation_status}} </p> --}}

                      <p> <b>Favourite Travel Partners: </b>{{$userdata->type_of_participants}}</p>
                      <p> <b>Favorite Nation: </b> {{$userdata->fav_nation}}</p>
                  </div>
           <div class="follow-div">

                @php $follow_status = 0 @endphp
                @if(!empty($followdata) && $followdata->status=='1')

                  @php $follow_status = 0 @endphp
                @else

                  @php $follow_status = 1 @endphp
                @endif
                <img class="followimg" height="35px" src="{{url('/img/frontend/follower.png')}}">

             @if(!empty(Auth::user()))

                    <div class="repo_btn1">
                   <button class="follow @if(Auth::user()->id == $userdata->user_id) disabled @endif" data-id="{{$userdata->user_id}}" data-value="{{ $follow_status }}" onClick="follow_user(this)" >
                @if(Auth::user()->id == '1')
                {{$followcount}}<a href="javascript:void(0)" > Follow</a>
                @else
                  @php
                    if(!empty($followdata) && $followdata->status=='1')

                    {

                        echo $followcount .'<a href="javascript:void(0)" > UnFollow</a>';
                    }
                    else{

                        echo $followcount .'<a href="javascript:void(0)" > Follow</a>';
                    }
                     @endphp
                   </button>
                    @endif
                    </div>

              @else
             <div class="repo_btn1">
                <button class="follow" data-id="{{ $user_id }}" data-value="{{ $follow_status }}" onClick="follow_user(this)" >{{ $followcount}}<a href="{{url('/main-login')}}"> Follow</a></button>
            </div>
              @endif
          </div>
           @php
         $auth=Auth::user()->id;
         @endphp
          @if($auth==$userdata->user_id)
          <div class="repo_btn">
            <a href="{{url('account')}}"><i class="fa fa-arrow-left"></i>Go to Settings Page</a>
          </div>
          @endif
              <!-- <div class="repo_btn">
                <a href="#">New Offer</a>
              </div> -->

              </div>
            </div>
        </div>
        <div class="col-md-9 right-detail">
          <div class="profile-banner">
            @include('frontend.profile-banner')
            {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}">
            <p>"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p> --}}
          </div>
          <ul class="travel-user">
            <li>
              <div class="travel-type">
                <p>PREFERRED TRAVEL</p>
                @if($userdata){{isset($userdata->preferred_travel_category)?$userdata->preferred_travel_category:''}}  @endif
              </div>
            </li>
            <li>
              <div class="travel-type">
                <p>PREFERRED TYPE OF TRAVEL</p>
                @if($userdata){{isset($userdata->type_of_travel)?$userdata->type_of_travel:''}}  @endif
              </div>
            </li>
            <li>
              <div class="travel-type">
                <p>FAVORITE STAY FORMULA</p>
                @if($userdata){{isset($userdata->preferred_type)?$userdata->preferred_type:''}}  @endif
              </div>
            </li>
            <li>
              <div class="travel-type">
                <p>FAVORITE TRAVEL VECTOR</p>
                @if($userdata){{isset($userdata->vector_type)?$userdata->vector_type:''}}  @endif
              </div>
            </li>
            <li>
              <div class="travel-type">
                <p>PREFERRED TYPE OF ACCOMODATION</p>
                @if($userdata){{isset($userdata->type_of_accommodation)?$userdata->type_of_accommodation:''}}  @endif
              </div>
            </li>
            <li>
              <div class="travel-type">
                <p>PREFERRED TRAVEL BUDGET</p>
                @if($userdata){{isset($userdata->preferred_travel_budget)?$userdata->preferred_travel_budget:''}}  @endif
              </div>
            </li>
          </ul>
        </div>
          <div class="user-detail">
            <h6>Bio: @if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif</h6>
            <p>@if($userdata){{isset($userdata->describe_yourself)?$userdata->describe_yourself:''}}@endif </p>
        </div>
      </div>
      <!-- share social media -->
      @if(!empty($userdata->cover_image))
        <meta property="og:image" content="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}"/>
        <meta property="og:image:secure_url" content="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" />
        @else
        <meta property="og:image" content="{{url('img/frontend/inner-banner.jpg')}}"/>
        <meta property="og:image:secure_url" content="{{url('img/frontend/inner-banner.jpg')}}" />
        @endif
        <meta property="og:title" content="title" />
        <meta property="og:description" content="description" />
        <meta property="og:url" content="http://localhost/travelmaker/public/profile/6" />
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="Page Title">
        <meta name="twitter:description" content="Page description less than 200 characters">
        <meta name="twitter:creator" content="@author_handle">
        <meta name="twitter:image" content="http://www.example.com/image.jpg">

        <h4 style="color: #005ca9;text-align: center;">Share</h4>

        <div class="share_links">
          <a href="{{ url('/')}}"><img src="{{url('img/frontend/log.png')}}"></a>
          @if(!empty($userdata->cover_image))
          <a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode('new profile');?>&amp;p[summary]=<?php echo urlencode('DESCRIPTION') ?>&amp;p[url]=<?php echo urlencode(url('/')); ?>&amp;p[images][0]=<?php echo urlencode(url('img/frontend/user/cover/'.$userdata->cover_image)); ?>"><img src="{{url('img/frontend/fb.png')}}"></a>
          @else
          <a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode('new profile');?>&amp;p[summary]=<?php echo urlencode('DESCRIPTION') ?>&amp;p[url]=<?php echo urlencode(url('/')); ?>&amp;p[images][0]=<?php echo urlencode(url('img/frontend/inner-banner.jpg')); ?>"><img src="{{url('img/frontend/fb.png')}}"></a>
          @endif
          <a href=""><img src="{{url('img/frontend/ins.png')}}"></a>
          @if(!empty($userdata->cover_image))
          <a href="http://twitter.com/share?url={{url('/')}}&text=TravelMaker&hashtags=travelmaker&image={{url('img/frontend/user/cover/'.$userdata->cover_image)}}" target="_blank"><img src="{{url('img/frontend/twi.png')}}"></a>
          @else
          <a href="http://twitter.com/share?url={{url('/')}}&text=TravelMaker&hashtags=travelmaker&image={{url('img/frontend/inner-banner.jpg')}}" target="_blank"><img src="{{url('img/frontend/twi.png')}}"></a>
          @endif
          <a href=""><img src="{{url('img/frontend/you.png')}}"></a>
          <a href=""><img src="{{url('img/frontend/tik.png')}}"></a>
        </div>

<!-- share social media -->

      <div class="travel-article">
        <div class="spac-inner">
         <?php

        $servicedata= explode(',',$userdata->blogger_service);
        ?>
           @foreach($servicedata as $services)
           @if($services=='Seo article')
            <div class="art-inner">
            <h4>scrittura articoli SEO con back-link</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
          @elseif($services=='Introduction')
          <div class="art-inner">
            <h4>Other</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
          @elseif($services=='Promotion Social')
          <div class="art-inner">
            <h4>Promotion on their social channels</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
          @elseif($services=='Take Over')
          <div class="art-inner">
            <h4>Take Over</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
          @elseif($services=='Ad_hoc Format')
          <div class="art-inner">
            <h4>Creation of an ad hoc format</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
          @elseif($services=='Promotional Video')
          <div class="art-inner">
            <h4>Video</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/Qmi-Xwq-MEc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          @elseif($services=='blogger images')
          <div class="art-inner">
            <h4>Dedicated Photo Shoot</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <ul class="art-img">
              <li><img src="{{url('img/frontend/alert1.jpg')}}">
              </li>
              <li><img src="{{url('img/frontend/alert2.jpg')}}">
              </li>
              <li><img src="{{url('img/frontend/alert3.jpg')}}">
              </li>
              <li><img src="{{url('img/frontend/alert4.jpg')}}">
              </li>
            </ul>
          </div>
        </div>
        @endif
        @endforeach
      </div>

<form method="post" action="{{ Route('frontend.user.collaboration_request')}}">
  @csrf
  <div class="blog-report login-form promo-form">
     <div class="form-group">
          <label>Select Promotional services:</label>
          <div class="serv-input-sec">
            <input type="checkbox" name="blog_service[]" value="Seo article">{{ html()->label(__('validation.attributes.frontend.seo_article'))->for('vat_number') }}
           </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blog_service[]" value="Introduction">{{ html()->label(__('validation.attributes.frontend.introduction'))->for('vat_number') }}
            </div>
           <div class="serv-input-sec">
            <input type="checkbox" name="blog_service[]" value="Promotion Social">
            {{ html()->label(__('validation.attributes.frontend.promotion_social'))->for('promotion_social') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blog_service[]" value="Take Over">
            {{ html()->label(__('validation.attributes.frontend.take_over'))->for('take_over') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blog_service[]" value="Ad_hoc Format" >
            {{ html()->label(__('validation.attributes.frontend.ad_hoc_format'))->for('ad_hoc_format') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blog_service[]" value="Promotional Video">
            {{ html()->label(__('validation.attributes.frontend.promotional_video'))->for('promotional_video') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blog_service[]" value="blogger images">
            {{ html()->label(__('validation.attributes.frontend.blogger_images'))->for('blogger_images') }}
            </div>
      </div>
      </div>
      <div class="blog-report login-form">
        <div class="form-group">
          <label>Send Request of Collaboration:</label>
          <textarea class="form-control" rows="4" name="message">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</textarea>
        </div>
        @php
          $login_id =Auth::user()->id;
        @endphp

       <input type="hidden" name="role_type" value="{{$userdata->role_type}}">
       <input type="hidden" name="user_id" value="{{$userdata->user_id}}">
       <input type="hidden" name="request_id" value="{{$login_id}}">
        <div class="req-btn">
          <button class="btn more_btn" type="submit">Send</button>
        </div>
      </div>

    </form>
    @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
   </div>

  </div>
</div>
<div class="travel-report">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="left-report row">
          @foreach($alert_super_data as $report_data)
          <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="travel_site">
                  <div class="travel_over">
                    @if(!empty($report_data->cover_photo) && file_exists(public_path('img/frontend/travel_report/coverphoto'.'/'.$report_data->cover_photo)) )
                       <img src="{{url('img/frontend/travel_report/coverphoto/'.$report_data->cover_photo)}}">
                       @else
                       <img src="{{url('img/frontend/alert1.jpg')}}">
                        @endif
                      <div class="overlay">
                    @if(!empty(Auth::user()))
                      @if(Auth::user()->id==$userdata->user_id)
                         <div class="edit-report" style="float:right"><a href="{{url('edit/travel_report',convertoToSlug($report_data->title))}}"><i class="fas fa-edit"></i></a></div>
                      @endif
                    @endif
                      <div class="middle">
                           @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
                             <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}">
                             @else
                             <img src="{{url('img/frontend/f-logo.png')}}">
                               @endif

                               <a href="{{url('view/travel_report',convertoToSlug($report_data->title))}}" class="text"><img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Report</a>
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
                             <a href="javascript:void(0)" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="Super" data-id="{{$report_data->id}}" data-count="{{$report_data->supers_count}}" data-text="Like">Like {{$report_data->supers_count}}</a>
                        @else
                           <a href="javascript:void(0)" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="super" data-id="{{$report_data->id}}" data-count="{{$report_data->supers_count}}" data-text="Like">Like {{$report_data->supers_count}}</a>
                        @endif
                    @else
                        <a href="{{url('/main-login')}}">Like! {{$report_data->supers_count}}</a>
                    @endif
                    @if(!empty(Auth::user()))
                        @php
                        $alert=check_alert_from_user($report_data->id, Auth::user()->id);
                        @endphp
                        @if($alert=='1')
                          <a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$report_data->id}}"  data-text="Alert" data-count="{{$report_data->alerts_count}}">Alert {{$report_data->alerts_count}}</a>
                        @else
                          <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$report_data->id}}" data-text="Alert" data-count="{{$report_data->alerts_count}}">Alert {{$report_data->alerts_count}}</a>
                        @endif
                    @else
                        <a href="{{url('/main-login')}}">Alert {{$report_data->alerts_count}}</a>
                    @endif
                    @if(!empty(Auth::user()))
                       @php
                           $same_trip_page=check_sametrip_page_from_user($report_data->id, Auth::user()->id);
                       @endphp
                      @if($same_trip_page=='1')
                        <a href="javascript:void(0)" class="travel_action1 status1 disabled @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip page" id = "sametrip-{{$report_data->id}}" data-id="{{$report_data->id}}">Same Trip Page</a>
                      @else
                        <a href="javascript:void(0)" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip page"  id = "sametrip-{{$report_data->id}}" data-id="{{$report_data->id}}">Same Trip Page</a>
                      @endif
                    @else
                      <a href="{{url('/main-login')}}">Same Trip Page</a>
                    @endif
                   @if(!empty(Auth::user()))
                         @php
                           $same_trip=check_sametrip_from_user($report_data->id, Auth::user()->id);
                         @endphp
                         @if($same_trip=='1')
                             <a href="javascript:void(0);" class="sametrip1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip" data-id="{{$report_data->id}}" onClick="same_trip_delete(this)" data-text="same trip">Same Trip</a>

                          @else

                            <a href="javascript:void(0);" id="element" class="sametrip1 status0 checktrip @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip" data-id="{{$report_data->id}}" onClick="same_report(this)" data-text="same trip">Same Trip</a>
                        @endif
                    @else
                      <a href="{{url('/main-login')}}">Same Trip</a>
                    @endif
                    </div>
            </div>
              </div>
      @endforeach

      </div>
     </div>
       <div class="col-md-3">
          <div class="ads_section1">
            <a href="#"><img src="{{ url('img/frontend/ads1.png') }}"></a>
            <a href="#"><img src="{{ url('img/frontend/ads1.png') }}"></a>
          </div>
       </div>

    </div>
    <!-- <button class="btn more_btn"><img class="report-black-img" src="{{ url('img/frontend/black_travel_report.png')}}">Call to Actions</button> -->
  </div>
</div>

@endif
<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Travel Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
         <form method="post" action="{{Route('frontend.user.same_trip_data')}}">
            @csrf
            <div class="modal-body" id="reportsame">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function follow_user(obj)
{
  $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    });
    var id = $(obj).data('id');
    var status = $(obj).data('value');

    $.ajax({
        type:'POST',
        url:'{{ url('/follow') }}',
        data:{user_id:id, follow_status:status},
        success:function(data){
          var base_url= '<?php echo url('/'); ?>';
        var html = '';
        if(data == 1){
              var html = '<div class="follow-div"><img class="followimg" height="35px" src="{{url('/img/frontend/follower.png')}}"><div class="repo_btn1"><button class="follow" data-id="'+id+'" data-value="'+data+'" onClick="follow_user(this)" > 2 <a href="#"> UnFollow</a></button></div></div>';
           		$(".follow-div").html(html);

         	}
         	else
         	{
         	var html = '<div class="follow-div"><img class="followimg" height="35px" src="{{url('/img/frontend/follower.png')}}"><div class="repo_btn1"><button class="follow" data-id="'+id+'" data-value="'+data+'" onClick="follow_user(this)" > 2 <a href="#"> Follow</a></button></div></div>';
           		$(".follow-div").html(html);
          	}
       }
    });
}

  function same_report(obj) {

    var id = $(obj).data('id');
    var user_id = '<?php echo Auth::user()->id; ?>';

    $.ajaxSetup({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       });
    $.ajax({
            type:'get',
            url:'{{ url('/same_trip_report') }}',
            data:{userid:user_id},
            success:function(response){

                var result = jQuery.parseJSON(response);
             if(response==0){

                $("#testmodal").modal('show');
                    $("#reportsame").empty();
                    var html = '';
                    var html = '<p style="text-align:center"><b>No Data</b></p>';
                     $("#reportsame").html(html);
                     $('.selected').css({"background": "#005ca9","color": "#fff"});

                 }else{

                      $("#testmodal").modal('show');
                      $("#reportsame").empty();
                      var html = '';
                      var html = '<input type="hidden" name="report_id" value="'+id+'"><input type="hidden" name="user_id" value="'+user_id+'">';

                      $.each(result, function( index, value ) {
                          html += '<input type="radio" value="'+value.id+'" name="same_trip_id"  > '+value.title+'<br/>'
                      });

                      $("#reportsame").html(html);
                      $('.selected').css({"background": "#fff","color": "#005ca9"});
                 }
              },
        });
     }
</script>

<script>
  var title = 'Site Title';
  setTimeout(function(){
      $(document).on('click','.facebook-share',function() {
        var shareUrl = window.location.href;
        link = 'https://www.facebook.com/sharer/sharer.php?u='+shareUrl+'&t=Share';
        window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");

      });

      $(document).on('click','.twitter-share',function() {
        var shareUrl = window.location.href;
        link = 'http://twitter.com/share?url='+shareUrl+'&text='+title;
        window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");

      });
  },500);

  setTimeout(function(){
  var st = sessionStorage.getItem("sameTrip");
  if(st){
    sessionStorage.setItem("sameTrip",'');
    $('#'+st).addClass('status1');
    window.location.reload();
  }
  $(".travel_action1").click(function() {
    var that = $(this);
    $(this).addClass('selected');

    var value = $(this).data('value');
    var count =0;
    var htext ='';
    if(typeof $(this).data('count') !== "undefined") {
      count=$(this).data('count');
    }
    if(typeof $(this).data('text') !== "undefined") {
      htext=$(this).data('text');
    }
    var report_id = $(this).data('id');
    var user_id = '<?php echo $auth; ?>';
    var newCount = 0;
    $.ajaxSetup({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      });
    $.ajax({
      type:'GET',
      url:'{{ url('/travel-action') }}',
      data:{action:value, report_id:report_id, userid:user_id},
      success:function(data){
        var html = '';
          if(that.hasClass('status1')) {
              that.removeClass('status1');
              that.addClass('status0');
          } else {
              that.removeClass('status0');
              that.addClass('status1');
          }
          if(data == 1){
               if(value == "same trip page"){
                  sessionStorage.setItem("sameTrip", that.attr('id'));
                  window.location.assign('{{url('/same-trip')}}'+'/'+report_id);
               } else {
                 newCount = parseInt(count) + 1;
                 that.data('count',newCount);
                 that.html(htext+' '+newCount);
               }
              //  if(value == "alert"){
              //   $.get('{{url('/configcontact1')}}');
              //  }
               that.css({"background": "#005ca9","color": "#fff"});
              }
           else
            {
              if(value!= "same trip page"){
                  newCount = parseInt(count) - 1;
                  that.data('count',newCount);
                  that.html(htext+' '+newCount);
              }
              that.css({"background": "#fff","color": "#005ca9"});
              that.disabled = true;
            }
          }
       });
     });
 },500);

  function same_trip_delete(obj) {
    var id = $(obj).data('id');
    var user_id = '<?php echo $auth; ?>';

    $.ajaxSetup({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       });
    $.ajax({
        type:'post',
        url:'{{ url('delete/same_trip') }}',
        data:{userid:user_id,report_id:id},
        success:function(response){
          if(response==1){
              location.reload();
          }
        }
      });
   }
</script>

<style>
  .travel_action1.status1{
    background: #005ca9;
    color: #fff;
  }

  .sametrip1.status1 {
    background: #005ca9;
    color: #fff;
}

.disabled {
    pointer-events: none;
}
</style>

@endsection
