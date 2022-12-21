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