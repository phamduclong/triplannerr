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
<style>
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

.travel-tt {

  text-align: center;
    color: #ddd;

}
</style>

<div class="profile-section mx-50">
  <div class="container-fluid">
    <div class="profile-inner">
    <div class="row">
      <div class="col-md-3">
          <div class="badge-img">
              @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
                 <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive">
              @else
                 <img src="{{url('img/frontend/blue.png')}}" class="img-responsive">
              @endif

          </div>
        <div class="profile-img">
         <!--  <h4 class="user_name">@if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif</h4>
             @php

              $current=date('Y-m-d H:i:s');

               $date1=isset($userdata->birth_place)?$userdata->birth_place:'';
                      $date2 = $current;
                      $diff = abs(strtotime($date2) - strtotime($date1));
                      $years = floor($diff / (365*60*60*24));
             @endphp -->


            <!-- @if(!empty($userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$userdata->profile_image)) )
               <img src="{{url('img/frontend/user/profile/'.$userdata->profile_image)}}" class="img-responsive" height="200" width="200">
              @else
               <img src="{{url('img/frontend/profile_user.jpg')}}">
            @endif -->

          <div class="profile-detail">
            <!-- <h4>@if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif</h4> -->
             @php

              $current=date('Y-m-d H:i:s');

              $date1=isset($userdata->birth_place)?$userdata->birth_place:'';
              $date2 = $current;
              $diff = abs(strtotime($date2) - strtotime($date1));
              $years = floor($diff / (365*60*60*24));

             @endphp
             <div class="user_dt">

              <p> <b> Age: </b> @if($years){{isset($years)?$years:''}}  @endif year</p>
              @if(!empty($userdata->sex))

              {{-- @if(!empty($userdata->sentimental_situation))
                   <p><b>Relationship Status:</b>@if($userdata) {{isset($userdata->sentimental_situation)?$userdata->sentimental_situation:''}}@endif</p>
              @endif --}}

              <p>
                  <b>Sex:</b>
                  @if($userdata)
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
                  @endif
                  @if($userdata) {{ isset($sex)?$sex:'' }}@endif
                  <!-- <input type="radio" name="sex" @if($userdata) @if($userdata->sex =='female') checked=""  @endif  @endif> Female -->
              </p>
              @endif


              @if(!empty($userdata->place_of_residence))
                  <p> <b>Residence:</b> @if($userdata){{isset($userdata->place_of_residence)?$userdata->place_of_residence:''}}@endif</p>
              @endif

               @if(!empty($userdata->type_of_participants))
                      <p> <b>Favourite Travel Partners: </b>@if($userdata) {{isset($userdata->type_of_participants)?$userdata->type_of_participants:''}}@endif</p>
               @endif
               @if(!empty($userdata->place_of_residence))
                  <p> <b>Place of Residence: </b>@if($userdata) {{isset($userdata->place_of_residence)?$userdata->place_of_residence:''}}@endif</p>
                @endif
                @if(!empty($userdata->fav_nation))
                        <p> <b>Favorite Nations you visited: </b>@if($userdata) {{isset($userdata->fav_nation)?$userdata->fav_nation:''}}@endif</p>
                @endif
                @if(!empty($userdata->fav_nation_want))
                        <p> <b>Favorite Nations you want to visited: </b>@if($userdata) {{isset($userdata->fav_nation_want)?$userdata->fav_nation_want:''}}@endif</p>
               @endif
               {{-- @if(!empty($userdata->sentimental_situation))
                   <p><b>Relationship Status:</b>@if($userdata) {{isset($userdata->sentimental_situation)?$userdata->sentimental_situation:''}}@endif</p>
               @endif --}}
              @if(!empty($userdata->preferred_travel_category))
                      <p> <b>Preferred Travel Category: </b>@if($userdata) {{isset($userdata->preferred_travel_category)?$userdata->preferred_travel_category:''}}@endif</p>
               @endif
               @if(!empty($userdata->type_of_travel))
                      <p> <b>Preferred Type Of Travel: </b>@if($userdata) {{isset($userdata->type_of_travel)?$userdata->type_of_travel:''}}@endif</p>
               @endif

               <?php
                  $total_alert = 0;
                  foreach ($alert_super_data as  $alert) {
                    $total_alert += $alert->supers_count;
                  }

                  $total_super = 0;
                  foreach ($alert_super_data as  $super) {
                    $total_super += $super->alerts_count;
                  }
               ?>

              @if(!empty($alert_super_data))
                <p><b>Total Alerts received :</b>
                  {{$total_alert}}
                </p>
              @endif

              @if(!empty($alert_super_data))
                <p><b>Total Supers received :</b>
                  {{$total_super}}
                </p>
              @endif
          </div>
          {{--dd($userdata)--}}

          <div class="follow-div">
            @php $follow_status = 0 @endphp
            @if(!empty($followdata) && $followdata->status=='1')

              @php $follow_status = 0 @endphp
            @else

              @php $follow_status = 1 @endphp
            @endif
            <!-- <img class="followimg" height="35px" src="{{url('/img/frontend/follower.png')}}"> -->


       @if(!empty(Auth::user()))
          <div class="repo_btn1">
           <button class="follow @if(Auth::user()->id == $user_id) disabled @endif" data-id="{{ $user_id }}" data-value="{{ $follow_status }}" onClick="follow_user(this)" >
          @if(Auth::user()->id == $user_id)
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

         @if(!empty(Auth::user()))
          @if($user_id==Auth::user()->id)
            <!--  <div class="repo_btn">
              <a href="{{url('/account')}}"><i class="fa fa-arrow-left"></i>Go to Settings Page</a>
            </div> -->
          @endif
         @endif
          <!-- <div class="repo_btn">
            <a href="#">Travel Report</a>
            <a href="#">Travel Journal</a>
            <a href="#">Travel / Vacation Proposal</a>
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
              <p>IDEAL TRAVEL CATEGORY</p>
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
              <p>IDEAL TYPE OF TRAVEL</p>
                <div class="travel-tt">
                  @if(!empty($userdata) && isset($userdata->type_of_travel) )
                      @php $type_of_travels =  explode(',', $userdata->type_of_travel)   @endphp

                      @forelse($type_of_travels as $key =>$type)
                         {{ $type }}
                      @empty

                      @endforelse
                  @endif
              </div>
            </div>
          </li>
         <!--  <li>
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
          </li> -->
          <li>
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
          </li>
          <li>
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
          </li>
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
          <li>
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
          </li>
        </ul>
      </div>
          @if(!empty($userdata->describe_yourself))
          <div class="user-detail">
            <h6>Bio: @if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif</h6>
            <p>@if($userdata){{isset($userdata->describe_yourself)?$userdata->describe_yourself:''}}@endif </p>
          </div>
          @endif



    </div>
    </div>
  </div>
