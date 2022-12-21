@extends('frontend.layouts.travelmaker')
@if(isset($pages->meta_title))
<meta name="title" content="{{ $pages->meta_title }}"/>
@endif
@if(isset($pages->meta_keywords))
<meta name="keywords" content="{{ $pages->meta_keywords }}"/>
@endif
@if(isset($pages->meta_description))
<meta name="description" content="{{ $pages->meta_description }}"/>
@endif
@section('title', app_name() . ' | ' . __('navs.general.home'))
@section('content')
<style>
.control-banner img {
    width: 100%;
    height: 560px;
}
</style>
<div class="inner-banner control-banner">
<!-- <img src="{{url('img/frontend/banner2.jpg')}}">   -->
@if(isset($pages->name))
<img src="{{url('img/frontend/2.jpg')}}">
@else
<img src="{{url('img/frontend/banner-img.png')}}">
@endif
</div>
<div class="account-section mx-50">
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col col-sm-10">
            <div class="card">
                <div class="card-body">
                    <div class="account-form">
                     <h4 style="color: #005ca9;margin-bottom: 20px;text-align: center;">{{isset($pages->name)?$pages->name:''}}</h4>
                          <div class="row">   
                            <div class="col-md-12">
                              <div class="about-content" style="padding: 20px;">
                                {!! isset($pages->description)?$pages->description:'' !!}
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
           </div>
       </div>
   </div>
 </div>
</div>
  @endsection