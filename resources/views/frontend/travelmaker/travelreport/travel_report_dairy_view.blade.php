@extends('frontend.layouts.travelmaker')
@section('title', app_name() . ' | ' . __('labels.frontend.travel_report.box_title'))
@section('content')

<div class="inner-banner">
    <img src="{{url('img/frontend/inner-banner.jpg')}}">
        <div class="badge-icon">
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
                        <img src="{{url('img/frontend/user/profile/'.$userdata-> profile_image)}}" class="img-responsive" height="200" width="200">
                    @else
                        <img src="{{url('img/frontend/profile_user.jpg')}}">
                    @endif

	          	    <div class="profile-detail">
	           			<h4>@if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif
	           			</h4>
	             		@php
	              			$current=date('Y-m-d H:i:s');
	               			$date1=isset($userdata->birth_place)?$userdata->birth_place:'';
	                      	$date2 = $current;
	                      	$diff = abs(strtotime($date2) - strtotime($date1));
	                      	$years = floor($diff / (365*60*60*24));
	             		@endphp
	         	 	</div>
        		</div>
      		</div>

	      <div class="col-md-9 right-detail">
	        <div class="profile-banner">
                @include('frontend.profile-banner')
	          {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}">
	          <p>"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p> --}}
	        </div>
	      </div>
    	</div>
    </div>
  </div>
</div>

<div class="viewtravel_section mx-50">
	<div class="container-fluid">
		<h2 class="title">Travel Report Dairy</h2>
		<div class="travel-gallery">
            <div id="owl-demo2">
              <div class="item">
                  <img src="{{ url('img/frontend/alert1.jpg') }}">
              </div>
              <div class="item">
                  <img src="{{ url('img/frontend/alert2.jpg') }}">
              </div>
              <div class="item">
                  <img src="{{ url('img/frontend/alert3.jpg') }}">
              </div>
              <div class="item">
                  <img src="{{ url('img/frontend/alert4.jpg') }}">
              </div>
              <div class="item">
                  <img src="{{ url('img/frontend/alert1.jpg') }}">
              </div>
               <div class="item">
                  <img src="{{ url('img/frontend/alert2.jpg') }}">
              </div>
              <div class="item">
                  <img src="{{ url('img/frontend/alert3.jpg') }}">
              </div>
            </div>
	 	</div>


	 	<div class="location_sec mx-50">
	 		<div class="row">
	 			<div class="col-md-7">
	 				<div class="loc_left">
	 					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	 				</div>
	 			</div>
	 			<div class="col-md-5">
	 				<div class="loc_right">
	 					<input type="search" name="" class="form-control" placeholder="WDP Technology, Surya nagar, Jaipur(Rajasthan)">
	 					<div class="map-icon">
	 						<i class="fa fa-map"></i>
	 					</div>
	 				</div>
	 			</div>
	 		</div>
	 	</div>

		<ul class="travel-user report_listing">
          <li>
            <div class="travel-type">
              <p>Travel Category</p>
            </div>
          </li>
          <li>
            <div class="travel-type">
                <p>Travel Report Date<br>
			   Start               End
				</p>
            </div>
          </li>
          <li>
            <div class="travel-type">
              <p>Country of departure:xyz</p>
              <p>Destination Country:xyz</p>
            </div>
          </li>
          <li>
            <div class="travel-type">
                <p>Number of participants</p>
            </div>
          </li>
          <li>
            <div class="travel-type">
              <p>Number of the carries </p>
            </div>
          </li>
        </ul>

		<div class="travel_budget mx-50">
			<div class="row">
				<div class="col-md-7">
					<div class="travel-content">
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
						</p>
						<table class="table table-bordered budget-table">
							<thead>
								<tr>
									<th></th>
									<th>Touristic Operator</th>
									<th>Contacts</th>
									<th>Check In Check Out</th>
									<th>Total Costs </th>
									<th>Individual Costs</th>
									<th>Notes</th>

								</tr>
								<tr>
									<td>Overnight stays</td>
									<td>Name / Address</td>
									<td>e.mail/website/phone</td>
									<td>Date /  /   Date /   / </td>
									<td>$</td>
									<td>$</td>
									<td>$</td>
								</tr>
								<tr>
									<td>Meals</td>
									<td>Name / Address</td>
									<td>e.mail/website/phone</td>
									<td>Date /  /   Date /   / </td>
									<td>$</td>
									<td>$</td>
									<td>$</td>
								</tr>
								<tr>
									<td>Fun / Extras</td>
									<td>Name / Address</td>
									<td>e.mail/website/phone</td>
									<td>Date /  /   Date /   / </td>
									<td>$</td>
									<td>$</td>
									<td>$</td>
								</tr>
								<tr>
									<td>Touristic Guide</td>
									<td>Name / Address</td>
									<td>e.mail/website/phone</td>
									<td>Date /  /   Date /   / </td>
									<td>$</td>
									<td>$</td>
									<td>$</td>
								</tr>
								<tr>
									<td>Services</td>
									<td>Name / Address</td>
									<td>e.mail/website/phone</td>
									<td>Date /  /   Date /   / </td>
									<td>$</td>
									<td>$</td>
									<td>$</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="col-md-5">
					<table class="table table-bordered budget-table">
						<thead>
							<tr>
								<th>Cost Summary</th>
								<th>Individual</th>
								<th>Total</th>
							</tr>
							<tr>
								<td>Travel tickets/ Transport
									Name / Address
									e.mail/website/phone
								</td>
								<td>
									<table class="inner-table">
										<tr>
											<td colspan="3">Vector</td>
										</tr>
										<tr>
											<td>Car</td>
											<td>$</td>
											<td>$</td>
										</tr>
										<tr>
											<td>Airplane</td>
											<td>$</td>
											<td>$</td>
										</tr>

									</table>
								</td>
								<td>
									<table class="inner-table">
										<tr>
											<td colspan="3">Vector</td>
										</tr>
										<tr>
											<td>Car</td>
											<td>$</td>
											<td>$</td>
										</tr>
										<tr>
											<td>Airplane</td>
											<td>$</td>
											<td>$</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>Overnight stays</td>
								<td>000</td>
								<td>000</td>
							</tr>
							<tr>
								<td>Meals</td>
								<td>000</td>
								<td>000</td>
							</tr>
							<tr>
								<td>Fun / Extra</td>
								<td>000</td>
								<td>000</td>
							</tr>
							<tr>
								<td>Total</td>
								<td>000</td>
								<td>000</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
