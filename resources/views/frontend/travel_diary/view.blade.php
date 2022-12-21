@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('Travel diary'))

@section('content')
<style>
.badge-icon.chagecss {
    position: absolute;
    top: 1%;
    left: 7%;
    width: 150px;
    height: 100px;
}
.image_caption_container {
		position: absolute;
		left: 12px;
		background: #000;
		color: #fff;
		top: 0px;
		width: 91%;
		text-align: center;
		opacity: 0.5;
	}
</style>
<style>
	.owl-demo-view-img {
		    height: 480px;
		    width: 100%;
		    background-size: cover !important;
		    display: inline-block;
		    background-position: center center !important;
		}
</style>

<div class="inner-banner control-banner">
    @include('frontend.profile-banner')
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
<div class="viewtravel_section mx-50">
	<div class="container-fluid">
		<h2 class="title">
			<a href="{{url('profile',Auth::user()->role_type)}}">
			  {{ $travel_report->title }}
			</a>
			 @if($travel_report->report_option == 'report' && Auth::user()->role_type=='travel_maker')
             <p style="font-size: 15px;">Travel Report with Report</p>
             @endif
             {{-- @if($travel_report->report_option == 'diary' && Auth::user()->role_type=='travel_maker')
             <p style="font-size: 15px;">Travel Report with Travel Diaries</p>
             @endif --}}
             @if($travel_report->report_option == 'offer' && Auth::user()->role_type=='travel_maker')
             <p style="font-size: 15px;">Travel Report with Travel Proposal</p>
             @endif
		</h2>
		<h5 class="title"><b>{{$travel_report->userdata->first_name}} {{$travel_report->userdata->last_name}}</b></h5>

		<!-- <center><p style="color: #005ca9;">After clicking the image you will redirect to Google Map Page</p></center>
        -->
		<div class="audio-section">
			<div id="owl-demo" class="owl-carousel owl-theme">
          		@if(!empty($travel_report->image_gallery))
               	    @foreach($travel_report->image_gallery as $Key => $image)
			          	<div class="item link">
			          		<div class="repo_btn">
								<a target="_blank" href="{{$image->image_location}}">Click here and find out where the photo was taken using Google Maps!</a>
							</div>
			          		<a class="owl-demo-view-img" target="blank" href="{{$image->image_location}}" style="background:url('{{ asset('/crop_images/'.$image->gallery_image) }}');"></a>
			          		<div class="carousel-caption">
					        	<h2>{{$image->image_caption}}</h2>
					      	</div>
			          	</div>
			        @endforeach
			    @endif
            </div>
            <br><br>
            <audio autoplay="autoplay" controls="controls" class="audio_player" id="slider_audio_play">
			  	<source src="{{ url('/travel-report/audio/1589639755.mp3') }}" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>
        </div>

	 	  <!-- <div class="location_sec mx-50">
	 		<div class="row">
	 			<div class="col-md-12">
	 				<div class="loc_left">
	 					<p>{!! $travel_report->description !!}</p>
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
	 	</div> -->
	 	<br>

		<ul class="travel-user report_listing">
		  	<li>
			        <div class="travel-type">
			          <p>Travel Category</p>
					  <p style="color:#ddd">
					  	@forelse($travel_report->categories as $key=>$category)
				  			{{ $category }}@if($key != (count($travel_report->categories)-1) ),  @endif
					  	@empty
					  		 No category
					  	@endforelse
					  </p>
			        </div>
			  	</li>

			  	@if(Auth::user()->role_type=='traveler')
		  	<li>
		        <div class="travel-type">
		          <p>Type of Travel</p>
				  <p style="color:#ddd">
				   @if(!empty($userdata) && isset($userdata->type_of_travel) )
                      @php $type_of_travels =  explode(',', $userdata->type_of_travel)   @endphp

                      @forelse($type_of_travels as $key =>$type)
                         {{ $type }}
                      @empty
                      	 No category
                      @endforelse
                  @endif
				  </p>
		        </div>
		  	</li>

		  	<li>
		        <div class="travel-type">
		          <p>Vector Type</p>
				  <p style="color:#ddd">
				   @if(!empty($userdata) && isset($userdata->vector_type) )
                      @php $type_of_travels =  explode(',', $userdata->vector_type)   @endphp

                      @forelse($type_of_travels as $key =>$type)
                         {{ $type }}
                      @empty
                      	 No category
                      @endforelse
                  @endif
				  </p>
		        </div>
		  	</li>
		  	@endif

		  	@if(Auth::user()->role_type=='travel_maker')
		  	<li>
		        <div class="travel-type">
		          <p>Type of Travel</p>
				  <p style="color:#ddd">
				   @if(!empty($userdata) && isset($userdata->type_of_travel) )
                      @php $type_of_travels =  explode(',', $userdata->type_of_travel)   @endphp

                      @forelse($type_of_travels as $key =>$type)
                         {{ $type }}
                      @empty
                      	 No category
                      @endforelse
                  @endif
				  </p>
		        </div>
		  	</li>

		  	<li>
		        <div class="travel-type">
		          <p>Vector Type</p>
				  <p style="color:#ddd">
				   @if(!empty($userdata) && isset($userdata->vector_type) )
                      @php $type_of_travels =  explode(',', $userdata->vector_type)   @endphp

                      @forelse($type_of_travels as $key =>$type)
                         {{ $type }}
                      @empty
                      	 No category
                      @endforelse
                  @endif
				  </p>
		        </div>
		  	</li>
		  	@endif

		  	@if(Auth::user()->role_type=='travel_blogger')
		  	<li>
		        <div class="travel-type">
		          <p>Type of Travel</p>
				  <p style="color:#ddd">
				   @if(!empty($userdata) && isset($userdata->type_of_travel) )
                      @php $type_of_travels =  explode(',', $userdata->type_of_travel)   @endphp

                      @forelse($type_of_travels as $key =>$type)
                         {{ $type }}
                      @empty
                      	 No category
                      @endforelse
                  @endif
				  </p>
		        </div>
		  	</li>

		  	<li>
		        <div class="travel-type">
		          <p>Vector Type</p>
				  <p style="color:#ddd">
				   @if(!empty($userdata) && isset($userdata->vector_type) )
                      @php $type_of_travels =  explode(',', $userdata->vector_type)   @endphp

                      @forelse($type_of_travels as $key =>$type)
                         {{ $type }}
                      @empty
                      	 No category
                      @endforelse
                  @endif
				  </p>
		        </div>
		  	</li>
		  	@endif

		  	    <li>
			        <div class="travel-type">
			          <p>Stay Formula</p>
					  <p style="color:#ddd">
					    @if(!empty($userdata) && isset($userdata->preferred_type) )
	                      @php $preferred_types =  explode(',', $userdata->preferred_type)   @endphp
	                      @forelse($preferred_types as $key =>$type)
	                          {{ $type }}
	                      @empty
	                      	 No category
	                      @endforelse
	                     @endif
					  </p>
			        </div>
		  	    </li>

		  	    <li>
			        <div class="travel-type">
			          <p>Transportation</p>
					  <p style="color:#ddd">
					    @if(!empty($userdata) && isset($userdata->vector_type) )
	                          @php $vector_types =  explode(',', $userdata->vector_type)   @endphp

	                          @forelse($vector_types as $key =>$type)
	                              {{ $type }}
	                          @empty
	                          	 No category
	                          @endforelse
	                      @endif
					  </p>
			        </div>
		  	    </li>

		  	    <li>
			        <div class="travel-type">
			          <p>Accomodation</p>
					  <p style="color:#ddd">
					    @if(!empty($userdata) && isset($userdata->type_of_accommodation) )
	                          @php $type_of_accommodations =  explode(',', $userdata->type_of_accommodation)   @endphp

	                          @forelse($type_of_accommodations as $key =>$type)
	                              {{ $type }}
	                          @empty

	                          @endforelse
	                      @endif
					  </p>
			        </div>
		  	    </li>

		  	    <li>
			        <div class="travel-type">
			          <p>Type of Partecipants</p>
					  <p style="color:#ddd">
					    @if(!empty($userdata) && isset($userdata->type_of_participants) )
	                          @php $type_of_participantss =  explode(',', $userdata->type_of_participants)   @endphp

	                          @forelse($type_of_participantss as $key =>$type)
	                              {{ $type }}
	                          @empty

	                          @endforelse
	                      @endif
					  </p>
			        </div>
		  	    </li>

		  	    <li>
			        <div class="travel-type">
			          <p>Meals</p>
					  <p style="color:#ddd">
					    @if(!empty($userdata) && isset($userdata->travel_favoritemealtype) )
	                          @php $travel_favoritemealtypes =  explode(',', $userdata->travel_favoritemealtype)   @endphp

	                          @forelse($travel_favoritemealtypes as $key =>$type)
	                              {{ $type }}
	                          @empty

	                          @endforelse
	                      @endif
					  </p>
			        </div>
		  	    </li>
        </ul>

		<div class="travel_budget mx-50">
			<div class="row">
				<div class="col-md-7">
					<div class="travel-content">
						{!! $travel_report->description !!}
					</div>
				</div>
				<div class="col-md-5">
						<table class="table table-bordered budget-table">
							<thead>
								<tr>
									<th colspan="2">Cost Summary</th>
									<th>Individual</th>
									<th>No. Of Partecipants</th>
									<th>Total for Partecipants</th>
								</tr>

								@php
								$total_individual = 0;
								$total_group = 0;
								@endphp
								@forelse($travel_report->report_components as $key => $component)
									@php
										$total_individual += $component->individual_cost;
										$total_group += $travel_report->no_of_participants * $component->individual_cost;
									@endphp
								<tr>
									<td>{{ $component->component }}</td>
									<td>{{ $component->sub_component }}</td>
									<td>{{ $component->individual_cost }} {{ $travel_report->currency->symbol }} </td>
									<td>{{$travel_report->no_of_participants}}</td>
									<td>{{ ($travel_report->no_of_participants * $component->individual_cost) }}.00 {{ $travel_report->currency->symbol }}</td>
									{{-- <td>{{ ($travel_report->no_of_participants * $component->component_cost) }}</td> --}}
								</tr>
								@empty

								@endforelse
								<tr>
									<th colspan="2">Total</th>
									<th>{{ $total_individual }}.00 {{ $travel_report->currency->symbol }}</th>
									<th></th>
									<th>{{ $total_group }}.00 {{ $travel_report->currency->symbol }}</th>
								</tr>
								{{--
								<tr>
									<td>Travel tickets/ Transport</td>
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
								--}}
							</thead>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="share_links">
      <!-- <a href="{{ url('/')}}"><img src="{{url('img/frontend/log.png')}}"></a> -->
      @if(!empty($userdata->cover_image))
      <a class="facebook-share" href="javascript:void(0)"><img src="{{url('img/frontend/fb.png')}}"></a>
      @else

      @endif
     <!--  <a href=""><img src="{{url('img/frontend/ins.png')}}"></a> -->
      @if(!empty($userdata->cover_image))
      <a href="javascript:void(0)" class="twitter-share"><img src="{{url('img/frontend/twi.png')}}"></a>
      @else

      @endif
     <!--  <a href="https://www.youtube.com/playlist?list=PLg6W69m2_zdtEnc7h8oWR_03a12KMiihu" target="_blank"><img src="{{url('img/frontend/you.png')}}"></a> -->
      <!-- <a href="javascript(0)"><img src="{{url('img/frontend/tik.png')}}"></a> -->
