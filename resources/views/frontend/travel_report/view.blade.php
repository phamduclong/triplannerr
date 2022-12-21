@extends('frontend.layouts.travelmaker')
@section('content')
	@if(!empty($travel_report))
		<style>
	.owl-demo-view-img {
    height: 100%;
    width: 100%;
    /* background-size: auto 100% !important; */
	background-size: contain !important;
    display: inline-block;
    background-position: top !important;
    background-repeat: no-repeat !important;

	
}
.login-btn .dropdown-menu {padding: 0; border-radius: 0;right: 0;
	left: auto;min-width: 18rem; left: -40px;}
       </style>
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">


		<style id="compiled-css" type="text/css">
		      #carouselButtons {
		    margin-left: 100px;
		    position: absolute;
		    bottom: 0px;
		}

		.videoWrapper {
		  height:500px;
		  width:100%;
		  position:relative;
		  overflow:hidden;
		}

		.videoWrapper iframe {
	        height:100%;
	        width:100%;
	        position:absolute;
	        top:0;
	        bottom:0;
		}

		.goog-te-gadget {
			font-size: 8px;
			
			}

			.goog-te-combo {
				font-size: 7pt;
			}

		</style>

		<div class="inner-banner control-banner notranslate">
		    {{-- @include('frontend.profile-banner') --}}
			<div class="regions_div" id="regions_div" style="width: 90%; height: 700px;" listCountries="{{json_encode($country_arr)}}" listCountryDeparture="{{$travel_report->country_departure}}" listCountryDestinations="{{$travel_report->country_destination}}"></div>
			<div class="mt-5 d-flex justify-content-center">
			<div class="p-3" style="background-color: #149ece; color: #fff;border-radius:10px 0px 0px 10px;box-shadow: 2px 2px 5px 5px #888888">Country of Departure</div>
			<div class="p-3" style="background-color: #bd0000; color: #fff;border-radius:0px 10px 10px 0px;box-shadow: 2px 2px 5px 5px #888888">Travel Destinations</div>
			</div>
			<div class="mt-5 d-flex justify-content-center" style="margin-top:20px;">
			<div class="row" style="width: 25%;background-color: white;">
				<div id="Country_Of_Departure" class="p-3 col-md-6" style="color: white;display:none;background-color:#149ece;border-right:1px solid #808080;border-radius:10px 0px 0px 10px;box-shadow: 2px 2px 5px 5px #888888"></div>
				<div id="Travel_Destinations" class="p-3 col-md-6" style="color: white;display:none;background-color: #bd0000;border-radius:0px 10px 10px 0px;box-shadow: 2px 2px 5px 5px #888888"></div>
			</div>
			</div>
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

		<div class="viewtravel_section mx-50 notranslate">
			<div class="container-fluid">
				<h2 class="title">
                    {{ $travel_report->title }}
					 @if($travel_report->report_option == 'report' && $role_type=='travel_maker')
                     <p style="font-size: 15px;margin-top:20px"><mark style="background-color: yellow;">Travel Report</mark></p>
                     @endif
                     {{-- @if($travel_report->report_option == 'diary' && Auth::user()->role_type=='travel_maker')
                     <p style="font-size: 15px;">Travel Report with Travel Diaries</p>
                     @endif --}}
                     @if($travel_report->report_option == 'offer' && $role_type=='travel_maker')
                     <p style="font-size: 15px;margin-top:20px"><mark style="background-color: yellow;">Travel Buddy Search</mark></p>
                     @endif
					 @if($role_type=='traveler')
                     <p style="font-size: 15px;margin-top:20px"><mark style="background-color: yellow;">Travel Report</mark></p>
                     @endif
					 @if($role_type=='travel_agency')
                     <p style="font-size: 15px;margin-top:20px"><mark style="background-color: yellow;">Travel Offert</mark></p>
                     @endif
					 @if($role_type=='travel_blogger')
                     <p style="font-size: 15px;margin-top:20px"><mark style="background-color: yellow;">Travel Post</mark></p>
                     @endif
				</h2>
				<h5 class="title">
					<b>
						<a href="{{url('profile/'.$role_type.'/'.strtolower($travel_report->userdata->first_name.$travel_report->userdata->last_name).'/'.$travel_report->userdata->id)}}" target="_blank">
							{{$travel_report->userdata->first_name}} {{$travel_report->userdata->last_name}}
						</a>
					</b>
				</h5>
				<!-- <center><p style="color: #005ca9;">Click here and find out where the photo was taken using Google Maps!</p></center> -->

	    	</div>
		</div>

		@if($role_type == 'travel_blogger'  || $role_type == 'travel_agency')
		<div class="viewtravel_section mx-50 notranslate">
			<div class="container-fluid" style="text-align: center">
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
                      <img style="margin-top:-22px;display:inline" src="{{url('img/frontend/user/'.$userdata->agency_logo)}}" class="img-responsive" width="35" height="35">
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
                        <img style="margin-top:-22px;display:inline" src="{{url('img/frontend/user/'.$userdata->agency_logo)}}" class="img-responsive" width="35" height="35">
                      </a>
                    @else
                      <i class="fa fa-id-card" aria-hidden="true" style="font-size: 3em;"></i>
                    @endif
                  </a>
                @endif
			</div>
		</div>
		@endif

		{{-- add button alert and like --}}
		<div class="travel_btn notranslate" style="text-align:center">
			@if(!empty(Auth::user()))
				@php
				$super=check_super_from_user($travel_report->id, Auth::user()->id);
				@endphp
				@if($super=='1')
					<a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$travel_report->id}}" data-count="{{$travel_report->supers_count}}" data-text="Like">Like {{$travel_report->supers_count}}</a>
				@else
				  <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$travel_report->id}}" data-text="Like" data-count="{{$travel_report->supers_count}}">Like {{$travel_report->supers_count}}</a>
				@endif
			@else
				<a href="{{url('/main-login')}}" class="likeNoAuth">Like {{$travel_report->supers_count}}</a>
			@endif

			@if(!empty(Auth::user()))
				<div id="userDataId" userId="{{Auth::user()->id}}" hidden></div>
				@php
				$alert=check_alert_from_user($travel_report->id, Auth::user()->id);
				@endphp
				@if($alert=='1')
				  <a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$travel_report->id}}"  data-text="Alert" data-count="{{$travel_report->alerts_count}}">Alert {{$travel_report->alerts_count}}</a>
				@else
				  <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$travel_report->id}}" data-text="Alert" data-count="{{$travel_report->alerts_count}}">Alert {{$travel_report->alerts_count}}</a>
				@endif
			@else
				<a href="{{url('/main-login')}}" class="AlertNoAuth">Alert {{$travel_report->alerts_count}}</a>
			@endif
		  </div>
		{{-- end add button alert and like --}}

		    <!-- Carousel -->
		<div class="audio-section notranslate">
			<div id="demo" class="carousel slide" data-ride="carousel">
			  <!-- Menu -->
			  <ol class="carousel-indicators">
			  		@if(!empty($travel_report->image_gallery))
					    @foreach($travel_report->image_gallery as $Key => $image)
					  	@php
					    $class ='';
					    @endphp
					    @if($Key == 0)
					     @php
					    $class ='active';
					    @endphp
					    @endif
				    		<li data-target="#demo" data-slide-to="{{$Key}}" class="{{$class}}"></li>
				    	@endforeach
					@endif
			  </ol>
			  <!-- Items -->
			  <div class="carousel-inner">
			      <!-- Item 1 -->
			      @if(!empty($travel_report->image_gallery))
				    @foreach($travel_report->image_gallery as $Key => $image)
				    @php
				    $class ='';
				    @endphp
				    @if($Key == 0)
				     @php
				    $class ='active';
				    @endphp
				    @endif

				    <div class="carousel-item {{ $class }}">
				    	<div class="repo_btn">
							<a target="_blank" href="{{$image->image_location}}" style="color: #fff; text-underline-position: none;">Click here and find out where the photo was taken using Google Maps!</a>
						</div>

						<a class="owl-demo-view-img" target="blank" href="{{$image->image_location}}" style="background:url('{{ asset('/crop_images/'.$image->gallery_image) }}');"></a>
				        <!-- <img src="{{url('/crop_images/'.$image->gallery_image)}}"> -->
						@if(isset($image->image_caption) && !empty($image->image_caption))
					      <div class="container">
					        <div class="carousel-caption">
					          <h2>{{$image->image_caption}}</h2>
					        </div>
					      </div>
						@endif
					    </div>
				       @endforeach
					@endif
			  	</div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#demo" data-slide="prev">
			    <span class="icon-prev"></span>
			  </a>
			  <a class="right carousel-control" href="#demo" data-slide="next">
			    <span class="icon-next"></span>
			  </a>

			  <div id="carouselButtons" style="display: none;">
			      <button id="playButton" type="button" class="btn btn-default btn-xs">
			          <span class="glyphicon glyphicon-play"></span>
			       </button>
			      <button id="pauseButton" type="button" class="btn btn-default btn-xs">
			          <span class="glyphicon glyphicon-pause"></span>
			      </button>
			  </div>
			</div>

			<br><br>
			<!-- <audio controls="controls" autoplay="autoplay" id="audio_player" style="width: 90%" >
			  	<source src="{{url('/audio/backend',$travel_report->image_audio) }}" type="audio/mpeg" allow="autoplay">
			</audio> -->

		    <audio autoplay="autoplay" controls="controls" class="audio_player" id="slider_audio_play" style="width: 90%">
			  	{{-- <source src="{{ url('/travel-report/audio/1589639755.mp3') }}" type="audio/mpeg"> --}}
				<source src="{{url('/audio/backend',$travel_report->image_audio) }}" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio> 
		</div>

		<br>
		<ul class="travel-user report_listing notranslate" style="background-color: #87CEFA;padding:10px;width:95%;margin:auto;border-radius: 10px">
		  	<li>
		        <div class="travel-type">
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Travel Category</p>
				  <p style="color:#ddd">
				  	@forelse($travel_report->categories as $key=>$category)
			  			{{ $category }}@if($key != (count($travel_report->categories)-1) ),  @endif
				  	@empty
				  		 No category
				  	@endforelse
				  </p>
		        </div>
		  	</li>

		  	@if($role_type=='traveler')
		  	<li>
		        <div class="travel-type">
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Type of Travel</p>
				  <p style="color:#ddd">
				   @if(!empty($travel_report) && isset($travel_report->type_of_travel) )
                      @php $type_of_travels =  explode(',', $travel_report->type_of_travel)   @endphp

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
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Vector Type</p>
				  <p style="color:#ddd">
				   @if(!empty($travel_report) && isset($travel_report->vector_type) )
                      @php $type_of_travels =  explode(',', $travel_report->vector_type)   @endphp

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

		  	@if($role_type=='travel_maker')
		  	<li>
		        <div class="travel-type">
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Type of Travel</p>
				  <p style="color:#ddd">
				   @if(!empty($travel_report) && isset($travel_report->type_of_travel) )
                      @php $type_of_travels =  explode(',', $travel_report->type_of_travel)   @endphp

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
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Vector Type</p>
				  <p style="color:#ddd">
				   @if(!empty($travel_report) && isset($travel_report->vector_type) )
                      @php $type_of_travels =  explode(',', $travel_report->vector_type)   @endphp

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

		  	@if($role_type=='travel_blogger')
		  	<li>
		        <div class="travel-type">
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Type of Travel</p>
				  <p style="color:#ddd">
				   @if(!empty($travel_report) && isset($travel_report->type_of_travel) )
                      @php $type_of_travels =  explode(',', $travel_report->type_of_travel)   @endphp

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
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Vector Type</p>
				  <p style="color:#ddd">
				   @if(!empty($travel_report) && isset($travel_report->vector_type) )
                      @php $type_of_travels =  explode(',', $travel_report->vector_type)   @endphp

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
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Stay Formula</p>
				  <p style="color:#ddd">
				    @if(!empty($travel_report) && isset($travel_report->preferred_type) )
                      @php $preferred_types =  explode(',', $travel_report->preferred_type)   @endphp
                      @forelse($preferred_types as $key =>$type)
                          {{ $type }}
                      @empty
                      	 No category
                      @endforelse
                     @endif
				  </p>
		        </div>
		  	</li>

		  	{{-- <li>
		        <div class="travel-type">
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Transportation</p>
				  <p style="color:#ddd">
				    @if(!empty($travel_report) && isset($travel_report->vector_type) )
                          @php $vector_types =  explode(',', $travel_report->vector_type)   @endphp

                          @forelse($vector_types as $key =>$type)
                              {{ $type }}
                          @empty
                          	 No category
                          @endforelse
                      @endif
				  </p>
		        </div>
		  	</li> --}}

		  	<li>
		        <div class="travel-type">
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Accomodation</p>
				  <p style="color:#ddd">
				    @if(!empty($travel_report) && isset($travel_report->type_of_accommodation) )
                      @php $type_of_accommodations =  explode(',', $travel_report->type_of_accommodation)   @endphp

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
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Type of Partecipants</p>
				  <p style="color:#ddd">
				    @if(!empty($travel_report) && isset($travel_report->type_of_participants) )
                          @php $type_of_participantss =  explode(',', $travel_report->type_of_participants)   @endphp

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
		          <p class="btn btn-primary" style="border: none;background-color: #0198cd">Meals</p>
				  <p style="color:#ddd">
				    @if(!empty($travel_report) && isset($travel_report->travel_favoritemealtype) )
                          @php $travel_favoritemealtypes =  explode(',', $travel_report->travel_favoritemealtype)   @endphp

                          @forelse($travel_favoritemealtypes as $key =>$type)
                              {{ $type }}
                          @empty

                          @endforelse
                      @endif
				  </p>
		        </div>
		  	</li>

			<li>
				<div class="travel-type">
					<p class="btn btn-primary" style="border: none;background-color: #0198cd">Age of the Participants</p>
					<p style="color:#ddd">
						@if($travel_report->birth_place == 1)
						18-25
						@elseif($travel_report->birth_place == 2)
						26-35
						@elseif($travel_report->birth_place == 3)
						36-45
						@elseif($travel_report->birth_place == 4)
						46-55
						@elseif($travel_report->birth_place == 5)
						56-65
						@elseif($travel_report->birth_place == 6)
						over 65
						@else
						18-25
						@endif
					</p>
				</div>
			</li>
			<li>
				<div class="travel-type">
					<p class="btn btn-primary" style="border: none;background-color: #0198cd">Travel Budget</p>
					<p style="color:#ddd">
						{{$travel_report->preferred_travel_budget}}
					</p>
				</div>
			</li>
		</ul>

		<div class="travel_budget mx-50 container-fluid">
			<div class="row">
				<div class="col-md-12 profile-inner">
					<div class="row">
						<div class="col-md-10"></div>
						<div class="col-md-2" id="google_translate_element"></div> 
					</div>
					{{-- <div class="travel-content" style="text-align: justify;"> --}}
					<div style="text-align: justify;margin-top:50px">
						{!! nl2br($travel_report->description) !!}
					</div>
				</div>
			</div>
			<div class="row notranslate" style="margin-top: 20px">
				<div class="col-md-12">
					<table class="table table-bordered budget-table">
						<thead>
							<tr>
								<th colspan="2" style="width: 20%">Cost Summary</th>
								<th style="width: 25%">Travel PRO</th>
								<th style="width: 20%">Individual</th>
								<th style="width: 15%">No. Of Partecipants</th>
								<th style="width: 20%">Total for Partecipants</th>
							</tr>
								@php
								$total_individual = 0;
								$total_group = 0;
								@endphp
								@foreach($travel_report->report_components as $key => $component)

								@php
									$total_individual += $component->individual_cost;
									$total_group += $travel_report->no_of_participants * $component->individual_cost;
								@endphp

							    <tr>
									<td>{{ $component->component }}</td>
									<td>{{ $component->sub_component }}</td>
									@if($component->travel_pro)
										@if(isset($component->security_user) && !empty($component->security_user))
											<td onclick="alert('This Travel PRO account will be reactivated shortly')" style="color: #00BFFF;cursor: pointer;">
												{{-- <a href="{{url($component->link_travel_pro)}}" target="_blank"> --}}
													{{ $component->travel_pro }}
												{{-- </a> --}}
											</td>
										@else
											@if(isset($component->link_travel_pro) && !empty($component->link_travel_pro))
												<td>
													<a href="{{url($component->link_travel_pro)}}" target="_blank">
														{{ $component->travel_pro }}
													</a>
												</td>
											@else
												<td></td>
											@endif
										@endif
									@else
										<td>{{$component->travel_pro_name}}</td>
									@endif
									
									<td>{{ $component->individual_cost }} {{ $travel_report->currency->symbol }} </td>
									<td>{{$travel_report->no_of_participants}}</td>
									<td>{{ ($travel_report->no_of_participants * $component->individual_cost) }}.00 {{ $travel_report->currency->symbol }}</td>
								</tr>
							@endforeach
							<tr>
								<th colspan="3">Total</th>
								<th>{{ $total_individual }}.00 {{ $travel_report->currency->symbol }}</th>
								<th></th>
								<th>{{ $total_group }}.00 {{ $travel_report->currency->symbol }}</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>



			<div class="video_section notranslate">
			  @if(!empty($travel_report->slider_video))
				@if($travel_report->slider_video_type == 'image')
		        <video width="100%" height="500" controls style="background-color: #000; max-width: 100%; margin: 0 auto; display: block;"><source src="{{url('video/frontend/travel_report/slidervideo/'.$travel_report->slider_video)}}" type="video/mp4">
		        </video>
		        <div class="delete-icon-video">
		          	{{-- <a href="{{url('delete_video/travel_report',convertoToSlug($travel_report->title))}}" class="delete" data-confirm="Are you sure to delete this item?"><i class="fas fa-trash"></i></a> --}}
					  <a href="{{url('delete_video/travel_report',$travel_report->id)}}" class="delete" data-confirm="Are you sure to delete this item?"><i class="fas fa-trash"></i></a>

		          	<!-- <a href="javascript:void(0)" class="deleteItem" data-confirm="Are you sure to delete this item?" data-href="{{url('delete_video/travel_report',convertoToSlug($travel_report->title))}}"><i class="fas fa-trash"></i></a> -->

				    </div>

		        @else

		        <div class="view-relative-box">
		        	<div id="videoWithNoJs" class="videoWrapper">
			        <iframe width="100%" height="500"  style="max-width: 100%; margin: 0 auto; display: block;" src="{{url('https://www.youtube.com/embed/'.$travel_report->slider_video)}}">
		           </iframe>
		       </div>
		          <div class="delete-icon-video">
		          	<a href="{{url('delete_video/travel_report',$travel_report->id)}}" class="delete" data-confirm="Are you sure to delete this item?"><i class="fas fa-trash"></i></a>


				  </div>
			  </div>
	          @endif
           @endif
	       </div>


		<div class="row notranslate">
			@if(!empty(Auth::user()))
				{{-- <div class="col-md-6">
					<div class="repo_btn">
						<a href="{{url('/add-booking',$travel_report->user_id)}}">Book or Request Information</a>
					</div>
				</div>

			  	@if(Auth::user()->role_type=='travel_maker' && $travel_report->userdata->role_type=='travel_maker')
		           	@if($travel_report->user_id !== Auth::user()->id)
						<div class="col-md-6">
							<div class="repo_btn">
								<a href="{{url('/add-booking',$travel_report->user_id)}}">Book or Request Information</a>
							</div>
						</div>
			       @endif
			   	@endif
			   	--}}
			@else
				<div class="col-md-6">
				  	<div class="repo_btn">
	                  	<a href="{{url('/main-login')}}">Book or Request Information</a>
				  	</div>
				</div>
	        @endif

			@if($role_type=='travel_maker' && $travel_report->report_option=='diary' )
				<div class="col-md-12">
					<div class="repo_btn">
						<a href="{{url('/requestcontent'.'/'.$travel_report->id.'/'.Auth::user()->id)}}">Information Request</a>
					</div>
				</div>

			  	{{--
			  	@if(Auth::user()->role_type=='travel_maker' && $travel_report->userdata->role_type=='travel_maker')
		           	@if($travel_report->user_id !== Auth::user()->id)
					   	<div class="col-md-6">
							<div class="repo_btn">
								<a href="{{url('/requestcontent'.'/'.$travel_report->id.'/'.Auth::user()->id)}}">Request Content</a>
							</div>
						</div>
			       	@endif
			   	@endif
			   	--}}
			@else
			<!-- 	<div class="col-md-12">
				  	<div class="repo_btn">
	                  	<center><a href="{{url('/main-login')}}">Request Content</a></center>
				  	</div>
				</div> -->
	        @endif


			@if($role_type=='travel_maker' && $travel_report->report_option=='offer' )
				<div class="col-md-12" style="margin-top:-2%">
					<form id="application_form" method="post" action="{{url('request_content/')}}" enctype="multipart/form-data">
						@csrf
						<div class="btns-div">
						<input type="hidden" name="report_id" value="{{ $travel_report->id }}" >
						<input type="hidden" name="request_type" value="participate">

						<button type="submit" class="btn more_btn">I WANT TO PARTICIPATE</button>
						</div>
					</form>
				</div>
			@endif

	        @if($role_type=='travel_agency')
	        	<div class="col-md-12">
					<div class="repo_btn">
						<a href="{{url('/requestcontent'.'/'.$travel_report->id.'/'.Auth::user()->id)}}">Information Request</a>
					</div>
				</div>
	        @endif
		</div>

		{{--
		@if($travel_report->userdata->role_type=='traveler' || $travel_report->userdata->role_type=='travel_maker')
		--}}
		@if($role_type == 'traveler' || $role_type ==  'travel_maker')
	 	<div class="row notranslate">
			@if(!empty(Auth::user()))
				{{--<div class="req-btn">
					<a href="{{url('/add-booking',$travel_report->user_id)}}"><button class="btn">PURCHASE TRAVEL SERVICES</button></a>
				</div>--}}
				{{--
			   	@if(Auth::user()->role_type =='travel_agency')
					<div class="req-btn">
						<a href="{{url('/add-booking',$travel_report->user_id)}}"><button class="btn">PURCHASE TRAVEL SERVICES</button></a>
					</div>
			    @elseif(Auth::user()->id == $travel_report->user_id)
					<div class="req-btn">
						<a href="{{url('/main-login')}}"><button class="btn">PURCHASE TRAVEL SERVICES</button></a>
					</div>
				@endif
				--}}
			@else
			<div class="req-btn">
				<a href="{{url('/main-login')}}"><button class="btn">PURCHASE TRAVEL SERVICES</button></a>
			</div>
			@endif

			@if(!empty(Auth::user()))
			    @if($role_type =='travel_maker')
			    	<div class="req-btn" style="display:none">
						<a href="{{url('/add-booking',$travel_report->user_id)}}"><button class="btn">TRAVEL REPORTS WITH TRAVEL PROPOSAL</button></a>
					</div>
		     		{{--
			     	@if(Auth::user()->id==$travel_report->user_id)
					<div class="req-btn" style="display:none">
						<a href="{{url('/add-booking',$travel_report->user_id)}}"><button class="btn">TRAVEL REPORTS WITH TRAVEL PROPOSAL</button></a>
					</div>
			 		@else
					<div class="req-btn" >
						<a href="{{url('/add-booking',$travel_report->user_id)}}"><button class="btn">TRAVEL REPORTS WITH TRAVEL PROPOSAL</button></a>
					</div>
		    		@endif
		    		--}}
			  	@endif
			@else
				<div class="req-btn" style="display:none">
					<a href="{{url('/main-login')}}"><button class="btn">TRAVEL REPORTS WITH TRAVEL PROPOSAL</button></a>
				</div>
			@endif
	 	</div>
	  	@else

	  	@endif
		@endif

    {{-- <div class="share_links">
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
    </div> --}}
	<div class="row notranslate" style="margin-top: 30px;margin-left:0px">
		<div class="col-md-5"></div>
		<div class="col-md-7">
			<a href="javascript:void(0)"><i id="shareFacebook" class="fa fa-facebook-square" style="font-size: 3em"></i></a>
			<a href="javascript:void(0)"><i id="shareTwitter" class="fa fa-twitter-square" style="font-size: 3em;color:#00BFFF"></i></a>
			<a href="javascript:void(0)"><i id="shareLinkedin" class="fa fa-linkedin-square" style="font-size: 3em;color:#1E90FF"></i></a>
			<a href="javascript:void(0)"><i id="shareTelegram" class="fa fa-telegram" aria-hidden="true" style="font-size: 3em;color:#1E90FF"></i></a>
			<a href="javascript:void(0)" data-action="share/whatsapp/share"><i id="shareWhatsapp" class="fa fa-whatsapp" aria-hidden="true" style="font-size: 3em;color:green"></i></a>
		</div>
    </div>
    @php
      $ip= Request::ip();
    @endphp
    <div class="add-section notranslate">
      <div class="container">
    	<div class="row">
    		@if(!empty($ads_data))
			    @foreach($ads_data as $ads)
			        <div class="col-md-3">
    			        <div class="add-img view-travel-box">
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
			            </div>
    		        </div>
                 @endforeach
            @endif
    	</div>
      </div>
    </div>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
//handle draw map
var listCountries = JSON.parse($('#regions_div').attr('listCountries'));
var listCountryDeparture = $('#regions_div').attr('listCountryDeparture');
var listCountryDestinations = $('#regions_div').attr('listCountryDestinations').split(",");
for(var key in listCountries){
	if(key == listCountryDeparture){
		$('#Country_Of_Departure').show();
		$('#Country_Of_Departure').html(listCountries[key]);
	}
}
var DESTINATION_COUNTRIES = '';
for(var key in listCountries){
	for(var i = 0; i < listCountryDestinations.length; ++i){
		if(key == listCountryDestinations[i]){
			DESTINATION_COUNTRIES += listCountries[key] + ', ';
		}
	}
}
$('#Travel_Destinations').show();
$('#Travel_Destinations').html(DESTINATION_COUNTRIES);
var list = [
['Country', 'Value', {role: 'tooltip', p:{html:true}}],
];

for(var key in listCountries){
	list.push([
	listCountries[key],
	700,
	''
	]);
}

for(var key in listCountries){
	if(key == listCountryDeparture){
		list.push([
            listCountries[key],
            500,
            ''
          ]);
	}
}

for(var key in listCountries){
	for(var i = 0; i < listCountryDestinations.length; ++i){
	if(key == listCountryDestinations[i]){
		list.push([
		listCountries[key],
		200,
		''
		]);
	}
	}
}

google.charts.load('current', {
    'packages':['geochart'],
    'mapsApiKey': 'AIzaSyCGrOHkMNJxFTIBIXK4TV5qS-yffxIaSxI'
  });
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable(
      list
    );

    var options = {
      colorAxis: {colors: ['#bd0000', '#149ece','gray']},
      datalessRegionColor: 'gray',
      defaultColor: '#f5f5f5',
      legend: 'none',
      keepAspectRatio: false,
      tooltip: {
        isHtml: true
      }
    };

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);
  }
//end handle draw map
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
setTimeout(function(){
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
    var user_id = $('#userDataId').attr('userId');
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
            //    if(value == "alert"){
            //     $.get('{{url('/configcontact1')}}');
            //    }
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
}, 500);


$(function () {
    $('#demo').carousel({
        interval:8000,
        pause: "false"
    });


    $('#playButton').click(function () {

        $('#demo').carousel('cycle');
    });
    $(document).on('click','audio', function()
    {
    	alert('gg');
    });
    //    $('audio_player').click(function () {
    // 	alert('gg');
    //     $('#demo').carousel('cycle');
    // });

    $('#pauseButton').click(function () {
        $('#demo').carousel('pause');
    });
});

var vid = document.getElementById("slider_audio_play");

vid.onplay = function() {
   $('#demo').carousel('cycle');
};
vid.onpause = function() {
   $('#demo').carousel('pause');
};

