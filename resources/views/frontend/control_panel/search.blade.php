@extends('frontend.layouts.travelmaker')
@section('title', app_name() . ' | ' . __('navs.general.home'))
@section('content')
<style>
  .search_table a{
    color:#fff !important;
  }
</style>
<div class="inner-banner control-banner">wwww
    {{--  @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )
        <img src="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" class="img-responsive">
    @else
        <img src="{{url('img/frontend/profile-banner.jpg')}}">
    @endif --}}
    @php
        print_r($userdata);
    @endphp
    @include('frontend.profile-banner')
    {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}">
    <div class="container-fluid">
        <p class="banner-txt">"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
    </div>
    <div class="badge-icon">
        @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
            <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive">
        @else
            <img src="{{url('img/frontend/user.png')}}">
        @endif
    </div> --}}
</div>
<div class="control-table mx-50">
  <div class="container-fluid">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
      <thead>
      <tr>
        <!-- <th rowspan="1"><img class="active-btn" src="img/frontend/active-btn.png">Show all my Travel Reports</th> -->
        <td colspan="12"><div class="booking_section">
          <form id="booking_form" class="booking_form" method="get" action="{{ Request::url() }}">
            @csrf
            <div class="nav">
              <ul class="nav__list">
                <li class="nav__menu search_table">
                  <a id="country_a" href="javascript:void(0)" >Country</a>
                  {{ Form::select('country', ['' => 'Country']+$country_arr, $parameters['country'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'country', 'onChange' =>'load_data(this)']) }}
                  <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                      @forelse($country_arr  as $key => $value)
                      <li class="nav__menu-items " data-id="{{ $key }}" data-email="country_a" data-select="country">
                          {{ $value }}
                      </li>
                      @empty

                      @endforelse
                  </ul>
                </li>

                <li class="nav__menu search_table">
                    <a id="age_a" href="javascript:void(0)" ><?php echo (isset($parameters['age']) && !empty($parameters['age'])) ? $travel_ages[$parameters['age']] : 'Age' ?></a>
                    {{Form::select('age', ['' => 'Age']+$travel_ages, $parameters['age'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'age', 'onChange' =>'load_data(this)']) }}
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_ages  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="age_a" data-select="age">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <!-- <li class="nav__menu search_table">
                    <a id="age_a" href="javascript:void(0)" >Age</a>
                    <ul class="nav__menu-lists nav__menu--1-lists">
                        <li class="nav__menu-items">
                          {{ Form::select('age', ['' => 'Select age']+$travel_ages, $parameters['age'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'age', 'onChange' =>'load_data(this)']) }}
                        </li>
                    </ul>
                </li>
 -->
                <li class="nav__menu search_table">
                    <a id="travel_categ_a" href="javascript:void(0)" ><?php echo (isset($travel_categ[$parameters['travel_categ']]) && !empty($travel_categ[$parameters['travel_categ']])) ? $travel_categ[$parameters['travel_categ']] : 'Travel Category' ?></a>
                    {{ Form::select('travel_categ', ['' => 'Travel Category']+$travel_categ, $parameters['travel_categ'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'travel_categ', 'onChange' =>'load_data(this)']) }}
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_categ  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="travel_categ_a" data-select="travel_categ">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <li class="nav__menu search_table">
                    <a id="travel_type_a" href="javascript:void(0)" ><?php echo (isset($travel_types[$parameters['travel_type']]) && !empty($travel_types[$parameters['travel_type']])) ? $travel_types[$parameters['travel_type']] : 'Travel Type' ?></a>
                    {{ Form::select('travel_type', ['' => 'Travel Type']+$travel_types, $parameters['travel_type'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'travel_type', 'onChange' =>'load_data(this)']) }}
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_types  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="travel_type_a" data-select="travel_type">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <li class="nav__menu search_table">
                    <a id="vector_type_a" href="javascript:void(0)" ><?php echo (isset($parameters['vector_type']) && !empty($parameters['vector_type'])) ? $travel_vectors[$parameters['vector_type']] : 'Vector Type' ?></a>
                    {{ Form::select('vector_type', ['' => 'Vector Type']+$travel_vectors, $parameters['vector_type'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'vector_type', 'onChange' =>'load_data(this)']) }}
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_vectors  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="vector_type_a" data-select="vector_type">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <li class="nav__menu search_table">
                <a id="type_of_accommodation_a" href="javascript:void(0)" ><?php echo (isset($parameters['type_of_accommodation']) && !empty($parameters['type_of_accommodation'])) ? $travel_accommodations[$parameters['type_of_accommodation']] : 'Type of Accomodation' ?></a>
                    {{ Form::select('type_of_accommodation', ['' => 'Type of Accomodation']+$travel_accommodations, $parameters['travel_accommodations'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'type_of_accommodation', 'onChange' =>'load_data(this)']) }}
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_accommodations  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="type_of_accommodation_a" data-select="type_of_accommodation">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <li class="nav__menu search_table">
                 <a id="type_of_participants_a" href="javascript:void(0)" ><?php echo (isset($parameters['type_of_participants']) && !empty($parameters['type_of_participants'])) ? $travel_participates[$parameters['type_of_participants']] : 'Type of Partecipants' ?></a>
                    {{ Form::select('type_of_participants', ['' => 'Type of Partecipants']+$travel_participates, $parameters['travel_participates'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'type_of_participants', 'onChange' =>'load_data(this)']) }}
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_participates  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="type_of_participants_a" data-select="type_of_participants" style="font-size:10px">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <li class="nav__menu search_table">
                    <a id="preferred_type_formula_a" href="javascript:void(0)" ><?php echo (isset($parameters['preferred_type_formula']) && !empty($parameters['preferred_type_formula'])) ? $travel_formula[$parameters['preferred_type_formula']] : 'Preferred Stay Formula' ?></a>
                    <select id="preferred_type_formula" name="preferred_type_formula" onChange = 'load_data(this)' class="form-control tags box-size home-select">
                        <option value="">Preferred Stay Formula</option>
                        @if(@$travel_formula)
                            @foreach($travel_formula as $key_formula=>$pref_type_formula_row)
                                @if(isset($parameters['preferred_type_formula']) &&  $parameters['preferred_type_formula'] == $key_formula)
                                    <option value="{{$key_formula}}" selected="">
                                @else
                                    <option value="{{$key_formula}}">
                                @endif
                                    {{$pref_type_formula_row}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_formula  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="preferred_type_formula_a" data-select="preferred_type_formula">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <li class="nav__menu search_table">
                    <a id="preferred_travel_mealtype_a" href="javascript:void(0)" ><?php echo (isset($parameters['travel_favoritemealtype']) && !empty($parameters['travel_favoritemealtype'])) ? $travel_budget[$parameters['travel_favoritemealtype']] : 'Type of favorite Meals' ?></a>
                    <select id="preferred_travel_mealtype" name="preferred_travel_mealtype" onChange = 'load_data(this)' class="form-control tags box-size home-select">
                        <option value="">Select Type of favorite Meals</option>
                        @if(@$travel_mealtype)
                          @foreach($travel_mealtype as $key => $pref_travel_mealtype_row)
                              @if(isset($parameters['preferred_travel_mealtype']) && $parameters['preferred_travel_mealtype']  == $key)
                                  <option value="{{$key}}" selected="">
                              @else
                                  <option value="{{$key}}">
                              @endif
                              {{$pref_travel_mealtype_row}}
                              </option>
                          @endforeach
                        @endif
                    </select>
                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                        @forelse($travel_mealtype  as $key => $value)
                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="preferred_travel_mealtype_a" data-select="preferred_travel_mealtype">
                            {{ $value }}
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </li>

                <li class="nav__menu search_table">
                    <a id="preferred_travel_budget_a" href="javascript:void(0)" ><?php echo (isset($parameters['preferred_travel_budget']) && !empty($travel_budget[$parameters['preferred_travel_budget']])) ? $travel_budget[$parameters['preferred_travel_budget']] : 'Budget' ?></a>
                            <select id="preferred_travel_budget" name="preferred_travel_budget" onChange = 'load_data(this)' class="form-control tags box-size home-select">
                                <option value="">Select Budget</option>
                                @if(@$travel_budget)
                                  @foreach($travel_budget as $key => $pref_travel_budget_row)
                                      @if(isset($parameters['preferred_travel_budget']) && $parameters['preferred_travel_budget']  == $key)
                                          <option value="{{$key}}" selected="">
                                      @else
                                          <option value="{{$key}}">
                                      @endif
                                      {{$pref_travel_budget_row}}
                                      </option>
                                  @endforeach
                                @endif
                            </select>
                            <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                                @forelse($travel_budget  as $key => $value)
                                <li class="nav__menu-items" data-id="{{ $key }}" data-email="preferred_travel_budget_a" data-select="preferred_travel_budget">
                                    {{ $value }}
                                </li>
                                @empty

                                @endforelse
                            </ul>
                        </li>
                    </ul>
                </li>

              </ul>
            </div>

            <div class="row">
                <div class="form-group mx-auto">
                    <div class=" col-6 btn_srch form_srch" style="float:left;">
                        <button type="button" name="filter_report_btn" class="btn search_btn form_btn filter_report_btn" id="filter_report_btn">Search</button>
                    </div>
                    <div class=" col-6 btn_srch form_srch"  style="float:left;">
                        <button type="button" class="btn search_btn form_btn filter_report_btn" style="float:left;" id="reset_btn">Reset</button>
                    </div>
                </div>
            </div>
          </form>
        </td>
       </tr>

        <tr>
          <th>Ascending or descending order</th>
            <th>Super!</th>
            <th>Alert</th>
            <th>Same Trip</th>
            <th>Total Followers</th>
            <th>Numbers of Share on Travel Maker</th>
            <th>Numbers of Share on Facebook</th>
            <th>Numbers of Share on Instagram</th>
            <th>Numbers of Share on Twitter</th>
            <th>ADS</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody class="reportdata">
          @foreach($travel_reports as $travel_report)
            <tr>
                <td>
                    <a href="{{url('view/travel_report/'.encrypt_decrypt('encrypt', $travel_report->id))}}" style="color: #007bff;">
                        {{$travel_report->userdata->first_name}} {{$travel_report->userdata->last_name}}</a>
                     @if($travel_report->report_option == 'report')
                     <p>Travel Report with Travel Report</p>
                     @endif
                     {{-- @if($travel_report->report_option == 'diary')
                     <p>Travel Report with Travel Diaries</p>
                     @endif --}}
                     @if($travel_report->report_option == 'offer')
                     <p>Travel Report with Travel Proposal</p>
                     @endif
                </td>
                <td>{{$travel_report->supers_count}}</td>
                <td>{{$travel_report->alerts_count}}</td>
                <td>
                    {{get_sametrip($travel_report->id)}}
                    <a href="{{url('/same-trip',$travel_report->id)}}" style="color: #007bff;">Trip Page</a>
                </td>
                <td>{{ $followcount}}</td>
                <td>000</td>
                <td>000</td>
                <td>000</td>
                <td>000</td>
                <td>000</td>
                <td class="btn-td">@include('frontend.traveler.control_panel.action')</td>
            </tr>

          @endforeach

        </tbody>

        <tr>
        @php $count = count($request_receive) @endphp
            @if($count %2 == 0)
                @php $devider = (int)($count/2) @endphp
            @else
                @php $devider = (int)($count/2) + 1 @endphp
            @endif
            @foreach($request_send as $a => $value)

                @if($a == 0)
                  <td colspan="5">
                @endif
                @if($a < $devider )
                    <div class="media">
                        <div class="media-left">
                            <!-- <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px"> -->
                            @if(!empty($value->userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$value->userdata->profile_image)) )
                                <img src="{{url('img/frontend/user/profile/'.$value->userdata->profile_image)}}" class="media-object" style="width:30px">
                              @else
                              <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
                            @endif
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">{{$value->user->user_name}}</h6>
                            <p>{{$value->message}}</p>
                        </div>
                    </div>
                @else
                    <div class="media">
                        <div class="media-left">
                        @if(!empty($value->userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$value->userdata->profile_image)) )
                                <img src="{{url('img/frontend/user/profile/'.$value->userdata->profile_image)}}" class="media-object" style="width:30px">
                              @else
                              <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
                            @endif
                        </div>
                        <div class="media-body">
                        <h6 class="media-heading">{{$value->user->user_name}}</h6>
                            <p>{{$value->message}}</p>
                        </div>
                    </div>
                @endif

                @if($a == $devider -1)
                  </td>
                  <td colspan="5">
                @endif
                @if($a == $count-1)
                  </td>
                @endif

            @endforeach

        </tr>
        <tr>
            <td>Collaboration Received</td>
            @php $count = count($request_receive) @endphp
            @if($count %2 == 0)
                @php $devider = (int)($count/2) @endphp
            @else
                @php $devider = (int)($count/2) + 1 @endphp
            @endif
            @foreach($request_receive as $a => $value)

                @if($a == 0)
                  <td colspan="5">
                @endif
                @if($a < $devider )
                    <div class="media">
                        <div class="media-left">
                        @if(!empty($value->userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$value->userdata->profile_image)) )
                                <img src="{{url('img/frontend/user/profile/'.$value->userdata->profile_image)}}" class="media-object" style="width:30px">
                              @else
                              <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
                            @endif
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">{{$value->user->user_name}}</h6>
                            <p>{{$value->message}}</p>
                        </div>
                    </div>
                @else
                    <div class="media">
                        <div class="media-left">
                        @if(!empty($value->userdata->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$value->userdata->profile_image)) )
                                <img src="{{url('img/frontend/user/profile/'.$value->userdata->profile_image)}}" class="media-object" style="width:30px">
                              @else
                              <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
                            @endif
                        </div>
                        <div class="media-body">
                        <h6 class="media-heading">{{$value->user->user_name}}</h6>
                            <p>{{$value->message}}</p>
                        </div>
                    </div>
                @endif

                @if($a == $devider -1)
                  </td>
                  <td colspan="5">
                @endif
                @if($a == $count-1)
                  </td>
                @endif

            @endforeach
            <!-- <td>Collaboration Sent</td>
            <td colspan="5">
              <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>

        <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
      </td>
            <td colspan="5">
              <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
        <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
            </td>
        </tr>
        <tr>
            <td>Collaboration Received</td>
            <td colspan="5">
        <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
        <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
            </td>
            <td colspan="5">
        <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
        <div class="media">
          <div class="media-left">
            <img src="{{url('img/frontend/user.png')}}" class="media-object" style="width:30px">
          </div>
          <div class="media-body">
            <h6 class="media-heading">John Doe</h6>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
            </td> -->
        </tr>
    </table>
  <div class="btns-div">
      <!-- <a href="{{url('/travel_report')}}" class="btn more_btn">New Travel Report </a>
     create a new "Travel Report" or  a new “Travel Diary” or a new “Travel /Holidays Offert”
      <a href="{{url('/travel_report')}}" class="btn more_btn">New Travel Diary </a> -->
      <a href="{{url('/travel_report')}}" class="btn more_btn">create a new Travel Report</a>
    </div>