</div>

    @php
      $ip= Request::ip();
    @endphp
     <div class="add-section">
      <div class="container">
    	<div class="row">
    		@if(!empty($ads_data))
			    @foreach($ads_data as $ads)
			        <div class="col-md-3">
    			        <div class="add-img">
			              @if($ads->type=="image")
			               <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
			               <h6>{{$ads->title}}</h6>
			               <img src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
			               <p>{{$ads->description}}</p>
			              @endif

			              @if($ads->type=='video')
		                   @if(!empty($ads->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$ads->type_file)) )
		                   <h6>{{$ads->title}}</h6>
		                    <video width="254" controls>
		                      <source src="{{url('img/backend/advertisement/'.$ads->type_file)}}" type="video/mp4">
		                    </video>
		                    <p>{{$ads->description}}</p>
		                    @else
		                     <h6>{{$ads->title}}</h6>
		                    <iframe width="254" src="{{isset($ads->embedded_link)?$ads->embedded_link:''}}">
		                    </iframe>
		                    <p>{{$ads->description}}</p>
			               @endif
			              @endif
			            </div>
    		        </div>
                 @endforeach
            @endif
    	</div>
    </div>
</div>
@endsection

@section('title', $travel_report->title)

@section('meta')

 @if(!empty($cover->cover_image))
	<meta property="og:image" content="{{url('img/frontend/user/cover/'.$cover->cover_image)}}"/>
	<meta property="og:image:secure_url" content="{{url('img/frontend/user/cover/'.$cover->cover_image)}}" />
	<meta property="og:title" content="{{ $travel_report->title }}" />
	<meta property="og:description" content="{{ substr(strip_tags($travel_report->description), 0, 160) }}" />
	<meta property="og:url" content="{{ Request::url() }}" />
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="{{ app_name() }}">
	<meta name="twitter:title" content="{{$travel_report->title}}">
	<meta name="twitter:description" content="{{ substr(strip_tags($travel_report->description), 0, 160) }}">
	<meta name="twitter:creator" content="{{ app_name() }}">
	<meta name="twitter:image" content="{{url('img/frontend/user/cover/'.$cover->cover_image)}}">
	@else
 @endif
