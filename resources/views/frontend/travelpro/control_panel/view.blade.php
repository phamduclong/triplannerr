  <style>
  .search_table a{
    color:#fff !important;
  }
</style>
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

  @php if(isset($_GET['report_type']) && !empty($_GET['report_type']))
  {
  $report_type =$_GET['report_type'];

  }
  @endphp

<div class="inner-banner control-banner">
    {{-- @include('frontend.profile-banner') --}}
    <div class="regions_div" id="regions_div" style="width: 100%; height: 700px;" name="{{$userdata}}" countriesOptions="{{$countriesOptions}}"></div>
        {{--  @if(!empty($userdata->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$userdata->cover_image)) )
            <img src="{{url('img/frontend/user/cover/'.$userdata->cover_image)}}" class="img-responsive">
        @else
            <img src="{{url('img/frontend/profile-banner.jpg')}}">
        @endif --}}
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
                    <!-- <th rowspan="2">
                        <img class="active-btn" src="{{ url('img/frontend/active-btn.png') }}">
                        Ascending or descending order
                    </th> -->
                    <td colspan="12">
                      <div class="booking_section">
                        <form id="booking_form" class="booking_form" method="post" action="{{ Route('frontend.filterreport')}}">
                          @csrf
                          <div class="nav">
                              <ul class="nav__list">
                                  <li class="nav__menu">
                                    <a id="country_a" href="javascript:void(0)" ><?php echo (isset($parameters['country']) && !empty($parameters['country'])) ? $country_arr[$parameters['country']] : 'Country' ?></a>
                                    {{ Form::select('country', ['' => 'Country']+$country_arr, $parameters['country'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'country', 'onChange' =>'load_data(this)']) }}
                                    <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                                        @forelse($country_arr  as $key => $value)
                                        <li class="nav__menu-items" data-id="{{ $key }}" data-email="country_a" data-select="country">
                                            {{ $value }}
                                        </li>
                                        @empty

                                        @endforelse
                                    </ul>
                                  </li>

                                  <li class="nav__menu">
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

                                  <li class="nav__menu">
                                      <a id="travel_categ_a" href="javascript:void(0)" ><?php echo (isset($parameters['travel_categ']) && !empty($parameters['travel_categ'])) ? $travel_categ[$parameters['travel_categ']] : 'Travel Category' ?></a>
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

                                  <li class="nav__menu">
                                      <a id="travel_type_a" href="javascript:void(0)" ><?php echo (isset($parameters['travel_type']) && !empty($parameters['travel_type'])) ? $travel_types[$parameters['travel_type']] : 'Travel Type' ?></a>
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

                                  <li class="nav__menu">
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

                                  <li class="nav__menu">
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

                                  <li class="nav__menu">
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

                                  <li class="nav__menu">
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

                                  <li class="nav__menu">
                                      <a id="preferred_travel_mealtype_a" href="javascript:void(0)" ><?php echo (isset($parameters['travel_favoritemealtype']) && !empty($parameters['travel_favoritemealtype'])) ? $travel_budget[$parameters['travel_favoritemealtype']] : 'Type of favorite Meals' ?></a>
                                      <select id="preferred_travel_mealtype" name="preferred_travel_mealtype" onChange = 'load_data(this)' class="form-control tags box-size home-select">
                                          <option value="">Select Budget</option>
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

                                  <li class="nav__menu">
                                      <a id="preferred_travel_budget_a" href="javascript:void(0)" ><?php echo (isset($parameters['preferred_travel_budget']) && !empty($parameters['preferred_travel_budget'])) ? $travel_budget[$parameters['preferred_travel_budget']] : 'Budget' ?></a>
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
                              <div class="clear" style="clear: both; height: 0px"></div>
                          </div>
                          <div class="row">
                              <div class="form-group mx-auto">
                                  <div class=" col-6 btn_srch form_srch" style="float:left;">
                                      <button type="button" name="filter_report_btn" class="btn search_btn form_btn filter_report_btn" id="filter_report_btn" onclick="check()">Search</button>
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
                    <!-- <th>Numbers of Share on Travel Maker</th> -->
                    <th>Numbers of Share on Facebook</th>
                    <!-- <th>Numbers of Share on Twitter</th> -->
                    <!-- <th>ADS</th> -->
                    <th>Travel / Vacation contacts received</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody class="reportdata">
                @foreach($report_data as $travel_report)
                <tr >
                    <td><a href="{{url('view/travel_report/'.$travel_report->slug)}}" style="color: #007bff; font-size: 15px;">
                        {{$travel_report->title}}
                       </a>
                       <b> {{$travel_report->userdata->first_name}} {{$travel_report->userdata->last_name}}</b>
                       <p>Travel Offert</p>
                   </td>
                    <td>{{$travel_report->supers_count}}</td>
                    <td>{{$travel_report->alerts_count}}</td>
                    <td>{{get_sametrip($travel_report->id)}}
                          <a href="{{url('/same-trip',$travel_report->id)}}" style="color: #007bff;">Trip Page</a>
                    </td>
                    <td>{{$followcount}}</td>
                   <!--  <td>000</td> -->
                    <td>{{$countData[$travel_report->id]['fb_count']}}</td>
                   <!--  <td>000</td> -->
                    <td>{{ !empty($travel_report->number_want_infomation) ? $travel_report->number_want_infomation : '0' }}</td>
                    <td class="btn-td">@include('frontend.travelpro.control_panel.action')</td>
                </tr>
                @endforeach
            </tbody>

            <tbody>
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
                  {{-- <td>Collaboration Received</td> --}}
                  <td></td>
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
            </tbody>
        </table>

         <div class="row">
            <div class="col-7">
                <div class="float-left">
                  {{ $report_data->total() }} Record Found
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   {{ $report_data->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
        @if(empty(Auth::user()->security_user))
        @if(Auth::user()->role_type =='travel_agency')
      <div class="btns-div">
          <a href="{{url('/travel_report')}}" class="btn more_btn">Create Travel Offert</a>
      </div>
      @else
      <div class="btns-div">
          <a href="{{url('/travel_report')}}" class="btn more_btn">create a new Travel Report</a>
      </div>
      @endif
      @endif

      <div class="btns-div">
        <button class="btn btn-primary" id="showListParticipate">Show the list of users who have requested information</button>
      </div>
  
      <div class="btns-div">
        <button class="btn btn-primary" id="show-travel">Show the List of Travel Buddy Search you want to join</button>
      </div>

      <div id="listparticipatemodal" class="modal fade notranslate">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 1000px !important;margin-left:-300px">
                <div class="modal-header">
                   <h6 class="modal-title">List Users Want To Participate</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonXParticipateClose">&times;</button>
                </div>
                <div class="modal-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 40%">Travel Buddy Search Name</th>
                        <th scope="col" style="width: 20%">Date</th>
                        <th scope="col" style="width: 20%">User Name</th>
                        <th scope="col" style="width: 20%">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($report_data as $report)
                      @if(!empty($report->userParticipate))
                      @foreach($report->userParticipate as $userparticipate)
                        <tr>
                          <th scope="row">{{ isset($userparticipate->travel_report_name) ? $userparticipate->travel_report_name : '' }}</th>
                          <td>{{ isset($userparticipate->date_click) ? $userparticipate->date_click : '' }}</td>
                          <td><a href="{{ isset($userparticipate->link_profile) ? $userparticipate->link_profile : '' }}" style="color: #007bff">{{ isset($userparticipate->user_name) ? $userparticipate->user_name : '' }}</a></td>
                          <td>{{ isset($userparticipate->user_email) ? $userparticipate->user_email : '' }}</td>
                        </tr>
                      @endforeach
                      @endif
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="buttonParticipateClose">Close</button>
                </div>
            </div>
        </div>
      </div>
  
      <div id="modal-travel" class="modal fade notranslate">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 1000px !important;margin-left:-300px">
                <div class="modal-header">
                   <h6 class="modal-title">Show List Travel</h6>
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 50%">Travel Name</th>
                        <th scope="col" style="width: 20%">Date</th>
                        <th scope="col" style="width: 30%">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($listParticipate))
                        @foreach($listParticipate as $report)
                        <tr>
                          <th scope="row">{{ $report->travel_report_name ? $report->travel_report_name : '' }}</th>
                          <td>{{ Carbon\Carbon::parse($report->date_click)->format('d/m/Y') }}</td>
                          {{-- <td><a href="{{ $report->userParticipate->link_profile }}" style="color: #007bff">{{ $report->userParticipate->user_name }}</a></td> --}}
                          @if(isset($report->travel_report->userdata) && !empty($report->travel_report->userdata))
                            <td>{{ $report->travel_report->userdata->email }}</td>
                          @else
                            <td></td>
                          @endif
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>

      <div class="btns-div" style="margin-top: 30px">
        <h3>Invite a Friend</h3>
      </div>
      @if(empty(Auth::user()->security_user))
        @if(Auth::user()->request_active_invitation == 'accept')
          <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
              <button class="btn btn-success" id="add-new-invitation">Create A New Invitation</button>
            </div>
          </div>
        @endif
      @endif
      <div class="col-md-12" style="margin-top: 20px">
        <div class="row">
          <div class="col-md-2 border border-secondary">Number</div>
          <div class="col-md-2 border border-secondary">Date</div>
          <div class="col-md-2 border border-secondary">Name and Surname</div>
          <div class="col-md-2 border border-secondary">Email address</div>
          <div class="col-md-2 border border-secondary">Contact</div>
          <div class="col-md-2 border border-secondary">Invitation Status</div>
          {{-- <th scope="col">Invitation Accepted</th>
          <th scope="col">Invitation not Accepted</th> --}}
        </div>
        <?php $i = 1; ?>
        <div id="container_invite" numberInvite="{{ count($invitations) }}" registerUrl="{{ $registerUrl }}"></div>
        @foreach($invitations as $invitation)
          <div class="row">
            <div class="col-md-2 border border-secondary" style="padding-top:10px">{{ $i }}</div>
            <div class="col-md-2 border border-secondary" style="padding-top:10px">{{ $invitation->date_invite }}</div>
            <div class="col-md-2 border border-secondary" style="padding-top:10px">{{ $invitation->name }}</div>
            <div class="col-md-2 border border-secondary" style="padding-top:10px">{{ $invitation->email }}</div>
            <div class="col-md-2 border border-secondary"></div>
            @if($invitation->status_invitation == 'pending')
              <div class="col-md-2 border border-secondary" style="padding-top:10px"><img src="{{url('img/frontend/sandClock.png')}}" width="30px" height="30px"></div>
            @endif
            @if($invitation->status_invitation == 'accept')
              <div class="col-md-2 border border-secondary" style="padding-top:10px"><img src="{{url('img/frontend/inviteAccept.png')}}" width="30px" height="30px"></div>
            @endif
            @if($invitation->status_invitation == 'notAccept')
              <div class="col-md-2 border border-secondary" style="padding-top:10px"><img src="{{url('img/frontend/inviteNotAccept.png')}}" width="30px" height="30px"></div>
            @endif
          </div>
        <?php $i++; ?>
        @endforeach
        
        <div id="invite_container"></div>
      </div>
      @if(empty(Auth::user()->security_user))
        @if(empty(Auth::user()->request_active_invitation) || Auth::user()->request_active_invitation == 'notAccept')
          <div class="btns-div" style="margin-top: 30px">
            <button class="btn btn-danger activation-request">Activation Request</button>
          </div>
        @endif
        @if(Auth::user()->request_active_invitation == 'pending')
          <div class="btns-div" style="margin-top: 30px">
            <button class="btn btn-danger">Awaiting Approval</button>
          </div>
        @endif
      @endif

      @if(empty(Auth::user()->security_user))
      <div class="row" style="margin-top: 20px">
        <div class="col-md-3"></div>
        <div class="col-md-9" style="text-align: left">
          <button class="btn btn-secondary" style="width:780px" id="voucherFiveDollar">
            <div id="textVoucherFiveDollar">Request 1 Month of Free Memberschip For every invitation accepted by your colleagues.</div>

            <div class="spinner-border text-primary" role="status" style="display:none" id="loadingVoucherFiveDollar">
              <span class="sr-only">Loading...</span>
            </div>
          </button>
          <button class="btn btn-warning" style="width:780px;margin-top:20px" id="voucherTwentyFiveDollar">
            <div id="textVoucherTwentyFiveDollar">Request 3 Month of Free Memberschip Every 3 invitations accepted by your colleagues.</div>
            <div class="spinner-border text-primary" role="status" style="display:none" id="loadingVoucherTwentyFiveDollar">
              <span class="sr-only">Loading...</span>
            </div>
          </button>
          <button class="btn btn-success" style="width:780px;margin-top:20px" id="voucherFiftyDollar">
            <div id="textVoucherFiftyDollar">Request 1 Year of Free Memberschip Every 10 invitations accepted by your colleagues.</div>
            <div class="spinner-border text-primary" role="status" style="display:none" id="loadingVoucherFiftyDollar">
              <span class="sr-only">Loading...</span>
            </div>
          </button>
        </div>
      </div>
      @endif

      <div class="btns-div" style="margin-top: 30px">
        <h3>Keep in Touch</h3>
    </div>

    <div class="col-md-12">
        <table class="table table-striped table-bordered dt-responsive nowrap">
            <thead class="thead-light">
              <tr>
                <th scope="col">Keep in touch with Triplannerr</th>
                <th scope="col">Community</th>
                <th scope="col">Social Network</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" style="width: 40%;text-align: left">
                    <div style="color: red;margin-top:-30px">Subscribe to the Channels to receive news and updates:</div>
                    <div style="font-weight: bold;margin-top:-30px">Triplannerr Telegram Channel</div>
                    <div style="margin-top:-30px">News and Information about Triplannerr: updates, news and "Travel Reports" that set the trend.</div>
                    <div style="margin-top:-30px;text-align:center"><a href="https://t.me/+PegDB4UtxXMzMDI0"><i id="shareTelegram" class="fa fa-telegram" aria-hidden="true" style="font-size: 3.25em;color:#1E90FF"></i></a></div>
                </th>
                <td style="width: 30%;text-align: left">
                    <div>Join the Facebook Group</div>
                    <div><a href="https://www.facebook.com/groups/triplannerr" style="color: #007bff;text-align:center"><i id="shareFacebook" class="fa fa-facebook-square" style="font-size: 3.25em"></i></a></div>
                </td>
                <td style="width: 30%;text-align: left">
                    <div>Instagram</div>
                    <div><a href="https://www.instagram.com/triplannerr.official/" style="color: red;text-align:center"><i class="fa fa-instagram" style="font-size: 3.25em;"></i></a></div>
                </td>
              </tr>
              <tr>
                <th scope="row" style="width: 40%;text-align: left">
                    <div style="font-weight: bold;margin-top:-30px">Triplannerr “Travel PRO” News</div>
                    <div style="margin-top:-30px">News and updates for the "Travel PRO" profiles in Triplannerr</div>
                    <div style="margin-top:-30px;text-align:center"><a href="https://t.me/+pYY5NkocOAU3M2Q0"><i id="shareTelegram" class="fa fa-telegram" aria-hidden="true" style="font-size: 3.25em;color:#1E90FF"></i></a></div>
                </th>
                <td style="width: 30%;text-align: left">
                    <div>Join the Linkedin Group</div>
                    <div><a href="https://www.linkedin.com/groups/9052174/" style="color: #007bff;text-align:center"><i id="shareLinkedin" class="fa fa-linkedin-square" style="font-size: 3.25em;color:#1E90FF"></i></a></div>
                </td>
                <td style="width: 30%;text-align: left">
                    <div>You Tube</div>
                    <div><a href="https://www.youtube.com/channel/UCilHVL-caUnfmxwPtC-WB6Q" style="color: black;text-align:center"><i class="fa fa-youtube-square" style="font-size: 3.25em;"></i></a></div>
                </td>
              </tr>
              <tr>
                <th scope="row" style="width: 40%;text-align: left">
                    <div style="color: red;margin-top:-30px">Sign up for Telegram Groups to chat with other Triplannerr users:</div>
                    <div style="font-weight: bold;margin-top:-30px">Triplannerr "Travel PRO" Group</div>
                    <div style="margin-top:-30px">Chat reserved for "Travel PRO" profiles in Triplannerr</div>
                    <div style="margin-top:-30px;text-align:center"><a href="https://t.me/+dt5tzJJGkJ40Mzg0"><i id="shareTelegram" class="fa fa-telegram" aria-hidden="true" style="font-size: 3.25em;color:#1E90FF"></i></a></div>
                </th>
                <td></td>
                <td style="width: 30%;text-align: left">
                    <div>Tik Tok</div>
                    <a href="https://www.tiktok.com/@triplannerr?lang=it-IT" style="margin-top:30px;text-align:center">
                      <svg style="margin-top: -24px;background-color:black;border-radius: 8px;padding:5px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                          <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                      </svg>
                    </a>
                </td>
              </tr>
            </tbody>
          </table>
    </div>

    <div class="btns-div" style="margin-top: 30px">
        <h3>Delete Account</h3>
      </div>

      @if(!empty(Auth::user()->security_user) && Auth::user()->security_user == 'pending')
        <div class="btns-div" style="margin-top: 30px">
          <button class="btn btn-danger" id="buttonReactive">
            <div id="textReactive"><a href="{{Route('frontend.reactive_account')}}" style="color: white">Reactivate Your Account</a></div>
            <div class="spinner-border text-light" role="status" style="display:none" id="loadingreactive">
              <span class="sr-only">Loading...</span>
            </div>
          </button>
        </div>
      @else
        <div class="btns-div" style="margin-top: 30px">
          <button class="btn btn-danger" id="buttonCancelAccount">Cancel account</button>
        </div>
      @endif

        <div class="col-md-12">
            <div class="left-report row">
              @if(!empty($ads_data_bottom))
                @foreach($ads_data_bottom as $ads)
                <div class="col-lg-4 col-md-6 col-sm-6">
                  @if($ads->ads_type=='paid' || $ads->ads_type=='free')
                    @if($ads->type=="image")
                     <a href="{{$ads->ad_url}}" onclick="ad_click(this)" data-id="{{$ads->id}}" target="_blank">
                     <h6>{{$ads->title}}</h6>
                     <img style="max-width: 100%; min-height: 190px; height: 173px;" src="{{url('img/backend/advertisement/'.$ads->type_file)}}"></a>
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
                  @endif
                 </div>
                @endforeach
              @endif
            </div>
        </div>
  </div>
</div>
<div id="cancelmodal" class="modal fade notranslate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h6 class="modal-title">Do you really want to permanently delete your account?
                All "Travel Reports" and your profile will be deleted forever.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonXClose">&times;</button>
  
            </div>
         <form method="post" action="{{Route('frontend.delete_account')}}">
            @csrf
            <div class="modal-body" id="cancelaccount">
              <div>
                <input type="radio" name="account" id="cancelAccount" value="cancel">
                <label for="cancelAccount">Yes, I want to delete my account permanently</label>
              </div>
              <div>
                <input type="radio" name="account" id="pendingAccount" value="pending">
                <label for="pendingAccount">Pause your profile</label>
              </div>
            </div>
            <div class="spinner-border text-primary" role="status" style="margin-left:230px;display:none" id="loadingcancelaccount">
              <span class="sr-only">Loading...</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="buttonClose">Close</button>
                <button type="submit" class="btn btn-primary" id="acceptOk">Ok</button>
            </div>
          </form>
        </div>
    </div>
  </div>

@push('after-scripts')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$(".filter_report_btn").on('click', function(){
    var country = $('#country').val();
    var age = $('#age').val();
    var travel_categ = $('#travel_categ').val();
    var travel_type = $('#travel_type').val();
    var vector_type = $('#vector_type').val();
    var type_of_participants = $('#type_of_participants').val();
    var type_of_accommodation = $('#type_of_accommodation').val();
    var preferred_type_formula = $('#preferred_type_formula').val();
    var preferred_travel_budget = $('#preferred_travel_budget').val();
    var preferred_travel_mealtype = $('#preferred_travel_mealtype').val();
    var querystring = "{{ url('/search-reports-pannel') }}?country="+country+"&age="+age+"&travel_categ="+travel_categ+"&travel_type="+travel_type+"&vector_type="+vector_type+"&type_of_participants="+type_of_participants+"&type_of_accommodation="+type_of_accommodation+"&preferred_type_formula="+preferred_type_formula+"&preferred_travel_budget="+preferred_travel_budget+"&preferred_travel_mealtype="+preferred_travel_mealtype
    window.location = querystring;
});

$('#reset_btn').on('click',function(){
    var querystring = "{{url('/control-panel')}}"; //alert(querystring);
    window.location = querystring;

});

var numberOfInvitation = parseInt($('#container_invite').attr('numberInvite')) + 1;
$('#add-new-invitation').click(function(){
  $.ajax({
        data:{numberOfInvitation : numberOfInvitation, '_token' : '{{ csrf_token()}}'},
        type:'get',
        url:'{{url("/add_new_invitation") }}',
        success: function(data){
          $('#invite_container').append(data);
          numberOfInvitation++;
        },
    });
});

$('#voucherFiveDollar').click(function(){
  $('#textVoucherFiveDollar').hide();
  $('#loadingVoucherFiveDollar').show();
  $.ajax({
        data:{typeVoucher : 'voucherOneMonth', '_token' : '{{ csrf_token()}}'},
        type:'get',
        url:'{{url("/check_type_voucher") }}',
        success: function(data){
          alert(data);
          $('#textVoucherFiveDollar').show();
          $('#loadingVoucherFiveDollar').hide();
        },
    });
});

$('#voucherTwentyFiveDollar').click(function(){
  $('#textVoucherTwentyFiveDollar').hide();
  $('#loadingVoucherTwentyFiveDollar').show();
  $.ajax({
        data:{typeVoucher : 'voucherThreeMonth', '_token' : '{{ csrf_token()}}'},
        type:'get',
        url:'{{url("/check_type_voucher") }}',
        success: function(data){
          alert(data);
          $('#textVoucherTwentyFiveDollar').show();
          $('#loadingVoucherTwentyFiveDollar').hide();
        },
    });
});

$('#voucherFiftyDollar').click(function(){
  $('#textVoucherFiftyDollar').hide();
  $('#loadingVoucherFiftyDollar').show();
  $.ajax({
        data:{typeVoucher : 'voucherOneYear', '_token' : '{{ csrf_token()}}'},
        type:'get',
        url:'{{url("/check_type_voucher") }}',
        success: function(data){
          alert(data);
          $('#textVoucherFiftyDollar').show();
          $('#loadingVoucherFiftyDollar').hide();
        },
    });
});

// $('#share_telegram').click(function(){
$(document).on("click", '#share_telegram', function(event) { 
  var shareUrl = $('#container_invite').attr('registerUrl');
  var title = "Hello, I thought I'd invite you to Triplannerr.com, the new website that will allow you to organize your trips in total autonomy. You will be able to find all the information you need for FREE plan every detail of your trip avoiding any form of intermediation. Sign up, it's FREE";
  link = 'https://telegram.me/share/url?url='+shareUrl+'&text='+title;
  // link = 'https://telegram.me/share/url?url='+shareUrl;
  window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
  setTimeout(() => {
    $('#controlPannelBody').css('opacity', '0.5');
    $('#sendInvitation').click();
  }, 3000);
});
// $('#shareWhatsapp').click(function(){
$(document).on("click", '#shareWhatsapp', function(event) {
  var title = "Hello, I thought I'd invite you to Triplannerr.com, the new website that will allow you to organize your trips in total autonomy. You will be able to find all the information you need for FREE plan every detail of your trip avoiding any form of intermediation. Sign up, it's FREE";
  var shareUrl = title + ". To Register Please Access This Link: " + $('#container_invite').attr('registerUrl');
  link = 'https://api.whatsapp.com/send?text='+shareUrl;
  // link = 'https://api.whatsapp.com/send?url='+shareUrl+'&text='+title;
  window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");
  setTimeout(() => {
    $('#controlPannelBody').css('opacity', '0.5');
    $('#sendInvitation').click();
  }, 3000);
});

var userdata = JSON.parse($('#regions_div').attr('name'));
var place_of_residence = userdata.place_of_residence;
var fav_nation = userdata.fav_nation.split(', ');
var fav_nation_want = userdata.fav_nation_want.split(', ');
var allCountries = JSON.parse($('#regions_div').attr('countriesOptions'));
var list = [
  ['Country', 'Value', {role: 'tooltip', p:{html:true}}],
];
for(var i = 0 ; i < allCountries.length; ++i){
  list.push([
    allCountries[i],
    700,
    ''
  ]);
}
for(var i = 0; i < fav_nation.length; ++i){
  list.push([
    fav_nation[i],
    400,
    ''
  ]);
}
for(var i = 0; i < fav_nation_want.length; ++i){
  list.push([
    fav_nation_want[i],
    500,
    ''
  ]);
}
list.push([
  place_of_residence,
  200,
  ''
]);

  google.charts.load('current', {
    'packages':['geochart'],
    'mapsApiKey': 'AIzaSyCGrOHkMNJxFTIBIXK4TV5qS-yffxIaSxI'
  });
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable(
      list
    );

    var options = {
      colorAxis: {colors: ['#32CD32', 'blue', 'red', 'gray']},
      backgroundColor: '#81d4fa',
      datalessRegionColor: 'gray',
      defaultColor: '#f5f5f5',
      legend: 'none',
      keepAspectRatio: false,
      tooltip: {
        isHtml: true
      }
    };

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);
  }