</div>
</div>
@push('after-scripts')


<script>
$(".filter_report_btn").on('click', function(){
  //alert();
    var country = $('#country').val();
    var age = $('#age').val();
    var travel_categ = $('#travel_categ').val();
    var travel_type = $('#travel_type').val();
    var vector_type = $('#vector_type').val();
    var type_of_participants = $('#type_of_participants').val();
    var type_of_accommodation = $('#type_of_accommodation').val();
    var preferred_type_formula = $('#preferred_type_formula').val();
    var preferred_travel_budget = $('#preferred_travel_budget').val();
    var preferred_travel_mealtype = '';
    if (typeof $('#preferred_travel_mealtype').val() !== "undefined") {
        preferred_travel_mealtype = $('#preferred_travel_mealtype').val();
    }
    var querystring = "{{ url('/search-reports-pannel') }}?country="+country+"&age="+age+"&travel_categ="+travel_categ+"&travel_type="+travel_type+"&vector_type="+vector_type+"&type_of_participants="+type_of_participants+"&type_of_accommodation="+type_of_accommodation+"&preferred_type_formula="+preferred_type_formula+"&preferred_travel_budget="+preferred_travel_budget+"&preferred_travel_mealtype="+preferred_travel_mealtype
    window.location = querystring;
});

$('#reset_btn').on('click',function(){
    var querystring = "{{url('/control-panel')}}"; //alert(querystring);
    window.location = querystring;

})

</script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css" />
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>


<script>
    function load_data(obj)
    {
        var id = $(obj).attr('id');
        var text = $( "#"+id+" option:selected" ).text();
        var value = $(obj).val();
        $('#'+id+'_a').html(text);
    }
</script>

<script>
    $(document).ready(function(){
        $(".home_filters li").click(function(){
            var li_text       = $(this).html();
            var li_value      = $(this).data('id');
            var anc_id        = $(this).data('email');
            var select_id     = $(this).data('select');
            $("#"+anc_id).html(li_text);
            $("#"+select_id).val(li_value);
        })
    });
</script>

<style type="text/css">
    .control-table .table tr td a{
        color: #fff;
    }

    .control-table .table tr th {
      width: 117px !important;
    }

   /* .booking_form .nav__menu {
      width: 11.1%;
  }*/

</style>
<!-- <script type="text/javascript">
 $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script> -->
@endpush