@endsection

@push('after-scripts')
<script>
    var slider='<?php echo $travel_report->slider_type;?>';
   	$(document).ready(function() {
      	$("#owl-demo").owlCarousel({
            singleItem : true,
            transitionStyle : slider,
            autoPlay :true,
		    autoPlayTimeout:500,
      	});

    });
</script>

<script type="text/javascript">
	$("#slider_audio_play").on('click', function(){
		alert();
	});
</script>
@endpush

@push('after-styles')
<style type="text/css">
	.image_caption_container {
		position: absolute;
		left: 12px;
		background: #000;
		color: #fff;
		top: 0px;
		width: 91%;
		text-align: center;
		opacity: 0.5;
	}

    #owl-demo .item img{
      	display: block;
      	width: 100%;
      	height: 500px;
    }
    .audio-section{position: relative;}
	.audio-section audio {
		width: 100%;
		position: absolute;
		bottom: 0px;
	}
	.carousel-caption {
	position: absolute;
	right: 15%;
	bottom: 20px;
	left: 15%;

}
.carousel-caption h2 {
    z-index: 10;
    color: #fff;
    text-align: center;
    background: #000;
    opacity: 0.7;
    display: inline-block;
    padding: 20px;
}
</style>
<link rel="stylesheet" href="{{url('css/frontend/carousel.css')}}">
<link rel="stylesheet" href="{{url('css/frontend/theme.css')}}">
<script src="http://www.landmarkmlp.com/js-plugin/owl.carousel/assets/js/jquery-1.9.1.min.js"></script>
<script src="{{url('js/frontend/owl.carousel.js')}}"></script>
<script>
</script>
@endpush
