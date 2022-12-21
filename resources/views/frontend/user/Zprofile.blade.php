@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div class="inner-banner">
	@if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )
        <div class="cover-img" style="background-image: url('{{ asset('img/frontend/user/cover/'.$userdata->cover_image)}}'); width: 100%;"></div>
    @else
        <img src="{{url('img/frontend/inner-banner.jpg')}}">
    @endif

    @if(!empty($userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$userdata->profile_image)) )
        <img src="{{url('img/frontend/user/profile/'.$userdata->profile_image)}}" class="profile-img-box img-responsive" height="200" width="200">
    @else
        <img class="profile-img-box" src="{{url('img/frontend/profile_user.jpg')}}">
    @endif
    <h3 style="text-align: center;">
      @if($userdata){{isset($userdata->user->first_name)?$userdata->user->first_name:''}} {{isset($userdata->user->last_name)?$userdata->user->last_name:''}}@endif 
      
    </h3>
    <h6 style="text-align: center; font-style: italic;">
        @if($role_type =='traveler')
            <i class="fas fa-map-marker-alt" style="color: #0dcb40;"></i>&nbsp;Traveler
        @elseif($role_type =='travel_maker')
            <i class="fas fa-map-marker-alt" style="color: #0654ff;"></i>&nbsp;Travel Maker
        @elseif($role_type =='travel_blogger')
            <i class="fas fa-map-marker-alt" style="color: #9b4dd4;"></i>&nbsp;Travel Blogger
        @elseif($role_type =='travel_agency')
            <i class="fas fa-map-marker-alt" style="color: #04fbec;"></i>&nbsp;Travel Pro
        @endif
    </h6>
</div>    

<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Travel Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               
            </div>
         <form method="post" action="{{Route('frontend.user.same_trip_data')}}">
            @csrf
            <div class="modal-body" id="reportsame">
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
    </div>
</div>

<!-- <div id="element" class="btn btn-default show-modal">show modal</div>
<div class="btn btn-default key-disable">show  modal whith keyboard disabled</div> --> 
</div>
</div>
</div>

@if(!empty($userdata->cover_image))
<meta property="og:image" content="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}"/>
<meta property="og:image:secure_url" content="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" />
@else
<meta property="og:image" content="{{url('img/frontend/inner-banner.jpg')}}"/>
<meta property="og:image:secure_url" content="{{url('img/frontend/inner-banner.jpg')}}" />
@endif
<meta property="og:title" content="title" />
<meta property="og:description" content="description" />
<meta property="og:url" content="http://localhost/travelmaker/public/profile/6" />
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="Page Title">
<meta name="twitter:description" content="Page description less than 200 characters">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="http://www.example.com/image.jpg"> 
</div>

<div class="share_links">
    Share&nbsp;
    <a href="javascript:void(0)" class="facebook-share"><i class="fab fa-facebook"></i></a>&nbsp;
    <a href="javascript:void(0)" class="twitter-share"><i class="fab fa-twitter"></i></a>
</div>

@if($role_type =='traveler')
    @include('frontend.traveler.profile.view')
@elseif($role_type =='travel_maker')
    @include('frontend.traveler.profile.view')
@elseif($role_type =='travel_blogger')
    @include('frontend.traveler.profile.view')
@elseif($role_type =='travel_agency')
    @include('frontend.traveler.profile.view')
@endif

</div>
<!--Creates the popup body-->


@php
  if(!empty(Auth::user())){
      
       $auth=Auth::user()->id;
   }else{
    
     $auth='0';
   }
@endphp
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function follow_user(obj)
{
    $.ajaxSetup({
       	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  	});
    var id = $(obj).data('id');
    
    var status = $(obj).data('value');
   
    var follow='<?php echo $followcount; ?>';
  
    $.ajax({
       	type:'POST',
       	url:'{{ url('/follow') }}',
       	data:{user_id:id, follow_status:status},
       	success:function(data){
         
       	var html = '';
           	if(data.follow_status == 0){

              var html = '<div class="follow-div"><img class="followimg" height="35px" src="{{url('/img/frontend/follower.png')}}"><div class="repo_btn1"><button class="follow" data-id="'+id+'" data-value="'+data.follow_status+'" onClick="follow_user(this)" > '+data.followcount+' <a href="javascript:void(0)"> UnFollow</a> </button></div></div>';
           		$(".follow-div").html(html);
           		
         	}
         	else
         	{
         	var html = '<div class="follow-div"><img class="followimg" height="35px" src="{{url('/img/frontend/follower.png')}}"><div class="repo_btn1"><button class="follow" data-id="'+id+'" data-value="'+data.follow_status+'" onClick="follow_user(this)" > '+data.followcount+' <a href="javascript:void(0)"> Follow</a> </button></div></div>';
           		$(".follow-div").html(html);
          	}
       }      
    });
}

setTimeout(function(){
  var st = sessionStorage.getItem("sameTrip");
  if(st){
    sessionStorage.setItem("sameTrip",'');
    $('#'+st).addClass('status1');
    window.location.reload();
  }

  $(".travel_action").click(function() { 
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
    var user_id = '<?php echo $auth; ?>';
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
 },500);


function same_trip_delete(obj) {
  var id = $(obj).data('id');

  var user_id = '<?php echo $auth; ?>';
 
  $.ajaxSetup({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     });
  $.ajax({
    type:'post',
    url:'{{ url('delete/same_trip') }}',
    data:{userid:user_id,report_id:id},
    success:function(response){
      if(response==1){
          location.reload();
      }
    }
  });
}

function same_report(obj) {

  var id = $(obj).data('id');
  var user_id = '<?php echo $auth; ?>';

  $.ajaxSetup({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     });
  $.ajax({
        type:'get',
        url:'{{ url('/same_trip_report') }}',
        data:{userid:user_id},
        success:function(response){
        var result = jQuery.parseJSON(response);
         if(response==0){

            $("#testmodal").modal('show');
                $("#reportsame").empty();
                var html = '';
                var html = '<p style="text-align:center"><b>No Data</b></p>';
                 $("#reportsame").html(html);
                 $('.selected').css({"background": "#005ca9","color": "#fff"}); 
                 
             }else{
                 
                $("#testmodal").modal('show');
                $("#reportsame").empty();
                var html = '';
                var html = '<input type="hidden" name="report_id" value="'+id+'"><input type="hidden" name="user_id" value="'+user_id+'">';
               
                $.each(result, function( index, value ) {
                    html += '<input type="radio" value="'+value.id+'" name="same_trip_id"  > '+value.title+'<br/>'
                });
              
                $("#reportsame").html(html);
                $('.selected').css({"background": "#fff","color": "#005ca9"}); 
             }
          },
    });
 }

// $(function() {
//   var tech = getUrlParameter('profile');
//   alert('ghhhf');
// });
</script>
@endsection
