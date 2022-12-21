@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div class="inner-banner control-banner">
    @include('frontend.profile-banner')
            {{-- @if(!empty($report_img) && file_exists(public_path('img/frontend/travel_report/coverphoto/'.'/'.$report_img)) )
                <img src="{{url('img/frontend/travel_report/coverphoto/'.$report_img)}}" class="img-responsive">
            @else
            <img src="{{url('img/frontend/profile-banner.jpg')}}">
            @endif  --}}

      	<!-- <div class="container-fluid">
    	      <p class="banner-txt">"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
      	</div> -->

        {{-- <div class="badge-icon chagecss">
       	    @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
                <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive">
            @else
                <img src="{{url('img/frontend/user.png')}}">
            @endif
        </div> --}}
    </div>
    <div class="account-section mx-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-sm-12 align-self-center">
                <div class="card">
                <div class="account-form travelreport-form">
                <div class="card-body">
                 {{ html()->form('POST', route('frontend.send_content'))->attribute('enctype','multipart/form-data')->open() }}

                <div class="row">
                        <div class="col">
                            <div class="form-group senti-list">

                                {{ html()->label(__('validation.attributes.frontend.request_content'))->for('license_detail') }}

                                {{ html()->textarea('description')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->autofocus() }}

                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('labels.general.buttons.send'))->class('more_btn') }}
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

