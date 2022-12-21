<style>
.badge-icon.chagecss {
    position: absolute;
    top: 1%;
    left: 7%;
    width: 150px;
    height: 100px;
}
.search_table a{
    color:#fff !important;

  }
</style>
<div class="inner-banner control-banner">
    @include('frontend.profile-banner')
    {{--  @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )
            <img src="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" class="img-responsive">
        @else
            <img src="{{url('img/frontend/profile-banner.jpg')}}">
        @endif --}}
        {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}">
        <div class="container-fluid">
            <p class="banner-txt">"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
        </div>
        <div class="badge-icon chagecss">
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
        <th rowspan="1"><img class="active-btn" src="img/frontend/active-btn.png">Show all my Travel Reports</th>
        <td colspan="10"><div class="booking_section">
        <form id="booking_form" class="booking_form" method="post" action="#">
       @csrf

      <div class="nav">
        <ul class="nav__list">

          <li class="nav__menu search_table">
              <a id="country_a" href="javascript:void(0)" >Country</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                  <li class="nav__menu-items">
                      {{ Form::select('country', ['' => 'Select country']+$country_arr, $parameters['country'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'country', 'onChange' =>'load_data(this)']) }}
                  </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="age_a" href="javascript:void(0)" >Age</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                  <li class="nav__menu-items">
                    {{ Form::select('age', ['' => 'Select age']+$travel_ages, $parameters['age'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'age', 'onChange' =>'load_data(this)']) }}
                  </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="travel_categ_a" href="javascript:void(0)" >Travel Category</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                  <li class="nav__menu-items">
                      {{ Form::select('travel_categ', ['' => 'Select category']+$travel_categ, $parameters['travel_categ'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'travel_categ', 'onChange' =>'load_data(this)']) }}
                  </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="travel_type_a" href="javascript:void(0)" >Travel Type</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                <li class="nav__menu-items">
                  {{ Form::select('travel_type', ['' => 'Select type']+$travel_types, $parameters['travel_type'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'travel_type', 'onChange' =>'load_data(this)']) }}
                </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="vector_type_a" href="javascript:void(0)" >Vector Type</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                  <li class="nav__menu-items">
                      {{ Form::select('vector_type', ['' => 'Select type']+$travel_vectors, $parameters['vector_type'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'vector_type', 'onChange' =>'load_data(this)']) }}
                  </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="type_of_accommodation_a" href="javascript:void(0)" >Type of Accomodation</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                  <li class="nav__menu-items">
                      {{ Form::select('type_of_accommodation', ['' => 'Select type']+$travel_accommodations, $parameters['travel_accommodations'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'type_of_accommodation', 'onChange' =>'load_data(this)']) }}
                  </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="type_of_participants_a" href="javascript:void(0)" >Type of Partecipants</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                  <li class="nav__menu-items">
                      {{ Form::select('type_of_participants', ['' => 'Select type']+$travel_participates, $parameters['travel_participates'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'type_of_participants', 'onChange' =>'load_data(this)']) }}
                  </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="preferred_type_formula_a" href="javascript:void(0)" >Preferred Stay Formula</a>
              <ul class="nav__menu-lists nav__menu--1-lists">
                <li class="nav__menu-items">
                {{ Form::select('preferred_type_formula', ['' => 'Select type']+$travel_formula, $parameters['preferred_type_formula'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'preferred_type_formula', 'onChange' =>'load_data(this)']) }}
                </li>
              </ul>
          </li>

          <li class="nav__menu search_table">
              <a id="preferred_travel_budget_a" href="javascript:void(0)" >Budget</a>

              <ul class="nav__menu-lists nav__menu--1-lists">
                  <li class="nav__menu-items">
                  {{ Form::select('preferred_travel_budget', ['' => 'Select type']+$travel_budget, $parameters['preferred_travel_budget'] ?? null, ['class' => 'form-control tags box-size', 'id' => 'preferred_travel_budget', 'onChange' =>'load_data(this)']) }}
                  </li>
              </ul>
          </li>

        </ul>
      </div>

      <div class="form-group col-md-12 btn_srch form_srch">
        <button type="button" name="filter_report_btn" class="btn search_btn form_btn" id="filter_report_btn">Search</button>
      </div>

    </form>
      </td>
      </tr>
        <tr>
          <th>Ascending or descending order</th>
            <th>Super!</th>
            <th>Alert</th>
            <th>Same Trip</th>
            <th>Followers</th>
            <th>Numbers of Share on Travel Maker</th>
            <th>Numbers of Share on Facebook</th>
            <th>Numbers of Share on Instagram</th>
            <th>Numbers of Share on Twitter</th>
            <th>ADS</th>
        </tr>
      </thead>
      <tbody>
   @foreach($travel_reports as $travel_report)
        <tr >
            <td><a href="#">{{$travel_report->title}}</a></td>
            <td>{{$travel_report->supers_count}}</td>
            <td>{{$travel_report->alerts_count}}</td>
            <td>{{get_sametrip($travel_report->id)}}
                        <a href="{{url('/same-trip',$travel_report->id)}}">Trip Page</a>
            </td>
            <td>000</td>
            <td>000</td>
            <td>000</td>
            <td>000</td>
            <td>000</td>
            <td>000</td>
        </tr>
        @endforeach

       @if(count($request_receive)>0)
        <tr>
            <td>Collaboration Sent</td>
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
        @endif
       @if(count($request_receive)>0)
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
        </tr>
        @endif
      </tbody>
    </table>
  <div class="btns-div">
      <a href="{{url('/travel_report')}}" class="btn more_btn">create a new Travel Report</a>
    </div>
</div>