</div>

{{--
<div class="travel-report">
  <div class="container-fluid">
        <div class="travel-filter">
      <div class="form-row">
        <div class="form-group col-md-3">

            <a class="sort_repo" href="#">Show All Travel Report<!-- <i class="fa fa-exchange"></i> -->
              <img src="{{ url('img/frontend/filter.png')}}">
            </a>
        </div>
        <div class="form-group col-md-3">

            <a class="sort_repo" href="#">Show Only Travel Report<!-- <i class="fa fa-exchange"></i> -->
              <img src="{{ url('img/frontend/filter.png')}}"></a>
        </div>
        <div class="form-group col-md-3">

            <a class="sort_repo" href="#">Show Only Travel Diaries<!-- <i class="fa fa-exchange"></i> -->
              <img src="{{ url('img/frontend/filter.png')}}"></a>
        </div>
        <div class="form-group col-md-3">
            <a class="sort_repo" href="#">Show Only Travel / Holidays Offers<!-- <i class="fa fa-exchange"></i> -->
              <img src="{{ url('img/frontend/filter.png')}}"></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="left-report row">
         @if(isset($alert_super_data) && !empty($alert_super_data))
          @foreach($alert_super_data as $report_data)

                <div class="col-lg-4 col-md-6 col-sm-6">
                   <div class="travel_site">
                    @if(!empty($report_data->cover_photo) && file_exists(public_path('img/frontend/travel_report/coverphoto'.'/'.$report_data->cover_photo)) )
                               <img src="{{url('img/frontend/travel_report/coverphoto/'.$report_data->cover_photo)}}">
                               @else
                               <img src="{{url('img/frontend/alert1.jpg')}}">
                                 @endif
                      <div class="site_text">
                        <h4>{{$report_data->title}}</h4>
                         <!-- <p>Africa</p> -->
                         @php
                           $reportdata=date("M j, Y", strtotime($report_data->report_date));
                         @endphp

                         <span>{{$reportdata}}</span>
                      </div>
                     <hr>
                       <div class="site_bottom">
                          <h4>${{$report_data->travel_cost}}</h4>

                            <a href="#"><img src="{{ url('img/frontend/arrow-right.png') }}"></a>
                         </div>
                      </div>
                  </div>
                  @endforeach
                @endif
          </div>
     </div>
       <div class="col-md-3">
          <div class="ads_section1">
            <a href="#"><img src="{{ url('img/frontend/ads1.png') }}"></a>
            <a href="#"><img src="{{ url('img/frontend/ads1.png') }}"></a>
          </div>
       </div>

    </div>
  </div>
</div>--}}

