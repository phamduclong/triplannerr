@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<style>
  header.driver-header {
    position: relative;
  }
</style>

@if(!Auth::check())
<div class="right-menu" style="display: block;">
    <a href="{{ url('/main-login') }}">
      <button class="btn btn-primary">Login</button>
    </a>
</div>
@endif

<div class="inner-banner notranslate" id="innerBanner">
    <div id="IMAGECOVER" style="margin-top: -70px">
      @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/'.$userdata->cover_image)) )
          <div class="cover-img" style="background-image: url('{{ asset('img/frontend/user/'.$userdata->cover_image)}}'); width: 100%;" style="z-index: -1"></div>
      @else
          <img src="{{url('img/frontend/inner-banner.jpg')}}" style="height: 400px;z-index: -1">
      @endif
      @if(Auth::check() && Auth::user()->id == $user_id)
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2 camera-cover" style="margin-top: -40px;margin-left:-10px">
            <i id="buttonCoverImage" class="fas fa-camera icon-camera-cover" style="font-size: 2.25em;display:none"></i>
          </div>
        </div>
      @endif
    </div>
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6">
        <div class="spinner-border text-primary" role="status" style="display:none" id="loadingImage">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-10"></div>
      <div class="col-md-2">
        <form action="{{ route('frontend.updateCoverImage') }}" method="POST" enctype="multipart/form-data" style="margin-top:-50px;margin-left:-22px">
          @csrf
          {{-- <button class="btn btn-primary" id="buttonCoverImage">Edit Cover Image</button>
          <input id="inputCoverImage" type="file" name="cover_image" accept="image/*" hidden>
          <input id="submitCoverImage" type="submit" value="Submit" hidden> --}}
          <input class="form-control to_crop"
              type="file" 
              name="cover_image" 
              id="cover" 
              accept="image/*" 
              data-id="cover_image_id" 
              data-height="400"
              data-width="1380"
              data-container="cover_image_container" 
              data-dimension="cover"
              hidden
          >
          <input type="hidden" name="cover_image_name" id="cover_image_id" >
          <input id="submitCoverImage" type="submit" value="Submit" hidden>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5"></div>
      <div class="col-md-7" id="WRAPIMAGEPROFILE">
        <div id="IMAGEPROFILE" style="width: 30%">
          @if(!empty($userdata->profile_image) && file_exists(public_path('img/frontend/user/'.$userdata->profile_image)) )
              <img src="{{url('img/frontend/user/'.$userdata->profile_image)}}" class="profile-img-box img-responsive" height="200" width="200">
          @else
              <img class="profile-img-box" src="{{url('img/frontend/profile_user.png')}}">
          @endif
          @if(Auth::check() && Auth::user()->id == $user_id)
            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6 camera-profile" style="margin-top: -50px">
                <i id="buttonProfileImage" class="fas fa-camera icon-camera-profile" style="font-size: 1.5em;margin-left:20px;display:none"></i>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6">
        <form action="{{ route('frontend.updateProfileImage') }}" method="POST" enctype="multipart/form-data" style="margin-top: -50px; margin-left:30px">
          @csrf
          {{-- <button class="btn btn-primary" id="buttonProfileImage">Edit Profile Image</button>
          <input id="inputProfileImage" type="file" name="profile_image" accept="image/*" hidden>
          <input id="submitProfileImage" type="submit" value="Submit" hidden> --}}
          {{-- <button class="btn btn-primary" id="buttonProfileImage">Edit Profile Image</button> --}}
          <input class="form-control to_crop"
              type="file" 
              name="profile_image" 
              id="profile" 
              accept="image/*" 
              data-id="profile_image_id" 
              data-height="200"
              data-width="200"
              data-container="profile_image_container" 
              data-dimension="profile"
              hidden
          >
          <input type="hidden" name="profile_image_name" id="profile_image_id" >
          <input id="submitProfileImage" type="submit" value="Submit" hidden>
        </form>
      </div>
    </div>
    <div id="title" style="display: none;margin-left:40px">
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
</div>

<div id="testmodal" class="modal fade notranslate">
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

<!-- <div class="share_links">
    Share&nbsp;
    <a href="javascript:void(0)" class="facebook-share"><i class="fab fa-facebook"></i></a>&nbsp;
    <a href="javascript:void(0)" class="twitter-share"><i class="fab fa-twitter"></i></a>
</div> -->
<div id="detail" style="display: none">
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
</div>
<!--Creates the popup body-->
<div id="uploadimageModal" class="modal notranslate" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Crop Image</h4>
              <button id="xClose" type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12 text-center">
                      <div id="image_demo"></div>
                      <input type="hidden" data-id="" id="preview-container-id" />
                      <input type="hidden" data-id="" id="image_container" />
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button class="btn btn-success crop_image" type="button">Crop</button>
              <button id="closeModalCrop" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

@php
  if(!empty(Auth::user())){

       $auth=Auth::user()->id;
   }else{

     $auth='0';
   }
@endphp
@push('after-styles')
  {!! script('js/frontend/jquery.min.js') !!}
  <link rel="stylesheet" href="{{ url('css/croppie.css')}}" />
  <style type="text/css">
      .modal-dialog {
          max-width: 80%;
          margin: 1.75rem auto;
      }
      .modal-body{overflow: scroll;}
  </style>
@endpush
<script src="{{ url('js/croppie.js')}}"></script>
{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> --}}
<script type="text/javascript">

$(document).ready(function(){
  $('#IMAGECOVER').hover(function(){
    $('#buttonCoverImage').show();
  },function(){
    $('#buttonCoverImage').hide();
  });

  $('#IMAGEPROFILE').hover(function(){
    $('#buttonProfileImage').show();
  },function(){
    $('#buttonProfileImage').hide();
  });
});

setTimeout(function(){
  $('#title').show();
  $('#detail').show();
}, 100);
//crop image
$(document).ready(function(){
  $('#buttonCoverImage').click(function(event){
    event.preventDefault();
    $('#cover').click();
  });
  // $('#inputCoverImage').change(function(){
  //   $('#submitCoverImage').click();
  //   $('#loadingImage').show();
  //   $('#innerBanner').css('opacity', '0.5');
  // });
  $('#buttonProfileImage').click(function(event){
    event.preventDefault();
    $('#profile').click();
  });
  // $('#inputProfileImage').change(function(){
  //   $('#submitProfileImage').click();
  //   $('#loadingImage').show();
  //   $('#innerBanner').css('opacity', '0.5');
  // });
  $('#xClose').click(function(){
    $('#cover').val('');
    $('#profile').val('');
    $('#cover_image_id').val('');
    $('#profile_image_id').val('');
  });
  $('#closeModalCrop').click(function(){
    $('#cover').val('');
    $('#profile').val('');
    $('#cover_image_id').val('');
    $('#profile_image_id').val('');
  });

  $('.to_crop').on('change', function(){
    inputId = $(this).attr('id');
    $that = this;
    var isErr = true;
    $("#image_demo").html('');
    var desired_height = $(this).data('height');
    var desired_width = $(this).data('width');
    var dimensions = $(this).data('dimension');
    var container_id = $(this).data('id');
    var image_container = $(this).data('container');
    var _URL = window.URL || window.webkitURL;
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
        if (desired_width <= this.width && desired_height <= this.height) {
            isErr = false;
            $('#'+inputId).removeClass('error');
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:desired_width,
                    height:desired_height,
                    type:'square' 
                },
                boundary:{
                    width:(desired_width+50),
                    height:(desired_height + 50)
                }
            });
            
        } else {
            $('#'+inputId).addClass('error');
            if (confirm("Image resolution should be minimum" + desired_width + "x" + desired_height) == true) {
              $('#cover').val('');
              $('#profile').val('');
              $('#cover_image_id').val('');
              $('#profile_image_id').val('');
            } else {
              $('#cover').val('');
              $('#profile').val('');
              $('#cover_image_id').val('');
              $('#profile_image_id').val('');
            }
            return;
        }
    };
    img.src = _URL.createObjectURL(file);
}

setTimeout(function(){
    if(typeof $image_crop !== 'string' && isErr === false){
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
        }

        reader.readAsDataURL($that.files[0]);
        $("#preview-container-id").val(container_id);
        $("#image_container").val(image_container);
        $('#uploadimageModal').modal('show');
    }
},300);
});

$('.crop_image').click(function(event){
    $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function(response){
        $.ajax({
            url:"{{ route('frontend.crop_image') }}",
            type: "POST",
            data:{"image": response, '_token': '{{ csrf_token() }}'},
            success:function(data)
            {
                var response = JSON.parse(data); 
                console.log(response);
                if(response.status == 200){
                    $("#"+$("#preview-container-id").val()).val(response.image);
                    $('#uploadimageModal').modal('hide');
                    $('#'+$("#image_container").val()).attr('src', response.image_url);

                    if(inputId == 'cover'){
                      $('#submitCoverImage').click();
                    }else{
                      $('#submitProfileImage').click();
                    }
                    $('#WRAPIMAGEPROFILE').css('zIndex', '-1');
                    $('#loadingImage').show();
                    $('#innerBanner').css('opacity', '0.5');
                }
            }
        });
    });
});
});
//end crop image
// $(document).ready(function(){
//   $('#buttonCoverImage').click(function(event){
//     event.preventDefault();
//     $('#inputCoverImage').click();
//   });
//   $('#inputCoverImage').change(function(){
//     $('#submitCoverImage').click();
//     $('#loadingImage').show();
//     $('#innerBanner').css('opacity', '0.5');
//   });
//   $('#buttonProfileImage').click(function(event){
//     event.preventDefault();
//     $('#inputProfileImage').click();
//   });
//   $('#inputProfileImage').change(function(){
//     $('#submitProfileImage').click();
//     $('#loadingImage').show();
//     $('#innerBanner').css('opacity', '0.5');
//   });
// });
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

  // $(".travel_action").click(function() {
  $(document).on("click", '.travel_action', function(event) { 
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
