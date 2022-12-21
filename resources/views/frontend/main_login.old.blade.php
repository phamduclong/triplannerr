@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    
     @include('frontend.includes.travelmaker.home_slider')

  <!--   <div class="inner-banner">
         <img src="{{ url('img/frontend/banner1.jpg') }}">
     <img src="img/frontend/login.jpg"> 
       
    </div> -->
 <div class="login-section login_option">
        <div class="container">
         <h4>Choose the profile that best suits you and login now! </h4>
          <div id="Monthly" class="">
            <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 pd5">
           <div class="boarding_effect">
            <div class="pattern_img">
             <h3>Traveler</h3>
             <img src="img/frontend/green.png">
            </div>
            <div class="detail-lg">

             <p>Shares his/her travels.</p>
             <p>Inspires other travellers.</p>
             <p>Uploads his/her photos and tells about his/her travel experiences.</p>
             <p>Searches for information about different types of travel to find inspiration, tips and advice on how to organize your holiday.</p>
            </div>
            <a href="{{ url('login?role_type=traveler')}}"><button class="btn user_login gr-btn">Login now!</button></a>
           </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 pd5">
           <div class="boarding_effect">
            <div class="pattern_img">
            <h3>Travel Maker</h3>
             <img src="img/frontend/blue.png">
            </div>
            <div class="detail-lg">
             
             <p>Shares his travels and inspires other travellers.</p>
             <p>Proposes itineraries and looks for travel partners.</p>
             <p>Becomes the Tour Leader of the trip he has planned and suggested to the Community.</p>
             <p>Proposes itineraries and calculates the budget necessary to participate.</p>
             <p>Can also earn money by sharing information to faithfully replicate his/her Travel Reports.</p>
            </div>
            <a href="{{ url('login?role_type=travel_maker')}}"><button class="btn user_login bl-btn">Login now!</button></a>
           </div>
          </div>
         <div class="col-lg-3 col-md-3 col-sm-6 pd5">
           <div class="boarding_effect">
            <div class="pattern_img">
            <h3>Travel Blogger</h3>
             <img src="img/frontend/purple.png">
            </div>
        <div class="detail-lg">
             <p>is a professional who shares information and news about his/her travels.</p>
             <p>Suggests new destinations.</p>
             <p>shares his/her travel reports.</p>
             <p>Offers promotional services to Travel Pros: Collaborations</p>
             
            </div>
            <a href="{{ url('login?role_type=travel_blogger')}}"><button class="btn user_login pur-btn">Login now!</button></a>
           </div>
          </div>
         <div class="col-lg-3 col-md-3 col-sm-6 pd5">
           <div class="boarding_effect">
            <div class="pattern_img">
            <h3>Travel Pro</h3>
             <img src="img/frontend/skyblue.png">
            </div>

        <div class="detail-lg">
           <p>is a professional who shares information and news about the offers and services he provides.</p>
           <p>Agencies:</p>
            <ul class="list-detail">
              <li>Tour Operator</li>
              <li>Travel Agency</li>
              <li>Travel Agent</li>
              <li>Local Agent</li>
            </ul>
           <p>Local Operators:</p>
           <ul class="list-detail">
              <li>Excursions</li>
              <li>Tour Guides</li>
              <li>Day Trips</li>
            </ul>
           <p>Tourist Accomodation Services:</p>
           <ul class="list-detail">
              <li>Overnight Accommodation</li>
              <li>Restaurants and Services</li>
              <li>Monuments and Institutions</li>
              <li>Attractions and Entertainment</li>
            </ul>
            </div>
           <a href="{{ url('login?role_type=travel_agency')}}"><button class="btn user_login sk-btn">Login now!</button></a>
           </div>
          </div>
        </div>
    </div>
    </div>
</div>

@endsection