//google translate
function googleTranslateElementInit() { 
	new google.translate.TranslateElement(
		{pageLanguage: 'auto'}, 
		'google_translate_element'
	); 
} 

</script>

<style>
.view_detail_btn {
    position: absolute;
    bottom: 10px;
    left: 10px;
}
button.btn.pause-btn {
    background: #005ca9;
    color: #fff;
    border-radius: 3px;
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
  .add-img p {
    font-size: 13px;
    background: #F1F1F1;
    line-height: 22px;
    padding: 10px;
    box-shadow: 0px 2px 5px #aaa;
    margin-top: -2px;
}
.add-img a img {
    margin-bottom: 0px !important;
}

.add-img a img {
    margin-bottom: 30px;
    width: 100%;
    /* display: none; */
  }

.audio-section .carousel-indicators {
	    display: block;
	}
	.audio-section .carousel-inner > .item > img {
	    height: 480px;
	}
	.audio-section {
	    position: relative;
	    padding: 0 60px 40px;
	}
	.carousel-inner {
		height: 680px;
	}
</style>
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

	.travel-tt {
	    text-align: center;
	    color: #ddd;
    }
    .container-fluid {
	    padding-left: 60px;
	    padding-right: 60px;
	}
	.viewtravel_section h5.title {
    font-size: 22px;
}
	a {
	    color: #007bff;
	}
	.viewtravel_section h2.title {
	    font-size: 36px;
	}
	.inner-banner p.banner-txt {
	    font-size: 17px;
	    margin: 0;
	}
	.table > thead > tr > th {
    vertical-align: middle;
    text-align: center;
}
.repo_btn a {
    padding: 8px 20px;
    font-size: 18px;
}
.carousel-item{
	height: 600px;
}
.travel_action1.status1{
    background: #005ca9;
    color: #fff;
	text-decoration: none;
	width: 10%;
	height: 50px;
	font-size: 30px;
}
.travel_action1.status0{
	text-decoration: none;
	width: 10%;
	height: 50px;
	font-size: 30px;
}
.AlertNoAuth{
	text-decoration: none !important;
	width: 10% !important;
	height: 50px !important;
	font-size: 30px !important;
}
.likeNoAuth{
	text-decoration: none !important;
	width: 10% !important;
	height: 50px !important;
	font-size: 30px !important;
}
</style>
<script>


var deleteLinks = document.querySelectorAll('.delete');

for (var i = 0; i < deleteLinks.length; i++) {
  deleteLinks[i].addEventListener('click', function(event) {
      event.preventDefault();

      var choice = confirm(this.getAttribute('data-confirm'));

      if (choice) {
        window.location.href = this.getAttribute('href');
      }
  });
}

// $(document).ready(function(){
//   $(".deleteItem").dblclick(function(){
//     hrf = $(this).data('href');
//     cnfrm = confirm("Are you really sure you want to delete this video.");
//     if(cnfrm){
//     	window.location.assign(hrf);
//     }
//   });
// });
</script>

@endsection