</script>

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

<script type="text/javascript">
    //  $(document).ready(function() {
    //     $('#example').DataTable( {
    //         "order": [[ 3, "desc" ]]
    //     } );
    // } );
    
     if ( $.fn.dataTable.isDataTable( '#example' ) ) {
        table = $('#example').DataTable();
    }
    else {
        table = $('#example').DataTable( {
            paging: false
        } );
    }
    
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $('#buttonCancelAccount').click(function(){
      $('#cancelmodal').modal('show');
    });

    $('#acceptOk').click(function(){
      $('#loadingcancelaccount').show();
    });
    $('#buttonClose').click(function(){
      $('#cancelmodal').modal('hide');
    });
    $('#buttonXClose').click(function(){
      $('#cancelmodal').modal('hide');
    });

    $('#buttonReactive').click(function(){
      $('#textReactive').hide();
      $('#loadingreactive').show();
    });

    $('#showListParticipate').click(function(){
      $('#listparticipatemodal').modal('show');
    });

    $('#buttonXParticipateClose').click(function(){
      $('#listparticipatemodal').modal('hide');
    });
    $('#buttonParticipateClose').click(function(){
      $('#listparticipatemodal').modal('hide');
    });

    $('#show-travel').click(function(){
      $('#modal-travel').modal('show');
    });

    $('.close-modal').click(function(){
      $('#modal-travel').modal('hide');
    });
  });
</script>

<style type="text/css">
    .control-table .table tr td a{
        color: #fff;
    }
</style>

@include('frontend.request_invitation')

@endpush