<div class="travel-report">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="left-report row">
          @foreach($alert_super_data as $report_data)
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
                               @if($report_data->report_option=='report')

                               <a href="{{url('view/travel_report',convertoToSlug($report_data->title)))}}" class="text"><img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Report</a>
                               {{-- @elseif($report_data->report_option=='diary')
                               <a href="{{url('view/travel_report_dairy',encrypt_decrypt('encrypt',$report_data->id))}}" class="text"><img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Diary</a> --}}
                               @elseif($report_data->report_option=='offer')
                               <a href="{{url('view/travel_report',convertoToSlug($report_data->title))}}" class="text"><img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Proposal</a>
                               @endif
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
                            <a href="javascript:void(0)" class="travel_action status1  @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$report_data->id}}" data-count="{{$report_data->supers_count}}" data-text="Like">Like {{$report_data->supers_count}}</a>
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
                          <a href="javascript:void(0)" class="travel_action status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$report_data->id}}" data-text="Alert" data-count="{{$report_data->alerts_count}}">Alert {{$report_data->alerts_count}}</a>
                        @endif
                    @else
                        <a href="{{url('/main-login')}}">Alert {{$report_data->alerts_count}}</a>
                    @endif
                    @if(!empty(Auth::user()))
                       @php

                           $same_trip_page=check_sametrip_page_from_user($report_data->id, Auth::user()->id);
                       @endphp
                      @if($same_trip_page=='1')
                        <a href="javascript:void(0)" class="travel_action status1 disabled @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip page" data-id="{{$report_data->id}}">Same Trip Page</a>
                      @else
                        <a href="javascript:void(0)" class="travel_action status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip page" data-id="{{$report_data->id}}">Same Trip Page</a>
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
                             @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip" data-id="{{$report_data->id}}"onClick="same_trip_delete(this)"
                              @if($userdata)@if($userdata->user_id==Auth::user()->id) disabled=''@endif @endif>Same Trip</a>

                        @else

                          <a href="javascript:void(0);" id="element" class=" sametrip status0 checktrip  @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif"  data-value="same trip" data-id="{{$report_data->id}}" onClick="same_report(this)">Same Trip</a>
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
                         <img style="max-width: 100%; min-height: 190px; height: 173px;" src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
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
                      @endif
                     </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <!-- <button class="btn more_btn"><img class="report-black-img" src="{{ url('img/frontend/black_travel_report.png')}}">Call to Actions</button> -->
  </div>
</div>
<style>
   .ads_section1 a img {
    margin-bottom: 30px;
    max-width: 100%;
    min-height: 190px;
    margin-bottom: 0px !important;
    /* display: none; */
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
    /*border: solid 1px #ddd;*/
    min-height: 320px;
}
</style>

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

</script>
