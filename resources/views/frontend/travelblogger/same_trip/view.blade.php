<style>
.badge-icon.chagecss {
    position: absolute;
    top: 1%;
    left: 7%;
    width: 150px;
    height: 100px;
}
</style>
<div class="inner-banner control-banner">
	@include('frontend.profile-banner')
    {{--  @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )
           <img src="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" class="img-responsive">
           @else
            <img src="{{url('img/frontend/profile-banner.jpg')}}">
            @endif --}}
 {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}">
	<div class="container-fluid">
	 <p class="banner-txt">"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
	</div>
   <div class="badge-icon chagecss">
   	@if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
           <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive">
           @else
           <img src="{{url('img/frontend/user.png')}}">
            @endif

    </div> --}}
</div>

<!-- <div class="trip-head">
	<h2>Travel Report <a href="#">travelreport</a></h2>
</div> -->

<div class="control-table mx-50">
	<h4 class="title-trip">Same Trip Page</h4>
  <div class="container-fluid">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
      <thead>
        <tr>
            <th>Travel Report</th>
            <th>Super!</th>
            <th>Alert</th>
            <th>Same Trip Page</th>
        </tr>
      </thead>
      <tbody>
       @foreach($sametrip_data as $travel_report)

        <tr>
            <td style="vertical-align: middle;">
                @if($travel_report->report_id == $trip_id)

                    {{ get_report($travel_report->same_trip_id)->title }}
                @else

                    {{ get_report($travel_report->report_id)->title }}
                @endif


                {{-- <a href="{{ url('/') }}" target="_blank">{{$travel_report->report->title}}</a> --}}
            </td>

            <td style="vertical-align: middle;">
                 @if($travel_report->report_id == $trip_id)
                   {{get_superdata($travel_report->same_trip_id)}}
                 @else
                   {{get_superdata($travel_report->report_id)}}
                 @endif
           </td>
            <td style="vertical-align: middle;">
                 @if($travel_report->report_id == $trip_id)
                   {{get_alertdata($travel_report->same_trip_id)}}
                 @else
                   {{get_alertdata($travel_report->report_id)}}
                 @endif
           </td>
            <td style="vertical-align: middle;">
                 @if($travel_report->report_id == $trip_id)
                   {{get_sametrip($travel_report->same_trip_id)}}
                 @else
                   {{get_sametrip($travel_report->report_id)}}
                 @endif
           </td>

        </tr>
        @endforeach
      </tbody>
  </table>
  </div>
</div>

