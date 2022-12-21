@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <strong>{{ $message }}</strong>
</div>
@endif

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8">
      <img src="{{ url('img/frontend/banner-img.png') }}" style="width: 100%; margin-top: 85px;">
      <div style="text-align: center; margin: 30px 0px;">
        <h5>The only tool you need to travel around the world</h5>
        <h6>Discover new destinations, suggestions and useful information to organize trips and holidays.</h6>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 align-self-center" style="margin: 90px auto;">
      <h5>Choose your profile & register</h5>
      <div id="accordion">
        <h3><i class="fas fa-map-marker-alt" style="color: #008037;"></i>&nbsp;Traveler</h3>
        <div>
          <p>He shares his travels.</p>
          <p>Inspire other travelers.</p>
          <p>Upload his photos and tell about travel experiences.</p>
          <p>He shares his Travel Reports with his Followers in Travel Maker and on Social Networks.</p>
          <p>It offers tips and information for organizing trips and holidays.</p>
          <p>Search for information on different types of travel to find inspiration, tips and advice on how to organize your holiday.</p>
          <div class="form-group clearfix login-tbtn bl-btn">
            <a href="{{ url('register?role_type=traveler')}}"><button class="btn btn-sm">Sign up now!</button></a>
          </div>
        </div>
        <h3><i class="fas fa-map-marker-alt" style="color: #5271ff;"></i>&nbsp;Travel Maker</h3>
        <div>
          <p>He shares his travels and inspires other travelers.</p>
          <p>It has all the features available for travelers and much more:</p>
          <p>It proposes its travels and looks for travel companions.</p>
          <p>Become the Tour Leader of the trip he has planned.</p>
          <p>He shares a passion for travel and organizes holidays for his friends.</p>
          <p>It proposes travel itineraries and calculates the budget necessary to participate</p>
          <div class="form-group clearfix login-tbtn bl-btn">
            <a href="{{ url('register?role_type=travel_maker')}}"><button class="btn btn-sm">Sign up now!</button></a>
          </div>
        </div>
        <h3><i class="fas fa-map-marker-alt" style="color: #cb6ce6;"></i>&nbsp;Travel Blogger</h3>
        <div>
          <p>He shares his travel reports.</p>
          <p>He is a professional who shares information and news.</p>
          <p>Suggests new destinations.</p>
          <p>Shares Travel Reports with his Followers in Travel Maker and on Social Networks.</p>
          <p>Offers promotional services to Travel Pros</p>
          <p>Writing SEO articles with back-links promotion on the Social Channels of the Blogger. </p>
          <div class="form-group clearfix login-tbtn bl-btn">
            <a href="{{ url('register?role_type=travel_blogger')}}"><button class="btn btn-sm">Sign up now!</button></a>
          </div>
        </div>
        <h3><i class="fas fa-map-marker-alt" style="color: #ffde59;"></i>&nbsp;Travel Pro</h3>
        <div>
          <p>He shares his travel reports.</p>
          <p>He is a professional who shares information and news on the offers and services he offers.</p>
          <ul class="list-detail">
            <li>Touristic Guides</li>
            <li>Tourist Services</li>
            <li>Hotels and B&B</li>
            <li>Restaurants</li>
            <li>Touristic Services</li>
            <li>Travel Agents</li>
          </ul>
          <div class="form-group clearfix login-tbtn bl-btn">
            <a href="{{ url('register?role_type=travel_agency')}}"><button class="btn btn-sm">Sign up now!</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('after-styles')
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
    .ui-widget {
      font-family: inherit;
      font-size: inherit;
    }

    .ui-accordion .ui-accordion-content {
      padding: 15px;
      font-size: 14px;
      font-weight: 500; 
    }

    .login-fbtn, .login-tbtn {
      max-width: 50%;
    }
  </style>
@endpush

@push('after-scripts')
  @if(config('access.captcha.login'))
    @captchaScripts
  @endif
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#accordion" ).accordion({
        collapsible: true,
        heightStyle: "content",
        active: false
      });
    } );
  </script>
@endpush