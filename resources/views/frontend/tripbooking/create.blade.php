@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<style>
   .senti-list .input-sec {
    display: inline-block;
    width: 24.50% !important;
    font-size: 13px;
}
</style>
<div class="inner-banner control-banner">
      
        <img src="{{url('img/frontend/user/cover/'.$agency_option->cover_image)}}">
      	
		 
        <div class="badge-icon chagecss">
       	    @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
                <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive">
            @else
                <img src="{{url('img/frontend/user.png')}}">
            @endif 
        </div>
    </div>
    <div class="account-section mx-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-sm-12 align-self-center">
                <div class="card">
                <div class="account-form travelreport-form">
                <div class="card-body">
                 {{ html()->form('POST', route('frontend.tripbooking.save'))->attribute('enctype','multipart/form-data')->open() }}

                <div class="row">
                        <div class="col">
                            <div class="form-group senti-list">

                                {{ html()->label(__('validation.attributes.frontend.identification_option'))->for('license_detail') }}
                            @php
                                $explode_identification_option=explode(',',$agency_option->identification_option);
                                $explode_local_operator=explode(',',$agency_option->local_operator);
                                $explode_tourist_facility=explode(',',$agency_option->tourist_facility);
                            @endphp
                        @foreach($explode_identification_option as $option)
                           
                                <div class="input-sec">
                                <input type="hidden" name="identification_option[]" value="{{$option}}">{{$option}}
                                </div>
                        @endforeach
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col">
                            <div class="form-group senti-list">
                                {{ html()->label(__('validation.attributes.frontend.local_operator'))->for('local_operator') }}
                               @foreach($explode_local_operator as $operator)
                                <div class="input-sec">
                                <input type="checkbox" name="local_operator[]" value="{{$operator}}" >{{$operator}}
                                </div>
                                @endforeach
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                
                    <input type="hidden" name="profile_id" value="{{$user_id}}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group senti-list">
                                {{ html()->label(__('validation.attributes.frontend.tourist_facility'))->for('tourist_facility') }}
                                @foreach($explode_tourist_facility as $tourist_facility)
                                <div class="input-sec">
                                <input type="checkbox" name="tourist_facility[]" value="{{$tourist_facility}}">{{$tourist_facility}}
                                </div>
                                @endforeach
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                    <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('labels.general.buttons.request'))->class('more_btn') }}
                                </div><!--form-group-->
                            </div><!--col-->
                    </div><!--row-->
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif