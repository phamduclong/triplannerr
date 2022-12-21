@extends('frontend.layouts.travelmaker')
@section('title', app_name() . ' | ' . __('navs.general.home'))
@section('content')
@include('frontend.includes.travelmaker.home_slider')
@include('frontend.includes.home.search_form')
@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>

@endif
<div class="row" style="margin-top: 20px">
  <div class="col-md-5"></div>
    <div class="col-md-7">
      <a href="javascript:void(0)"><i id="shareFacebook" class="fa fa-facebook-square" style="font-size: 3em"></i></a>
      <a href="javascript:void(0)"><i id="shareTwitter" class="fa fa-twitter-square" style="font-size: 3em;color:#00BFFF"></i></a>
      <a href="javascript:void(0)"><i id="shareLinkedin" class="fa fa-linkedin-square" style="font-size: 3em;color:#1E90FF"></i></a>
      <a href="javascript:void(0)"><i id="shareTelegram" class="fa fa-telegram" aria-hidden="true" style="font-size: 3em;color:#1E90FF"></i></a>
      <a href="javascript:void(0)" data-action="share/whatsapp/share"><i id="shareWhatsapp" class="fa fa-whatsapp" aria-hidden="true" style="font-size: 3em;color:green"></i></a>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<section class="main-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="tab-content">
          <div id="home" class="tab-pane active"><br>
            <div class="row" id="more-travel-reports">
              @forelse($travel_reports as $key=>$super_row)
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="travel_site">
                    <div class="travel_over">
                      <b style="color: #005ca9;"><center>{{ $super_row->title}}</center></b>
                      @if(!empty($super_row->cover_photo) && file_exists(public_path('img/frontend/travel_report/coverphoto'.'/'.$super_row->cover_photo)) )
                        <img src="{{url('img/frontend/travel_report/coverphoto/'.$super_row->cover_photo)}}">
                      @else
                        <img src="{{url('img/frontend/alert1.jpg')}}">
                      @endif

                      <div class="overlay">
                        <div class="middle">
                          <!-- @php
                          echo $role=getrole_data($super_row->user_id);
                          @endphp -->

                          @if(!empty($role) && file_exists(public_path('img/backend/traveler_image'.'/'.$role)) )
                            <img src="{{url('img/backend/traveler_image/'.$role)}}">
                          @else
                            <img src="{{url('img/frontend/f-logo.png')}}">
                          @endif

                          {{-- @if($super_row->report_option=='report')
                             <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                              <img class="report-img" src="{{url('img/frontend/globe.png')}}">Travel Report
                            </a>
                          @elseif($super_row->report_option=='offer')
                            <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                              <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Proposal
                            </a>
                          @endif --}}
                          @if($super_row->report_option=='report' && $super_row->role_type == 'travel_maker')
                             <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                              <img class="report-img" src="{{url('img/frontend/globe.png')}}">Travel Report
                            </a>
                          @elseif($super_row->report_option=='offer' && $super_row->role_type == 'travel_maker')
                            <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                              <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Buddy Search
                            </a>
                          @elseif($super_row->role_type == 'traveler')
                            <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                              <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Report
                            </a>
                          @elseif($super_row->role_type == 'travel_agency')
                            <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                              <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Offert
                            </a>
                          @elseif($super_row->role_type == 'travel_blogger')
                            <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                              <img class="report-img" src="{{url('img/frontend/all_my_travel_reports_button.png')}}">Travel Post
                            </a>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="travel_btn">
                      <!-- <a href="javascript:void(0)" class="travel_action status1" data-value="super" data-id="4">Super {{ $super_row->supers_count }}</a> -->

                      @if(!empty(Auth::user()))
                          @php
                          $super=check_super_from_user($super_row->id, Auth::user()->id);
                          @endphp
                          @if($super=='1')
                              <a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$super_row->id}}" data-count="{{$super_row->supers_count}}" data-text="Like">Like {{$super_row->supers_count}}</a>
                          @else
                            <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="super" data-id="{{$super_row->id}}" data-text="Like" data-count="{{$super_row->supers_count}}">Like {{$super_row->supers_count}}</a>
                          @endif
                      @else
                          <a href="{{url('/main-login')}}">Like {{$super_row->supers_count}}</a>
                      @endif

                      <!-- <a href="javascript:void(0)" class="travel_action1 status1" data-value="alert" data-id="4">Alert {{ $super_row->alerts_count }}</a> -->
                      @if(!empty(Auth::user()))
                          @php
                          $alert=check_alert_from_user($super_row->id, Auth::user()->id);
                          @endphp
                          @if($alert=='1')
                            <a href="javascript:void(0);" class="travel_action1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$super_row->id}}"  data-text="Alert" data-count="{{$super_row->alerts_count}}">Alert {{$super_row->alerts_count}}</a>
                          @else
                            <a href="javascript:void(0);" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="alert" data-id="{{$super_row->id}}" data-text="Alert" data-count="{{$super_row->alerts_count}}">Alert {{$super_row->alerts_count}}</a>
                          @endif
                      @else
                          <a href="{{url('/main-login')}}">Alert {{$super_row->alerts_count}}</a>
                      @endif

                       @if(!empty(Auth::user()))
                         @php
                             $same_trip_page=check_sametrip_page_from_user($super_row->id,Auth::user()->id);
                         @endphp
                         @if($same_trip_page=='1')
                          <a href="javascript:void(0)" class="travel_action1 status1 disabled @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip page" id = "sametrip-{{$super_row->id}}" data-id="{{$super_row->id}}">Same Trip Page</a>
                         @else
                          <a href="javascript:void(0)" class="travel_action1 status0 @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip page"  id = "sametrip-{{$super_row->id}}" data-id="{{$super_row->id}}">Same Trip Page</a>
                         @endif
                      @else
                        <a href="{{url('/main-login')}}">Same Trip Page</a>
                      @endif

                      @if(!empty(Auth::user()))
                           @php
                             $same_trip=check_sametrip_from_user($super_row->id, Auth::user()->id);
                           @endphp
                           @if($same_trip=='1')
                              <a href="javascript:void(0);" class="sametrip1 status1 @if($userdata)@if($userdata->user_id==Auth::user()->id) @endif @endif" data-value="same trip" data-id="{{$super_row->id}}"onClick="same_trip_delete(this)" data-text="same trip">Same Trip</a>
                           @else
                             <a href="javascript:void(0);" id="element" class="sametrip1 status0 checktrip @if($userdata)@if($userdata->user_id==Auth::user()->id)  @endif @endif" data-value="same trip" data-id="{{$super_row->id}}" onClick="same_report(this)" data-text="same trip">Same Trip</a>
                          @endif
                        @else
                        <a href="{{url('/main-login')}}">Same Trip</a>
                      @endif
                    </div>
                    <div class="site_text">
                      <h4>
                        @if($super_row->report_option=='report')
                          <a href="{{url('view/travel_report/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                            {{ substr($super_row->title, 0, 50) }}
                          </a>
                        {{-- @elseif($super_row->report_option=='diary')
                          <a href="{{url('view/travel_report_dairy/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                            {{ substr($super_row->title, 0, 50) }}
                          </a> --}}
                        @elseif($super_row->report_option=='offer')
                          <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                            {{ substr($super_row->title, 0, 50) }}
                          </a>
                        @endif
                      </h4>
                      <p>
                        {!! substr($super_row->description, 0, 100)  !!}
                      </p>
                      <span>
                        {{ displayDate($super_row->report_startdate) }}
                      </span>
                    </div>

                    <hr>
                    <div class="site_bottom">
                      <h4>{{ getCurrencySymbol($super_row->currency_id) }} {{ $super_row->travel_cost }}</h4>

                      @if($super_row->report_option=='report')
                        <a href="{{url('view/travel_report/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                          <img src="{{url('img/frontend/arrow-right.png')}}">
                        </a>
                      {{-- @elseif($super_row->report_option=='diary')
                        <a href="{{url('view/travel_report_dairy/'.encrypt_decrypt('encrypt', $super_row->id))}}" class="text">
                          <img src="{{url('img/frontend/arrow-right.png')}}">
                        </a> --}}
                      @elseif($super_row->report_option=='offer')
                        <a href="{{url('view/travel_report', convertoToSlug($super_row->title))}}" class="text">
                          <img src="{{url('img/frontend/arrow-right.png')}}">
                        </a>
                      @endif

                    </div>
                  </div>
                </div>
              @empty
                <h3>No report found</h3>
              @endforelse
              <div id="load-data"></div>
            </div>
            <div id="remove-row">
               <button class="btn more_btn filter_report_btn_more" id="more_btn" data-id="{{-- $super_row->id --}}">
                <span id="textMoreReport">More Reports</span>
                <div class="spinner-border text-light" role="status" style="display:none" id="loadingReport">
                  <span class="sr-only">Loading...</span>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
      @if(Auth::user()->role_type=="travel_agency")
      <div class="col-md-3">
        @php
          $ip= Request::ip();
        @endphp
        <div class="ads_section1 view-travel-box">
          @if(!empty($ads_data1))
            @foreach($ads_data1 as $ads)
              @if($ads->type=="image")
               <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
               <h6>{{$ads->title}}</h6>
               <img src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
               <p>{{$ads->description}}</p>
              @endif

              @if($ads->type=='video')
                  @if(!empty($ads->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$ads->type_file)) )
                   <h6>{{$ads->title}}</h6>
                    <video controls>
                      <source src="{{url('img/backend/advertisement/'.$ads->type_file)}}" type="video/mp4">
                    </video>
                    <p>{{$ads->description}}</p>
                     @else
                     <h6>{{$ads->title}}</h6>
                    <iframe src="{{isset($ads->embedded_link)?$ads->embedded_link:''}}">
                    </iframe>
                    <p>{{$ads->description}}</p>
                  @endif
              @endif
            @endforeach
          @endif
        </div>

      </div>
      @else
      <div class="col-md-3">
        @php
          $ip= Request::ip();
        @endphp
        <div class="ads_section1 view-travel-box">
          @if(!empty($ads_data1))
            @foreach($ads_data1 as $ads)
              @if($ads->type=="image")
               <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
               <h6>{{$ads->title}}</h6>
               <img src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
               <p>{{$ads->description}}</p>
              @endif

              @if($ads->type=='video')
                  @if(!empty($ads->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$ads->type_file)) )
                   <h6>{{$ads->title}}</h6>
                    <video controls>
                      <source src="{{url('img/backend/advertisement/'.$ads->type_file)}}" type="video/mp4">
                    </video>
                    <p>{{$ads->description}}</p>
                     @else
                     <h6>{{$ads->title}}</h6>
                    <iframe src="{{isset($ads->embedded_link)?$ads->embedded_link:''}}">
                    </iframe>
                    <p>{{$ads->description}}</p>
                  @endif
              @endif
            @endforeach
          @endif
        </div>

      </div>
      @endif
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          @if(count($ads_data_bottom)>0)
            @foreach($ads_data_bottom as $ads)
            <div class="col-lg-4 col-md-6 col-sm-6">
              @if($ads->type=="image")
               <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
               <h6>{{$ads->title}}</h6>
               <img style="max-width: 100%; min-height: 190px; height:auto;" src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
               <p>{{$ads->description}}</p>
              @endif

              @if($ads->type=='video')
                  @if(!empty($ads->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$ads->type_file)) )
                   <h6>{{$ads->title}}</h6>
                    <video controls>
                      <source src="{{url('img/backend/advertisement/'.$ads->type_file)}}" type="video/mp4">
                    </video>
                    <p>{{$ads->description}}</p>
                     @else
                     <h6>{{$ads->title}}</h6>
                    <iframe src="{{isset($ads->embedded_link)?$ads->embedded_link:''}}">
                    </iframe>
                    <p>{{$ads->description}}</p>
                  @endif
              @endif
            </div>
            @endforeach
          @endif
        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>
  </div>
</section>

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

@endsection
@php
  if(!empty(Auth::user())){

       $auth=Auth::user()->id;
   }else{

     $auth='0';
   }
@endphp
@push('after-styles')
<style>
  .ads_section1.view-travel-box p {
    font-size: 13px;
    background: #F1F1F1;
    line-height: 22px;
    padding: 10px;
    box-shadow: 0px 2px 5px #aaa;
    margin-top: -2px;
    background: #fff;
    box-shadow: none;
    margin: 0;
}

  #loader {
    width: 100%;
    height: 100%;
    top: 200;
    left: 20;
    position: fixed;
    display: block;
    opacity: 0.7;
    background-color: #fff;
    z-index: 99;
    text-align: center;
  }
  .nav__menu a {
    color: #FFF;
  }

  .ads_section1 a img {
    margin-bottom: 30px;
    max-width: 100%;
    min-height: 190px;
    margin-bottom: 0px !important;
    /* display: none; */
  }

  .travel_action1.status1{
    background: #005ca9;
    color: #fff;
  }

  .sametrip1.status1 {
    background: #005ca9;
    color: #fff;
}

.disabled {
    pointer-events: none;
}

.ads_section1 iframe {
    max-width: 100%;
    min-height: 190px;
}

.ads_section1 video {
    max-width: 100%;
    height: 190px;
    background: #000;
}

