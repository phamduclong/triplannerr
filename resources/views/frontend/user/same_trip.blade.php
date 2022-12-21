@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')

@if(Auth::user()->role_type =='traveler')
        @include('frontend.traveler.same_trip.view')
    @endif
    @if(Auth::user()->role_type =='travel_maker')
        @include('frontend.travelmaker.same_trip.view')
    @endif
    @if(Auth::user()->role_type =='travel_blogger')
        @include('frontend.travelblogger.same_trip.view')
    @endif
    @if(Auth::user()->role_type =='travel_agency')
        @include('frontend.travelpro.same_trip.view')
    @endif


@endsection
