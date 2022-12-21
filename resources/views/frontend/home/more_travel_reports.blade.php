@forelse($travel_reports as $key=>$super_row)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="travel_site">
        <div class="travel_over">
            <b style="color: #005ca9;"><center>{{ $super_row->title}}</center></b>
            @if(!empty($super_row->cover_photo) && file_exists(public_path('img/frontend/travel_report/coverphoto'.'/'.$super_row->cover_photo)) )
            <img src="{{url('img/frontend/travel_report/coverphoto/'.$super_row->cover_photo)}}">
            @else
            <img src="{{url('img/frontend/alert1.jpg')}}">
            @endif

            <div class="overlay">
            <div class="middle">
                <!-- @php
                echo $role=getrole_data($super_row->user_id);
                @endphp -->

                @if(!empty($role) && file_exists(public_path('img/backend/traveler_image'.'/'.$role)) )
                <img src="{{url('img/backend/traveler_image/'.$role)}}">
                @else
                <img src="{{url('img/frontend/f-logo.png')}}">
                @endif

                {{-- @if($super_row->report_option=='report')
                    <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                    <img class="report-img" src="{{url('img/frontend/globe.png')}}">Travel Report
                </a>
                @elseif($super_row->report_option=='offer')
                <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                    <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Proposal
                </a>
                @endif --}}
                @if($super_row->report_option=='report' && $super_row->role_type == 'travel_maker')
                    <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                    <img class="report-img" src="{{url('img/frontend/globe.png')}}">Travel Report
                </a>
                @elseif($super_row->report_option=='offer' && $super_row->role_type == 'travel_maker')
                <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                    <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Buddy Search
                </a>
                @elseif($super_row->role_type == 'traveler')
                <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                    <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Report
                </a>
                @elseif($super_row->role_type == 'travel_agency')
                <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                    <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Offert
                </a>
                @elseif($super_row->role_type == 'travel_blogger')
                <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                    <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Post
                </a>
                @endif
            </div>
            </div>
        </div>

        <div class="travel_btn">
            <!-- <a href="javascript:void(0)" class="travel_action status1" data-value="super" data-id="4">Super {{ $super_row->supers_count }}</a> -->

            @if(!empty(Auth::user()))
                @php
                $super=check_super_from_user($super_row->id, Auth::user()->id);
                @endphp
                @if($super=='1')
                    <a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$super_row->id}}" data-count="{{$super_row->supers_count}}" data-text="Like">Like {{$super_row->supers_count}}</a>
                @else
                <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$super_row->id}}" data-text="Like" data-count="{{$super_row->supers_count}}">Like {{$super_row->supers_count}}</a>
                @endif
            @else
                <a href="{{url('/main-login')}}">Like {{$super_row->supers_count}}</a>
            @endif

            <!-- <a href="javascript:void(0)" class="travel_action1 status1" data-value="alert" data-id="4">Alert {{ $super_row->alerts_count }}</a> -->
            @if(!empty(Auth::user()))
                @php
                $alert=check_alert_from_user($super_row->id, Auth::user()->id);
                @endphp
                @if($alert=='1')
                <a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$super_row->id}}"  data-text="Alert" data-count="{{$super_row->alerts_count}}">Alert {{$super_row->alerts_count}}</a>
                @else
                <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$super_row->id}}" data-text="Alert" data-count="{{$super_row->alerts_count}}">Alert {{$super_row->alerts_count}}</a>
                @endif
            @else
                <a href="{{url('/main-login')}}">Alert {{$super_row->alerts_count}}</a>
            @endif

            @if(!empty(Auth::user()))
                @php
                    $same_trip_page=check_sametrip_page_from_user($super_row->id,Auth::user()->id);
                @endphp
                @if($same_trip_page=='1')
                <a href="javascript:void(0)" class="travel_action1 status1 disabled @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip page" id = "sametrip-{{$super_row->id}}" data-id="{{$super_row->id}}">Same Trip Page</a>
                @else
                <a href="javascript:void(0)" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip page"  id = "sametrip-{{$super_row->id}}" data-id="{{$super_row->id}}">Same Trip Page</a>
                @endif
            @else
            <a href="{{url('/main-login')}}">Same Trip Page</a>
            @endif

            @if(!empty(Auth::user()))
                @php
                    $same_trip=check_sametrip_from_user($super_row->id, Auth::user()->id);
                @endphp
                @if($same_trip=='1')
                    <a href="javascript:void(0);" class="sametrip1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip" data-id="{{$super_row->id}}"onClick="same_trip_delete(this)" data-text="same trip">Same Trip</a>
                @else
                    <a href="javascript:void(0);" id="element" class="sametrip1 status0 checktrip @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip" data-id="{{$super_row->id}}" onClick="same_report(this)" data-text="same trip">Same Trip</a>
                @endif
            @else
            <a href="{{url('/main-login')}}">Same Trip</a>
            @endif
        </div>
        <div class="site_text">
            <h4>
            @if($super_row->report_option=='report')
                <a href="{{url('view/travel_report/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                {{ substr($super_row->title, 0, 50) }}
                </a>
            {{-- @elseif($super_row->report_option=='diary')
                <a href="{{url('view/travel_report_dairy/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                {{ substr($super_row->title, 0, 50) }}
                </a> --}}
            @elseif($super_row->report_option=='offer')
                <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                {{ substr($super_row->title, 0, 50) }}
                </a>
            @endif
            </h4>
            <p>
            {!! substr($super_row->description, 0, 100)  !!}
            </p>
            <span>
            {{ displayDate($super_row->report_startdate) }}
            </span>
        </div>

        <hr>
        <div class="site_bottom">
            <h4>{{ getCurrencySymbol($super_row->currency_id) }} {{ $super_row->travel_cost }}</h4>

            @if($super_row->report_option=='report')
            <a href="{{url('view/travel_report/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                <img src="{{url('img/frontend/arrow-right.png')}}">
            </a>
            {{-- @elseif($super_row->report_option=='diary')
            <a href="{{url('view/travel_report_dairy/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                <img src="{{url('img/frontend/arrow-right.png')}}">
            </a> --}}
            @elseif($super_row->report_option=='offer')
            <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                <img src="{{url('img/frontend/arrow-right.png')}}">
            </a>
            @endif

        </div>
        </div>
    </div>
    @empty
    <h3>No report found</h3>
    @endforelse
    <div id="load-data"></div>