.view-travel-box h6 {
    display: inline-block;
    width: 100%;
    padding: 6px 0;
    margin: 0;
}

.ads_section1 {
    display: inline-block;
    width: 100%;
    text-align: center;
    /*border: solid 1px #ddd;*/
    min-height: 320px;
}

</style>
<script type="text/javascript">
  //handle share social
  setTimeout(function(){
      var title = 'Triplannerr';
      $('#shareFacebook').click(function(){
        var shareUrl = window.location.href;
        // link = 'https://www.facebook.com/sharer/sharer.php?u='+shareUrl+'&t=Share';
        link = 'https://www.facebook.com/sharer/sharer.php?u='+shareUrl;
        window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
      });
      $('#shareTwitter').click(function(){
        var shareUrl = window.location.href;
        // link = 'http://twitter.com/share?url='+shareUrl+'&text='+title;
        link = 'http://twitter.com/share?url='+shareUrl;
        window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
      });
      $('#shareLinkedin').click(function(){
        var shareUrl = window.location.href;
        link = 'https://www.linkedin.com/shareArticle?mini=true&url='+shareUrl;
        window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
      });
      $('#shareTelegram').click(function(){
        var shareUrl = window.location.href;
        // link = 'https://telegram.me/share/url?url='+shareUrl+'&text='+title;
        link = 'https://telegram.me/share/url?url='+shareUrl;
        window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
      });
      $('#shareWhatsapp').click(function(){
        var shareUrl = window.location.href;
        link = 'https://api.whatsapp.com/send?text='+shareUrl;
        // link = 'https://api.whatsapp.com/send?url='+shareUrl;
        window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
      });
    }, 500);
  //end handle share social
  function ad_click(obj) {
    var id = $(obj).data('id');
    var ip = '<?php echo $ip; ?>';
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'post',
      url:'{{ url('/ads/save') }}',
      data:{userip:ip,ad_id:id},
      success:function(response){

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

  $(document).on("click", '.travel_action1', function(event) { 
  // $(".travel_action1").click(function() {
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
              //  if(value == "alert"){
              //   $.get('{{url('/configcontact1')}}');
              //  }
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
</script>


@endpush
