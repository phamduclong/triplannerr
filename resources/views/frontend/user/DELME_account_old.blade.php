@extends('frontend.layouts.travelmaker')

@section('content')

<div class="inner-banner">
          @if(!empty($user_data->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$user_data->cover_image)) )
           <img src="{{url('img/frontend/user/cover/'.$user_data->cover_image)}}" class="img-responsive" width="100" height="100">
           @else
            <img src="{{url('img/frontend/inner-banner.jpg')}}">
            @endif    
</div> 
<h1>hjgjhgjhghj</h1>
@endsection
