@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
<div class="inner-banner control-banner">
<img src="{{url('img/frontend/banner2.jpg')}}">  
</div>
@if(Auth::user()->role_type =='traveler')
   
    @include('frontend.traveler.characteristics.view')
@elseif(Auth::user()->role_type =='travel_maker')
    
    @include('frontend.travelmaker.characteristics.view')
@elseif(Auth::user()->role_type =='travel_blogger')
   
    @include('frontend.travelblogger.characteristics.view')
@elseif(Auth::user()->role_type =='travel_agency')
   
    @include('frontend.travelpro.characteristics.view')
@endif
</div>
@endsection