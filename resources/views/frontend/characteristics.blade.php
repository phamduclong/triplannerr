@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

    @include('frontend.includes.travelmaker.home_slider')
    @if($role_type =='traveler')
        @include('frontend.traveler.characteristics.view')
    @endif
    @if($role_type =='travel_maker')
        @include('frontend.travelmaker.characteristics.view')
    @endif
    @if($role_type =='travel_blogger')
        @include('frontend.travelblogger.characteristics.view')
    @endif
    @if($role_type =='travel_agency')
        @include('frontend.travelpro.characteristics.view')
    @endif
  
@endsection
